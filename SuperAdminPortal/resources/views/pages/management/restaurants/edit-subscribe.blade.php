@extends('layouts.page-details')

@section('title', 'Restaurant Subscription Plan')

@section('content')
  @section('page-title', 'Restaurant Subscription Plan')
  @section('page-back', route('manage.restaurants.view', ['id' => $subscribed->restaurant->id]))
    
  <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : ''}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
    {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
  </div>

  <div class="text-center mt-3 text-2xl font-light">Edit {{$subscribed->product->name}} Subscription Plan</div>
    <form id="subscribeForm" action="{{route('manage.restaurants.update-subscribe', ['id' => $subscribed->restaurant->id])}}" method="post">
        @csrf
        <input type="hidden" name="product_id" value="{{$subscribed->product->id}}">
        @php
          $count = $plans->where('product_id', $subscribed->product->id)->count();
          $index = 1;
        @endphp
        <div class="row mt-5 px-4">
          <div class="col-12">
            <div class="row justify-content-between px-2 mb-2">
              <div><span class="h4">{{$subscribed->product->name}}</span></div>
              <div><button type="button" onclick="uncheckAll('{{'plan_'.$subscribed->product->id}}', {{$subscribed->product->id}})" class="btn btn-outline-danger px-3 py-0"><i class="fas fa-close"></i>&nbsp;&nbsp; Clear All</button></div>
            </div>
            <div class="row mb-2"><div class="col-12 px-1"><hr class="border-secondary"></div></div>
            <div class="row justify-content-around py-3">
                @foreach ($plans as $plan)
                    <div id="{{$index.'_'.$subscribed->product->id.'_div'}}" class="col-md-3 px-5 py-5 bg-darkAsh-300 rounded-sm mx-2 border my-2 @if($plan->id == $subscribed->plan_id) border-success @endif">
                        <input type="radio" name="{{'plan_'.$subscribed->product->id}}" value="{{$plan->id}}" id="{{$index.'_'.$subscribed->product->id.'_radio'}}" @if($plan->id == $subscribed->plan_id) checked @endif hidden>
                        <div class="row justify-content-center mb-2"><span class="">{{$plan->name}}</span></div>
                        <div class="row justify-content-center mb-3"><div class="col-12"><hr class="border-secondary"></div></div>
                        <div class="row justify-content-center mb-1"><span class="h5">${{$plan->pricing}}</span></div>
                        <div class="row justify-content-center mb-3"><span class="text-secondary">{{$plan->duration}}</span></div>
                        <div class="row justify-content-center"><div class="col-12"><button type="button" class="btn btn-secondary w-100 border bg-darkAsh-300 @if($plan->id == $subscribed->plan_id) border-success @endif" id="{{$index.'_'.$subscribed->product->id.'_button'}}" onclick="buttonClicked('{{$index}}', '{{$subscribed->product->id}}', {{$count}})">Select</button></div></div>
                    </div>
                    @php
                        $index++;
                    @endphp
                @endforeach
            </div>
          </div>
        </div>
      <br><br>
      <div class="row justify-content-center mb-4">
        <div class="col-md-4"><button type="submit" class="btn btn-success py-1 w-100">Update</button></div>
      </div>
    </form>

  <script>
    function uncheckAll(radiogroup, product_id) {
      var radioButtons = document.getElementsByName(radiogroup);

      for (let i = 0; i < radioButtons.length; i++) {
        radioButtons[i].checked = false;
        changeBorderColor(i+1, product_id, false);
      }
    }

    function buttonClicked(num, product_id, count) {
      document.getElementById(num + '_' + product_id + '_radio').checked = true;

      for (let i = 1; i <= count; i++) {
        changeBorderColor(i, product_id, (num == i) ? true : false);
      }
      
    }

    function changeBorderColor(id, product_id, state) {
      var divElement = document.getElementById(id + '_' + product_id + '_div');
      var buttonElement = document.getElementById(id + '_' + product_id + '_button');

      if(state){
        if(!divElement.classList.contains("border-success")){
          divElement.classList.add('border-success');
        }
        if(!buttonElement.classList.contains("border-success")){
          buttonElement.classList.add('border-success');
        }
      }else{
        if(divElement.classList.contains("border-success")){
          divElement.classList.remove('border-success');
        }
        if(buttonElement.classList.contains("border-success")){
          buttonElement.classList.remove('border-success');
        }
      }
    }
  </script>
@stop