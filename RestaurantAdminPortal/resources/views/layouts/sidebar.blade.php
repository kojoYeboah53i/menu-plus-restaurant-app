
{{-- mobile menu bar --}}
<div class="bg-transparent md:bg-darkAsh-200 text-gray-400 flex justify-between block md:hidden">
            
  
      {{-- <i class="mobile-menu-button cursor-pointer fa fa-bars fa-2x block p-4 font-bold hover:bg-gray-700"></i> --}}
      <a href="" class="block p-4 font-bold"></a>
</div>
<div class="h-screen sidebar  absolute top-0 sidebar bg-darkAsh-200 text-blue-100 w-64 space-y-6 md:relative md:translate-x-0 py-7 
       inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out">
      <div class="text-right mr-3 md:hidden">
            <i class="fa fa-times cursor-pointer fa-2x mobile-menu-button"></i>
  
      </div>


      <a href="#">
            <img src="https://menuplus-dev-921487239036.s3.ap-southeast-2.amazonaws.com/menuplus_images/logos/png/logo_gold.png" alt="Logo" srcset="" class="restaurant-logo mx-auto">
      </a>
 
      <nav>
            <a href="{{route('dashboard.home')}}" class="text-white block hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('dashboard-nav-active')">
                  @php
                        $toggleRedBar = View::hasSection('dashboard-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-3">Dashboard</div>
        
            </a>
            <a href="{{route('payments.home')}}" class="text-white block hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('payments-nav-active')">
                  @php
                        $toggleRedBar = View::hasSection('payments-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-3">Payment</div>
            </a>
            <a href="{{route('accountinfo.home')}}" class="text-white block hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('accountinfo-nav-active')">
                  @php
                        $toggleRedBar = View::hasSection('accountinfo-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-3">Account Info</div>
             
            </a>
            <a href="{{route('qrcode.home')}}" class="text-white block hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('qrcode-nav-active')">
                  @php
                        $toggleRedBar = View::hasSection('qrcode-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-3">Generate QR Code</div>
          
                </a>
            <div class="absolute bottom-0 w-100">
                  <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout').submit();" class="text-white bg-danger  hover:bg-darkAsh-200 hover:text-white transition duration-200 flex hover:no-underline @yield('account-nav-active')">
                        <span class="px-4 pt-2 pb-1 h5">
                              <i class="fa fa-sign-out-alt"></i>&emsp; Logout
                        </span>
                  </a>
                  <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                  </form>
            </div>
      </nav>
</div>


