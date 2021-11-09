<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Restaurant;

class QRCodeController extends Controller
{
    public function qrCode()
    {
        $navs = [
            [
                [
                    'title' => 'Generate QR for Staff',
                    'link' => 'qrcode.generate-staff',
                    'icon' => 'fa fa-qrcode',
                ],
                [
                    'title' => 'Download QR for Customer',
                    'link' => 'qrcode.generate-customer',
                    'icon' => 'fa fa-qrcode',
                ],
            ],
        ];
        return view('pages.qr-code-generate.home', compact('navs'));
    }
    
    public function generateForStaff()
    {
        //Setup Staff QR Code Key
        $restaurant = Restaurant::find(auth()->user()->restaurant_id);
        $currentTimeinSeconds = time();
        $key_string = 'res_' . $restaurant->id . date('Y-m-d:H', $currentTimeinSeconds);
        $restaurant->staff_qr_key = $key_string;
        $restaurant->save();

        $qr_key = urlencode($key_string);

        $staff_url = 'waiterdev.menuplus.com.au/qr/' . $qr_key;
        $image_url = config('app.qr_app_logo_url');

        // generate QR Code
        // $image = QrCode::size(200)->generate($staff_url);
        $image = QrCode::format('png')->merge($image_url, 0.3, true)
            ->size(500)->errorCorrection('H')
            ->generate($staff_url);

        $data = [
            'restaurant' => $restaurant,
            'image' => $image,
        ];

        //Print out PDF containing QR Code
        // $pdf = PDF::loadView('pages.qr-code-generate.generate-staff', $data);

        // return $pdf->download('qr-code-staff.pdf');

        return view('pages.qr-code-generate.view-staff-qr')->with($data);
    }

    public function generateForCustomer()
    {
        //Setup Customer QR Code Key
        $restaurant = Restaurant::find(auth()->user()->restaurant_id);
        if ($restaurant->customer_qr_key == null) {
            $currentTimeinSeconds = time();
            $key_string = 'res_' . $restaurant->id . date('Y-m-d:H', $currentTimeinSeconds);
            $restaurant->customer_qr_key = $key_string;
            $restaurant->save();
        }

        //generate QR Code
        if($restaurant->logo == null){
            session()->flash('res_logo_not_exist', 'Upload Restaurant Logo Before QR Code Can Be generated');

            return redirect()->back();
        }
        $image = QrCode::format('png')->merge($restaurant->logo, 0.3, true)
            ->size(500)->errorCorrection('H')
            ->generate('dinnerdev.menuplus.com.au/qr/' . urlencode($restaurant->customer_qr_key));

        $data = [
            'restaurant' => $restaurant,
            'image' => $image,
        ];

        //Print out PDF containing QR Code
        // $pdf = PDF::loadView('pages.qr-code-generate.generate-customer', $data);
        // return $pdf->download('qr-code-customer.pdf');

        return view('pages.qr-code-generate.view-customer-qr')->with($data);
    }
}
