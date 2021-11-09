@extends('layouts.page-details')

@section('title', 'Manage Staff')

@section('content')
  @section('page-title', 'Dinning Areas')
  @section('page-back', route('dashboard.dinning-area.list'))

  <div class="text-center mt-3 mb-4 font-bold text-xl">Dinning Area: {{$dinningArea->name}}</div>
  <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : ''}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
    {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
  </div>
  <div class="flex space-x-10 mt-5">
    <div class="w-1/2 mt-3">
      <div class="mb-3">Staff Unassigned To Dinning Area</div>
      @if(count($dinningArea->unassigned_waiters) > 0)
        @foreach($dinningArea->unassigned_waiters as $user)
        <div class="rounded-lg mb-2 px-4 py-2 bg-darkAsh-300 font-light">
          <div class="flex justify-between items-center">
            <div>{{$user->fullname}}</div>
            <div class="font-extrabold text-xl cursor-pointer text-green-500" data-url="{{route('dashboard.dinning-area.syncDinningAreaStaff',
            ['type' => 'assign', 'waiter_ID' => $user->id, 'dining_area_ID' => $dinningArea->id])}}" 
            onclick="event.preventDefault(); confirmAction('syncWaiter', event)">+</div>
          </div>
          <form class="hidden" id="syncWaiter" method="POST">
            @csrf
          </form>
        </div>
        @endforeach
      @else
        <div class="rounded-lg mt-3 mb-1 p-4 bg-darkAsh-300 font-light">
          <div class="text-center py-2 text-base font-light text-darkAsh-50">All staff have been assigned to this dinning area.</div>
        </div>
      @endif
    </div>
    <div class="w-1/2 mt-3">
      <div class="mb-3">Staff Assigned To Dinning Area</div>
      @if(count($dinningArea->assigned_waiters) > 0)
        @foreach($dinningArea->assigned_waiters as $user)
        <div class="rounded-lg mb-2 px-4 py-2 bg-darkAsh-300 font-light">
          <div class="flex justify-between items-center">
            <div>{{$user->fullname}}</div>
            <div class="font-extrabold text-xl cursor-pointer text-red-500" data-url="{{route('dashboard.dinning-area.syncDinningAreaStaff',
            ['type' => 'unassign', 'waiter_ID' => $user->id, 'dining_area_ID' => $dinningArea->id])}}" 
            onclick="event.preventDefault(); confirmAction('syncWaiter', event)">-</div>
          </div>
          <form class="hidden" id="syncWaiter" method="POST">
            @csrf
          </form>
        </div>
        @endforeach
      @else
        <div class="rounded-lg mt-3 mb-1 p-4 bg-darkAsh-300 font-light">
          <div class="text-center py-2 text-base font-light text-darkAsh-50">There are no staff assigned to this dinning area.</div>
        </div>
      @endif
    </div>
  </div>
@stop