@extends('layouts.page-details')

@section('title', 'Manage Tables')

@section('content')
      @section('page-title', 'Manage Bookings')
      <div class="container cursor-pointer" style="position: absolute; left:10px;top:30px;margin-left: -13px;cursor: pointer">
            <div class="burger">
              
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
      </div>
      @section('page-back', route('dashboard.home'))
      <div class="flex md:space-x-10 2xl:space-x-20 mt-20">
            <div id="booking-calender" class="w-7/12"></div>
            <div class="w-5/12">
                  <div id="selectedBooking"></div>
                  <div class="flex justify-between items-center">
                        <div>Current Bookings</div>
                        <div class="select w-5/12 bg-darkAsh-200 text-white">
                              <select id="standard-select">
                                    <option value="Option 1">Breakfast</option>
                                    <option value="Option 1">Lunch</option>
                                    <option value="Option 1">Supper</option>
                              </select>
                        </div>
                  </div>
                  <div class="mt-3 max-h-96 overflow-y-auto">
                        <div class="bg-darkAsh-200 px-3 md:px-5 py-3 rounded-lg mb-2">
                              <div class="flex justify-between">
                                    <div>John Doe</div>
                                    <div>4 guests</div>
                              </div>
                              <div class="flex justify-between mt-2">
                                    <div class="text-darkAsh-50">
                                          <i class="fa fa-clock"></i>
                                          <span>7:30</span>
                                    </div>
                                    <div class="text-darkAsh-50">Lunch</div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
@stop