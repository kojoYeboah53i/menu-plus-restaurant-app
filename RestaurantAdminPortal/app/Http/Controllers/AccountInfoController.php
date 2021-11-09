<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountInfoController extends Controller
{
    public function accountInfo()
    {
        $accountInfoNav = [
            [
                [
                    'title' => 'Account Contact',
                    'link' => 'accountinfo.contact',
                    'icon' => 'fa fa-user',
                ],
                [
                    'title' => 'Location Address',
                    'link' => 'accountinfo.locationaddress',
                    'icon' => 'fa fa-map-marked-alt',
                ],
            ],
            [
                [
                    'title' => 'Subscription Plan',
                    'link' => 'accountinfo.susbcriptionplan',
                    'icon' => 'fa fa-file-alt',
                ],
                [
                    'title' => 'Manage Support Contact',
                    'link' => 'accountinfo.managesupportcontact',
                    'icon' => 'fa fa-user',
                ],
            ],
        ];

        return view('pages.account-info.home', compact('accountInfoNav'));
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
    
}
