@extends('layouts.authorized')

@section('title', 'Dashboard')

@section('content')
  @section('page-title', 'Account Contact')
  <div class="login-card" style="width: 532px; height: auto;">
    <div class="login-inputs text-white">
      <form action="{{route('dashboard.home')}}" method="GET">
        <div class="form-group row" style="margin-bottom: 8px !important;">
          <label for="fullname" class="col-sm-2 col-form-label form-input-label text-left">FullName</label>
          <div class="col-sm-10">
            <input type="text" name="fullname" class="form-control login-input" style="margin-bottom: 0px;">
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px !important;">
          <label for="email" class="col-sm-2 col-form-label form-input-label text-left">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control login-input to-input" style="margin-bottom: 0px;">
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px !important;">
          <label for="email" class="col-sm-2 col-form-label form-input-label text-left">Mobile</label>
          <div class="col-sm-10">
            <input type="tel" class="form-control login-input to-input" style="margin-bottom: 0px;">
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px !important;">
          <label for="email" class="col-sm-2 col-form-label form-input-label text-left  ">Landline</label>
          <div class="col-sm-10">
            <input type="tel" class="form-control login-input to-input" style="margin-bottom: 0px;">
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px !important;">
          <label for="email" class="col-sm-2 col-form-label form-input-label"></label>
          <div class="col-sm-10">
            <div class="row">
              <div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-6">
                <button type="submit" class="btn btn-danger float-left btn-block" style="margin-top: 10px;">Save / Update</button>
              </div>
              <div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-6">
                <button type="submit" class="btn btn-secondary float-left btn-block cancel-btn" style="margin-top: 10px;">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@stop