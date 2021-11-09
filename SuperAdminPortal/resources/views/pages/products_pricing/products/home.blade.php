@extends('layouts.page-details')

@section('title', 'Manage Products')

@section('content')
  @section('page-title', 'Manage Products')
  @section('page-back', route('products.home'))
  <div class="row justify-content-end">
    <a href="{{route('products.product.create')}}" class="btn btn-danger py-1 px-5"><i class="fa fa-plus"></i> Add Product</a>
  </div>
  <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : ''}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
    {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
  </div>
  @if (count($products) > 0)
    <div class="mt-5"></div>
    <div class="{{session()->has('search_message') ? '' : 'hidden'}} bg-blue-500 text-blue-200 py-2 text-center rounded-lg my-3">
      {{session()->get('search_message')}}
    </div>
    <div class="rounded-sm mb-3 px-5 py-3 bg-darkAsh-300">
      <div class="text-darkAsh-50">
        <div class="grid grid-cols-{{count($products)}} gap-4">
          @foreach ($products as $product)
              <div style="border-right: 1px solid gray;">{{$product->name}} &emsp; <a href="{{route('products.product.edit', ['id' => $product->id])}}"><i class="fa fa-edit"></i></a></div>
          @endforeach
        </div>
      </div>
    </div>
    @for ($inner = 0; $inner < $greatest_width; $inner++)  
      <div class="rounded-sm px-5 mb-1 py-3 bg-darkAsh-300 cursor-pointer">
        <div class="text-darkAsh-50">
          <div class="grid grid-cols-{{count($products)}} gap-4">
            @foreach ($products as $product)
              <div style="border-right: 1px solid gray;"> @isset($features_list[$product->name][$inner]) {{$features_list[$product->name][$inner]}} @endisset </div>
            @endforeach
          </div>
        </div>
      </div>
    @endfor
  @else
    <div class="text-center mt-5 text-2xl font-light text-darkAsh-50">There are no Products at this time.</div>
  @endif

  <!-- New Products Modal -->
  <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="Products Model" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content bg-darkAsh-200">
        <div class="modal-header" style="border: none;">
          <h4 class="modal-title pr-2" id="staticBackdropLabel">Add New Product</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span class="text-danger"><i class="fa fa-close"></i></span></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('products.product.store')}}" method="post" id="form_product_add">
            @csrf
            <div class="row justify-content-center mb-3">
              <div class="w-75 md:mr-1">
                <label class="text-sm" for="name">Enter Product Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
              </div>
            </div>
            <div class="row justify-content-center mb-3">
              <div class="w-75 md:mr-1">
                <label class="text-sm" for="name">Enter Product Features:</label>
                <textarea name="features" id="features" cols="30" rows="5" class="form-control" placeholder="Separate features with ';'." required></textarea>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-4"><button class="btn btn-danger py-1 w-100" type="submit" value="Save" form="form_product_add">Save</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop