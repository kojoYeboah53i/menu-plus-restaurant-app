@extends('layouts.app')

@section('main')
      @php
        $routeActive = explode('.', Route::currentRouteName())[0];
      @endphp
      <div class="relative min-h-screen md:flex">
        @section($routeActive . '-nav-active', 'active')
        @section($routeActive . '-nav-redbar', 'redbar-active')
        <div class="fixed">
          @include('layouts.sidebar')
        </div>
        <div class="relative md:ml-64 flex-1">
          <div class="px-10 pt-3 pb-10">
            <div>
              @include('layouts.top-nav')
            </div>
            <div class="flex justify-between items-center">
              <div>
                <a href="@yield('page-back')" class="hover:text-darkAsh-100 hover:no-underline">
                  <i class="fa fa-angle-left mr-3 cursor-pointer"></i>
                  @yield('page-title')
                </a>
              </div>
              <div class="col-md-2">
                <img src="{{Auth::user()->restaurant->logo}}" class="img img-fluid">
              </div>
            </div>
            <div class="flex justify-center">
              <div class="flex-1">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
      </div>
@stop