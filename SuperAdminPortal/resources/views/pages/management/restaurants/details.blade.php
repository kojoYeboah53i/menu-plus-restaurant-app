@extends('layouts.page-details')

@section('title', 'Products & Services')

@section('content')
  @section('page-title', 'Restaurant Details')
  @section('page-back', route('manage.restaurants.home'))
  <div class="{{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : ''}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
    {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
  </div>
  <div class="mt-5">
    @if(count($reports) > 0)
    <div class="flex justify-between space-x-20">
      <div class="w-1/3 rounded-sm px-5 py-4 bg-darkAsh-300">
        <div class="flex items-center">
          <div class="bg-darkAsh-50 h-10 w-10 rounded-full flex  items-center justify-center">
            <i class="fa fa-dollar"></i>
          </div>
          <div class="ml-4">
            <div class="text-2xl"><b>226K</b></div>
            <div class="text-darkAsh-50">Total Revenue</div>
            <div class="text-darkAsh-50">10% (30 Days)</div>
          </div>
        </div>
      </div>
      <div class="w-1/3 rounded-sm px-5 py-4 bg-darkAsh-300">
        <div class="flex items-center">
          <div class="bg-darkAsh-50 h-10 w-10 rounded-full flex  items-center justify-center">
            <i class="fa fa-dollar"></i>
          </div>
          <div class="ml-4">
            <div class="text-2xl"><b>755</b></div>
            <div class="text-darkAsh-50">Total Orders</div>
            <div class="text-darkAsh-50">10% (30 Days)</div>
          </div>
        </div>
      </div>
      <div class="w-1/3 rounded-sm px-5 py-4 bg-darkAsh-300">
        <div class="flex items-center">
          <div class="bg-darkAsh-50 h-10 w-10 rounded-full flex  items-center justify-center">
            <i class="fa fa-users"></i>
          </div>
          <div class="ml-4">
            <div class="text-2xl"><b>71</b></div>
            <div class="text-darkAsh-50">Total Clients</div>
            <div class="text-darkAsh-50">10% (30 Days)</div>
          </div>
        </div>
      </div>
    </div>
    @endif
    @if($restaurant)
    <div class="grid grid-cols-12 gap-4 mt-4">
      <div class="col-span-6 rounded-sm px-5 py-4 bg-darkAsh-300">
        <div class="flex justify-between space-x-5 mb-4">
          <div>Restaurant Information</div>
          <div>
            <span class="h5 mr-4">{{ $restaurant->status ? 'Active' : 'Inactive'}}</span>
            <label class="switch">
              <input name="status" value="true" type="checkbox" {{ $restaurant->status ? 'checked' : ''}} disabled>
              <span class="slider round"></span>
            </label>
          </div>
        </div>
      <form id="restaurant_details" action="{{route('manage.restaurants.update', ['id' => $restaurant->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex justify-center space-x-5 mb-4">
          <div class="col-5">
            <div onclick="document.getElementById('imgupload').click()" class="flex justify-center items-center rounded-full bg-darkAsh-300">
              <img id="imagePreview" class="hidden img img-fluid p-2 rounded-full"/>
              <img id="existingImg" class="img img-fluid rounded-full" src="{{ $restaurant->logo ?? config('app.logo_placeholder_url', '')}}">
              <input type="file" name="logo" id="imgupload" onchange="loadImagePreview(this);" class="hidden"/> 
            </div>
          </div>
        </div>
        <div class="flex justify-between space-x-5">
          <div>
            <label for="name" class="text-xs text-darkAsh-50 font-light">
              Restaurant Name
            </label>
            <input type="text" name="name" placeholder="Restaurant Name" value="{{old('name') ?? $restaurant->name}}" class="input-field" required>
          </div>
          <div>
            <label for="" class="text-xs text-darkAsh-50 font-light">
              Contact Person Name
            </label>
            <input type="text" name="contact_person" placeholder="Contact Person Name" value="{{old('contact_person') ?? $restaurant->user->fullname}}" class="input-field" disabled>
          </div>
        </div>
        <div class="flex justify-between space-x-5">
          <div>
            <label for="state" class="text-xs text-darkAsh-50 font-light">
              State
            </label>
            <input type="text" name="state" value="{{old('state') ?? $restaurant->state}}" class="input-field" required>
          </div>
          <div>
            <label for="city" class="text-xs text-darkAsh-50 font-light">
              City
            </label>
            <input type="text" name="city" value="{{old('city') ?? $restaurant->city}}" class="input-field" required>
          </div>
        </div>
        <div class="flex justify-between space-x-5">
          <div>
            <label for="suburb" class="text-xs text-darkAsh-50 font-light">
              Suburb
            </label>
            <input type="text" name="suburb" value="{{old('suburb') ?? $restaurant->suburb}}" class="input-field" required>
          </div>
          <div> 
            <label for="post_code" class="text-xs text-darkAsh-50 font-light">
              Post Code
            </label>
            <input type="text" name="post_code" value="{{old('post_code') ?? $restaurant->post_code}}" class="input-field" required>
          </div>
        </div>
        <div class="flex justify-between space-x-5">
          <div class="flex-1"> 
            <label for="address" class="text-xs text-darkAsh-50 font-light">
              Address
            </label>
            <input type="text" name="address" placeholder="Address" value="{{old('address') ?? $restaurant->address}}" class="input-field" required>
          </div>
        </div>
        <div class="flex justify-between space-x-5">
          <div class="flex-1">
            <label for="business_type" class="text-xs text-darkAsh-50 font-light">
              Business Type
            </label>
            <div class="select input-field">
              <select name="business_type" class="@error('business_type') input-error @enderror" required>
                <option @if($restaurant->business_type == 'Cafe & Takeaway') selected @endif>Cafe & Takeaway</option>
                <option @if($restaurant->business_type == 'Restaurants') selected @endif>Restaurants</option>
                <option @if($restaurant->business_type == 'Pubs & Clubs') selected @endif>Pubs & Clubs</option>
                <option @if($restaurant->business_type == 'Hotels & Service Apartments') selected @endif>Hotels & Service Apartments</option>
              </select>
              @error('business_type')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
            </div>
          </div>
        </div>
        <div class="flex justify-between space-x-5">
          <div class="flex-1"> 
            <label for="phone_number" class="text-xs text-darkAsh-50 font-light">
              Phone No
            </label>
            <input type="text" name="phone_number" placeholder="Phone No" value="{{old('phone_number') ?? $restaurant->phone_number}}" class="input-field" required>
          </div>
        </div>
        <div class="flex justify-between space-x-5">
          <div class="flex-1"> 
            <label for="email" class="text-xs text-darkAsh-50 font-light">
              Email
            </label>
            <input type="text" name="email" placeholder="Email" value="{{old('email') ?? $restaurant->email}}" class="input-field" required>
          </div>
        </div>
        <div class="flex justify-between space-x-5">
          <div>
            <label for="" class="text-xs text-darkAsh-50 font-light">
              Capacity/Seats
            </label>
            <input type="text" name="capacity" placeholder="Capacity" value="{{old('capacity') ?? $restaurant->capacity}}" class="input-field" required>
          </div>
          <div>
            <label for="" class="text-xs text-darkAsh-50 font-light">
              Date & Time
            </label>
            <input type="text" placeholder="Date" value="{{$restaurant->created_at}}" class="input-field" disabled>
          </div>
        </div><br><br>
        <div class="flex justify-center space-x-5">
          <div class="col-10">
            <button type="submit" form="restaurant_details" class="btn btn-danger w-full py-1">Update</button>
          </div>
        </div>
      </form>
      </div>
      <div class="col-span-6 rounded-sm px-3 py-4 bg-darkAsh-300">
        <div class="flex justify-between items-center">
          <div>Account Owner</div>
          <div>
            <a href="#" class="btn btn-outline-success" onclick="event.preventDefault(); confirmReset('{{route('manage.restaurants.reset-user-password', ['id' => $restaurant->user->id])}}');">Reset Password</a>
          </div>
        </div>
        @if (session()->has('new_password'))
        <br>
          <div class="flex justify-center items-center">
            <div>New Password:&emsp;<span class="h4 text-success">{{session()->get('new_password')}}</span></div>
          </div>
        @endif
        <form id="account_owner" action="{{route('manage.restaurants.update-user', ['id' => $restaurant->user->id])}}" method="post">
          @csrf
          @method('PUT')
          <br>
          <div class="flex justify-center space-x-5 mb-4">
            <div class="col-3">
              <img class="img img-fluid rounded-full" src="{{ $restaurant->user->profile_pic ?? config('app.profile_placeholder_url', '')}}">
            </div>
          </div>
          <div class="flex justify-between space-x-5">
            <div class="flex-1">
              <label for="name" class="text-xs text-darkAsh-50 font-light">
                Fullname
              </label>
              <input type="text" name="fullname" placeholder="Fullname" value="{{old('fullname') ?? $restaurant->user->fullname}}" class="input-field" required>
            </div>
          </div>
          <div class="flex justify-between space-x-5">
            <div> 
              <label for="phone_number" class="text-xs text-darkAsh-50 font-light">
                Phone No
              </label>
              <input type="text" name="phone_number" placeholder="Phone No" value="{{old('phone_number') ?? $restaurant->user->phone_number}}" class="input-field" required>
            </div>
            <div> 
              <label for="email" class="text-xs text-darkAsh-50 font-light">
                Email
              </label>
              <input type="text" name="email" placeholder="Email" value="{{old('email') ?? $restaurant->user->email}}" class="input-field" required>
            </div>
          </div>
          <br><br>
          <div class="flex justify-center space-x-5">
            <div class="col-10">
              <button type="submit" form="account_owner" class="btn btn-danger w-full py-1">Update</button>
            </div>
          </div>
        </form><br><br>
        <hr class="border border-secondary">
        <form id="payment_details" action="" method="post">
          @csrf
          @method('put')
          <div class="flex justify-between space-x-5 mt-5">
            <div class="flex-1">
              <label for="method" class="text-xs text-darkAsh-50 font-light">
                Payment Method
              </label>
              <div class="select input-field">
                <select name="method" class="@error('method') input-error @enderror" required>
                  <option>Credit Card</option>
                  <option>Debit Card</option>
                </select>
                @error('method')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
            </div>
          </div>
          <div class="flex justify-between space-x-5">
            <div> 
              <label for="phone_number" class="text-xs text-darkAsh-50 font-light">
                Credit Card Details
              </label>
              <input type="text" name="card_number" placeholder="Card Number" class="input-field" disabled>
            </div>
            <div> 
              <label for="email" class="text-xs text-darkAsh-50 font-light">
                Expiry Date
              </label>
              <input type="date" name="date" placeholder="day/month/year" class="input-field" disabled>
            </div>
          </div>
          <div class="flex justify-between space-x-5">
            <div> 
              <label for="phone_number" class="text-xs text-darkAsh-50 font-light">
                Bank Account Number
              </label>
              <input type="text" name="card_number" placeholder="A/No:" class="input-field" disabled>
            </div>
            <div> 
              <label for="email" class="text-xs text-darkAsh-50 font-light">
                CCV
              </label>
              <input type="text" name="date" placeholder="eg. 007" class="input-field" disabled>
            </div>
          </div>
          <br><br>
          <div class="flex justify-center space-x-5">
            <div class="col-10">
              <button type="submit" form="payment_details" class="btn btn-danger w-full py-1" disabled>Update Payment Info</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="grid grid-cols-12 gap-4 mt-4">
      <div class="col-span-12 rounded-sm px-5 py-4 bg-darkAsh-300">
        <div class="flex justify-between items-center mb-4">
          <div>
            Subscription Plan
          </div>
          <div>
            <a class="btn btn-outline-danger" href="{{route('manage.restaurants.subscribe', ['id' => $restaurant->id])}}"><i class="fas fa-plus"></i>&nbsp;&nbsp; Subscribe</a>
          </div>
        </div>
        <div class="flex justify-center items-center">
          @if ($restaurant->subscriptions->isNotEmpty())
            @foreach ($plans as $plan)
              <div class="w-11/12 background-alt-1 py-4 px-5 rounded-sm">
                <div class="row justify-content-between">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-7"><span class="text-secondary">{{$plan->product->name}} Subscription Plan</span></div>
                      <div class="col-md-3"><a href="{{route('manage.restaurants.edit-subscribe', ['id' => $plan->id])}}" class="text-success">Edit Plan</a></div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="row px-3">
                      <span class="h1 mt-2">{{$plan->name}}</span>
                    </div>
                  </div>
                  @php
                      $created_at = $restaurant->subscriptions->where('plan_id', $plan->id)->first()->created_at;
                      $datetime1 = new DateTime($created_at);
                      $currentTime = time();
                      $datetime2 = new DateTime(date("Y-m-d", $currentTime));
                      $days = $datetime2->diff($datetime1)->format("%d");;
                  @endphp
                  <div class="col-md-2">
                    <div class="row"><span class="text-secondary">Count Up</span></div>
                    <div class="row"><span class="h4 mt-2"> {{$days}} &nbsp;&nbsp; {{($days > 1)? 'Days' : 'Day'}}</span></div>
                  </div>
                  <div class="col-md-2">
                    <div class="row"><span class="text-secondary">Billed {{$plan->duration}}</span></div>
                    <div class="row"><span class="h1 mt-2">$ {{$plan->pricing}}</span></div>
                  </div>
                </div>
              </div>
            @endforeach
          @else
          <div class="text-center my-3 text-2xl font-light text-darkAsh-50"> {{$restaurant->name}} Has No Subscriptions</div>
          @endif
        </div>
      </div>
    </div>
    @endif
  </div>
  <script>
    function confirmReset(url) {
      var results = confirm('Do you want to Reset Account Owner Password?');
      if(results){
        window.location.href = url;
      }
    }
  </script>
@stop