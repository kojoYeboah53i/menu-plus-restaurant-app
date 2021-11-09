@extends('layouts.page-details')

@section('title', 'Edit Account')

@section('content')
      @section('page-title', 'Edit Account')
      @section('page-back', route('account.list'))
      <div class="flex justify-center">
        <div class="flex justify-between w-full rounded-sm mt-5 mb-1 px-5 py-4 bg-darkAsh-300">
          <div class="flex justify-between items-center">
            <div class="flex items-center justify-center border-4 border-gray-500 rounded-full text-center h-28 w-28 py-4">
              <small>No Image</small>
            </div>
            <div class="ml-3">
              <div class="text-lg">Hailey Adams</div>
              <div class="font-light text-sm text-darkAsh-50">
                <div>haileyadams@gmail.com</div>
                <div>Sydney</div>
                <div>120-131-1221</div>
              </div>
            </div>
          </div>
          <div class="align-self-center">
            <a href="{{route('products.customers.edit', ['id', '1'])}}" class="hover:no-underline hover:text-white btn btn-red py-1 px-4 block mb-2">Edit</a>
            <div class="btn btn-default py-1 px-4">Cancel</div>
          </div>
        </div>
      </div>
      <div class="flex justify-between mt-5 space-x-8">
        <div class="flex-1">
          <div class="font-extrabold text-lg">Liked Food</div>
          <div class="px-2 mt-3 flex justify-between text-sm font-light text-darkAsh-50">
            <div>Dish Name</div>
            <div>Restaurant Name</div>
            <div>Total Price</div>
          </div>
          <div class="px-3 py-2 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Pizza</div>
            </div>
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Americano</div>
            </div>
            <div class="text-white flex items-center">$25000</div>
          </div>
          <div class="px-3 py-2 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Pizza</div>
            </div>
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Americano</div>
            </div>
            <div class="text-white flex items-center">$25000</div>
          </div>
          <div class="px-3 py-2 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Pizza</div>
            </div>
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Americano</div>
            </div>
            <div class="text-white flex items-center">$25000</div>
          </div>
          <div class="px-3 py-2 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Pizza</div>
            </div>
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Americano</div>
            </div>
            <div class="text-white flex items-center">$25000</div>
          </div>
          <div class="px-3 py-2 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Pizza</div>
            </div>
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Americano</div>
            </div>
            <div class="text-white flex items-center">$25000</div>
          </div>
        </div>
        <div class="flex-1">
          <div class="font-extrabold text-lg">Disliked Food</div>
          <div class="px-2 mt-3 flex justify-between text-sm font-light text-darkAsh-50">
            <div>Dish Name</div>
            <div>Restaurant Name</div>
            <div>Total Price</div>
          </div>
          <div class="px-3 py-2 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Pizza</div>
            </div>
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Americano</div>
            </div>
            <div class="text-white flex items-center">$25000</div>
          </div>
          <div class="px-3 py-2 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Pizza</div>
            </div>
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Americano</div>
            </div>
            <div class="text-white flex items-center">$25000</div>
          </div>
          <div class="px-3 py-2 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Pizza</div>
            </div>
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Americano</div>
            </div>
            <div class="text-white flex items-center">$25000</div>
          </div>
          <div class="px-3 py-2 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Pizza</div>
            </div>
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Americano</div>
            </div>
            <div class="text-white flex items-center">$25000</div>
          </div>
          <div class="px-3 py-2 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Pizza</div>
            </div>
            <div class="flex items-center">
              <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
              <div class="ml-1 text-white">Americano</div>
            </div>
            <div class="text-white flex items-center">$25000</div>
          </div>
        </div>
      </div>
      <div class="mt-5">
        <div class="font-extrabold text-lg mb-2">Most Visited Restaurant</div>
        <div class="px-3 py-3 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
          <div class="flex items-center">
            <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
            <div class="ml-1">
              <div>Restaurant Name</div>
              <div class="text-white"><b>Americano</b></div>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex-1">
              <div>Total Visits</div>
              <div class="text-white"><b>12</b></div>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex-1">
              <div>Total Spent</div>
              <div class="text-white"><b>$25000</b></div>
            </div>
          </div>
        </div>
        <div class="px-3 py-3 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
          <div class="flex items-center">
            <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
            <div class="ml-1">
              <div>Restaurant Name</div>
              <div class="text-white"><b>Americano</b></div>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex-1">
              <div>Total Visits</div>
              <div class="text-white"><b>12</b></div>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex-1">
              <div>Total Spent</div>
              <div class="text-white"><b>$25000</b></div>
            </div>
          </div>
        </div>
        <div class="px-3 py-3 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
          <div class="flex items-center">
            <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
            <div class="ml-1">
              <div>Restaurant Name</div>
              <div class="text-white"><b>Americano</b></div>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex-1">
              <div>Total Visits</div>
              <div class="text-white"><b>12</b></div>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex-1">
              <div>Total Spent</div>
              <div class="text-white"><b>$25000</b></div>
            </div>
          </div>
        </div>
        <div class="px-3 py-3 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
          <div class="flex items-center">
            <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
            <div class="ml-1">
              <div>Restaurant Name</div>
              <div class="text-white"><b>Americano</b></div>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex-1">
              <div>Total Visits</div>
              <div class="text-white"><b>12</b></div>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex-1">
              <div>Total Spent</div>
              <div class="text-white"><b>$25000</b></div>
            </div>
          </div>
        </div>
        <div class="px-3 py-3 mt-2 bg-darkAsh-200 flex justify-between text-sm font-light text-darkAsh-50">
          <div class="flex items-center">
            <div class="rounded-full w-12 h-12 border-4 border-darkAsh-500"></div>
            <div class="ml-1">
              <div>Restaurant Name</div>
              <div class="text-white"><b>Americano</b></div>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex-1">
              <div>Total Visits</div>
              <div class="text-white"><b>12</b></div>
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex-1">
              <div>Total Spent</div>
              <div class="text-white"><b>$25000</b></div>
            </div>
          </div>
        </div>
      </div>
@stop