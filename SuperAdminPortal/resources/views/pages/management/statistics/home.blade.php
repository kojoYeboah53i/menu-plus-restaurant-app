@extends('layouts.page-details')

@section('title', 'Statistics & Analysis')
@section('visibility', 'hidden')
@section('content')
  @section('page-title', 'Statistics & Analysis')
  @section('page-back', route('manage.home'))
  <div class="mt-5">
    <div class="flex justify-between space-x-10">
      <div class="rounded-sm px-5 py-4 bg-darkAsh-300 w-1/3">
        <div class="flex items-center">
          <div class="bg-darkAsh-50 h-10 w-10 rounded-full flex  items-center justify-center">
            <i class="fa fa-dollar"></i>
          </div>
          <div class="ml-4">
            <div class="text-2xl"><b>226K</b></div>
            <div class="text-darkAsh-50">Total Revenue</div>
            <div class="text-darkAsh-50">10% (30 Days)</div>
          </div>
        </div>
      </div>
      <div class="rounded-sm px-5 py-4 bg-darkAsh-300  w-1/3">
        <div class="flex items-center">
          <div class="bg-darkAsh-50 h-10 w-10 rounded-full flex  items-center justify-center">
            <i class="fa fa-dollar"></i>
          </div>
          <div class="ml-4">
            <div class="text-2xl"><b>{{$statistics['orders']}}</b></div>
            <div class="text-darkAsh-50">Total Orders</div>
            <div class="text-darkAsh-50">10% (30 Days)</div>
          </div>
        </div>
      </div>
      <div class="rounded-sm px-5 py-4 bg-darkAsh-300 w-1/3">
        <div class="flex items-center">
          <div class="bg-darkAsh-50 h-10 w-10 rounded-full flex  items-center justify-center">
            <i class="fa fa-users"></i>
          </div>
          <div class="ml-4">
            <div class="text-2xl"><b>71</b></div>
            <div class="text-darkAsh-50">Total Clients</div>
            <div class="text-darkAsh-50">10% (30 Days)</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop