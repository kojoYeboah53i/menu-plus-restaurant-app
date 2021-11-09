@extends('layouts.page-details')

@section('title', 'Cities & Territories')

@section('content')
      @section('page-title', 'Cities & Territories')
      @section('page-back', route('dashboard.home'))
      <div class="mt-5 flex justify-between space-x-10">
        <div class="w-8/12 search-field">
          <div class="flex justify-between items-center space-x-5">
            <form class="flex items-center flex-1" action="{{route('dashboard.cities.home')}}" method="GET">
              <input type="text" value="{{old('searchKey')}}" class="w-11/12 search-field-input" name="searchKey" placeholder="Search State, City, Suburb or Post Code">
              <div class="w-1/12 text-center"><button><i class="fa fa-search cursor-pointer"></i></button></div>
            </form>
          </div>
        </div>
        <div class="w-4/12 text-darkAsh-50 border-2 border-darkAsh-200 px-5 py-3 bg-darkAsh-200 text-right rounded-lg">
          @isset($search_key)
            {{$search_key}}
          @else
            All Restaurants
          @endisset
        </div>
      </div>
      <div class="rounded-lg mt-3 p-4 bg-darkAsh-200 grid grid-cols-1">
        <div class="text-darkAsh-50 mb-4">
          <div class="grid grid-cols-12 gap-4">
            <div class="col-span-4 text-center">Business Type</div>
            <div class="col-span-8 grid gap-4 grid-cols-4 place-items-center">
              <div>Active</div>
              <div>Inactive</div>
              <div>Menuplus</div>
              <div>Mis-en Plus</div>
            </div>
          </div>
        </div>
        @for ($i = 0; $i < 4; $i++)
          <div class="mb-2">
            <div class="grid grid-cols-12 gap-4">
              <div class="col-span-4">
                <div class="flex justify-center">
                  <div class="w-10/12 place-items-center border-darkAsh-400 rounded-lg py-2 px-3 bg-darkAsh-400 
                  border-2 text-darkAsh-50">{{$business_type[$i]}}</div>
                </div>
              </div>
              <div class="col-span-8 grid gap-4 grid-cols-4 place-items-center">
                <div class="flex justify-center">
                  <div class="place-items-center border-darkAsh-400 rounded-lg py-2 px-3 bg-darkAsh-400 
                  border-2 text-darkAsh-50">{{$actives[$i]}}</div>
                </div>
                <div class="flex justify-center">
                  <div class="place-items-center border-darkAsh-400 rounded-lg py-2 px-3 bg-darkAsh-400 
                  border-2 text-darkAsh-50">{{$inactives[$i]}}</div>
                </div>
                <div class="flex justify-center">
                  <div class="place-items-center border-darkAsh-400 rounded-lg py-2 px-3 bg-darkAsh-400 
                  border-2 text-darkAsh-50">0</div>
                </div>
                <div class="flex justify-center">
                  <div class="place-items-center border-darkAsh-400 rounded-lg py-2 px-3 bg-darkAsh-400 
                  border-2 text-darkAsh-50">0</div>
                </div>
              </div>
            </div>
          </div>
        @endfor
      </div>
@stop