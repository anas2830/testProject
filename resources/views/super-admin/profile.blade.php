@extends('layouts.admin')

@section('content')
    
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Profile</a></li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
          <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12 col-12">
                  <div class="alert alert-dismissible" role="alert" id="Msg" style="display: none" >
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <span id="text"></span>
                  </div>
                  <input type="hidden" value="{{$authRole}}" id="authRole" />
                  <form id="updateProfile">

                      <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                      <div class="form-group row">
                          <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="name" value="{{ $userInfo->name }}" required autocomplete="name" autofocus>
                              <span class="text-danger" id="nameErrorMsg"></span>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>
                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                              <span class="text-danger" id="passwordErrorMsg"></span> 
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                          <div class="col-md-6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                          </div>
                      </div>

                      <div class="form-group row">
                          <label class="control-label col-md-3 text-md-right">Photo </label>
                          <div class="col-md-6">
                              @if($userInfo->photo_name != null)
                                <p style="color:#8bc34a">Already added this image: <?php echo $userInfo->photo_original_name; ?></p>
                                <p>If you want to change this please choose</p>
                              @endif

                              <input type="file" class="file-input" name="photo" required> </br>
                              <span class="help-block">Allow extensions: <code>jpg/jpeg</code> , <code>png</code>,and  Allow Size: <code>512 KB</code> Only</span> </br>
                              <span class="text-danger" id="photoErrorMsg"></span>
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-3">
                              <button type="submit" class="btn btn-primary">
                                  Update Profile
                              </button>
                          </div>
                      </div>

                  </form>
                </div>
              </div>
          </div>
        </section>

    </div>
    
    
@endsection

@push('javascript')

<script type="text/javascript">

     $("#updateProfile").submit(function(e) {
          e.preventDefault();
          var form = document.getElementById('updateProfile');
          var formdata = new FormData(form);
          if($('#authRole').val() =="admin"){
            var url = "/adminProfileUpdate";
          }else{
            var url = "/moderatorProfileUpdate";
          }

          $.ajax({
              type: "POST",
              url: url,
              processData: false,
              contentType: false,
              headers: { 'X-CSRF-TOKEN': $('#token').val() },
              data: formdata,
              success: function(data) {
                  console.log('success');
                  console.log(data);
                  console.log(data.msgtype);

                  if(data.msgtype == "success"){
                      $('#Msg').removeClass('alert-danger');
                      $('#Msg').addClass('alert-success');
                      $('#text').text(data.messege);
                      $('#Msg').show();
                      setTimeout(function(){ 
                            location.reload();
                        }, 1000);
                  }else{
                      $('#Msg').removeClass('alert-success');
                      $('#Msg').addClass('alert-danger');
                      $('#text').text(data.messege);
                      $('#Msg').show();
                  }
              },
              error: function(response) {
                  console.log('error');
                  $('#nameErrorMsg').text(response.responseJSON.errors.name);
                  $('#userNameErrorMsg').text(response.responseJSON.errors.userName);
                  $('#passwordErrorMsg').text(response.responseJSON.errors.password);
                  $('#photoErrorMsg').text(response.responseJSON.errors.photo);
              }
          });
      });
    
</script>

@endpush