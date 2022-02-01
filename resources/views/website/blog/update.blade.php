<form class="form-horizontal form-validate-jquery" action="{{url('userBlog', [$blog->id])}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="panel panel-flat">
        <div class="panel-body" id="modal-container">

            <div class="form-group row">
                <label class="control-label checkbox-inline col-md-4 required"> Blog Title </label>
                <div class="col-md-8">
                    <input type="text" name="title" class="pt5 form-control" required value="{!! $blog->blog_title !!}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label checkbox-inline col-md-4"> Blog Description </label>
                <div class="col-md-8">
                    <textarea row="4" class="form-control summernote" name="description" required><?php echo $blog->blog_description ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-lg-4 col-md-4">Upload Image </label>
                <div class="col-md-8">
                    <p style="color:#8bc34a">Already added this image: <?php echo $blog->photo_original_name; ?></p>
                    <p>If you want to change this please choose</p>
                   
                    <input type="file" class="file-input" name="blogImage"> 
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
</script>