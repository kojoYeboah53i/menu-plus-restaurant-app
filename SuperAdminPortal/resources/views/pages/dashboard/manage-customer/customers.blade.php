@extends('layouts.page-details')

@section('title', 'Manage Customer')

@section('content')
      @section('page-title', 'Manage Customers')
      @section('page-back', route('dashboard.home'))
      <div class="mt-5 flex justify-between items-center space-x-10">
        <div class="mr-5 text-2xl">Customers</div>
        @if(count($customers) > 0)
      <div class="flex-1 search-field">
        <div class="flex justify-between items-center space-x-5">
          <form class="flex items-center flex-1" action="{{route('dashboard.customers.list')}}" method="GET">
            <input type="text" value="{{old('searchKey')}}" class="w-11/12 search-field-input" name="searchKey" placeholder="Search Customer">
            <div class="w-1/12 text-center"><button><i class="fa fa-search cursor-pointer"></i></button></div>
          </form>
        </div>
      </div>
      {{-- <div class="w-2/12 search-field">
        <div class="select bg-darkAsh-200 text-darkAsh-100">
          <select id="standard-select h-full">
            <option value="Option 1">All</option>
          </select>
          <span class="focus"></span>
        </div>
      </div> --}}
      @endif
      </div>
      <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : ''}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
        {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
      </div>
  @if(count($customers) > 0)
    <div class="mt-5"></div>
    <div class="{{session()->has('search_message') ? '' : 'hidden'}} bg-blue-500 text-blue-200 py-2 text-center rounded-lg my-3">
      {{session()->get('search_message')}}
    </div>
    <div class="rounded-sm mt-5 mb-1 px-5 py-3 bg-darkAsh-300">
        <div class="text-darkAsh-50">
          <div class="grid grid-cols-3 gap-4 text-xs">
            <div>Name</div>
            <div>Phone Number</div>
            <div>Email</div>
          </div>
        </div>
      </div>
    @foreach($customers as $user)
      <div class="rounded-sm px-5 mb-3 py-3 bg-darkAsh-300">
        <div class="text-darkAsh-50">
          <div class="grid grid-cols-3 gap-4">
            <div>{{$user->firstname}} {{$user->lastname}}</div>
            <div>{{$user->phoneNumber}}</div>
            <div>{{$user->email}}</div>
          </div>
        </div>
      </div>
    @endforeach
    @else
      <div class="text-center mt-5 text-2xl font-light text-darkAsh-50">There are no user accounts at this time.</div>
    @endif
@stop