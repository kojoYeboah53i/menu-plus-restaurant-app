@extends('layouts.page-details')

@section('title', 'Subscription Pricing')

@section('content')
  @section('page-title', 'Subscription Pricing')
  @section('page-back', route('products.home'))
  <div class="row justify-content-end">
    <a href="{{route('products.pricing.create')}}" class="btn btn-danger py-1 px-5"><i class="fa fa-plus"></i> Add a Plan</a>
    
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
              <div style="border-right: 1px solid gray;">{{$product->name}}</div>
          @endforeach
        </div>
      </div>
    </div>
    @if (count($plan_list) > 0)
      <div class="grid grid-cols-{{count($products)}}">
        @foreach ($products as $product)
          <div class="col-12 mx-0 p-0">
            @if ($plan_list[$product->name]->isNotEmpty())
            @php
              $counter = 0;
            @endphp
              @foreach ($plan_list[$product->name] as $plan)
                <div class="bg-darkAsh-300 mb-2 py-3 px-5">
                  <div class="row justify-content-between pl-3">
                    <span class="h5">{{$plan->name}}</span>
                    <a href="{{route('products.pricing.edit', ['id' => $plan->id])}}"><i class="fa fa-edit"></i></a>
                  </div>
                  <div class="row pl-3">
                    <span class="text-sm text-secondary">{{$plan->duration}}</span>
                  </div>
                  <div class="row pl-3">
                    <span>AUD {{number_format($plan->pricing, 2)}}</span>
                  </div>
                </div>
                @php
                  $counter++;
                @endphp
              @endforeach
              @if ($counter < $greatest_width)
                @for ($i = $counter; $i < $greatest_width; $i++)
                  <div class="bg-darkAsh-300 mb-2 py-3 px-5">
                    <div class="row justify-content-between pl-3">
                      <span class="h5">&nbsp;</span>
                    </div>
                    <div class="row pl-3">
                      <span class="text-sm text-secondary">&nbsp;</span>
                    </div>
                    <div class="row pl-3">
                      <span>&nbsp;</span>
                    </div>
                  </div>
                @endfor
              @endif
            @else
                @for ($i = 0; $i < $greatest_width; $i++)
                  <div class="bg-darkAsh-300 mb-2 py-3 px-5">
                    <div class="row justify-content-between pl-3">
                      <span class="h5">&nbsp;</span>
                    </div>
                    <div class="row pl-3">
                      <span class="text-sm text-secondary">&nbsp;</span>
                    </div>
                    <div class="row pl-3">
                      <span>&nbsp;</span>
                    </div>
                  </div>
                @endfor
            @endif
            
          </div>
        @endforeach
      </div>
    @else
        <div class="row justify-content-center">
          There are no Plans for the Products.
        </div>
    @endif
  @else
    <div class="text-center mt-5 text-2xl font-light text-darkAsh-50">There are no Products at this time.</div>
  @endif
    
@stop