@extends('layouts.page-details')

@section('title', 'Manage Accounts')

@section('content')
  @section('page-title', 'Manage Accounts')
  @section('page-back', route('manage.home'))
  <div class="mt-5 flex justify-{{count($users) > 0 ? 'between' : 'center'}} space-x-10">
    <a href="{{route('manage.accounts.create')}}" class="flex items-center justify-center w-3/12 btn btn-red no-underline hover:no-underline hover:text-white text-sm">
      <span>Add New Account Manager</span>
    </a>
    @if(count($users) > 0)
      <div class="flex-1 search-field">
        <div class="flex justify-between items-center space-x-5">
          <form class="flex items-center flex-1" action="{{route('manage.accounts.home')}}" method="GET">
            <input type="text" value="{{old('searchKey')}}" class="w-11/12 search-field-input" name="searchKey" placeholder="Search Account">
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
  @if(count($users) > 0)
    <div class="mt-5"></div>
    <div class="{{session()->has('search_message') ? '' : 'hidden'}} bg-blue-500 text-blue-200 py-2 text-center rounded-lg my-3">
      {{session()->get('search_message')}}
    </div>
    <div class="rounded-sm mb-1 px-5 py-3 bg-darkAsh-300">
      <div class="text-darkAsh-50">
        <div class="grid grid-cols-4 gap-4 text-xs">
          <div>User Name</div>
          <div>Phone</div>
          <div>Email</div>
          <div></div>
        </div>
      </div>
    </div>
  @foreach($users as $user)
    <div class="rounded-sm px-5 mb-3 py-3 bg-darkAsh-300">
      <div class="text-darkAsh-50">
        <div class="grid grid-cols-4 gap-4">
          <div>{{$user->firstname}} {{$user->lastname}}</div>
          <div>{{$user->number}}</div>
          <div>{{$user->email}}</div>
          <div class="text-right flex space-x-8 justify-center">
            <a href="{{route('manage.accounts.edit', ['id' => $user->id])}}" class="hover:no-underline no-underline hover:text-white">Edit</a>
            @if(auth()->id() !== $user->id)
            <span data-url="{{route('manage.accounts.delete',['id' => $user->id])}}"><i class="fa fa-trash text-red-500 cursor-pointer" onclick="event.preventDefault(); confirmDelete('deleteItem', event)"></i></span>
            <form class="hidden" id="deleteItem" method="POST">
              @method('DELETE')
              @csrf            
             </form>
             @endif
          </div>
        </div>
      </div>
    </div>
  @endforeach
  @else
    <div class="text-center mt-5 text-2xl font-light text-darkAsh-50">There are no user accounts at this time.</div>
  @endif
@stop