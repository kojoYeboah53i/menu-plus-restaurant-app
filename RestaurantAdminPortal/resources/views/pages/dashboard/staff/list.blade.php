@extends('layouts.page-details')

@section('title', 'Manage Staff')

@section('content')
  @section('page-title', 'Manage Staff')
  @section('page-back', route('dashboard.home'))

  <div class="mt-5 flex justify-{{count($staff) > 0 ? 'between' : 'center'}} space-x-10">
      <a href="{{route('dashboard.staff.create')}}" class="w-2/12 btn btn-red no-underline hover:no-underline hover:text-white">Add New Staff</a>
    @if(count($staff) > 0)
      <div class="flex-1 search-field">
        <div class="flex justify-between items-center space-x-5">
            <form class="flex items-center flex-1" action="{{route('dashboard.staff.list')}}" method="GET">
                  <input type="text" value="{{old('searchKey')}}" class="w-11/12 search-field-input" name="searchKey" placeholder="Search">
                  <div class="w-1/12 text-center"><button><i class="fa fa-search cursor-pointer"></i></button></div>
            </form>
        </div>
      </div>
    @endif
    <a href="{{route('dashboard.dinning-area.list')}}" class="w-2/12 btn btn-blue no-underline hover:no-underline hover:text-white">View Dinning Area</a>
  </div>
  <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : ''}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
    {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
  </div>
  @if(count($staff) > 0)
  <div class="mt-5"></div>
<div class="{{session()->has('search_message') ? '' : 'hidden'}} bg-blue-500 text-blue-200 py-2 text-center rounded-lg my-3">
      {{session()->get('search_message')}}</div>
  @foreach($staff as $user)
  <div class="rounded-lg mb-3 p-4 bg-darkAsh-300 font-light">
            @method('PUT')
            @csrf  
            <div class="flex justify-between space-x-8">
                  <div class="w-full flex justify-between space-x-8">
                        <div class="w-full flex space-x-6">
                              <img class="rounded-full w-28 h-28 border border-darkAsh-300" src="{{ $user->profile_pic }}" />
                              <div class="flex-1">
                                    <div class="flex justify-between items-center">
                                          <div class="text-base">{{$user->fullname}}</div>
                                          <i class="fa fa-pencil"></i>
                                    </div>
                                    <div class="bg-gray-900 rounded-lg mt-3 ">
                                          <div class="select text-darkAsh-100">
                                                <select id="standard-select h-full">
                                                      <option value="Option 1">Edit Roll</option>
                                                </select>
                                                <span class="focus"></span>
                                          </div>
                                    </div>
                                    <div class="bg-gray-900 rounded-lg mt-3 ">
                                          <div class="select text-darkAsh-100">
                                                <select id="standard-select h-full">
                                                      <option value="Option 1">28/h</option>
                                                </select>
                                                <span class="focus"></span>
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="border-r-2 border-gray-500"></div>
                  </div>
                  <div class="w-full flex justify-between space-x-8">
                        <div class="w-full flex-1 flex justify-center space-x-10">
                              <div class="bg-gray-800 w-11/12 text-white p-3">
                                    <div>Employment</div>
                                    <div class="mt-3">
                                          <div class="flex mt-1 items-center space-x-2">
                                                <div  class="h-4 w-4 rounded-full border p-1 border-red-500 flex  justify-center items-center">
                                                      <input type="radio" {{$user->employment_type === 'casual' ? 'checked': ''}} class="input-value{{$user->id}}" name="employment_type_{{$user->id}}" data-val="casual"> 
                                                </div>
                                                <span class="text-darkAsh-50">Casual</span>
                                          </div>
                                          <div class="flex mt-1 items-center space-x-2">
                                                <div  class="h-4 w-4 rounded-full border p-1 border-red-500 flex  justify-center items-center">
                                                      <input type="radio" {{$user->employment_type === 'part-time' ? 'checked': ''}} class="input-value{{$user->id}}" name="employment_type_{{$user->id}}" data-val="part-time"> 
                                                </div>
                                                <span class="text-darkAsh-50">Part Time</span>
                                          </div>
                                          <div class="flex mt-1 items-center space-x-2">
                                                <div  class="h-4 w-4 rounded-full border p-1 border-red-500 flex  justify-center items-center">
                                                      <input type="radio" {{$user->employment_type === 'full-time' ? 'checked': ''}} class="input-value{{$user->id}}" name="employment_type_{{$user->id}}" data-val="full-time"> 
                                                </div>
                                                <span class="text-darkAsh-50">Full Time</span>
                                          </div>
                                    </div>
                              </div>
                              <div class="bg-gray-800 w-11/12 text-white p-3">
                                    <div>On Shift</div>
                                    <div class="mt-3">
                                          <div class="flex mt-1 items-center space-x-2">
                                                <div  class="h-4 w-4 rounded-full border p-1 border-red-500 flex  justify-center items-center">
                                                      <input type="radio" name="on_shift_{{$user->id}}" {{$user->on_shift === 'yes' ? 'checked': ''}} class="input-value{{$user->id}}" data-val="yes"> 
                                                </div>
                                                <span class="text-darkAsh-50">Yes</span>
                                          </div>
                                          <div class="flex mt-1 items-center space-x-2">
                                                <div  class="h-4 w-4 rounded-full border p-1 border-red-500 flex  justify-center items-center">
                                                      <input type="radio" name="on_shift_{{$user->id}}" {{$user->on_shift === 'no' ? 'checked': ''}} class="input-value{{$user->id}}" data-val="no"> 
                                                </div>
                                                <span class="text-darkAsh-50">No</span>
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="border-r-2 border-gray-500"></div>
                  </div>
                  <div class="w-9/12 flex flex-col justify-center items-center space-y-4">
                        <button class="w-44 btn btn-red" id="updateWaiterBtn" data-id="{{$user->id}}" data-url="{{route('dashboard.staff.update',['id' => $user->id])}}" 
                        >Save Changes</button>
                        <button class="w-44 btn btn-default" data-url="{{route('dashboard.staff.delete',['id' => $user->id])}}" 
                        onclick="event.preventDefault(); confirmAction('deleteItem', event)">Delete Staff</button>
                        <form class="hidden" id="deleteItem" method="POST">
                              @method('DELETE')
                              @csrf            
                        </form>
                  </div>
            </div>
      </div>
  @endforeach
  @else
    <div class="text-center mt-5 text-2xl font-light text-darkAsh-50">There are no staff accounts at this time.</div>
  @endif
@stop