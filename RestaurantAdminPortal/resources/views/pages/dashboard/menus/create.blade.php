@extends('layouts.authorized')

@section('title', 'Create Menu')

@section('content')
  @section('page-title', 'Create New Menu')
  <div class="max-w-6xl mt-5">
    <div class="md:flex bg-darkAsh-300 text-white py-5 md:px-12 md:justify-between">
      <div class="w-full md:w-1/2 md:mr-1 px-3">
        <form action="{{route('dashboard.home')}}" method="GET">
          <input type="text" placeholder="Dish Name" class="form-control control-input background-alt-1 mb-2">
          <textarea name="" id="" rows="6" placeholder="Dish Description" class="form-control control-input background-alt-1 mb-2" style="resize: none; margin-bottom: 20px;"></textarea>
          <div class="md:flex justify-between">
            <div class="w-full md:w-1/2 md:mr-3 mb-2">
              <div class="select background-alt-1 text-darkAsh-100">
                <select id="standard-select">
                  <option value="Option 1">Entree</option>
                </select>
                <span class="focus"></span>
              </div>
            </div>
            <div class="w-full md:w-1/2 md:ml-3 mb-2">
              <div class="select background-alt-1 text-darkAsh-100">
                <select id="standard-select">
                  <option value="Option 1">Cooking Temperature</option>
                </select>
                <span class="focus"></span>
              </div>
            </div>
          </div>
          <div class="md:flex justify-between">
            <div class="w-full md:w-1/2 md:mr-3 mb-2">
              <div class="select background-alt-1 text-darkAsh-100">
                <select id="standard-select">
                  <option value="Option 1">Side Dish</option>
                </select>
                <span class="focus"></span>
              </div>
            </div>
            <div class="w-full md:w-1/2 md:ml-3 mb-2">
              <div class="select background-alt-1 text-darkAsh-100">
                <select id="standard-select">
                  <option value="Option 1">Sauce</option>
                </select>
                <span class="focus"></span>
              </div>
            </div>
          </div>
          <div class="md:flex justify-between">
            <div class="w-full md:w-1/2 md:mr-3 mb-2">
              <div class="select background-alt-1 text-darkAsh-100">
                <select id="standard-select">
                  <option value="Option 1">Toppings</option>
                </select>
                <span class="focus"></span>
              </div>
            </div>
            <div class="w-full md:w-1/2 md:ml-3 mb-2">
              <div class="select background-alt-1 text-darkAsh-100">
                <select id="standard-select">
                  <option value="Option 1">Breakfast</option>
                </select>
                <span class="focus"></span>
              </div>
            </div>
          </div>
          <input type="text" placeholder="Price ($)" class="form-control control-input background-alt-1 mb-2">
          <input type="text" placeholder="Chef Note" class="form-control control-input background-alt-1 mb-2">
        </form>
      </div>
      <div>
        <hr class="block md:hidden mx-3 my-4 border-darkAsh-100">
        <div class="hidden md:block border-l-2 border-darkAsh-100 h-full"></div>
      </div>
      <div class="w-full md:w-1/2 md:mr-1 px-3">
        <div class="mb-3">Upload Image</div>
        <div id='my-uploader' style='height: 80px;'></div>
      </div>
    </div>
  </div>
@stop