@extends('layouts.page-details')

@section('title', 'Create Menu')

@section('content')
  @section('page-title', 'Create New Menu')
  @section('page-back', route('dashboard.menus.home'))
  <div class="max-w-6xl mt-5">
    <form class="flex justify-center" action="{{route('dashboard.menus.create.menu')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="restaurant_id" value="{{Auth::user()->restaurant_id}}">
      <input type="hidden" name="enabled" value="0">
      <div class="bg-darkAsh-300 text-white w-1/2 py-3 md:px-12 ">
        <div class="py-3">
          <div class="-mt-16 flex justify-center">
            <div onclick="document.getElementById('imgupload').click()" class="rounded-full flex justify-center items-center border-2 border-darkAsh-200 h-35 w-35 bg-darkAsh-300">
              <img id="imagePreview" class="hidden rounded-full border-2 border-gray-500 p-1 h-28 w-28"/>
              <div id="uploadImageBlock" class="rounded-full border-4 border-gray-500 text-center h-28 w-28 py-4 upload">
                <div class="block flex-1">
                  <i class="fa fa-camera"></i>
                </div>
                <div class="block flex-1 text-xs mt-1">Add Image</div>
                <input type="file" name="image" id="imgupload" onchange="loadFile(event);" class="hidden"/> 
              </div>
            </div>
          </div>
          <div class="my-3 {{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : old('')}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
            {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
          </div>
          <div>
            <hr class="block mx-3 my-4 border-darkAsh-100">
          </div>
          <div class="w-full md:mr-1 px-3">
            <input type="text" placeholder="Menu Name" class="form-control control-input background-alt-1 mb-2" id="name" name="name">
            <textarea name="description" id="description" rows="4" placeholder="Menu Description" class="form-control control-input background-alt-1 mb-2" style="resize: none; margin-bottom: 20px;"></textarea>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4"><button class="btn btn-danger py-1 w-100" type="submit">Save</button></div>
        </div>
      </div>
    </form>
  </div>
@stop