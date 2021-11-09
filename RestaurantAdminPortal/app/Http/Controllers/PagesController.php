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
use Illuminate\Support\Facades\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PagesController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function getRestaurantDetails()
    {
        $restaurant = Restaurant::find(auth()->user()->restaurant_id);
        return $restaurant;
    }

    public function unsusbcribe()
    {
        return view('pages.subscription.unsusbcribe');
    }

    public function contact()
    {
        return view('pages.account-info.contact');
    }

    public function locationAddress()
    {
        return view('pages.account-info.location');
    }

    public function manageSupportContact()
    {
        return view('pages.account-info.support');
    }

    public function susbcriptionPlan()
    {
        return view('pages.account-info.subscription-plan');
    }

    public function customers()
    {
        $customers = Dinner::get();
        return view('pages.dashboard.customers.list', compact('customers'));
    }

    public function selfUploadImage()
    {
        $validator = Validator::make(request()->all(), [
            'profile_pic' =>
            'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Upload image
        $message_type = 'error';
        if (request()->has('profile_pic')) {
            $user = User::find(auth()->id());
            $image = request()->file('profile_pic');
            $name = $user->id . '_profile_pic' . '.' . $image->getClientOriginalExtension();
            $folder = '/uploads/restaurantAdmin/profile';
            $filePath = $this->uploadOne($image, $folder, $name);
            $user->profile_pic = $filePath;
            $user->save();
            $message_type = 'success_menu';
        }
        session()->flash('self_image_upload', true);
        session()->flash(
            $message_type . '_message',
            $message_type === 'success_menu'
            ? 'You have successfully updated your profile picture.'
            : 'Sorry, could not update profile picture.'
        );
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' =>  'required|string|min:8',
            'confirm_password' =>  'required|same:new_password',
        ]);

        if( !Hash::check( $request->input('old_password'), auth()->user()->password ) ){
            session()->flash('error_message', 'The old password provided is incorrect.');
            return back();
        }

        $user = auth()->user();
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
        
        session()->flash('password_success', 'Your Password has been successfully changed.'); 

        return redirect()->back();
    }
}
