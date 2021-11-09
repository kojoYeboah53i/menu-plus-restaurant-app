@extends('layouts.page-details')

@section('title', $menu->name)

@section('content')
    @section('page-title', 'Edit '.$menu->name)
    @section('page-back', route('dashboard.menus.home'))

    <div class="mt-5"></div>
    <div class="my-3 {{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : old('')}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
        {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-8">
            <form action="{{route('dashboard.menus.show', ['id' => $id])}}" method="GET">
                @csrf
                <div class="search-field">
                    <div class="flex justify-between items-center space-x-5">
                        <input id="searchKey" name="searchKey" type="text" class="w-11/12 search-field-input" placeholder="Search">
                        <div class="w-1/12 text-center"><button type="submit"><i class="fa fa-search"></i></button></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-2">
            <a href="{{route('dashboard.menus.create.dish')}}" class="btn btn-danger">Create New Dish</a>
        </div>
    </div>
    <div class="{{!session()->has('search_message') ? 'hidden' : ''}} bg-red-500 text-red-200 py-2 text-center rounded-lg my-3">{{session()->get('search_message')}}</div>
    <div class="row justify-content-center mt-5">
        <div class="col-10">
            @if(isset($dishes))
                @foreach ($dishes as $dish)
                    <div class="row bg-darkAsh-200 mx-1 py-2 mb-2" style="border-radius: 5px;">
                        <div class="col-5 my-2" style="border-right: 1px solid gray;">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-5">
                                        <img src="{{$dish->image_1}}" class="img img-fluid"/>
                                    </div>
                                    <div class="col-7">
                                        <div class="row justify-content-between mb-2">
                                            <span class="text-light">{{$dish->name}}</span>
                                            <span class="text-light"><i class="fa fa-edit"></i></span>
                                        </div>
                                        <div class="row justify-content-between mb-1">
                                            <span class="text-light">Edit Description</span>
                                            <span class="text-light"><i class="fa fa-edit"></i></span>
                                        </div>
                                        <div class="row justify-content-start">
                                            <span class="text-secondary" style="font-size: 10px;">
                                                {{$dish->description}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 my-2 px-4" style="border-right: 1px solid gray;">
                            <div class="row mx-1 mb-2">
                                <div class="flex justify-between items-center background-alt-1 p-1 px-2" style="border-radius: 5px;">
                                    <input type="text" class="w-11/12 background-alt-1" value="${{$dish->price}}">
                                    <div class="w-1/12 text-center"><i class="fa fa-edit"></i></div>
                                </div>
                            </div>
                            <div class="row m-1">
                                <div class="col-12 background-alt-1 py-1" style="border-radius: 5px;">
                                    <div class="row px-2"><span>Hide Dish</span></div>
                                    <div class="row px-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hide" id="hide">
                                            <label class="form-check-label text-secondary text-sm" for="hide">Hide</label>
                                        </div>
                                    </div>
                                    <div class="row px-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hide" id="available">
                                            <label class="form-check-label text-secondary text-sm" for="available">Available</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 my-2">
                            <button class="btn btn-danger mb-2 w-100" type="button">Save changes</button>
                            <button class="btn btn-dark w-100" type="button">Delete Dish</button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row justify-content-center mt-5">
                    <span class="h4 text-secondary">No Dishes Added</span>
                </div>
            @endif
        </div>
    </div>
      
@stop