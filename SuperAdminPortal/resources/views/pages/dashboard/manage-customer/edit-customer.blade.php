@extends('layouts.page-details')

@section('title', 'Edit Account')

@section('content')
      @section('page-title', 'Edit Account')
      @section('page-back', route('dashboard.home'))
      <div class="flex justify-center">
        <div class="flex justify-between flex-1 rounded-sm mt-5 mb-1 px-5 py-4 bg-darkAsh-300">
          <div class="flex items-center">
            <div class="flex items-center justify-center border-4 border-gray-500 rounded-full text-center h-28 w-28 py-4">
              <small>No Image</small>
            </div>
            <div class="text-sm font-light ml-3">
              <div class="text-darkAsh-50">Customer Name</div>
              <div class="text-white text-lg font-extrabold">Hailey Adams</div>
            </div>
          </div>
          <div class="align-self-center">
            <div class="btn btn-red py-1 px-4 block mb-2">Update</div>
            <div class="btn btn-default py-1 px-4">Cancel</div>
          </div>
        </div>
      </div>
      <div class="flex justify-center">
        <div class="flex-1 rounded-sm mt-4 mb-1 px-5 py-4 bg-darkAsh-300">
          <div class="flex items-center justify-center">
            <div class="border-4 border-gray-500 rounded-full text-center h-28 w-28 py-4">
              <div class="block flex-1">
                <i class="fa fa-camera"></i>
              </div>
              <div class="block flex-1 text-xs">Add Image</div>
            </div>
          </div>
          <div class="text-center mt-2">Edit Info</div>
          <div class="grid grid-rows-4 gap-0 mt-4">
            <input type="text" placeholder="Name" class="input-field">
            <input type="text" placeholder="Mobile Number  " class="input-field">
            <input type="text" placeholder="Email" class="input-field">
            <input type="text" placeholder="Location" class="input-field">
            <div class="mt-3 btn btn-red w-full py-2">
              Update
            </div>
          </div>
        </div>
      </div>
@stop