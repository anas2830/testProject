<style>
.modal-dialog {
    max-width: 800px;
}
</style>
<form class="form-horizontal form-validate-jquery" action="@if(Auth::guard('admin')->check()) {{url('blogAdminCommentUpdateAction', [$UserComment->id])}} @else {{url('blogModeratorCommentUpdateAction', [$UserComment->id])}}  @endif" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="panel panel-flat">
        <div class="panel-body" id="modal-container">


            <div class="form-group row">
                <label class="control-label checkbox-inline col-md-3"> Comment </label>
                <div class="col-md-9">
                    <textarea row="4" class="form-control summernote" name="comment" required><?php echo $UserComment->comment ?></textarea>
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