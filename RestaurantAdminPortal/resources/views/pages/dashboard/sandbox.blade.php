@extends('layouts.authorized')

@section('title', 'Dashboard')

@section('content')
@section('page-title', 'Sandbox')

<div class="container cursor-pointer" style="position: absolute; left:10px;top:30px;margin-left: -13px;cursor: pointer">
        <div class="burger">
          
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
  </div>


  <div class="container  sandbox ">
    <a class="dropdown-item" href="#"  onclick="document.getElementById('profileUpload_d').click()"><i class="fa fa-user-circle"></i>&nbsp;&nbsp; Change Profile Image</a>

      <h1>Sandbox</h1>
      {{-- @php session()->flash('') @endphp --}}
        <form id="selfUploadForm_m" action="{{route('sandbox-route')}}" method="POST"  enctype="multipart/form-data">
            @csrf
        <input type="file" name="profile_pic_c" id="profileUpload_d" onchange="sandboxImageUpload(this)" class="hidden" enctype="multipart/form-data"/>
            {{-- <button type="submit" class="p-1 rounded  m-auto text-blue-600 bg-white button sumbmit"> Submit</button> --}}
    </form>
            <div class="text">
                @if(session()->has('reload-page')) 
                    <h2> page reloaded</h2>
                @endif

            </div>
  </div>
  <div id="pictureUploadBlock" class="border-2 border-darkAsh-50 -mx-8 rounded-full w-16 h-16 bg-darkAsh-200">
    <img id="selfUploadImageBlock" class="img img-fluid rounded-full w-16 h-16 pb-1" src="{{ auth()->user()->profile_pic ?? config('app.profile_placeholder_url', '')}}">
    <img id="selfImagePreview" class="hidden border-2 border-gray-500 w-16 h-16 pb-1 rounded-full"/>
</div>
        <style>
            .sandbox{
                display: flex;
                padding: 50px;
                width: 400px;
                padding-top: 10px;
                height: 20vh;
                background: rgb(163, 156, 156);
                border-radius: 45px;

                justify-content: space-between;

                justify-items: center;
                margin: auto;
                flex-direction: column;
            }
        </style>


</div>
@stop