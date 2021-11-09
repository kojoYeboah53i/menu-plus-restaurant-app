@extends('layouts.page-details')

@section('title', 'Manage Customers')

@section('content')
  @section('page-title', 'Manage Customers')
  <div class="container cursor-pointer" style="position: absolute; left:10px;top:30px;margin-left: -13px;cursor: pointer">
    <div class="burger">
      
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>
</div>
  @section('page-back', route('dashboard.home'))
  @if(count($customers) > 0)
  <div class="mt-5 flex justify-{{count($customers) > 0 ? 'between' : 'center'}} space-x-10">
    <div class="flex-1 search-field">
      <div class="flex justify-between items-center space-x-5">
        <input type="text" class="w-11/12 search-field-input" placeholder="Search Name">
        <div class="w-1/12 text-center"><i class="fa fa-search"></i></div>
      </div>
    </div>
    <a class="w-2/12 btn btn-red no-underline hover:no-underline hover:text-white hidden" id="downloadCustomerBtn"><i class="fa fa-download"></i> Download Customer Data</a>
  </div>
  @endif
  <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : ''}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
    {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
  </div>
  @if(count($customers) > 0)
    <div class="rounded-sm mt-5 mb-1 px-5 py-3 bg-darkAsh-300">
      <div class="text-darkAsh-50">
        <div class="grid grid-cols-6 gap-4 text-base">
          <div>Select</div>
          <div>Full Name</div>
          <div>Contact Mobile</div>
          <div>Email Address</div>
          <div>Total Spent</div>
          <div>Opt Out</div>
        </div>
      </div>
    </div>
  @foreach($customers as $user)
    <div class="rounded-sm px-5 mb-3 py-3 bg-darkAsh-300 customersList">
      <div class="text-white">
        <div class="grid grid-cols-6 gap-4 customersData">
          <span class="rounded-lg border-2 border-darkAsh-50 w-5 h-5 flex justify-center items-center"><input type="checkbox" class="select-customer opacity-60 transform scale-200" /></span>
          <div data-val="Full Name">{{$user->firstname}} {{$user->lastname}}</div>
          <div data-val="Contact Mobile">{{$user->phoneNumber}}</div>
          <div data-val="Email Address">{{$user->email}}</div>
          <div data-val="Total Spent">0</div>
          <div data-val="Opt Out">No</div>
        </div>
      </div>
    </div>
  @endforeach
  @else
    <div class="text-center mt-5 text-2xl font-light text-darkAsh-50">There are no customer accounts at this time.</div>
  @endif
@stop