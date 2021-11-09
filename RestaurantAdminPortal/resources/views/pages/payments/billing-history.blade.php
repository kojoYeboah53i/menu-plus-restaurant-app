@extends('layouts.authorized')

@section('title', 'Payment')

@section('content')
  @section('page-title', 'Billing History')
  <div class="login-card" style="width: 732px; height: auto; text-align: left; padding: 50px 80px;">
    <div class="row">
      <div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-6"><b>Current Year</b></div>
      <div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-6 text-right">
        <div class="select" style="width: 100px;float: right;">
          <select id="standard-select">
            <option value="Option 1">Sort By</option>
          </select>
          <span class="focus"></span>
        </div>
      </div>
    </div>
    <div style="margin-top: 20px;">
      <div class="row mb-3" style="background-color: #212629; padding: 10px 15px;">
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">#23523</div>
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4 text-center" style="color: #76787b">12/3/2015</div>
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4 text-right">
          $90 <i class="fa fa-download text-danger ml-3"></i>
        </div>
      </div>
      <div class="row mb-3" style="background-color: #212629; padding: 10px 15px;">
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">#23523</div>
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4 text-center" style="color: #76787b">12/3/2015</div>
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4 text-right">
          $90 <i class="fa fa-download text-danger ml-3"></i>
        </div>
      </div>
      <div class="row mb-3" style="background-color: #212629; padding: 10px 15px;">
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">#23523</div>
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4 text-center" style="color: #76787b">12/3/2015</div>
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4 text-right">
          $90 <i class="fa fa-download text-danger ml-3"></i>
        </div>
      </div>
    </div>
  </div>
@stop