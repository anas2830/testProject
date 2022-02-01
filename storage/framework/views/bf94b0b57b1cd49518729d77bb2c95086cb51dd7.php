<form class="form-horizontal form-validate-jquery" action="<?php echo e(url('userBlog')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<div class="panel panel-flat">
    <div class="panel-body" id="modal-container">

        <div class="form-group row">
            <label class="control-label checkbox-inline col-md-3 required"> Blog Title </label>
            <div class="col-md-9">
                <input type="text" name="title" class="pt5 form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label checkbox-inline col-md-3"> Blog Description </label>
            <div class="col-md-9">
                <textarea row="4" class="form-control summernote" name="description" required></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-lg-3 col-md-3">Upload Image </label>
            <div class="col-md-9">
                <input type="file" class="file-input" name="blogImage"> </br>
                <span class="help-block">Allow extensions: <code>jpg/jpeg</code> , <code>png</code>,and  Allow Size: <code>512 KB</code> Only</span>
            </div>
        </div>

    </div>
</div>
</form>
<script type="text/javascript">
	 $(document).ready( function () {
        $(".summernote").summernote({
            height: 150
        });
     });
</script><?php /**PATH D:\xampp\htdocs\laravel-blog-v1\resources\views/website/blog/create.blade.php ENDPATH**/ ?>