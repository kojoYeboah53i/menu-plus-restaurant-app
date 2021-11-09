@extends('layouts.page-details')

@section('title', 'Manage Restaurants')

@section('content')
  @section('page-title', 'Manage Restaurants')
  @section('page-back', route('manage.home'))
    <div class="mt-5 flex justify-{{count($restaurants) > 0 ? 'between' : 'center'}} space-x-10 items-center">
      <a href="{{route('manage.restaurants.create')}}" class="py-3 flex items-center justify-center w-3/12 btn btn-red no-underline hover:no-underline hover:text-white text-sm">
        <span>Add New Restaurant</span>
      </a>
      @if(count($restaurants) > 0)
      <div class="w-8/12 search-field">
        <div class="flex justify-between items-center space-x-5">
          <form class="flex items-center flex-1" action="{{route('manage.restaurants.home')}}" method="GET">
            <input name="filter" type="hidden" value="{{old('filter') ?? $filter}}">
            <input type="text" value="{{old('searchKey') ?? $searchKey}}" class="w-11/12 search-field-input" name="searchKey" placeholder="Search Restaurant">
            <div class="w-1/12 text-center"><button><i class="fa fa-search cursor-pointer"></i></button></div>
          </form>
        </div>
      </div>
      <div class="w-4/12 search-field">
        <div class="select bg-darkAsh-200 text-darkAsh-100">
          <select id="filter" class="standard-select h-full" onchange="if (this.value) window.location.href=this.value;">
            <option value="{{route('manage.restaurants.home', ['filter' => 'all'])}}" @if($filter == 'all')selected @endif>All</option>
            <option value="{{route('manage.restaurants.home', ['filter' => 'active'])}}" @if($filter == 'active')selected @endif>Live Restaurants</option>
            <option value="{{route('manage.restaurants.home', ['filter' => 'inactive'])}}" @if($filter == 'inactive')selected @endif>Deactivated Restaurants</option>
          </select>
          <span class="focus"></span>
        </div>
      </div>
      @endif
    </div>
    <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : ''}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
      {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
    </div>
    @if(count($restaurants) > 0)
    <div class="mt-5"></div>
    <div class="{{session()->has('search_message') ? '' : 'hidden'}} bg-blue-500 text-blue-200 py-2 text-center rounded-lg my-3">
      {{session()->get('search_message')}}
    </div>
    <div class="rounded-sm mb-3 px-5 py-3 bg-darkAsh-300">
      <div class="text-darkAsh-50">
        <div class="grid grid-cols-5 gap-4">
          <div>&emsp;Restaurant Name</div>
          <div>Location</div>
          <div>Email</div>
          <div>Contact Person</div>
          <div>Contact Number</div>
        </div>
      </div>
    </div>
    @foreach($restaurants as $restaurant)
    <div class="rounded-sm px-5 mb-2 py-3 bg-darkAsh-300 cursor-pointer">
      <div class="text-darkAsh-50">
        <div class="grid grid-cols-5 gap-4">
          <div onclick="location.href='{{route('manage.restaurants.view', ['id' => $restaurant->id])}}'">
            <span class="{{($restaurant->status == true) ? 'text-success' : 'text-danger'}}"><i class="far fa-circle"></i></span>&emsp;{{$restaurant->name}}</div>
          <div onclick="location.href='{{route('manage.restaurants.view', ['id' => $restaurant->id])}}'">{{$restaurant->address}}</div>
          <div onclick="location.href='{{route('manage.restaurants.view', ['id' => $restaurant->id])}}'">{{$restaurant->email}}</div>
          <div onclick="location.href='{{route('manage.restaurants.view', ['id' => $restaurant->id])}}'">{{$restaurant->user->fullname}}</div>
          <div onclick="location.href='{{route('manage.restaurants.view', ['id' => $restaurant->id])}}'">{{$restaurant->user->phone_number}}</div>
        </div>
      </div>
    </div>
    @endforeach
  @else
  <div class="text-center mt-5 text-2xl font-light text-darkAsh-50">There are no restaurants at this time.</div>
  @endif
@stop