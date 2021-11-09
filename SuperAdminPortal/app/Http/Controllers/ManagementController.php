<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dinner;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantUser;
use App\Models\User;
use App\Models\Product;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ManagementController extends Controller
{
    public function home()
    {
        $navs = [
            [
                [
                    'title' => 'Admin Users',
                    'link' => 'manage.accounts.home',
                    'icon' => 'fas fa-user',
                ],
                [
                    'title' => 'Manage Restaurants',
                    'link' => 'manage.restaurants.home',
                    'icon' => 'fas fa-store-alt',
                ],
                [
                    'title' => 'Statistics & Analysis',
                    'link' => 'manage.statistics.home',
                    'icon' => 'fa fa-chart-bar',
                ],
            ],
        ];
        return view('pages.management.home', compact('navs'));
    }

    //Accounts Route Functions.
    public function account()
    {
        $users = User::get();
        if (request()->searchKey && request()->searchKey !== '') {
            $usersFilter = $users->filter(function ($value) {
                return stripos($value->firstname, request()->searchKey) !==
                    false ||
                    stripos($value->lastname, request()->searchKey) !== false ||
                    stripos($value->email, request()->searchKey) !== false ||
                    stripos($value->number, request()->searchKey) !== false ||
                    stripos($value->restaurant->name, request()->searchKey) !== false;
            });
            if (count($usersFilter) <= 0) {
                session()->flash(
                    'search_message',
                    'No result found for search key: ' . request()->searchKey
                );
            }
            $users = count($usersFilter) > 0 ? $usersFilter : $users;
        }
        return view('pages.management.accounts.list', compact('users'));
    }

    public function createAccount()
    {
        return view('pages.management.accounts.create');
    }

    public function storeAccount()
    {
        $validator = Validator::make(request()->all(), [
            'profile_pic' =>
                'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|unique:users,email',
            'firstname' => 'required',
            'lastname' => 'required',
            'number' => 'required|unique:users,number|phone:AUTO,AU',
            'access_rights' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        $password = Str::random(10);
        request()['password'] = Hash::make($password);
        $user = User::create(request()->all());
        // Upload image
        if (request()->has('profile_pic')) {
            $image = request()->file('profile_pic');
            $name =
                $user->id .
                '_' .
                $user->email .
                '_profile_pic' .
                '.' .
                $image->getClientOriginalExtension();
            $folder = '/uploads/superAdmin/profile';
            $filePath = $this->uploadOne($image, $folder, $name);
            $user->profile_pic = $filePath;
            $user->save();
        }
        $user->activated = false;
        $user->save();
        try {
            $data = [
                'password' => $password,
                'type' => 'super admin',
                // 'login_url' => config('app.url') . '/login',
                'login_url' => 'https://superadmindev.menuplus.com.au/login',
            ];
            $user->notify(new WelcomeEmailNotification($data));
            DB::commit();
        } catch (\Exception $exception) {
            logger("Could not add User Account.");
            Log::error(['Error' => $exception->getMessage()]);
            $user = null;
            DB::rollBack();
        }
        session()->flash(
            ($user ? 'success' : 'error') . '_message',
            $user
                ? 'You have successfully added the user account: ' .
                    (request()->firstname . ' ' . request()->lastname)
                : 'Sorry, could not add user account.'
        );
        return redirect()->route('manage.accounts.home');
    }

    public function editAccount($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('pages.management.accounts.edit', compact('user'));
        }
        return redirect()->route('manage.accounts.home');
    }

    public function updateAccount($id)
    {
        $this->validate(request(),[
            'number' => 'required|phone:AUTO,AU',
        ]);

        $user = User::find($id);
        if ($user) {
            $update = $user->update(request()->all());
            // Upload image
            if (request()->profile_pic) {
                $image = request()->file('profile_pic');
                $name =
                    $user->id .
                    '_' .
                    $user->email .
                    '_profile_pic' .
                    '.' .
                    $image->getClientOriginalExtension();
                $folder = '/uploads/superAdmin/profile';
                $filePath = $this->uploadOne($image, $folder, $name);
                $user->profile_pic = $filePath;
                $user->save();
            }
        }
        session()->flash(
            ($update ? 'success' : 'error') . '_message',
            $update
                ? 'You have successfully updated the user account: ' .
                    (request()->firstname . ' ' . request()->lastname)
                : 'Sorry, could not add user account.'
        );
        return redirect()->back();
    }

    public function deleteAccount($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->deleteOne($user->profile_pic);
            $user->delete();
            session()->flash(
                ($user ? 'success' : 'error') . '_message',
                $user
                    ? 'You have successfully deleted the user account: ' .
                        ($user->firstname . ' ' . $user->lastname)
                    : 'Sorry, could not delete user account.'
            );
            return redirect()->back();
        }
        return redirect()->route('manage.accounts.home');
    }

    //Restaurant Route Functions.
    public function restaurants()
    {
        $restaurants = Restaurant::with('user')->get();
        $filter = 'all';
        $searchKey = null;
        if(request()->filter && request()->filter !== 'all'){
            if(request()->filter == 'active'){
                $restaurantsFilter = $restaurants->filter(function ($value) {
                    return $value->status == true;
                });
                $filter = 'active';
            }else if(request()->filter == 'inactive'){
                $restaurantsFilter = $restaurants->filter(function ($value) {
                    return $value->status == false;
                });
                $filter = 'inactive';
            }
            $restaurants =
                count($restaurantsFilter) > 0
                    ? $restaurantsFilter
                    : $restaurants;
        }
        if (request()->searchKey && request()->searchKey !== '') {
            $restaurantsFilter = $restaurants->filter(function ($value) {
                return stripos($value->name, request()->searchKey) !== false ||
                    stripos($value->address, request()->searchKey) !== false ||
                    stripos($value->email, request()->searchKey) !== false ||
                    stripos($value->phone_number, request()->searchKey) !==
                        false;
            });
            if (count($restaurantsFilter) <= 0) {
                session()->flash(
                    'search_message',
                    'No result found for search key: ' . request()->searchKey
                );
            }
            $restaurants =
                count($restaurantsFilter) > 0
                    ? $restaurantsFilter
                    : $restaurants;
            
            $searchKey = request()->searchKey;
        }
        $data = [
            'restaurants' => $restaurants,
            'filter' => $filter,
            'searchKey' => $searchKey,
        ];
        return view('pages.management.restaurants.list', $data);
    }

    public function createRestaurants()
    {
        return view('pages.management.restaurants.create-edit');
    }

    public function editRestaurant($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant) {
            return view(
                'pages.management.restaurants.create-edit',
                compact('restaurant')
            );
        }
        return redirect()->route('manage.restaurants.list');
    }

    public function updateRestaurant($id)
    {
        $validator = Validator::make(request()->all(), [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'suburb' => 'required',
            'post_code' => 'required',
            'address' => 'required',
            'phone_number' => 'required|phone:AUTO,AU',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $restaurant = Restaurant::find($id);
        if ($restaurant) {
            $restaurant->update(request()->all());
    
            // Upload image
            if (request()->has('logo')) {
                $image = request()->file('logo');
                $name =
                    $restaurant->id .
                    '_logo' .
                    '.' .
                    $image->getClientOriginalExtension();
                $folder = '/uploads/restaurants';
                $filePath = $this->uploadOne($image, $folder, $name);
                $restaurant->logo = $filePath;
                $restaurant->save();
            }
            $restaurant->save();
            session()->flash(
                ($restaurant ? 'success' : 'error') . '_message',
                $restaurant
                    ? 'You have successfully Updated the Restaurant: ' .
                        request()->name
                    : 'Sorry, could not Update Restaurant Information.'
            );
        }
        return redirect()->back();
    }

    public function deleteRestaurant($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant) {
            $this->deleteOne($restaurant->logo);
            $restaurant->delete();
            session()->flash(
                ($restaurant ? 'success' : 'error') . '_message',
                $restaurant
                    ? 'You have successfully deleted restaurant: ' .
                        $restaurant->name
                    : 'Sorry, could not delete restaurant.'
            );
            return redirect()->back();
        }
        return redirect()->route('manage.restaurants.list');
    }

    public function addRestaurant()
    {
        $validator = Validator::make(request()->all(), [
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'password' => 'required|min:10',
            'address' => 'required',
            'email' => 'required|unique:restaurant_users,email',
            'fullname' => 'required',
            'phone_number' => 'required|phone:AUTO,AU',
        ]);
        if ($validator->fails()) {
            Log::warning('Validation Error', [$validator->errors()]);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        // DB::beginTransaction();
        $restaurant = Restaurant::create(request()->all());
        // add restaurant user
        // $password = Str::random(10);
        // request()['password'] = Hash::make($password);
        request()['password'] = Hash::make(request()->input('password'));
        $restaurant->user()->create(request()->all());
        // Upload image
        if (request()->has('logo')) {
            $image = request()->file('logo');
            $name =
                $restaurant->id .
                '_logo' .
                '.' .
                $image->getClientOriginalExtension();
            $folder = '/uploads/restaurants';
            $filePath = $this->uploadOne($image, $folder, $name);
            $restaurant->logo = $filePath;
            $restaurant->save();
        }
        $restaurant->save();
        // Send email to user about their new account
        // try {
        //     $data = [
        //         'password' => $password,
        //         'type' => 'restaurant admin',
        //         'login_url' => config('app.restaurant_url') . '/login',
        //     ];
        //     $restaurant->user->notify(new WelcomeEmailNotification($data));
        //     DB::commit();
        // } catch (\Exception $exception) {
        //     Log::error(['Error' => $exception->getMessage()]);
        //     $restaurant = null;
        //     DB::rollBack();
        // }
        session()->flash(
            ($restaurant ? 'success' : 'error') . '_message',
            $restaurant
                ? 'You have successfully added the restaurant: ' .
                    request()->name
                : 'Sorry, could not add restaurant.'
        );
        return redirect()->route('manage.restaurants.subscribe', ['id' => $restaurant->id]);
    }

    public function viewRestaurant($id)
    {
        $reports = [];
        $restaurant = Restaurant::with('user')
            ->with('subscriptions')
            ->where('id', $id)
            ->first();

        $plans = [];

        foreach ($restaurant->subscriptions as $subscribe) {
            $plans[] = SubscriptionPlan::with('product')->find($subscribe->plan_id);
        }
        
        $data = [
            'reports' => $reports,
            'restaurant' => $restaurant,
            'plans' => $plans,
        ];

        return view('pages.management.restaurants.details', $data);
    }

    public function updateRestaurantUser($id)
    {
        $validator = Validator::make(request()->all(), [
            'fullname' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|phone:AUTO,AU',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $restaurantUser = RestaurantUser::find($id);
        if ($restaurantUser) {
            $restaurantUser->update(request()->all());
            $restaurantUser->save();
            session()->flash(
                ($restaurantUser ? 'success' : 'error') . '_message',
                $restaurantUser
                    ? 'You have successfully Updated the Information of Account Owner: ' .
                        request()->fullname
                    : 'Sorry, could not Update Account Owner information.'
            );
        }
        return redirect()->back();
    }

    public function resetRestaurantUserPassword($id)
    {
        $restaurantUser = RestaurantUser::find($id);
        if($restaurantUser){
            $new_password = Str::random(10);
            $restaurantUser->password = Hash::make($new_password);
            $restaurantUser->save();

            session()->flash('new_password', $new_password);
            session()->flash(
                ($restaurantUser ? 'success' : 'error') . '_message',
                $restaurantUser
                    ? 'You have successfully Reset the Account Owner Password.'
                    : 'Sorry, Account Owner Password Reset Failed.'
            );
        }
        return redirect()->back();
    }

    public function activation($id)
    {        
        $restaurant = Restaurant::find($id);
        $restaurant->status = true;
        $restaurant->save();

        return ($restaurant)? true : false;
    }

    public function subscribe($id)
    {
        $restaurant = Restaurant::find($id);

        $products = Product::all();
        $plans = SubscriptionPlan::all();

        $data = [
            'restaurant' => $restaurant,
            'plans' => $plans,
            'products' => $products,
        ];

        return view('pages.management.restaurants.subscribe', $data);
    }
    
    public function setSubscribe($id)
    {
        $products = Product::all();
        foreach ($products as $product) {
            if(request()->has('plan_' . $product->id)){
                $subscribe = Subscription::where('restaurant_id', $id)
                                        ->where('product_id', $product->id)
                                        ->first();
                if ($subscribe) {
                    $subscribe->plan_id = request()->input('plan_' . $product->id);
                    $subscribe->save();
                }else{
                    $subscribe = new Subscription();
                    $subscribe->plan_id = request()->input('plan_' . $product->id);
                    $subscribe->restaurant_id = $id;
                    $subscribe->product_id = $product->id;
                    $subscribe->status = true;
                    $subscribe->save();
                }
            }
        }

        $activate = $this->activation($id);

        session()->flash(
            (($subscribe && $activate)? 'success' : 'error') . '_message',
            ($subscribe && $activate) ? 'Subscription is successful.' : 'Subscription Failed.'
        );

        return redirect()->route('manage.restaurants.view', ['id' => $id]);

    }

    public function editSubscribe($id)
    {
        $selected_subscription = Subscription::with('restaurant')
                                            ->with('product')
                                            ->where('plan_id', $id)->first();

        $plans = SubscriptionPlan::where('product_id', $selected_subscription->product_id)->get();
        // dd($plans);
        $data = [
            'subscribed' => $selected_subscription,
            'plans' => $plans,
        ];

        return view('pages.management.restaurants.edit-subscribe', $data);
    }

    public function updateSubscribe($id)
    {
        $subscribe = Subscription::with('restaurant')
                                ->where('restaurant_id', $id)
                                ->where('product_id', request()->input('product_id'))
                                ->first();

        $subscribe->plan_id = request()->input('plan_' . request()->input('product_id'));
        $subscribe->save();

        session()->flash(
            ($subscribe ? 'success' : 'error') . '_message',
            $subscribe ? 'Subscription updated  successfully.' : 'Subscription Update Failed.'
        );

        return redirect()->route('manage.restaurants.view', ['id' => $subscribe->restaurant->id]);
    }

    //Statistics Route Functions.
    public function statistics()
    {
        $orders = Order::count();
        $statistics = ['orders' => $orders];
        return view('pages.management.statistics.home', compact('statistics'));
    }
}
