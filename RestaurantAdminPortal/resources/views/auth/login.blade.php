@extends('layouts.visitor')

@section('title', 'Login')

@section('content')
  <div class="row justify-content-center">
    <img src="https://menuplus-dev-921487239036.s3.ap-southeast-2.amazonaws.com/menuplus_images/logos/png/logo_gold_slogan.png" alt="Logo" srcset="" class="restaurant-logo mt-5">
  </div>
  <h1> what the fuck is going on with this login</h1>
  <div class="mt-3 font-light text-2xl">Welcome to the <span class="font-extrabold">MenuPlus</span></div>
  <div class="flex justify-center mt-10">
    <form action="{{route('login')}}" method="POST" class="bg-darkAsh-200 px-5 pb-5 w-5/12 rounded-xl">
      <div class="my-4 text-md font-light">Login As Restaurant Admin</div>
      @csrf
      <input type="email" value="{{old('email')}}" required  name="email" placeholder="Email Or Phone Number" class="input-field @error('email') input-error @enderror">
      @error('email')
        <small class="text-red-500 text-left flex justify-start -mt-2 mb-3">{{ $message }}</small>
      @enderror
      <input type="password" required name="password" placeholder="Password" class="input-field @error('password') input-error @enderror">
      @error('password')
        <small class="text-red-500 text-left flex justify-start -mt-2 mb-3">{{ $message }}</small>
      @enderror
      {{-- <input type="text" placeholder="Verification Code" class="input-field"> --}}
      <button class="text-white bg-red-600 w-full mt-4 py-2 rounded-lg"><span class="h5">Login</span></button>
    </form>
  </div>
@stop