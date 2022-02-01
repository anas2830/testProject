@extends('layouts.website')

@section('content')


    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('{{ asset('website')}}/images/img_4.jpg');">
        <div class="container">
        <div class="row same-height justify-content-center">
            <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
                <h1 class="">Register</h1>
                <p class="lead mb-4 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, adipisci?</p>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card" style="margin:5%">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="alert alert-dismissible" role="alert" id="Msg" style="display: none" >
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span id="text"></span>
                </div>

                <div class="card-body">
                    <form id="register">

                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <span class="text-danger" id="nameErrorMsg"></span>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="userName" class="col-md-4 col-form-label text-md-right">User Name</label>

                            <div class="col-md-6">
                                <input id="userName" type="text" class="form-control @error('userName') is-invalid @enderror" name="userName" value="{{ old('userName') }}" required autocomplete="userName" autofocus>
                                <span class="text-danger" id="userNameErrorMsg"></span>
                                @error('userName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <span class="text-danger" id="emailErrorMsg"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <span class="text-danger" id="passwordErrorMsg"></span> 
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-lg-4 col-md-4 text-md-right">Photo </label>
                            <div class="col-lg-6 col-md-6">
                                <input type="file" class="file-input" name="photo" required> </br>
                                <span class="help-block">Allow extensions: <code>jpg/jpeg</code> , <code>png</code>,and  Allow Size: <code>512 KB</code> Only</span> </br>
                                <span class="text-danger" id="photoErrorMsg"></span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('javascript')
    <script type="text/javascript">

         $("#register").submit(function(e) {
            e.preventDefault();
            var form = document.getElementById('register');
            var formdata = new FormData(form);

            $.ajax({
                type: "POST",
                url: "/sign-up",
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
                            location.href = "/";
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
                    $('#emailErrorMsg').text(response.responseJSON.errors.email);
                    $('#passwordErrorMsg').text(response.responseJSON.errors.password);
                    $('#photoErrorMsg').text(response.responseJSON.errors.photo);
                }
            });
        });



    </script>
@endpush
