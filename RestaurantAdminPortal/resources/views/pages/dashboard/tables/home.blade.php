@extends('layouts.page-details')

@section('title', 'Manage Table')

@section('content')
      @section('page-title', 'Manage Tables')
      @section('page-back', route('dashboard.home'))
      <div class="mt-20">
            @foreach($tableNav as $nav)
                  <div class="flex justify-center space-x-7 flex-col md:flex-row">
                        @foreach($nav as $item)
                              <div class="mb-20 flex-1">
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