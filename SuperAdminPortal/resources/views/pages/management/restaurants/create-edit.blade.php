@extends('layouts.page-details')
@php $edit = isset($restaurant); @endphp

@section('title', ($edit ? 'Edit' : 'New') . ' Restaurant')

@section('content')
      @section('page-title', ($edit ? 'Edit' : 'New') . ' Restaurant')
      @section('page-back', route('manage.restaurants.home'))
      <div class="flex justify-center">
        <form class="flex-1 w-11/12" method="POST" action="{{route('manage.restaurants.' . ($edit ? 'update' : 'add'), $edit ? ['id' => $restaurant->id] : '')}}" enctype="multipart/form-data">
          @csrf
          @if($edit)
            @method('PUT')
          @endif
        <div class="rounded-sm mt-5 mb-1 px-5 py-3 bg-darkAsh-300">
          <div class="-mt-16 flex justify-center">
            <div onclick="document.getElementById('imgupload').click()" class="flex justify-center items-center rounded-full border-2 border-darkAsh-200 h-35 w-35 bg-darkAsh-300">
              <img id="imagePreview" class="hidden border-2 border-gray-500 p-2 h-28 w-28 rounded-full"/>
              @if(!$edit)
              <div id="uploadImageBlock" class="border-4 border-gray-500 rounded-full text-center h-28 w-28 py-4 upload">
                <div class="block flex-1">
                  <i class="fa fa-camera"></i>
                </div>
                <div class="block flex-1 text-xs">Add Image</div>
              </div>
              @else
              <img id="existingImg" class="border-4 border-gray-500 rounded-full text-center h-28 w-28" src="{{ $restaurant->logo ?? asset('image/no-user-image.jpeg') }}">
              @endif
              <input type="file" name="logo" id="imgupload" onchange="loadImagePreview(this);" class="hidden"/> 
            </div>
          </div>
          @error('logo')
            <small class="text-red-500 flex justify-center text-center">
              <div>{{$message}}</div>
            </small>
          @enderror
          <div class="text-center my-4">{{$edit ? 'Edit' : 'New'}} Restaurant</div>
            @csrf
            <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : old('')}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
              {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3">
              <div>
                <input type="text" required name="name" value="{{$edit ? $restaurant->name : old('name')}}" placeholder="Restaurant Name" class="@error('name') input-error @enderror input-field">
                @error('name')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
              <div class="select input-field w-12/12">
                <select name="business_type" value="{{$edit ? $restaurant->business_type : old('business_type')}}" class="@error('business_type') input-error @enderror" required>
                  <option value="" disabled selected>Choose Business Type</option>
                  <option>Cafe & Takeaway</option>
                  <option>Restaurants</option>
                  <option>Pubs & Clubs</option>
                  <option>Hotels & Service Apartments</option>
                </select>
                @error('business_type')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div class="grid grid-cols-2 gap-4">
                <input type="text" required name="state" value="{{$edit ? $restaurant->state : old('state')}}" placeholder="State or Territory" class="@error('state') input-error @enderror input-field">
                @error('state')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                <input type="text" required name="city" value="{{$edit ? $restaurant->city : old('city')}}" placeholder="City" class="@error('city') input-error @enderror input-field">
                @error('city')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
              <div class="grid grid-cols-2 gap-4">
                <input type="text" required name="suburb" value="{{$edit ? $restaurant->suburb : old('suburb')}}" placeholder="Suburb" class="@error('suburb') input-error @enderror input-field">
                @error('suburb')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                <input type="text" required name="post_code" value="{{$edit ? $restaurant->post_code : old('post_code')}}" placeholder="Post Code (eg. 1435)" class="@error('post_code') input-error @enderror input-field">
                @error('post_code')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3">
              <div>
                <input type="text" required name="address" value="{{$edit ? $restaurant->address : old('address')}}" placeholder="Address" class="@error('address') input-error @enderror input-field">
                @error('address')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <input type="email" required name="email" value="{{$edit ? $restaurant->email : old('email')}}" placeholder="Email" class="@error('email') input-error @enderror input-field">
                @error('email')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
              <div>
                <input type="text" required name="phone_number" value="{{$edit ? $restaurant->phone_number : old('phone_number')}}" placeholder="Mobile Number" class="@error('phone_number') input-error @enderror input-field">
                @error('phone_number')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
            </div>
            <div class="grid grid-cols-4 gap-4 mb-3">
              <div>
                <input type="number" required name="capacity" value="{{$edit ? $restaurant->capacity : old('capacity')}}" placeholder="Capacity by Seats" min=1 class="@error('capacity') input-error @enderror input-field">
                @error('capacity')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <input type="text" required name="fullname" value="{{$edit ? $restaurant->user->fullname : old('fullname')}}" placeholder="Account User Full Name" class="@error('fullname') input-error @enderror input-field">
                @error('fullname')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
              <div>
                <div class="input-group">
                  <input id="password" name="password" type="password" class="form-control control-input background-alt-1 @error('password') input-error @enderror" placeholder="Password" aria-describedby="addon" {{$edit ? 'readonly' : ''}} value="{{$edit ? '******' : old('password')}}" required>
                  <span class="input-group-text control-input background-alt-1 py-2" id="basic-addon2" onclick="makeVisible(this, 'password')"><i class="fas fa-eye"></i></span>
                </div>
                @error('password')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
            </div>
            <button type="submit" class="mt-5 btn btn-red w-full py-2">
              {{$edit ? 'Update' : 'Add' }}
            </button>
        </div>
      </form>
      </div>
@stop