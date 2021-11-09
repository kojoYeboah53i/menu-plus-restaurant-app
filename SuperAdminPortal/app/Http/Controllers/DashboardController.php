<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dinner;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantUser;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function home()
    {
        //logger('Testing to see if the Cloudwatch Logs are working.');
        // Log::warning('Testing to see if the Cloudwatch Logs are working.');
        $navs = [
            [
                [
                    'title' => 'Search by Postcode',
                    'link' => 'dashboard.cities.home',
                    'icon' => 'fas fa-map-marker-alt',
                ],
                [
                    'title' => 'Search by Restaurant',
                    'link' => 'manage.restaurants.home',
                    'icon' => 'fas fa-store-alt',
                ],
                [
                    'title' => 'Manage Emails',
                    'link' => 'dashboard.emails.home',
                    'icon' => 'fa fa-envelope',
                ],
            ],
        ];
        return view('pages.dashboard.home', compact('navs'));
    }
    
    public function cities()
    {
        $restaurants = Restaurant::with('user')->get();
        $search_key = null;
        if (request()->searchKey && request()->searchKey !== '') {
            $restaurantsFilter = $restaurants->filter(function ($value) {
                return stripos($value->state, request()->searchKey) !== false ||
                    stripos($value->city, request()->searchKey) !== false ||
                    stripos($value->suburb, request()->searchKey) !== false ||
                    stripos($value->post_code, request()->searchKey) !==
                        false;
            });

            $search_key = request()->searchKey;

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
        }

        $business_type = ['Cafe & Takeaway', 'Restaurants', 'Pubs & Clubs', 'Hotels & Service Apartments'];

        $actives = [
            $restaurants->where('business_type', 'Cafe & Takeaway')->where('status', true)->count(),
            $restaurants->where('business_type', 'Restaurants')->where('status', true)->count(),
            $restaurants->where('business_type', 'Pubs & Clubs')->where('status', true)->count(),
            $restaurants->where('business_type', 'Hotels & Service Apartments')->where('status', true)->count(),
        ];

        $inactives = [
            $restaurants->filter(function($value){
                return $value->business_type == 'Cafe & Takeaway' && ($value->status == false || $value->status == null);
            })->count(),
            $restaurants->filter(function($value){
                return $value->business_type == 'Restaurants' && ($value->status == false || $value->status == null);
            })->count(),
            $restaurants->filter(function($value){
                return $value->business_type == 'Pubs & Clubs' && ($value->status == false || $value->status == null);
            })->count(),
            $restaurants->filter(function($value){
                return $value->business_type == 'Hotels & Service Apartments' && ($value->status == false || $value->status == null);
            })->count(),
        ];

        $data = [
            'business_type' => $business_type,
            'search_key' => $search_key,
            'actives' => $actives,
            'inactives' => $inactives,
        ];

        return view('pages.dashboard.cities.home', $data);
    }

    public function manageEmails()
    {
        $contact_persons = RestaurantUser::all();
        if (request()->searchKey && request()->searchKey !== '') {
            $contact_persons_filter = $contact_persons->filter(function ($value) {
                return stripos($value->fullname, request()->searchKey) !==
                false ||
                stripos($value->email, request()->searchKey) !== false ||
                stripos($value->phone_number, request()->searchKey) !==
                    false;
            });
            if (count($contact_persons_filter) <= 0) {
                session()->flash(
                    'search_message',
                    'No result found for search key: ' . request()->searchKey
                );
            }
            $contact_persons = count($contact_persons_filter) > 0 ? $contact_persons_filter : $contact_persons;
        }
        
        $data = [
            'contact_persons' => $contact_persons,
        ];
        return view('pages.dashboard.manage-emails.home', $data);
    }
}
