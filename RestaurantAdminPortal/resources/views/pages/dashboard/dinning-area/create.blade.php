@extends('layouts.page-details')

@section('title', 'Manage Dinning Area')

@section('content')
  @section('page-title', 'Manage Dinning Area')
  @section('page-back', route('dashboard.tables.home'))
  <div class="mt-5"></div>
  <div class="my-3 {{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : old('')}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
    {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
  </div>

  <div class="row justify-content-center mb-2 mt-">
    <div class="col-4"><div class="row pl-3 pt-1"><span>View & Add Dining Areas</span></div></div>
    <div class="col-2">
      <div class="row justify-content-center">
        <button type="button" class="btn btn-success py-0"  data-toggle="modal" data-target="#addDinningArea">
        <i class="fa fa-plus"></i> Dinning Area</button>
      </div>
    </div>
    <div class="col-5"><div class="row justify-content-center pl-3 pt-1"><span>View & Add Tables</span></div></div>
    <div class="col-1">
      <div class="row justify-content-center">
        <button type="button" class="btn btn-success py-0" data-toggle="modal" data-target="#addTable"><i class="fa fa-plus"></i> Table</button>
      </div>
    </div>
  </div>
  <hr class="bg-secondary">
  <div class="row justify-content-end mt-2">
    <div class="col-5">
      <div class="row">
        <div class="col-6"><div class="row justify-content-center text-secondary">Table No</div></div>
        <div class="col-6"><div class="row justify-content-center text-secondary">Capacity</div></div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>
  <div class="row justify-content-center mt-3">
    <div id="dinningAreasCol" class="col-6">
      {{-- Start Adding Dinning Areas Here --}}
      @if (isset($dinningAreas))
          @foreach ($dinningAreas as $dinning_area)
            <div class="row mb-2">
              <div class="col-8">
                <div class="row mx-2 py-2 justify-content-center bg-darkAsh-200" style="border-radius: 5px;"><span>{{$dinning_area->name}}</span></div>
              </div>
              <div class="col-4">
                <div class="row justify-content-center mt-1">
                  <a href="{{ route('dashboard.dinning-area.showAssign',['id' => $dinning_area->id])}}" class="mr-3"><i class="fa fa-plus"></i></a>
                  <a href="{{ route('dashboard.dinning-area.delete',['id' => $dinning_area->id]) }}" class="ml-3 text-danger"><i class="fa fa-trash"></i></a>
                </div>
              </div>
            </div>
          @endforeach
      @else
        <div class="row justify-content-center">
          <span class="text-secondary h5">No Dinning Areas Added</span>
        </div>
      @endif
    </div>
    <div id="tablesCol" class="col-6">
      {{-- Start Adding Tables Here --}}
      @if (isset($tables))
          @foreach ($tables as $table)
            <div class="row mb-2">
              <div class="col-10">
                <div class="row">
                  <div class="col-6">
                    <div class="row mx-2 py-2 justify-content-center bg-darkAsh-200" style="border-radius: 5px;">{{$table->number}}</div>
                  </div>
                  <div class="col-6">
                    <div class="row mx-2 py-2 justify-content-center bg-darkAsh-200" style="border-radius: 5px;">{{$table->capacity}}</div>
                  </div>
                </div>
              </div>
              <div class="col-2">
                <div class="row justify-content-center mt-1">
                  <a href="{{ route('dashboard.tables.delete',['id' => $table->id]) }}" class="ml-3 text-danger"><i class="fa fa-trash"></i></a>
                </div>
              </div>
            </div>
          @endforeach
      @else
        <div class="row justify-content-center">
          <span class="text-secondary h5">No Tables Added</span>
        </div>
      @endif
      
    </div>
  </div>

  <!-- Dinning Area Modal -->
  <div class="modal fade" id="addDinningArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content bg-darkAsh-200">
        <div class="modal-header" style="border: none;">
            <h5 class="modal-title" id="staticBackdropLabel">Add Dinning Area</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span class="text-danger"><i class="fa fa-close"></i></span></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('dashboard.dinning-area.store')}}" method="post">
            @csrf
            <div class="row justify-content-center">
              <div class="w-full md:mr-1 px-3">
                <input type="text" placeholder="Enter Dinning Area Name" class="form-control control-input background-alt-1 mb-2" id="name" name="name">
                <textarea name="description" id="description" rows="4" placeholder="Dinning Area Description" class="form-control control-input background-alt-1 mb-2" style="resize: none; margin-bottom: 20px;"></textarea>
              </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-4"><button class="btn btn-danger py-1 w-100" type="submit" value="DinningArea">Save</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Tables Modal -->
  <div class="modal fade" id="addTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content bg-darkAsh-200">
        <div class="modal-header" style="border: none;">
            <h5 class="modal-title" id="staticBackdropLabel">Add Table</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span class="text-danger"><i class="fa fa-close"></i></span></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('dashboard.tables.store')}}" method="post">
            @csrf
            <div class="row justify-content-center">
              <div class="w-full md:mr-1 px-3">
                <input type="number" min="1" step="1" placeholder="Enter Table Number" class="form-control control-input background-alt-1 mb-2" id="number" name="number" required>
                <input type="number" min="1" step="1" placeholder="Enter Table Capacity" class="form-control control-input background-alt-1 mb-2" id="capacity" name="capacity" required>
              </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-4"><button class="btn btn-danger py-1 w-100" type="submit" value="Table">Save</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop