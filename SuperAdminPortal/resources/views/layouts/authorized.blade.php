@extends('layouts.app')

@section('main')
      @php
            $routeArray = explode('.', Route::currentRouteName());
            $routeActive = $routeArray[0];
            $routeSubActive = ($routeArray[1] == 'home' )? $routeActive : $routeArray[1];
      @endphp
      <div class="relative min-h-screen md:flex">
            @section($routeActive . '-nav-active', 'active')
            @section($routeSubActive . '-nav-redbar', 'redbar-active')
            <div class="fixed">
                  @include('layouts.sidebar')
            </div>
            <div class="relative md:ml-64 flex-1">
                  <div class="px-10 pt-3 pb-10">
                        <div class="mb-48">
                              @include('layouts.top-nav')
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