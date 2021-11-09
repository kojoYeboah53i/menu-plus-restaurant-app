@extends('layouts.page-details')

@section('title', 'Staff QR Code')

@section('content')
    @section('page-back', route('qrcode.home'))
    
    <div class="container mt-3 pt-3">
        <div class="row justify-content-center mb-2">
            <div class="col-5">
                <div class="row justify-content-center">
                    <h3>QR Code for {{$restaurant->name}} Staffs</h3>
                </div>
            </div>
        </div><br>
        <div class="row justify-content-center mb-2">
            <div class="col-5">
                <div class="row justify-content-center">
                    <h4>Scan Below QR Code to Open Portal</h4>
                </div>
            </div>
        </div><br><br>
        <div class="row justify-content-center mb-1">
            <div class="col-5">
                <div class="row justify-content-center">
                    <img src="data:image/png;base64,{!! base64_encode($image) !!}" class="img img-fluid"/>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row justify-content-center mb-1">
            <div class="col-3">
                <a class="btn btn-sm btn-danger w-100" href="data:image/png;base64,{!! base64_encode($image) !!}" download="staff-qr-code">Download QR Code</a>
            </div>
        </div>
    </div>
@stop