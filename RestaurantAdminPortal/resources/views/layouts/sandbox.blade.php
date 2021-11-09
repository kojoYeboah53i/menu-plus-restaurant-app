<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="{{ asset('image/Menuplus_logo.png') }}"/>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="booking-url" content="{{ route('dashboard.bookings.selectedBooking') }}">
        <title>Menu Plus | @yield('title')</title>
        <script src="{{asset('js/app.js')}}"></script>
    </head>
    <body class="font-helRegular">

<div class="px-10 pt-3 pb-10">
    <div>
          <div class="flex justify-between mb-5">
<div class="flex space-x-10 items-center ml-2">
<span class="h3">King Group</span>
</div>
<div class="flex space-x-10 items-center mr-2">

<div class="flex items-center">
<div id="top-nav-dropdown" class="dropdown show">
    <div class="py-2 pt-3 px-4 pr-5 rounded-lg text-base bg-darkAsh-200 font-calibreLight dropdown-toggle" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Hello, Rosalee Schamberger
    </div>
    
    <div class="dropdown-menu ml-3" aria-labelledby="dropdownMenu">
          <a class="dropdown-item" href="#" onclick="document.getElementById('profileUpload').click()"><i class="fa fa-user-circle"></i>&nbsp;&nbsp; Change Profile Image</a>
          <form id="selfUploadForm" action="http://localhost:8000/upload-image" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="PwvVlWjsPXbQDsq3CawgXqPCQBeibHWuUT5LLQc2">                                    <input type="file" name="profile_pic" onchange="loadSelfImagePreview(this);" id="profileUpload" class="hidden" enctype="multipart/form-data">
            </form> 
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassword"><i class="fas fa-key"></i>&nbsp;&nbsp; Change Password</a>
          <a class="dropdown-item" href="http://localhost:8000/account-info"><i class="fas fa-cog"></i>&nbsp;&nbsp; My Account</a>
    </div>
</div>
<div id="pictureUploadBlock" class="border-2 border-darkAsh-50 -mx-8 rounded-full w-16 h-16 bg-darkAsh-200">
    <img id="selfUploadImageBlock" class="img img-fluid rounded-full w-16 h-16 pb-1" src="">
    <img id="selfImagePreview" class="hidden border-2 border-gray-500 w-16 h-16 pb-1 rounded-full">
</div>
</div>
</div>
</div>

<div class="hidden bg-red-500 text-red-200 py-2 text-center rounded-lg my-3">

</div>

<!-- Tables Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
<div class="modal-content bg-darkAsh-200">
<div class="modal-header" style="border: none;">
    <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span class="text-danger"><i class="fa fa-close"></i></span></button>
</div>
<div class="modal-body">
    <form action="http://localhost:8000/change-password" method="post">
          <input type="hidden" name="_token" value="PwvVlWjsPXbQDsq3CawgXqPCQBeibHWuUT5LLQc2">                              <div class="row justify-content-center">
                <div class="w-75 md:mr-1">
                      <div class="input-group mb-3">
                            <input id="old_password" name="old_password" type="password" class="form-control control-input background-alt-1" placeholder="Enter Old Password" aria-describedby="basic-addon2" required="">
                            <span class="input-group-text control-input background-alt-1 py-0" id="basic-addon2" onclick="makeVisible(this, 'old_password')"><i class="fas fa-eye"></i></span>
                      </div>
                      <div class="input-group mb-3">
                            <input id="new_password" name="new_password" type="password" class="form-control control-input background-alt-1" placeholder="Enter New Password" aria-describedby="basic-addon2" required="">
                            <span class="input-group-text control-input background-alt-1 py-0" id="basic-addon2" onclick="makeVisible(this, 'new_password')"><i class="fas fa-eye"></i></span>
                      </div>
                      <div class="input-group mb-3">
                            <input id="confirm_password" name="confirm_password" onchange="confirmPassword(this)" type="password" class="form-control control-input background-alt-1" placeholder="Confirm Password" aria-describedby="basic-addon2" required="">
                            <span class="input-group-text control-input background-alt-1 py-0" id="basic-addon2" onclick="makeVisible(this, 'confirm_password')"><i class="fas fa-eye"></i></span>
                      </div>
                </div>
          </div>
          <div class="row justify-content-center">
                <div class="col-4"><button id="save_new_pass" class="btn btn-danger py-1 w-100" type="submit" value="Table" disabled="">Save</button></div>
          </div>
    </form>
</div>
</div>
</div>
</div>
<script>
function confirmPassword(conf_password) {
var new_password = document.getElementById('new_password');
if(conf_password.value == new_password.value){
document.getElementById('save_new_pass').disabled = false;
if(conf_password.classList.contains("border-danger")){
    conf_password.classList.remove('border-danger');
}
}else{
if(!conf_password.classList.contains("border-danger")){
    conf_password.classList.add('border-danger');
}
document.getElementById('save_new_pass').disabled = true;
}
}

function makeVisible(element, input_id) {
var x = document.getElementById(input_id);
var icon = (element.children)[0];
if (x.type === "password") {
x.type = "text";
icon.classList.remove('fa-eye');
icon.classList.add('fa-eye-slash');
} else {
x.type = "password";
icon.classList.remove('fa-eye-slash');
icon.classList.add('fa-eye');
}
} 
</script>                        </div>
    <div class="flex justify-center mb-20">
          <a href="http://localhost:8000/dashboard">
                <img src="" alt="Logo" srcset="" class="h-32 w-32">
          </a>
    </div>
    <div class="flex justify-center">
          <div class="flex-1">
                            <div>
          <div class="flex flex-col md:flex-row justify-center  space-y-7 md:space-y-0 md:space-x-7 flex-col md:flex-row md:mb-10 mb-10">
                                  <div class="mb-0 md:mb-20 flex-1">
                <div class="flex justify-center">
                      <i class="fas fa-utensils fa-2x text-center -mb-3"></i>
                </div>
                <div class="cursor-pointer bg-darkAsh-200 text-center py-5 rounded-lg space-between" onclick="window.location='http://localhost:8000/dashboard/tables'">
                      <span class="block">Manage Tables</span>
                </div>
          </div>
                                  <div class="mb-0 md:mb-20 flex-1">
                <div class="flex justify-center">
                      <i class="fa fa-file-alt fa-2x text-center -mb-3"></i>
                </div>
                <div class="cursor-pointer bg-darkAsh-200 text-center py-5 rounded-lg space-between" onclick="window.location='http://localhost:8000/dashboard/menus'">
                      <span class="block">Manage Menus</span>
                </div>
          </div>
                                  <div class="mb-0 md:mb-20 flex-1">
                <div class="flex justify-center">
                      <i class="fa fa-book fa-2x text-center -mb-3"></i>
                </div>
                <div class="cursor-pointer bg-darkAsh-200 text-center py-5 rounded-lg space-between" onclick="window.location='http://localhost:8000/dashboard/bookings'">
                      <span class="block">Manage Bookings</span>
                </div>
          </div>
                      </div>
          <div class="flex flex-col md:flex-row justify-center  space-y-7 md:space-y-0 md:space-x-7 flex-col md:flex-row md:mb-10 mb-10">
                                  <div class="mb-0 md:mb-20 flex-1">
                <div class="flex justify-center">
                      <i class="fa fa-address-book fa-2x text-center -mb-3"></i>
                </div>
                <div class="cursor-pointer bg-darkAsh-200 text-center py-5 rounded-lg space-between" onclick="window.location='http://localhost:8000/dashboard/staff'">
                      <span class="block">Manage Staffs</span>
                </div>
          </div>
                                  <div class="mb-0 md:mb-20 flex-1">
                <div class="flex justify-center">
                      <i class="fa fa-user fa-2x text-center -mb-3"></i>
                </div>
                <div class="cursor-pointer bg-darkAsh-200 text-center py-5 rounded-lg space-between" onclick="window.location='http://localhost:8000/dashboard/customers'">
                      <span class="block">Manage Customers</span>
                </div>
          </div>
                      </div>
</div>
          </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous" defer></script>
</body>
</html>
