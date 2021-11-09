@extends('layouts.page-details')

@section('title', 'Dinning Areas')

@section('content')
      @section('page-title', 'Dinning Areas')
      <div class="container cursor-pointer" style="position: absolute; left:10px;top:30px;margin-left: -13px;cursor: pointer">
            <div class="burger">
              
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
      </div>
      @section('page-back', route('dashboard.staff.list'))
      <div class="mt-20">
            <div class="flex justify-center space-x-7 flex-wrap">
                  @empty($dinningAreasNav)
                        <span class="text-secondary h5 mb-10">No Dinning Area Available</span>
                  @else
                        @foreach($dinningAreasNav as $item)
                              <div class="cursor-pointer mb-10 bg-darkAsh-200 text-center py-4 rounded-lg w-1/4 space-between" onclick="window.location='{{route('dashboard.dinning-area.assignedStaff', ['id' => $item['id']])}}'">
                                    <span class="block">{{$item['title']}}</span>
                              </div>
                        @endforeach
                  @endempty
            </div>
            <div class="title-w900"></div>
            <div class="flex justify-center space-x-7 flex-wrap mt-10">
                  <div class="cursor-pointer mb-10 bg-darkAsh-200 text-center py-4 rounded-lg w-1/4 space-between" onclick="window.location='{{route('dashboard.tables.managedinningareas')}}'">
                        <span class="block">Create New Dinning Area</span>
                  </div>
            </div>
      </div>
@stop