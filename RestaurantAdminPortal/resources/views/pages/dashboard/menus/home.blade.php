@extends('layouts.page-details')

@section('title', 'Manage Menus')

@section('content')
      @section('page-title', 'Manage Menus')
      <div class="container cursor-pointer" style="position: absolute; left:10px;top:30px;margin-left: -13px;cursor: pointer">
            <div class="burger">
              
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
      </div>
      @section('page-back', route('dashboard.home'))
      
      <div class="my-3 {{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : old('')}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
            {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
      </div>
      <div class="mt-20">
            <div class="flex justify-center space-x-7 flex-wrap">
                  @empty($menusNav)
                        <span class="text-secondary h5 mb-10">No Menus Available</span>
                  @else
                        @foreach($menusNav as $item)
                              <div class="cursor-pointer mb-10 bg-darkAsh-200 text-center py-4 rounded-lg w-1/4 space-between" onclick="window.location='{{route($item['link'], ['id' => $item['id']])}}'">
                                    <span class="block">{{$item['title']}}</span>
                              </div>
                        @endforeach
                  @endempty
            </div>
            <div class="title-w900"></div>
            <div class="flex justify-center space-x-7 flex-wrap mt-10">
                  <div class="cursor-pointer mb-10 bg-darkAsh-200 text-center py-4 rounded-lg w-1/4 space-between" onclick="window.location='{{route('dashboard.menus.create.menu')}}'">
                        <span class="block">Create New Menu</span>
                  </div>
                  <div class="cursor-pointer mb-10 bg-darkAsh-200 text-center py-4 rounded-lg w-1/4 space-between" onclick="window.location='{{route('dashboard.menus.create.dish')}}'">
                        <span class="block">Create New Dish</span>
                  </div>
            </div>
      </div>
@stop