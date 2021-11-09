@extends('layouts.authorized')

@section('title', 'Manage Sales')

@section('content')
      @section('page-title', 'Manage Sales')
      <div class="mt-10">
            @foreach($navs as $nav)
                  <div class="mx-28 flex flex-col md:flex-row justify-center  space-y-7 md:space-y-0 md:space-x-7 md:mb-10 mb-10">
                        @foreach($nav as $item)
                              <div class="mb-0 md:mb-20 flex-1">
                                    <div class="flex justify-center">
                                          <i class="{{$item['icon']}} fa-2x text-center -mb-3"></i>
                                    </div>
                                    <div class="cursor-pointer bg-darkAsh-200 text-center py-5 rounded-lg space-between">
                                          <span class="block">{{$item['title']}}</span>
                                    </div>
                              </div>
                        @endforeach
                  </div>
            @endforeach
      </div>
@stop