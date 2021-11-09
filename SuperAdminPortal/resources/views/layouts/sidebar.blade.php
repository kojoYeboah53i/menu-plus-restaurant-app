{{-- mobile menu bar --}}
<script>
      const testfuck = () => {

      alert("blunt")
      }
</script>
<div> <button class="p-4 bg-darkAsh-100 text-white" onclick="testfuck()"> count</button> </div>
<div class="h-screen sidebar  absolute top-0 sidebar bg-darkAsh-200 text-blue-100 w-64 space-y-6 md:relative md:translate-x-0 py-7 
       inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out">
      <div class="text-right mr-3 md:hidden">
            <i class="fa fa-times fa-2x mobile-menu-button"></i>
      </div>
      <a href="{{route('dashboard.home')}}">
            <img src="https://menuplus-dev-921487239036.s3.ap-southeast-2.amazonaws.com/menuplus_images/logos/png/logo_gold.png" alt="Logo" srcset="" class="mx-auto img img-fluid   appLogo" width="70%"> 
      </a>
      @php $isSubMenu = trim($__env->yieldContent('is-submenu')); @endphp
      <nav>
            <div style="overflow-y: auto; height: 60vh;scrollbar-width: thin;">
            <div class="text-white block hover:bg-darkAsh-400 transition duration-200 flex @yield('dashboard-nav-active')">
                  @php
                        $toggleRedBar = View::hasSection('dashboard-nav-redbar') && $isSubMenu === '' ? 'redbar-active' : 'redbar-inactive';
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-3 w-100">
                        <div class="row justify-content-between">
                              <a href="{{route('dashboard.home')}}" class="hover:no-underline hover:text-white"><div style="font-size: 16px; font-weight: 400;">Dashboard</div></a>
                              <div><button value="dashboard-submenus" onclick="sidebarCaret(this, this.value)"><i class="fas @if(View::hasSection('dashboard-nav-active')) fa-caret-up @else fa-caret-down @endif"></i></button></div>
                        </div>
                  </div>
            </div>
            <a href="{{route('dashboard.cities.home')}}" class="text-white @if(View::hasSection('dashboard-nav-active')) block @else hidden @endif hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('dashboard-nav-active') dashboard-submenus">
                  @php
                        $toggleRedBar = View::hasSection('cities-nav-redbar') ? 'redbar-active' : 'redbar-inactive';
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-1">&emsp;&emsp; State & Location</div>
            </a>
            <div class="text-white hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('manage-nav-active')">
                  @php
                        $toggleRedBar = View::hasSection('manage-nav-redbar') && $isSubMenu === '' ? 'redbar-active' : 'redbar-inactive';
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-3 w-100">
                        <div class="row justify-content-between">
                              <a href="{{route('manage.home')}}" class="hover:no-underline hover:text-white"><div style="font-size: 16px; font-weight: 400;">Management</div></a>
                              <div><button value="manage-submenus" onclick="sidebarCaret(this, this.value)"><i class="fas @if(View::hasSection('manage-nav-active')) fa-caret-up @else fa-caret-down @endif"></i></button></div>
                        </div>
                  </div>
            </div>
            <a href="{{route('manage.accounts.home')}}" class="text-white @if(View::hasSection('manage-nav-active')) block @else hidden @endif hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('manage-nav-active') manage-submenus">
                  @php
                        $toggleRedBar = View::hasSection('accounts-nav-redbar') ? 'redbar-active' : 'redbar-inactive';
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-1">&emsp;&emsp; Accounts</div>
            </a>
            <a href="{{route('manage.restaurants.home')}}" class="text-white @if(View::hasSection('manage-nav-active')) block @else hidden @endif hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('manage-nav-active') manage-submenus">
                  @php
                        $toggleRedBar = View::hasSection('restaurants-nav-redbar') ? 'redbar-active' : 'redbar-inactive';
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-1">&emsp;&emsp; Restaurants</div>
            </a>
            <a href="{{route('manage.statistics.home')}}" class="text-white @if(View::hasSection('manage-nav-active')) block @else hidden @endif hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('manage-nav-active') manage-submenus">
                  @php
                        $toggleRedBar = View::hasSection('statistics-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-1">&emsp;&emsp; Statistics & Analysis</div>
            </a>
            <div class="text-white block hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('products-nav-active')">
                  @php
                        $toggleRedBar = View::hasSection('products-nav-redbar') && $isSubMenu === '' ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-3 w-100">
                        <div class="row justify-content-between">
                              <a href="{{route('products.home')}}" class="hover:no-underline hover:text-white"><div style="font-size: 16px; font-weight: 400;">Products & Pricing</div></a>
                              <div><button value="products-submenus" onclick="sidebarCaret(this, this.value)"><i class="fas @if(View::hasSection('products-nav-active')) fa-caret-up @else fa-caret-down @endif"></i></button></div>
                        </div>
                  </div>
            </div>
            <a href="{{route('products.product.home')}}" class="text-white  @if(View::hasSection('products-nav-active')) block @else hidden @endif hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('products-nav-active') products-submenus">
                  @php
                        $toggleRedBar = View::hasSection('product-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-1">&emsp;&emsp; Manage Products</div>
            </a>
            <a href="{{route('products.pricing.home')}}" class="text-white @if(View::hasSection('products-nav-active')) block @else hidden @endif hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('products-nav-active') products-submenus">
                  @php
                        $toggleRedBar = View::hasSection('pricing-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-1">&emsp;&emsp; Subscription Pricing</div>
            </a>
            <div class="text-white block hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('sales-nav-active')">
                  @php
                        $toggleRedBar = View::hasSection('sales-nav-redbar') && $isSubMenu === '' ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-3 w-100">
                        <div class="row justify-content-between">
                              <a href="{{route('sales.home')}}" class="hover:no-underline hover:text-white"><div style="font-size: 16px; font-weight: 400;">Manage Sales</div></a>
                              <div><button value="sales-submenus" onclick="sidebarCaret(this, this.value)"><i class="fas @if(View::hasSection('sales-nav-active')) fa-caret-up @else fa-caret-down @endif"></i></button></div>
                        </div>
                  </div>
            </div>
            <a href="#" class="text-white @if(View::hasSection('sales-nav-active')) block @else hidden @endif hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('sales-nav-active') sales-submenus">
                  @php
                        $toggleRedBar = View::hasSection('agent-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-1">&emsp;&emsp; Direct Sales Agent</div>
            </a>
            <a href="#" class="text-white @if(View::hasSection('sales-nav-active')) block @else hidden @endif hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('sales-nav-active') sales-submenus">
                  @php
                        $toggleRedBar = View::hasSection('channels-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-1">&emsp;&emsp; Sales Channels</div>
            </a>
            <a href="#" class="text-white @if(View::hasSection('sales-nav-active')) block @else hidden @endif hover:bg-darkAsh-400 hover:text-white transition duration-200 flex hover:no-underline @yield('sales-nav-active') sales-submenus">
                  @php
                        $toggleRedBar = View::hasSection('affiliates-nav-redbar') ? 'redbar-active' : 'redbar-inactive'
                  @endphp
                  <div class="active border-l-4 border-red-600 py-3 no-underline {{$toggleRedBar}}"></div>
                  <div class="px-4 py-1">&emsp;&emsp; Sales Affiliates</div>
            </a>
            </div>
            
            <div class="fixed bottom-0 w-100">
                  <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout').submit();" class="text-white bg-danger  hover:bg-darkAsh-200 hover:text-white transition duration-200 flex hover:no-underline @yield('account-nav-active')">
                        <span class="px-4 pt-2 pb-1 h5">
                              <i class="fa fa-sign-out"></i>&emsp; Logout
                        </span>
                  </a>
                  <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                  </form>
            </div>
      </nav>
</div>

<script>
      function sidebarCaret(element, class_name) {
            var subMenus = document.getElementsByClassName(class_name);
            var icon = (element.children)[0];
            if(icon.classList.contains("fa-caret-up")){
                  icon.classList.remove("fa-caret-up");
                  icon.classList.add("fa-caret-down");
                  for(var i = 0; i < subMenus.length; i++){
                        if(subMenus[i].classList.contains("block")){
                              subMenus[i].classList.remove("block");
                              subMenus[i].classList.add("hidden");
                        }else{
                              subMenus[i].classList.add("hidden");
                        }                        
                  }
            }
            else if(icon.classList.contains("fa-caret-down")){
                  icon.classList.remove("fa-caret-down");
                  icon.classList.add("fa-caret-up");
                  for(var i=0; i < subMenus.length; i++){
                        if(subMenus[i].classList.contains("hidden")){
                              subMenus[i].classList.remove("hidden");
                              subMenus[i].classList.add("block");
                        }else{
                              subMenus[i].classList.add("block");
                        }
                  }
            }
      }
</script>