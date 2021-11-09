<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function home()
    {
        $navs = [
            [
                [
                    'title' => 'Direct Sales Agent',
                    'link' => 'manage.accounts.home',
                    'icon' => 'fas fa-user-tie',
                ],
                [
                    'title' => 'Sales Channels',
                    'link' => 'manage.accounts.home',
                    'icon' => 'fas fa-route',
                ],
                [
                    'title' => 'Sales Affiliates',
                    'link' => 'manage.accounts.home',
                    'icon' => 'fas fa-handshake',
                ],
            ],
        ];
        return view('pages.sales.home', compact('navs'));
    }
}
