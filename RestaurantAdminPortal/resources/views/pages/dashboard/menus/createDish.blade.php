@extends('layouts.page-details')

@section('title', 'Create Dish')

@section('content')
  @section('page-title', 'Create New Dish')
  @section('page-back', route('dashboard.menus.home'))
  <div class="max-w-6xl mt-5">
    <div class="bg-darkAsh-300 pb-3">
      <div class="my-3 {{!session()->has('success_message') && !session()->has('error_message') ? 'hidden' : old('')}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
        {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
      </div>
      <form action="{{route('dashboard.menus.create.dish')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="md:flex bg-darkAsh-300 text-white pt-5 pb-3 md:px-12 md:justify-between">
          <div class="w-full md:w-1/2 md:mr-1 px-3">
            <input type="text" id="name" name="name" placeholder="Dish Name" class="form-control control-input background-alt-1 mb-2">
            @error('name')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
            <textarea name="description" id="description" rows="3" placeholder="Dish Description with Ingredients" class="form-control control-input background-alt-1 mb-2" style="resize: none; margin-bottom: 20px;"></textarea>
            @error('description')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
            <input type="text" id="chef_note" name="chef_note" placeholder="Chef Note" class="form-control control-input background-alt-1 mb-2">
            @error('chef_note')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
            <div class="form-row">
              <div class="col-6 pr-2">
                <span class="text-secondary justify-content-start">Price ($):</span>
                <br>
                <input id="price" name="price" type="number" step=".01" min="0" value="0.00" placeholder="Price (AUD)" class="form-control control-input background-alt-1 mb-2  mt-2">
                @error('price')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
              </div>
              <div class="col-6 pl-2">
                <span class="text-secondary justify-content-start">Select Menu:</span>
                <br>
                <div class="select background-alt-1 text-darkAsh-100 mb-2 mt-2">
                  <select id="menu_id" name="menu_id">
                    @foreach ($menus as $menu)
                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                    @endforeach
                    @error('menu_id')<small class="-mt-3 text-red-500">{{$message}}</small>@enderror
                  </select>
                  <span class="focus"></span>
                </div>
              </div>
            </div>
            <div>
              <hr class="my-3 border-darkAsh-100">
            </div>
            <div class="row justify-content-between mb-2">
              <div class="col-7">
                <span class="text-secondary">Add Cooking Preference (Max: 5)</span>
              </div>
              <div class="col-2 pr-4">
                <div class="row justify-content-end">
                  <button type="button" id="addCookingPreferenceBtn" class="p-1 py-1 btn-danger mr-1" onclick="addCKToDiv('addCookingPreference')"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div id="addCookingPreference" class="col-12 my-2 mx-0">

            </div>
          </div>
          <div>
            <hr class="block md:hidden mx-3 my-4 border-darkAsh-100">
            <div class="hidden md:block border-l-2 border-darkAsh-100 h-full"></div>
          </div>
          <div class="w-full md:w-1/2 md:mr-1 px-3">
            {{-- <div class="mb-3">Upload Image</div>
            <div id='my-uploader' style='height: 80px;'></div> --}}
            <div class="row pl-3 mb-2">
              <span class="h5 text-secondary">Upload Dish Images</span>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div onclick="document.getElementById('image_1').click()" class="border-2 border-darkAsh-200 h-35 w-35 bg-darkAsh-300">
                  <img id="imagePreview1" class="hidden border-2 border-gray-500 p-1 h-28 w-30"/>
                  <div id="uploadImageBlock1" class="border-4 border-gray-500 text-center h-28 w-30 py-4 upload">
                    <div class="block flex-1">
                      <i class="fa fa-camera"></i>
                    </div>
                    <div class="block flex-1 text-xs mt-1">Upload Image</div>
                    <input type="file" name="image_1" id="image_1" onchange="loadFile2(event,'imagePreview1','uploadImageBlock1');" class="hidden"/> 
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div onclick="document.getElementById('image_2').click()" class="border-2 border-darkAsh-200 h-35 w-35 bg-darkAsh-300">
                  <img id="imagePreview2" class="hidden border-2 border-gray-500 p-1 h-28 w-30"/>
                  <div id="uploadImageBlock2" class="border-4 border-gray-500 text-center h-28 w-30 py-4 upload">
                    <div class="block flex-1">
                      <i class="fa fa-camera"></i>
                    </div>
                    <div class="block flex-1 text-xs mt-1">Upload Image</div>
                    <input type="file" name="image_2" id="image_2" onchange="loadFile2(event,'imagePreview2','uploadImageBlock2');" class="hidden"/> 
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div onclick="document.getElementById('image_3').click()" class="border-2 border-darkAsh-200 h-35 w-35 bg-darkAsh-300">
                  <img id="imagePreview3" class="hidden border-2 border-gray-500 p-1 h-28 w-30"/>
                  <div id="uploadImageBlock3" class="border-4 border-gray-500 text-center h-28 w-30 py-4 upload">
                    <div class="block flex-1">
                      <i class="fa fa-camera"></i>
                    </div>
                    <div class="block flex-1 text-xs mt-1">Upload Image</div>
                    <input type="file" name="image_3" id="image_3" onchange="loadFile2(event,'imagePreview3','uploadImageBlock3');" class="hidden"/> 
                  </div>
                </div>
              </div>
            </div>
            <div>
              <hr class="my-3 border-darkAsh-100">
            </div>
            <div class="row justify-content-between mb-2">
              <div class="col-7">
                <span class="text-secondary">Add Side Dish (Max: 5)</span>
              </div>
              <div class="col-2 pr-4">
                <div class="row justify-content-end">
                  <button type="button" id="addSideDishBtn" class="p-1 py-1 btn-danger mr-1" onclick="addSDToDiv('addSideDish')"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div id="addSideDish" class="col-12 my-2 mx-0">
              
            </div>
            <div>
              <hr class="my-3 border-darkAsh-100">
            </div>
            <div class="row justify-content-between mb-2">
              <div class="col-7">
                <span class="text-secondary">Add Sauce (Max: 5)</span>
              </div>
              <div class="col-2 pr-4">
                <div class="row justify-content-end">
                  <button type="button" type="button" id="addSauceBtn" class="p-1 py-1 btn-danger mr-1" onclick="addSauceToDiv('addSauce')"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div id="addSauce" class="col-12 my-2 mx-0">
              
            </div>
            <div>
              <hr class="my-3 border-darkAsh-100">
            </div>
            <div class="row justify-content-between mb-2">
              <div class="col-7">
                <span class="text-secondary">Add Topping (Max: 5)</span>
              </div>
              <div class="col-2 pr-4">
                <div class="row justify-content-end">
                  <button type="button" id="addToppingBtn" class="p-1 py-1 btn-danger mr-1" onclick="addTopToDiv('addTopping')"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div id="addTopping" class="col-12 my-2 mx-0">
              
            </div>
          </div>
        </div>
        <div class="form-row justify-content-center">
          <div class="col-5">
            <button type="submit" class="btn btn-danger py-1 w-100 my-2">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script>
    var loadFile2 = function(event,id, block_id){
      var uploadBlock = document.getElementById(block_id);
      uploadBlock.style.display = 'none';
      var image = document.getElementById(id);
      image.style.display = 'block';
      image.src = URL.createObjectURL(event.target.files[0]);
    }
    //Add Global Variables
      //Cooking Preference Variables.
      var addCKPref = 1;
      var addCKPref_last = addCKPref;
      var ranCKList = new Array();

      //Side Dishes Variables.
      var addSD = 1;
      var addSD_last = addSD;
      var ranSDList = new Array();

      //Sauce Variables.
      var addSauce = 1;
      var addSauce_last = addSauce;
      var ranSauceList = new Array();

      //Toppings Variables.
      var addTop = 1;
      var addTop_last = addTop;
      var ranTopList = new Array();

    const random = (min, max) => Math.floor(Math.random() * (max - min)) + min;

    function create(htmlStr) {
      var frag = document.createDocumentFragment(),
      temp = document.createElement('div');
      temp.innerHTML = htmlStr;

      while (temp.firstChild) {
        frag.appendChild(temp.firstChild);
      }

      return frag;
    }

    function divHTML(index, ranNum){
      var htmlString;
      switch (index) {
        case 1:
          htmlString = '<div id="innerCKdiv_'+ ranNum +'" class="row"><div class="col-6 px-0"><input type="text" id="CKname_'+ ranNum +'" name="CKPref[]" class="form-control control-input background-alt-1 mb-2 mt-2" placeholder="Enter Cooking Preference"/></div><div class="col-5 mr-0"></div><div class="col-1 px-0 pt-2"><div class="row justify-content-center"><button type="button" class="btn-danger btn-sm p-0 px-1 mb-2 mt-2" onclick="removeElements('+"'innerCKdiv_"+ ranNum +"'," + 1 + ')"><i class="fas fa-times"></i></button></div></div></div>';
          break;
        case 2:
          htmlString = '<div id="innerSDdiv_'+ ranNum +'" class="row mb-2"><div class="col-4"><div onclick="document.getElementById(' + "'SDimg_"+ ranNum+"'"+').click()" class="border-2 border-darkAsh-200 h-35 w-35 bg-darkAsh-300"><img id="SDPreview_'+ ranNum +'" class="hidden border-2 border-gray-500 p-1 h-28 w-30"/><div id="SDUpBlock_'+ ranNum +'" class="border-4 border-gray-500 text-center h-28 w-30 py-4 upload"><div class="block flex-1"><i class="fa fa-camera"></i></div><div class="block flex-1 text-xs mt-1">Upload Image</div><input type="file" name="SD[\''+ ranNum +'\'][img]" id="SDimg_'+ ranNum +'" onchange="loadFile2(event,'+"'SDPreview_"+ ranNum+"'"+', '+ "'SDUpBlock_"+ ranNum+"'" +');" class="hidden"/></div></div></div><div class="col-7  py-2"><div class="form-row mb-2"><input type="text" name="SD[\''+ ranNum +'\'][name]" id="SDname_'+ ranNum +'" class="form-control control-input background-alt-1" placeholder="Enter Side Dish Name"/></div><div class="form-row"><div class="col-6 p-0"><input type="number" name="SD[\''+ ranNum +'\'][price]" id="SDprice_'+ ranNum +'" class="form-control control-input background-alt-1" min="0" step=".01" placeholder="Price ($)"/></div></div></div><div class="col-1 px-0 py-4"><div class="row justify-content-center"><button type="button" class="btn-danger btn-sm p-0 px-1 mb-2 mt-2" onclick="removeElements('+"'innerSDdiv_"+ ranNum +"'," + 2 + ')"><i class="fas fa-times"></i></button></div></div></div>';
          break;
        case 3:
          htmlString = '<div id="innerSaucediv_'+ ranNum +'" class="row"><div class="col-6 px-0"><input type="text" id="SauceName_'+ ranNum +'" name="Sauce[\''+ ranNum +'\'][name]" class="form-control control-input background-alt-1 my-1" placeholder="Enter Sauce"/></div><div class="col-5 mr-0"><input type="number" id="SaucePrice'+ ranNum +'" name="Sauce[\''+ ranNum +'\'][price]" class="form-control control-input background-alt-1 my-1" min="0" step=".01" placeholder="Price($)"/></div><div class="col-1 px-0 pt-2"><div class="row justify-content-center"><button type="button" class="btn-danger btn-sm p-0 px-1 my-1" onclick="removeElements('+"'innerSaucediv_"+ ranNum +"', "+ 3 +')"><i class="fas fa-times"></i></button></div></div></div>';
          break;
        case 4:
          htmlString = '<div id="innerTopdiv_'+ ranNum +'" class="row"><div class="col-6 px-0"><input type="text" id="TopName_'+ ranNum +'" name="Topping[\''+ ranNum +'\'][name]" class="form-control control-input background-alt-1 my-1" placeholder="Enter Toppings"/></div><div class="col-5 mr-0"><input type="number" id="Topping'+ ranNum +'" name="Topping[\''+ ranNum +'\'][price]" class="form-control control-input background-alt-1 my-1" min="0" step=".01" placeholder="Price($)"/></div><div class="col-1 px-0 pt-2"><div class="row justify-content-center"><button type="button" class="btn-danger btn-sm p-0 px-1 my-1" onclick="removeElements('+"'innerTopdiv_"+ ranNum +"', "+ 4 +')"><i class="fas fa-times"></i></button></div></div></div>';
          break;
        default:
          break;
      }
      return htmlString;
    }

    var addCKToDiv = function (divID) {
      if(addCKPref <= 5){
        var div = document.getElementById(divID);
        do {
          var ran_num_CKPref = random(addCKPref_last, 50);
        } while (ranCKList.includes(ran_num_CKPref));
        ranCKList.push(ran_num_CKPref);
        var fragment = create(divHTML(1, ran_num_CKPref));
        div.appendChild(fragment);
        addCKPref++;
        addCKPref_last = (addCKPref>addCKPref_last)?addCKPref: addCKPref_last;
      }
    }
    var addSDToDiv = function (divID) {
      if(addSD <= 5){
        var div = document.getElementById(divID);
        do {
          var ran_num_SD = random(addSD_last, 50);
        } while(ranSDList.includes(ran_num_SD));
        ranSDList.push(ran_num_SD);
        var fragment = create(divHTML(2, ran_num_SD));
        div.appendChild(fragment);
        addSD++;
        addSD_last = (addSD>addSD_last)?addSD: addSD_last;
      }
    }
    var addSauceToDiv = function (divID) {
      if(addSauce <= 5){
        var div = document.getElementById(divID);
        do {
          var ran_num_Sauce = random(addSauce_last, 50);
        } while(ranSauceList.includes(ran_num_Sauce));
        ranSauceList.push(ran_num_Sauce);
        var fragment = create(divHTML(3, ran_num_Sauce));
        div.appendChild(fragment);
        addSauce++;
        addSauce_last = (addSauce>addSauce_last)?addSauce: addSauce_last;
      }
    }
    var addTopToDiv = function (divID) {
      if(addTop <= 5){
        var div = document.getElementById(divID);
        do {
          var ran_num_Top = random(addTop_last, 50);
        } while(ranTopList.includes(ran_num_Top));
        ranTopList.push(ran_num_Top);
        // var divname = 'innerTopdiv_' + ran_num_Top;
        var fragment = create(divHTML(4, ran_num_Top));
        div.appendChild(fragment);
        addTop++;
        addTop_last = (addTop>addTop_last)?addTop: addTop_last;
      }
    }

    var removeElements = function (divID, type) {
      document.getElementById(divID).remove()
      var ranNumber = parseInt((divID.split("_"))[1]);
      var ran_index;
      switch (type) {
        case 1:
          ran_index = ranCKList.indexOf(ranNumber);
          ranCKList.splice(ran_index,1);
          addCKPref--;
          break;
        case 2:
          ran_index = ranSDList.indexOf(ranNumber);
          ranSDList.splice(ran_index,1);
          addSD--;
          break;
        case 3:
          ran_index = ranSauceList.indexOf(ranNumber);
          ranSauceList.splice(ran_index,1);
          addSauce--;
          break;
        case 4:
          ran_index = ranTopList.indexOf(ranNumber);
          ranTopList.splice(ran_index,1);
          addTop--;
          break;
        default:
          break;
      }
    }
  </script>
@stop