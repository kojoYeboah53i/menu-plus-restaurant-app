<div class="flex justify-end mb-5">
      <div class="flex space-x-10 items-center mr-2">
            <i class="fa fa-bell-o"></i>
            <i class="fa fa-comment-o"></i>
            <i class="fa fa-gift"></i>
            <i class="fa fa-life-ring"></i>
            <div class="flex items-center">
                  <div id="top-nav-dropdown" class="dropdown show">
                        <div class="py-2 pt-3 px-4 pr-5 rounded-lg text-base bg-darkAsh-200 font-calibreLight dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Hello, {{auth()->user()->firstname}} {{auth()->user()->lastname}}
                        </div>
                        
                        <div class="dropdown-menu ml-3" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item" href="#"  onclick="document.getElementById('profileUpload').click()"><i class="fa fa-user-circle"></i>&nbsp;&nbsp; Change Profile Image</a>
                              <form id="selfUploadForm" action="{{route('upload-image')}}" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="profile_pic" onchange="loadSelfImagePreview(this);" id="profileUpload" class="hidden" enctype="multipart/form-data"/>
                                </form> 
                              <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#changePassword"><i class="fas fa-key"></i>&nbsp;&nbsp; Change Password</a>
                              <a class="dropdown-item" href="{{route('manage.accounts.edit', ['id' => auth()->user()->id])}}"><i class="fas fa-cog"></i>&nbsp;&nbsp; My Account</a>
                        </div>
                  </div>
                  <div id="pictureUploadBlock" class="border-2 border-darkAsh-50 -mx-8 rounded-full w-16 h-16 bg-darkAsh-200">
                        <img id="selfUploadImageBlock" class="img img-fluid rounded-full w-16 h-16 pb-1" src="{{ auth()->user()->profile_pic ?? config('app.profile_placeholder_url', '')}}">
                        <img id="selfImagePreview" class="hidden border-2 border-gray-500 w-16 h-16 pb-1 rounded-full"/>
                  </div>
            </div>
      </div>
</div>
    
<div class="{{(!session()->has('self_image_upload') || (!session()->has('success_message')) && !session()->has('error_message')) ? 'hidden' : ''}} bg-{{session()->get('success_message') ? 'green' : 'red'}}-500 text-{{session()->get('success_message') ? 'green' : 'red'}}-200 py-2 text-center rounded-lg my-3">
      {{session()->has('success_message') ? session()->get('success_message') : session()->get('error_message')}}
</div>
@if(session()->has('password_success'))
      <div class="bg-green-500 text-green-200 py-2 text-center rounded-lg my-3">{{ session()->get('password_success') }}</div>
@endif
@if($errors->any())
    @foreach ($errors->all() as $error)
      <div class="bg-red-500 text-red-200 py-2 text-center rounded-lg my-3">{{ $error }}</div>
    @endforeach
@endif

<!-- Password Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content bg-darkAsh-200">
                  <div class="modal-header" style="border: none;">
                        <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span class="text-danger"><i class="fa fa-close"></i></span></button>
                  </div>
                  <div class="modal-body">
                        <form action="{{ route('change-password')}}" method="post">
                              @csrf
                              <div class="row justify-content-center">
                                    <div class="w-75 md:mr-1">
                                          <div class="input-group mb-3">
                                                <input id="old_password" name="old_password" type="password" class="form-control control-input background-alt-1" placeholder="Enter Old Password" aria-describedby="basic-addon2" required>
                                                <span class="input-group-text control-input background-alt-1 py-0" id="basic-addon2" onclick="makeVisible(this, 'old_password')"><i class="fas fa-eye"></i></span>
                                          </div>
                                          <div class="input-group mb-3">
                                                <input id="new_password" name="new_password" type="password" class="form-control control-input background-alt-1" placeholder="Enter New Password" aria-describedby="basic-addon2" required>
                                                <span class="input-group-text control-input background-alt-1 py-0" id="basic-addon2" onclick="makeVisible(this, 'new_password')"><i class="fas fa-eye"></i></span>
                                          </div>
                                          <div class="input-group mb-3">
                                                <input id="confirm_password" name="confirm_password" onchange="confirmPassword(this)" type="password" class="form-control control-input background-alt-1" placeholder="Confirm Password" aria-describedby="basic-addon2" required>
                                                <span class="input-group-text control-input background-alt-1 py-0" id="basic-addon2" onclick="makeVisible(this, 'confirm_password')"><i class="fas fa-eye"></i></span>
                                          </div>
                                    </div>
                              </div>
                              <div class="row justify-content-center">
                                    <div class="col-4"><button id="save_new_pass" class="btn btn-danger py-1 w-100" type="submit" value="Table" disabled>Save</button></div>
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
</script>