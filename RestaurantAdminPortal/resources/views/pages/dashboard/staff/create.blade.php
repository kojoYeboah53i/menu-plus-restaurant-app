@extends('layouts.page-details')

@section('title', 'New Account')

@section('content')
  @section('page-title', 'New Account')
  @section('page-back', route('dashboard.staff.list'))
  <div class="flex justify-center">
    <form class="flex-1" method="POST" action="{{route('dashboard.staff.store')}}" enctype="multipart/form-data">
      @csrf
      <div class="w-11/12 rounded-sm mt-5 mb-1 px-5 py-3 bg-darkAsh-300">
        <div class="-mt-16 flex justify-center">
          <div onclick="document.getElementById('imgupload').click()" class="flex justify-center items-center rounded-full border-2 border-darkAsh-200 h-35 w-35 bg-darkAsh-300">
            <img id="imagePreview" class="hidden border-2 border-gray-500 p-2 h-28 w-28 rounded-full"/>
            <div id="uploadImageBlock" class="border-4 border-gray-500 rounded-full text-center h-28 w-28 py-4 upload">
              <div class="block flex-1">
                <i class="fa fa-camera"></i>
              </div>
              <div class="block flex-1 text-xs">Add Image</div>
              <input type="file" name="profile_pic" id="imgupload" onchange="loadImagePreview(this);" class="hidden"/> 
            </div>
          </div>
        </div>
        @error('profile_pic')
        <small class="text-red-500 flex justify-center text-center">
          <div>{{$message}}</div>
        </small>
        @enderror
        <div class="text-center my-4">New User</div>
        <div class="grid grid-cols-1">
          <div>
            <input name="fullname" value="{{old('fullname')}}" required type="text" placeholder="Full Name" class="@error('fullname') input-error @enderror input-field">
            @error('fullname')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
          </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <input name="phone_number" value="{{old('phone_number')}}"  required type="number" placeholder="Phone Number" class="@error('phone_number') input-error @enderror input-field">
            @error('phone_number')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
          </div>
          <div>
            <input name="pin" value="{{old('pin')}}" required type="number" placeholder="PIN" class="@error('pin') input-error @enderror input-field">
            @error('pin')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
          </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div class="grid grid-rows-2">
            <div class="mt-3">Employment Type</div>
            @php
              $access = [['name' => 'Casual', 'value' => 'Casual'], ['name' => 'Full-Time', 'value' => 'full-time'], ['name' => 'Part-Time', 'value' => 'part-time']];
            @endphp
            <div class="grid grid-cols-5 gap-2  mt-2 text-darkAsh-50">
              @foreach ($access as $item)
                <small>{{$item['name']}}</small>
              @endforeach
            </div>
            <div class="grid grid-cols-5 gap-1 mt-2">
              @foreach ($access as $item)
                <div class="flex items-center">
                  <input type="radio" name="employment_type" {{old('employment_type') === $item['value'] ? 'checked' : ''}} value="{{$item['value']}}" class="opacity-0 absolute h-4 w-4" />
                  <div class="bg-darkAsh-400 border-2 rounded-sm border-white w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-red-500">
                    <svg class="fill-current hidden w-3 h-3 text-green-500 pointer-events-none" version="1.1" viewBox="0 0 17 12" xmlns="http://www.w3.org/2000/svg">
                      <g fill="none" fill-rule="evenodd">
                        <g transform="translate(-9 -11)" fill="#1F73F1" fill-rule="nonzero">
                        <path d="m25.576 11.414c0.56558 0.55188 0.56558 1.4439 0 1.9961l-9.404 9.176c-0.28213 0.27529-0.65247 0.41385-1.0228 0.41385-0.37034 0-0.74068-0.13855-1.0228-0.41385l-4.7019-4.588c-0.56584-0.55188-0.56584-1.4442 0-1.9961 0.56558-0.55214 1.4798-0.55214 2.0456 0l3.679 3.5899 8.3812-8.1779c0.56558-0.55214 1.4798-0.55214 2.0456 0z" />
                        </g>
                      </g>
                    </svg>
                  </div>
                </div>
              @endforeach
            </div>
            @error('employment_type')<small class="mt-2 text-red-500">{{$message}}</small>@enderror
          </div>
          <div class="grid grid-rows-2">
            <div class="mt-3">On Shift</div>
            @php
              $access = [['name' => 'Yes', 'value' => 'yes'], ['name' => 'No', 'value' => 'no']];
            @endphp
            <div class="grid grid-cols-5 gap-2  mt-2 text-darkAsh-50">
              @foreach ($access as $item)
                <small>{{$item['name']}}</small>
              @endforeach
            </div>
            <div class="grid grid-cols-5 gap-1 mt-2">
              @foreach ($access as $item)
                <div class="flex items-center">
                  <input type="radio" name="on_shift" {{old('on_shift') === $item['value'] ? 'checked' : ''}} value="{{$item['value']}}" class="opacity-0 absolute h-4 w-4" />
                  <div class="bg-darkAsh-400 border-2 rounded-sm border-white w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-red-500">
                    <svg class="fill-current hidden w-3 h-3 text-green-500 pointer-events-none" version="1.1" viewBox="0 0 17 12" xmlns="http://www.w3.org/2000/svg">
                      <g fill="none" fill-rule="evenodd">
                        <g transform="translate(-9 -11)" fill="#1F73F1" fill-rule="nonzero">
                        <path d="m25.576 11.414c0.56558 0.55188 0.56558 1.4439 0 1.9961l-9.404 9.176c-0.28213 0.27529-0.65247 0.41385-1.0228 0.41385-0.37034 0-0.74068-0.13855-1.0228-0.41385l-4.7019-4.588c-0.56584-0.55188-0.56584-1.4442 0-1.9961 0.56558-0.55214 1.4798-0.55214 2.0456 0l3.679 3.5899 8.3812-8.1779c0.56558-0.55214 1.4798-0.55214 2.0456 0z" />
                        </g>
                      </g>
                    </svg>
                  </div>
                </div>
              @endforeach
            </div>
            @error('on_shift')<small class="mt-2 text-red-500">{{$message}}</small>@enderror
          </div>
        </div>
        <button type="submit" class="mt-5 mb-3 btn btn-red w-full py-2">
          Add
        </button>
      </div>
    </form>
  </div>
@stop