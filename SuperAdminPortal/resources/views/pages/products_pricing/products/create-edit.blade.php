@extends('layouts.page-details')
@php $edit = isset($product); @endphp

@section('title', ($edit ? 'Edit' : 'New') . ' Product')

@section('content')
      @section('page-title', ($edit ? 'Edit' : 'New') . ' Product')
      @section('page-back', route('products.product.home'))
      <div class="flex justify-center">
        <form class="flex-1 col-8" method="POST" action="{{route('products.product.' . ($edit ? 'update' : 'store'), $edit ? ['id' => $product->id] : '')}}">
          @csrf
          @if($edit)
            @method('PUT')
          @endif
        <div class="rounded-sm mt-5 mb-1 px-5 py-3 bg-darkAsh-300">
          <div class="text-center h4 my-4">{{$edit ? 'Edit' : 'New'}} Product</div>
            @csrf
            <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : old('')}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
              {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
            </div>

            <div class="row justify-content-center mb-3">
                <div class="w-75 md:mr-1">
                    <label for="name">Enter Product Name:</label>
                    <input type="text" name="name" id="name" value="{{$edit ? $product->name : old('name')}}" class="@error('name') input-error @enderror input-field" required>
                    @error('name')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                </div>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="w-75 md:mr-1">
                    <label for="name">Enter Product Features:</label>
                    <textarea name="features" id="features" cols="30" rows="5"  class="@error('features') input-error @enderror input-field" placeholder="Separate features with a New Line." required>{{$edit ? $product->features : old('features')}}</textarea>
                    @error('features')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                </div>
            </div>
            <div class="row justify-content-center">
                @if ($edit)
                    <div class="row w-75">
                        <div class="col-md-6"><button type="submit" class="mb-4 btn btn-success w-full py-2">Update</button></div>
                        <div class="col-md-6"><a href="{{route('products.product.delete', ['id' => $product->id])}}" onclick="deleteCheck('{{$product->name}}')" class="mb-4 btn btn-red w-full py-2">Delete</a></div>
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