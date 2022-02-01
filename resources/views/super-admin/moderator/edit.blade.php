<style>
.modal-dialog {
    max-width: 700px;
}
</style>
<form class="form-horizontal form-validate-jquery" action="{{url('handleModerator', [$moderator->id])}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="panel panel-flat">
        <div class="panel-body" id="modal-container">

            <div class="form-group row">
                <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required autocomplete="name" value="{{ $moderator->name }}" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label text-md-right">Email Address</label>

                <div class="col-md-6">
                    <input id="email" value={{ $moderator->email }} type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
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
                    <p style="color:#8bc34a">Already added this image: <?php echo $moderator->photo_original_name; ?></p>
                    <p>If you want to change this please choose</p>
                    <input type="file" class="file-input" name="photo" required> </br>
                    <span class="help-block">Allow extensions: <code>jpg/jpeg</code> , <code>png</code>,and  Allow Size: <code>512 KB</code> Only</span> </br>
                </div>
            </div>

        </div>
    </div>
</form>

<script type="text/javascript">
	 $(document).ready( function () {
        
     });
</script>