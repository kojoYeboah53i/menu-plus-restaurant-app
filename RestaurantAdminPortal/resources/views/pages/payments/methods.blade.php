@extends('layouts.authorized')

@section('title', 'Payment')

@section('content')
      @section('page-title', 'Payment Methods')
      <div class="mt-20 flex justify-center">
        <div class="bg-darkAsh-300 w-full md:w-9/12 py-14">
          @foreach($methods as $nav)
            <div class="flex justify-center space-x-10 flex-col md:flex-row">
              @foreach($nav as $item)
                    <div class="relative -mt-2 left-40 hidden">
                      <i class="fa fa-check fa-1x block rounded-full border border-red-500 bg-red-600"></i>
                    </div>
                    <div class="cursor-pointer {{!$loop->parent->last ? 'mb-10' : ''}} border border-gray-100 text-center py-4 
                      rounded-lg w-9/12 md:w-1/4 space-between flex justify-center items-center space-x-2 payment-method-card mb-10"
                      data-index="{{$loop->parent->index . $loop->index}}">
                          <i class="fa {{$item['icon']}}"></i><span class="block">{{$item['title']}}</span>
                    </div>
              @endforeach
            </div>
          @endforeach
        
        </div>
      </div>
@stop