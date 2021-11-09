<?php

namespace App\Http\Controllers;

use App\Models\Dinner;
use App\Models\DinningArea;
use App\Models\Dish;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\User;
use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function sandboxdashboard(){
        $navs = [
            [
                ['title' => 'Manage Tables', 'link' => 'dashboard.tables.home', 'icon' => 'fas fa-utensils'],
                ['title' => 'Manage Menus', 'link' => 'dashboard.menus.home', 'icon' => 'fa fa-file-alt'],
                ['title' => 'Manage Bookings', 'link' => 'dashboard.bookings.home', 'icon' => 'fa fa-book'],
            ],
            [
                [
                    'title' => 'Manage Staffs',
                    'link' => 'dashboard.staff.list',
                    'icon' => 'fa fa-address-book',
                ],
                [
                    'title' => 'Manage Customers',
                    'link' => 'dashboard.customers',
                    'icon' => 'fa fa-user',
                ],
                // [
                //     'title' => 'Statistic Report',
                //     'link' => 'dashboard.reports',
                //     'icon' => 'fas fa-file-contract',
                // ],
            ],
        ];

        return view('layouts.sandbox', compact('navs'));    }
    public function dashboard()
    {
        $navs = [
            [
                ['title' => 'Manage Tables', 'link' => 'dashboard.tables.home', 'icon' => 'fas fa-utensils'],
                ['title' => 'Manage Menus', 'link' => 'dashboard.menus.home', 'icon' => 'fa fa-file-alt'],
                ['title' => 'Manage Bookings', 'link' => 'dashboard.bookings.home', 'icon' => 'fa fa-book'],
            ],
            [
                [
                    'title' => 'Manage Staffs',
                    'link' => 'dashboard.staff.list',
                    'icon' => 'fa fa-address-book',
                ],
                [
                    'title' => 'Manage Customers',
                    'link' => 'dashboard.customers',
                    'icon' => 'fa fa-user',
                ],
                // [
                //     'title' => 'Statistic Report',
                //     'link' => 'dashboard.reports',
                //     'icon' => 'fas fa-file-contract',
                // ],
            ],
        ];

        return view('pages.dashboard.home', compact('navs'));
    }

    public function tables()
    {
        $tableNav = [
            [
                ['title' => 'Manage Dining Areas', 'link' => 'dashboard.tables.managedinningareas', 'icon' => 'fas fa-utensils'],
                ['title' => 'Manage Tables', 'link' => 'dashboard.tables.managetables', 'icon' => 'fas fa-chair'],
            ],
        ];

        return view('pages.dashboard.tables.home', compact('tableNav'));
    }
    public function manageDinningAreas()
    {
        $dinningAreas = DinningArea::where(
            'restaurant_ID',
            auth()->user()->restaurant_id
        )->get();
        $dinningAreas = $dinningAreas->isEmpty() ? null : $dinningAreas;
        $tables = Table::where('restaurant_id', auth()->user()->restaurant_id)
            ->orderby('number', 'asc')
            ->get();
        $tables = $tables->isEmpty() ? null : $tables;
        $data = [
            'dinningAreas' => $dinningAreas,
            'tables' => $tables,
        ];
        return view('pages.dashboard.dinning-area.create')->with($data);
    }

    public function menus()
    {
        $menus = Menu::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )->get();
        $menusNav = [];
        if ($menus->isNotEmpty()) {
            foreach ($menus as $menu) {
                $menusNav[] = [
                    'title' => $menu->name,
                    'link' => 'dashboard.menus.show',
                    'id' => $menu->id,
                ];
            }
        }

        return view('pages.dashboard.menus.home', compact('menusNav'));
    }

    public function dinningArea()
    {
        $dinningAreas = DinningArea::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )->get();
        $dinningAreasNav = [];
        if ($dinningAreas->isNotEmpty()) {
            foreach ($dinningAreas as $area) {
                $dinningAreasNav[] = [
                    'id' => $area->id,
                    'title' => $area->name,
                    'link' => 'dashboard.tables.managetables',
                ];
            }
        }
        return view(
            'pages.dashboard.dinning-area.list',
            compact('dinningAreasNav')
        );
    }

    public function showMenu($id)
    {
        $menu = Menu::find($id);
        $dishes = Dish::where('menu_id', $menu->id)->get();
        $dishes = $dishes->isEmpty() ? null : $dishes;

        if (request()->searchKey && request()->searchKey !== '' & $dishes != null) {
            $dishesFilter = $dishes->filter(function ($value) {
                return stripos($value->name, request()->searchKey) !== false ;
            });
            if (count($dishesFilter) <= 0) {
                session()->flash(
                    'search_message',
                    'No result found for search key: ' . request()->searchKey
                );
            }
            $dishes = count($dishesFilter) > 0 ? $dishesFilter : $dishes;
        }

        $data = [
            'menu' => $menu,
            'dishes' => $dishes,
            'id' => $id,
        ];
        return view('pages.dashboard.menus.showMenu')->with($data);
    }

    public function bookings()
    {
        return view('pages.dashboard.bookings.home');
    }

    public function getSelectedBooking()
    {
        return View::make('pages.dashboard.bookings.selected-bookings', [
            'date' => request()->date,
        ]);
    }

    public function createMenu()
    {
        return view('pages.dashboard.menus.createMenu');
    }

    public function createDinningArea()
    {
        return view('pages.dashboard.dinning-area.create');
    }

    public function storeDinningArea()
    {
        $this->validate(request(), [
            'name' => 'required|string',
        ]);
        request()['restaurant_id'] = auth()->user()->restaurant_id;
        $dinningArea = DinningArea::create(request()->all());
        session()->flash(
            ($dinningArea ? 'success' : 'error') . '_message',
            $dinningArea
            ? 'You have successfully add the dinning area: ' .
            request()->name
            : 'Sorry, could not add dinning area.'
        );

        return redirect()->back();
    }
    public function deleteDinningArea($id)
    {
        $dinningArea = DinningArea::find($id);
        $name = $dinningArea->name;

        $tables = Table::where('dining_area_id', $id)->get();
        if ($tables->isNotEmpty()) {
            foreach ($tables as $table) {
                $table->dining_area_id = null;
                $table->save();
            }
        }
        $dinningArea->delete();

        session()->flash(
            'error_message',
            'You have successfully deleted the Dinning Area: ' . $name
        );
        return redirect()->back();
    }
    public function showAssignTables($id)
    {
        $dinningArea = DinningArea::find($id);
        $assignedTables = Table::where('dining_area_id', $id)
            ->orderby('number', 'asc')
            ->get();
        $assignedTables = $assignedTables->isEmpty() ? null : $assignedTables;

        $unassignedTables = Table::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )
            ->where('dining_area_id', null)
            ->orderby('number', 'asc')
            ->get();
        $unassignedTables = $unassignedTables->isEmpty()
        ? null
        : $unassignedTables;

        $data = [
            'dinningArea' => $dinningArea,
            'assignedTables' => $assignedTables,
            'unassignedTables' => $unassignedTables,
        ];
        return view('pages.dashboard.dinning-area.assign')->with($data);
    }
    public function assignTableToDinningArea($id)
    {
        $this->validate(request(), [
            'tables' => 'array',
        ]);
        $selected_tables = request()->tables;
        if (!empty($selected_tables)) {
            foreach ($selected_tables as $key => $value) {
                $table = Table::find($value);
                $table->dining_area_id = $id;
                $table->save();
            }
            session()->flash(
                'success_message',
                'You have successfully Assigned Tables to Dinning Area'
            );
        } else {
            session()->flash('error_message', 'No Tables was Selected');
        }
        return redirect()->back();
    }
    public function clearAssigned($id)
    {
        $table = Table::find($id);
        $number = $table->number;
        $table->dining_area_id = null;
        $table->save();

        session()->flash(
            'error_message',
            'Tables ' . $number . ' UnAssigned from Dinning Area.'
        );
        return redirect()->back();
    }

    public function storeTable()
    {
        $this->validate(request(), [
            'number' => 'required|numeric|gte:1',
            'capacity' => 'required|numeric|gte:1',
        ]);
        request()['restaurant_id'] = auth()->user()->restaurant_id;
        $table = Table::create(request()->all());
        session()->flash(
            ($table ? 'success' : 'error') . '_message',
            $table
            ? 'You have successfully add the Table: ' . request()->number
            : 'Sorry, could not add Table.'
        );

        return redirect()->back();
    }
    public function deleteTable($id)
    {
        $table = Table::find($id);
        $number = $table->number;
        $table->delete();

        session()->flash(
            'error_message',
            'You have successfully Deleted Table: ' . $number
        );
        return redirect()->back();
    }

    public function manageTables()
    {
        return view('pages.dashboard.tables.manageTable');
    }

    public function addMenu(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        request()['restaurant_ID'] = auth()->user()->restaurant_id;
        $menu = Menu::create($request->all());
        // Upload image
        if (request()->has('image')) {
            $image = request()->file('image');
            $name = $menu->id . '_image' . '.' . $image->getClientOriginalExtension();
            $folder = '/uploads/menus';
            $filePath = $this->uploadOne($image, $folder, $name);
            $menu->image = $filePath;
            $menu->save();
        }
        session()->flash(
            ($menu ? 'success' : 'error') . '_message',
            $menu
            ? 'You have successfully created The Menu: ' . $request->name
            : 'Sorry, could not add Menu.'
        );

        return redirect()->route('dashboard.menus.home');
    }
    public function createDish()
    {
        $menus = Menu::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )->get();
        if ($menus->isEmpty()) {
            session()->flash(
                'error_message',
                'Create Menu Before you can Add Dishes.'
            );

            return redirect()->back();
        }

        return view('pages.dashboard.menus.createDish')->with('menus', $menus);
    }
    public function addDish(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'chef_note' => 'required|string',
            'price' => 'required|numeric|gt:0',
            'CKPref.*.name' => 'string',
            'CKPref.*.addcost' => 'numeric|gte:0',
            'SD.*.name' => 'string',
            'SD.*.price' => 'numeric|gte:0',
            'menu_id' => 'required|integer',
            'image_1' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'image_2' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'image_3' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'SD.*.img' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        //Create Dish
        $dish = new Dish();
        $dish->menu_id = (int) $request->input('menu_id');
        $dish->name = $request->input('name');
        $dish->description = $request->input('description');
        $dish->chef_note = $request->input('chef_note');
        $dish->price = (float) $request->input('price');
        $dish->currency = 'AUD';
        // Upload image 1
        if (request()->has('image_1')) {
            $image = request()->file('image_1');
            //get File with extension
            $filenameWithExt = $image->getClientOriginalName();
            //get just the file name.
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get file extension
            $extension = $request
                ->file('image_1')
                ->getClientOriginalExtension();
            //file name to store
            $name = $filename . '_' . time() . '.' . $extension;
            $folder = '/uploads/dishes';
            $filePath = $this->uploadOne($image, $folder, $name);
            $dish->image_1 = $filePath;
        }
        // Upload image 2
        if (request()->has('image_2')) {
            $image = request()->file('image_2');
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request
                ->file('image_2')
                ->getClientOriginalExtension();
            $folder = '/uploads/dishes';
            $name = $filename . '.' . $extension;
            $filePath = $this->uploadOne($image, $folder, $name);
            $dish->image_2 = $filePath;
        }
        // Upload image 3
        if (request()->has('image_3')) {
            $image = request()->file('image_3');
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request
                ->file('image_3')
                ->getClientOriginalExtension();
            $name = $filename . '_' . time() . '.' . $extension;
            $filePath = $this->uploadOne($image, $folder, $name);
            $dish->image_3 = $filePath;
        }
        $dish->selected_image = 1;
        $dish->active = true;
        $dish->save();

        if ($dish) {
            //Create Sauce
            $sauces_inputs = $request->get('Sauce');
            if ($sauces_inputs) {
                foreach ($sauces_inputs as $sauce) {
                    $dish->sauces()->create([
                        'name' => $sauce['name'],
                        'price' => (float) ($sauce['price'] ?? 0.00),
                    ]);
                }
            }
            //Create Toppings
            $topping_inputs = $request->get('Topping');
            if ($topping_inputs) {
                foreach ($topping_inputs as $topping) {
                    $dish->toppings()->create([
                        'name' => $topping['name'],
                        'price' => (float) ($topping['price'] ?? 0.00),
                    ]);
                }
            }
            //Create Cooking Preference
            $CK_inputs = $request->input('CKPref');
            if ($CK_inputs) {
                foreach ($CK_inputs as $CK) {
                    $dish->cookingpreferences()->create([
                        'name' => $CK,
                    ]);
                }
            }
            //Create Side Dish
            $SD_inputs = $request->input('SD');
            if ($SD_inputs) {
                $index = 1;
                foreach ($SD_inputs as $key => $SD) {
                    // Upload image 1
                    $imagePath = '/uploads/sidedishes/placeholder.jpg';
                    if (request()->hasfile('SD.' . $key . '.img')) {
                        $img = request()->file('SD.' . $key . '.img');
                        $imagename =
                        $dish->id .
                        $index .
                        '_img' .
                        '.' .
                        $img->getClientOriginalExtension();
                        $folderToStore = '/uploads/sidedishes';
                        $imagePath = $this->uploadOne($img, $folderToStore, $imagename);
                    }
                    $index++;
                    $dish->sidedishes()->create([
                        'name' => $SD['name'],
                        'price' => (float) ($SD['price'] ?? 0.0),
                        'image' => $imagePath,
                    ]);
                }
            }
        }
        session()->flash(
            ($dish ? 'success' : 'error') . '_message',
            $dish
            ? 'You have successfully created The Dish: ' . $request->name
            : 'Sorry, could not add Dish.'
        );

        return redirect()->back();
        // return $request;
    }

    public function dinningAreaStaffList($id)
    {
        $dinningArea = DinningArea::with('waiters')
            ->where('restaurant_ID', auth()->user()->restaurant_id)
            ->find($id);
        $assigned_waiters = $dinningArea->waiters;
        $assigned_waiters_id = $dinningArea->waiters
            ->map(function ($item) {
                return $item->id;
            })
            ->toArray();
        $unassigned_waiters = auth()
            ->user()
            ->waiters()
            ->whereNotIn('id', $assigned_waiters_id)
            ->get();
        $dinningArea['assigned_waiters'] = $assigned_waiters;
        $dinningArea['unassigned_waiters'] = $unassigned_waiters;
        return view(
            'pages.dashboard.dinning-area.staff',
            compact('dinningArea')
        );
    }

    public function syncDinningAreUser($type, $waiter_ID, $dining_area_ID)
    {
        $dining_area = DinningArea::with('waiters')->find($dining_area_ID);
        // dd($dining_area);
        if ($type === 'unassign') {
            $dining_area->waiters()->detach($waiter_ID);
        } else {
            // dd($dining_area->id);
            $dining_area->waiters()->attach($waiter_ID);
        }
        return redirect()->back();
    }

    public function staffList()
    {
        $staff = auth()->user()->waiters;
        if (request()->searchKey && request()->searchKey !== '') {
            $staffFilter = $staff->filter(function ($value) {
                return stripos($value->fullname, request()->searchKey) !==
                false ||
                stripos($value->phone_number, request()->searchKey) !==
                false ||
                stripos($value->employment_type, request()->searchKey) !==
                false ||
                stripos($value->on_shift, request()->searchKey) !== false;
            });
            if (count($staffFilter) <= 0) {
                session()->flash(
                    'search_message',
                    'No result found for search key: ' . request()->searchKey
                );
            }
            $staff = count($staffFilter) > 0 ? $staffFilter : $staff;
        }
        return view('pages.dashboard.staff.list', compact('staff'));
    }

    public function createStaff()
    {
        return view('pages.dashboard.staff.create');
    }

    public function storeStaff()
    {
        $validator = Validator::make(request()->all(), [
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fullname' => 'required',
            'phone_number' => 'required|phone:AUTO,AU',
            'pin' => 'required',
            'employment_type' => 'required',
            'on_shift' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        request()['restaurant_id'] = auth()->user()->restaurant_id;
        // Hash PIN
        request()['pin'] = Hash::make(request()->pin);
        $waiter = Waiter::create(request()->all());
        // Upload image
        if (request()->has('profile_pic')) {
            $image = request()->file('profile_pic');
            $name = $waiter->id . '_' . $waiter->phone_number . '_profile_pic' . '.' . $image->getClientOriginalExtension();
            $folder = '/uploads/waiter/profile';
            $filePath = $this->uploadOne($image, $folder, $name);
            $waiter->profile_pic = $filePath;
            $waiter->save();
        }
        session()->flash(
            ($waiter ? 'success' : 'error') . '_message',
            $waiter
            ? 'You have successfully added the waiter: ' . request()->name
            : 'Sorry, could not add waiter.'
        );
        return redirect()->route('dashboard.staff.list');
    }

    public function updateStaff($id)
    {
        \Log::debug(['ree' => request()->all()]);
        $except = ['_token', 'employment_type_' . $id, 'on_shift_' . $id];
        request()['employment_type'] = request()['employment_type_' . $id];
        request()['on_shift'] = request()['on_shift_' . $id];
        $request = array_filter(request()->except($except));
        $waiter = Waiter::find($id);
        if ($waiter) {
            \Log::debug(['$waiter' => $waiter->id, 'request' => $request]);
            $waiter->update($request);
            session()->flash(
                ($waiter ? 'success' : 'error') . '_message',
                $waiter
                ? 'You have successfully deleted the waiter account: ' .
                ($waiter->firstname . ' ' . $waiter->lastname)
                : 'Sorry, could not delete waiter account.'
            );
            return response()->json(['url' => route('dashboard.staff.list')]);
        }
        session()->flash(
            'error_message',
            'Sorry, could not delete waiter account.'
        );
        return response()->json(['url' => route('dashboard.staff.list')]);
    }

    public function deleteStaff($id)
    {
        $waiter = Waiter::find($id);
        if ($waiter) {
            $this->deleteOne($user->profile_pic);
            $waiter->delete();
            session()->flash(
                ($waiter ? 'success' : 'error') . '_message',
                $waiter
                ? 'You have successfully deleted the waiter account: ' .
                ($waiter->firstname . ' ' . $waiter->lastname)
                : 'Sorry, could not delete waiter account.'
            );
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function customers()
    {
        $customers = Dinner::get();
        return view('pages.dashboard.customers.list', compact('customers'));
    }

    public function reports()
    {
        return;
    }
}
