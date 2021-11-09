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
                        <div class="flex justify-center mb-20">
                              <a href="{{route('dashboard.home')}}">
                                    <img src="{{auth()->user()->restaurant->logo}}" alt="Logo" srcset="" class="h-32 w-32">
                              </a>
                        </div>
                        <div class="flex justify-center">
                              <div class="flex-1">
                                    @yield('content')
                              </div>
                        </div>
                  </div>
            </div>
      </div>

      <div class="sidebar-mobile ">
            <nav>
                  <ul class="nav-links p-1">
                        <a href="#" class="p-1">  
            <img src="https://menuplus-dev-921487239036.s3.ap-southeast-2.amazonaws.com/menuplus_images/logos/png/logo_gold.png" alt="Logo" srcset="" class="restaurant-logo mx-auto">
                        </a>
                              <a href="{{route('dashboard.home')}}" class="text-white block hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('dashboard-nav-active')">
                                    @php
                                          $toggleRedBar = View::hasSection('dashboard-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                                    @endphp
                                    <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                                    <div class="px-6 py-2">Dashboard</div>
                                    
                              </a>
                  
                              <a href="{{route('payments.home')}}" class="text-white block hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('payments-nav-active')">
                                    @php
                                          $toggleRedBar = View::hasSection('payments-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                                    @endphp
                                    <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                                    <div class="px-6 py-2">Payment</div>
                              </a>
                        
                              <a href="{{route('accountinfo.home')}}" class="text-white block hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('accountinfo-nav-active')">
                                    @php
                                          $toggleRedBar = View::hasSection('accountinfo-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                                    @endphp
                                    <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                                    <div class="px-6 py-2">Account Info</div>
                                    
                              </a>
                        
                  
                              <a href="{{route('qrcode.home')}}" class="text-white block hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('qrcode-nav-active')">
                                    @php
                                          $toggleRedBar = View::hasSection('qrcode-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                                    @endphp
                                    <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                                    <div class="px-6 py-2">Generate QR Code</div>
                            
                                 </a>

                                 <div class="absolute mb-10 bottom-10 w-100">
                                    <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout').submit();" class="text-white bg-danger  hover:bg-darkAsh-200 hover:text-white transition duration-200 flex hover:no-underline @yield('account-nav-active')">
                                          <span class="px-4 pt-2 pb-1 h5">
                                                <i class="fa fa-sign-out-alt"></i>&emsp; Logout
                                          </span>
                                    </a>
                                    <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                    </form>
                              </div>
                  
                  </ul>
            </nav>
      </div>
@stop