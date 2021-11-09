<?php

namespace App\Http\Controllers;

use App\Models\Dinner;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    // public function manageCustomers()
    // {
    //     $customers = Dinner::all();
    //     if (request()->searchKey && request()->searchKey !== '') {
    //         $customersFilter = $customers->filter(function ($value) {
    //             return stripos($value->firstname, request()->searchKey) !==
    //             false ||
    //             stripos($value->lastname, request()->searchKey) !== false ||
    //             stripos($value->email, request()->searchKey) !== false ||
    //             stripos($value->phoneNumber, request()->searchKey) !==
    //                 false;
    //         });
    //         if (count($customersFilter) <= 0) {
    //             session()->flash(
    //                 'search_message',
    //                 'No result found for search key: ' . request()->searchKey
    //             );
    //         }
    //         $customers =
    //         count($customersFilter) > 0 ? $customersFilter : $customers;
    //     }
    //     return view('pages.dashboard.manage-customer.customers', compact('customers'));
    // }

    // public function viewCustomer()
    // {
    //     return view('pages.dashboard.manage-customer.customer-details');
    // }
    // public function editCustomer()
    // {
    //     return view('pages.dashboard.manage-customer.edit-customer');
    // }

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
        try {
            if (request()->has('profile_pic')) {
                $user = User::find(auth()->id());
                $image = request()->file('profile_pic');
                request()['uploaded_image'] = $image;
                $name = $user->id . '_profile_pic' . '.' . $image->getClientOriginalExtension();
                $folder = '/uploads/superAdmin/profile';
                $filePath = $this->uploadOne($image, $folder, $name);
                $user->profile_pic = $filePath;
                $user->save();
                $message_type = 'success';
            }
            session()->flash('self_image_upload', true);
            session()->flash(
                $message_type . '_message',
                $message_type === 'success'
                ? 'You have successfully updated your profile picture.'
                : 'Sorry, could not update profile picture.'
            );
        } catch (\Exception $exception) {
            Log::error(['Error' => $exception->getMessage()]);
            session()->flash(
                $message_type . '_message',
                $message_type === 'success'
                ? 'You have successfully updated your profile picture.'
                : 'Sorry, could not update profile picture.'
            );
        }
        return redirect()->back();
    }

    public function userProfileImage(Request $request){
        $validator = Validator::make(request()->all(), [
            'croppedImage' => 'required',
            'user_id' => 'required'
        ]);
        Log::info("Validation stated");
        if ($validator->fails()) {
            Log::error($validator->errors());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        Log::info("Validation Successful.");
        try{
            Log::info("Does Request Have CroppedImage: " . request()->has('croppedImage'));
            if (request()->croppedImage){
                $user = User::find(request()->user_id);
                Log::info('Found User\'s ID : ' . $user->id);

                $image = request()->file('croppedImage');
                // request()['uploaded_image'] = $image;
                // $name = $user->id . '_profile_pic' . '.' . $image->getClientOriginalExtension();
                $name = $user->id . '_profile_pic.jpg';
                $folder = '/uploads/superAdmin/profile';
                $filePath = $this->uploadOne($image, $folder, $name);
                $user->profile_pic = $filePath;
                $user->save();
                $message_type = 'success';
                
            }
            session()->flash('self_image_upload', true);
            session()->flash(
                'success_message',
                'You have successfully updated your profile picture.'
            );
        
        } catch (\Exception $exception) {
            Log::error(['Error' => $exception->getMessage()]);
            session()->flash(
                'error_message',
                'Sorry, could not update profile picture.'
            );
        }
        
        return response()->json(["message"=> "attempting to upload image"]);
    }


}
