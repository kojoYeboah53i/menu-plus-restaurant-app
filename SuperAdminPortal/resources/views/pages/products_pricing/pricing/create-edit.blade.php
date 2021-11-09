@extends('layouts.page-details')
@php $edit = isset($plan); @endphp

@section('title', ($edit ? 'Edit' : 'New') . ' Subscription Plan')

@section('content')
      @section('page-title', ($edit ? 'Edit' : 'New') . ' Subscription Plan')
      @section('page-back', route('products.pricing.home'))
      <div class="flex justify-center">
        <form class="flex-1 col-8" method="POST" action="{{route('products.pricing.' . ($edit ? 'update' : 'store'), $edit ? ['id' => $plan->id] : '')}}">
          @csrf
          @if($edit)
            @method('PUT')
          @endif
        <div class="rounded-sm mt-5 mb-1 px-5 py-3 bg-darkAsh-300">
          <div class="text-center h4 my-4">{{$edit ? 'Edit' : 'New'}} Plan</div>
            <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : old('')}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
              {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
            </div>

            <div class="row justify-content-center mb-3">
                <div class="w-75 md:mr-1">
                    <label for="product_id">Select Product:</label>
                    <div class="select input-field w-12/12 @error('product_id') input-error @enderror">
                        <select name="product_id" id="product_id" required>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}" @if ((isset($plan) && $plan->product_id == $product->id) || old('product_id') == $product->id) selected @endif>{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('product_id')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="w-75 md:mr-1">
                    <label for="name">Enter Plan Name:</label>
                    <input type="text" name="name" id="name" value="{{$edit ? $plan->name : old('name')}}" class="@error('name') input-error @enderror input-field" required>
                    @error('name')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="w-75 md:mr-1">
                    <label for="duration">Select duration:</label>
                    <div class="select input-field @error('duration') input-error @enderror">
                        <select name="duration" id="duration" value="{{$edit ? $plan->duration : old('duration')}}" required>
                            <option value="monthly">Monthly</option>
                            <option value="annually">Annually</option>
                            <option value="2 years">2 Years</option>
                            <option value="5 years">5 Years</option>
                        </select>
                    </div>
                    @error('duration')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                </div>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="w-75 md:mr-1">
                    <label for="pricing">Enter Pricing for Plan (AUD):</label>
                    <input type="number" name="pricing" id="pricing" min="0" step="0.01"  class="@error('pricing') input-error @enderror input-field" value="{{$edit ? $plan->pricing : old('pricing')}}" required>
                    @error('pricing')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                </div>
            </div>
            <div class="row justify-content-center">
                @if ($edit)
                    <div class="row w-75">
                        <div class="col-md-6"><button type="submit" class="mb-4 btn btn-success w-full py-2">Update</button></div>
                        <div class="col-md-6"><a href="{{route('products.pricing.delete', ['id' => $plan->id])}}" onclick="deleteCheck('{{$plan->name}}')" class="mb-4 btn btn-red w-full py-2">Delete</a></div>
                    </div>
                @else
                    <button type="submit" class="mb-4 btn btn-red w-75 py-2">Add</button>
                @endif
            </div>
        </div>
      </form>
    </div>
    <script>
        function deleteCheck(text) {
            confirm("Do you wish to Delete "+ text +" Product?");
        }
    </script>
@stop