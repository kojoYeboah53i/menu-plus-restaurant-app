@extends('layouts.page-details')

@section('title', 'Manage Dinning Area')

@section('content')
  @section('page-title', 'Manage Dinning Area')
  @section('page-back', route('dashboard.tables.managedinningareas'))
  <div class="my-3 {{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : old('')}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
    {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
  </div>
  <div class="max-w-5xl mt-5 p-3">
    <div class="bg-darkAsh-300 p-3">
        <div class="row mb-2 pl-4"><span class="h5">{{ $dinningArea->name }}</span></div>
        <hr class="bg-secondary">
        <form action="{{route('dashboard.dinning-area.assignedTables',['id' => $dinningArea->id])}}" method="post">
            @csrf
            <div class="row justify-content-between my-3">
                <div class="col-5">
                    <div class="row mb-4">
                        <div class="col-12 pl-4">
                            Current Tables
                        </div>
                    </div>
                    {{-- Start Adding Current Tables Here --}}
                    @if (isset($assignedTables))
                        <div class="row mb-3">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-6"><div class="row justify-content-center text-secondary">Table No</div></div>
                                    <div class="col-6"><div class="row justify-content-center text-secondary">Capacity</div></div>
                                </div>
                            </div>
                        </div>
                        @foreach ($assignedTables as $assignedTable)
                            <div class="row mb-2">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row mx-2 py-2 justify-content-center bg-darkAsh-200" style="border-radius: 5px;">{{$assignedTable->number}}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row mx-2 py-2 justify-content-center bg-darkAsh-200" style="border-radius: 5px;">{{$assignedTable->capacity}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="row justify-content-center mt-1">
                                        <a href="{{route('dashboard.dinning-area.clearAssigned', ['id' => $assignedTable->id])}}" class="ml-3 text-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row justify-content-center">
                            <span class="h5 text-secondary">No Tables Assigned to Dinning Area</span>
                        </div>
                    @endif
                </div>
                <div class="col-5">
                    <div class="row mb-3">
                        <div class="col-12  pl-4">
                            Available Tables
                        </div>
                    </div>
                    {{-- Start Adding Current Tables Here --}}
                    @if (isset($unassignedTables))
                        <div class="row justify-content-end mb-3">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-6"><div class="row justify-content-center text-secondary">Table No</div></div>
                                    <div class="col-6"><div class="row justify-content-center text-secondary">Capacity</div></div>
                                </div>
                            </div>
                        </div>
                        @foreach ($unassignedTables as $unassignedTable)
                        <div class="row mb-2">
                            <div class="col-1">
                                <div class="row justify-content-center mt-1">
                                    <input type="checkbox" class="form-check-input" value="{{$unassignedTable->id}}" name="tables[]">
                                </div>
                            </div>
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row mx-2 py-2 justify-content-center bg-darkAsh-200" style="border-radius: 5px;">{{$unassignedTable->number}}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row mx-2 py-2 justify-content-center bg-darkAsh-200" style="border-radius: 5px;">{{$unassignedTable->capacity}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="row justify-content-center">
                            <span class="h5 text-secondary">No Tables Available</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center my-4">
                <div class="col-3">
                    <button class="btn btn-danger py-1 w-100" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection