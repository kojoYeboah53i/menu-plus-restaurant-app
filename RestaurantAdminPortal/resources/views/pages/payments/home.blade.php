@extends('layouts.authorized')

@section('title', 'Payment')

@section('content')
      @section('page-title', 'Payment')
      <div class="container cursor-pointer" style="position: absolute; left:10px;top:30px;margin-left: -13px;cursor: pointer">
            <div class="burger">
              
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
      </div>
      <div>
            @foreach($paymentsNav as $nav)
            <div class="mx-28 flex flex-col md:flex-row justify-center  space-y-7 md:space-y-0 md:space-x-7 flex-col md:flex-row md:mb-10 mb-10">
                  @foreach($nav as $item)
                        <div class="mb-0 md:mb-20 flex-1">
                              <div class="flex justify-center">
                                    <i class="{{$item['icon']}} fa-2x text-center -mb-3"></i>
                              </div>
                              <div class="cursor-pointer bg-darkAsh-200 text-center py-5 rounded-lg space-between" onclick="window.location='{{route($item['link'])}}'">
                                    <span class="block">{{$item['title']}}</span>
                              </div>
                        </div>
                  @endforeach
            </div>
            @endforeach
      </div>
@stop