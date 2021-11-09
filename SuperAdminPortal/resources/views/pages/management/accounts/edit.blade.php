@extends('layouts.page-details')

@section('title', 'Edit Account')

@section('content')
      @section('page-title', 'Edit Account')
      @section('page-back', route('manage.accounts.home'))
      <div class="flex justify-center">
        <form method="POST" class="flex-1" action="{{route('manage.accounts.update', ['id' => $user->id])}}" id="updateData" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="w-11/12 rounded-sm mt-4 mb-1 px-5 py-4 bg-darkAsh-300">
            <div class="flex items-center justify-center">
              <div onclick="document.getElementById('imgupload').click()" class="flex justify-center items-center rounded-full border-2 border-darkAsh-200 h-35 w-35 bg-darkAsh-300">
                <img id="imagePreview" src="{{ $user->profile_pic ?? asset('image/no-user-image.jpeg')  }}" class="border-2 border-gray-500 p-2 h-28 w-28 rounded-full"/>
                <input type="file" name="profile_pic" id="imgupload" onchange="loadImagePreview(this);" class="hidden"/> 
              </div>
            </div>
            <div class="text-center mt-2">Edit Info</div>
            <div class="grid grid-rows-4 gap-0 mt-4">
                <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : ''}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
                  {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
                </div>
                <div class="flex justify-between space-x-8"> 
                  <div class="flex-1">
                    <input name="firstname" value="{{$user->firstname}}" required type="text" placeholder="First Name" class="@error('firstname') input-error @enderror input-field">
                    @error('firstname')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                  </div>
                  <div class="flex-1">
                    <input name="lastname" value="{{$user->lastname}}" required type="text" placeholder="Last Name" class="@error('lastname') input-error @enderror input-field">
                    @error('lastname')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                  </div>
              </div>
              <div class="flex-1">
                <input name="number" value="{{$user->number}}" required type="text" placeholder="Phone Number" class="@error('number') input-error @enderror input-field">
                @error('number')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
              <div class="flex-1">
                <input type="email" name="email" value="{{$user->email}}" required type="email" placeholder="@menuplus.com" class="@error('email') input-error @enderror input-field">
                @error('email')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
              {{-- <input type="text" placeholder="Location" class="input-field"> --}}
              <button type="submit" class="mt-3 btn btn-red w-full py-2">
                Update
              </button>
      
            </div>
          </div>
        </form>
      </div>
@stop