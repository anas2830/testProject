<style>
.modal-dialog {
    max-width: 700px;
}
</style>
<form class="form-horizontal form-validate-jquery" action="<?php echo e(url('handleModerator')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
    <div class="panel panel-flat">
        <div class="panel-body" id="modal-container">

            <div class="form-group row">
                <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label text-md-right">Email Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-3 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                </div>
            </div>
            <div class="form-group row">
                <label for="password-confirm" class="col-md-3 col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?></label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-md-3 text-md-right">Photo </label>
                <div class="col-md-6">
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
</script><?php /**PATH D:\xampp\htdocs\laravel-blog-v1\resources\views/super-admin/moderator/create.blade.php ENDPATH**/ ?>