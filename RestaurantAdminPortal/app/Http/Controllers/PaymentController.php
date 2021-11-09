<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payments()
    {
        $paymentsNav = [
            [
                [
                    'title' => 'Payment Method',
                    'link' => 'payments.methods',
                    'icon' => 'fas fa-money-bill-alt',
                ],
                [
                    'title' => 'Payment Gateway',
                    'link' => 'payments.gateway',
                    'icon' => 'fa fa-location-arrow',
                ],
            ],
            [
                [
                    'title' => 'Billing History',
                    'link' => 'payments.billinghistory',
                    'icon' => 'fa fa-user',
                ],
                [
                    'title' => 'Unsubscription',
                    'link' => 'payments.unsubscription',
                    'icon' => 'fa fa-file-alt',
                ],
            ],
        ];

        return view('pages.payments.home', compact('paymentsNav'));
    }

    public function billingHistory()
    {
        return view('pages.payments.billing-history');
    }

    public function gateway()
    {
        $gateways = [
            [
                ['title' => 'Paypal', 'icon' => 'fa fa-paypal'],
                ['title' => 'E-way', 'icon' => 'fa fa-paypal'],
            ],
        ];
        return view('pages.payments.gateway', compact('gateways'));
    }

    public function methods()
    {
        $methods = [
            [
                ['title' => 'Credit Card', 'icon' => 'fa fa-paypal'],
                ['title' => 'Credit Card', 'icon' => 'fa fa-paypal'],
            ],
            [
                ['title' => 'Paypal', 'icon' => 'fa fa-paypal'],
                ['title' => 'E-way', 'icon' => 'fa fa-paypal'],
            ],
        ];
        return view('pages.payments.methods', compact('methods'));
    }

    public function unsusbcribe()
    {
        return view('pages.subscription.unsusbcribe');
    }
    
}
