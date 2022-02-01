<style>
.modal-dialog {
    max-width: 800px;
}
</style>
<form class="form-horizontal form-validate-jquery" action="<?php if(Auth::guard('admin')->check()): ?> <?php echo e(url('handleBlogAdmin', [$blog->id])); ?> <?php else: ?>  <?php echo e(url('handleBlogModerator', [$blog->id])); ?><?php endif; ?>" method="POST" enctype="multipart/form-data">
    <?php echo method_field('PUT'); ?>
    <?php echo csrf_field(); ?>
    <div class="panel panel-flat">
        <div class="panel-body" id="modal-container">

            <div class="form-group row">
                <label class="control-label checkbox-inline col-md-3 required"> Blog Title </label>
                <div class="col-md-9">
                    <input type="text" name="title" class="pt5 form-control" required value="<?php echo $blog->blog_title; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label checkbox-inline col-md-3"> Blog Description </label>
                <div class="col-md-9">
                    <textarea row="4" class="form-control summernote" name="description" required><?php echo $blog->blog_description ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-lg-3 col-md-3">Upload Image </label>
                <div class="col-md-9">
                    <p style="color:#8bc34a">Already added this image: <?php echo $blog->photo_original_name; ?></p>
                    <p>If you want to change this please choose</p> </br>
                   
                    <input type="file" class="file-input" name="blogImage">  </br>
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
</script><?php /**PATH D:\xampp\htdocs\laravel-blog-v1\resources\views/super-admin/blog-post/update.blade.php ENDPATH**/ ?>