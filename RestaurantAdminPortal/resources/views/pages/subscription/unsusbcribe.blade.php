@extends('layouts.authorized')

@section('title', 'Dashboard')

@section('content')
      @section('page-title', 'Unsubscription')
      <div class="login-card" style="width: 532px; height: auto;">
        <div class="login-inputs text-white">
          <form action="{{route('dashboard.home')}}" method="GET">
            <input type="text" placeholder="To: " class="form-control login-input to-input">
            <div class="row">
              <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12 col-12">
                <input type="text" placeholder="Username" class="form-control login-input">
              </div>
              <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12 col-12">
                <input type="text" placeholder="Mobile Number" class="form-control login-input">
              </div>
            </div>
            <input type="text" placeholder="Name Of Restaurant" class="form-control login-input">
            <textarea name="" id="" rows="6" placeholder="Type A Message" class="form-control login-input" style="resize: none; margin-bottom: 20px;"></textarea>
            <button type="submit" class="btn btn-danger login-button float-left" style="margin-top: 0px;">Send</button>
          </form>
        </div>
      </div>
@stop