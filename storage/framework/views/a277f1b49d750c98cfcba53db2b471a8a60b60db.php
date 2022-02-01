
  

<?php $__env->startSection('content'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
              <div class="col-sm-6">
                  <h1 class="m-0">Question</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard v1</li>
                  </ol>
              </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="" style="padding:2%">

              <?php if(session('msgType')): ?>
                  <?php if(session('msgType') == 'danger'): ?>
                    <div id="msgDiv" class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold"><?php echo e(session('msgType')); ?>!</span> <?php echo e(session('messege')); ?>

                    </div>
                  <?php else: ?>
                    <div id="msgDiv" class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold"><?php echo e(session('msgType')); ?>!</span> <?php echo e(session('messege')); ?>

                    </div>
                  <?php endif; ?>
              <?php endif; ?>

              <?php if($errors->any()): ?>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="alert alert-danger alert-styled-left alert-bordered">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">Opps!</span> <?php echo e($error); ?>.
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>

              <form class="form-horizontal form-validate-jquery" action="<?php echo e(route('courseQuestionArchive.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <fieldset class="content-group">
                    <?php if(session('msgType')): ?>
                        <div id="msgDiv" class="alert alert-<?php echo e(session('msgType')); ?> alert-styled-left alert-arrow-left alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold"><?php echo e(session('msgType')); ?>!</span> <?php echo e(session('messege')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($errors->any()): ?>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="alert alert-danger alert-styled-left alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">Opps!</span> <?php echo e($error); ?>.
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-2">Question <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea id="overviewDetails" name="question" class="form-control">
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Answer Type <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select class="select-search" name="answer_type"  id="answer_type" required>
                                <option value="">Select Type</option>
                                <?php $__currentLoopData = $answer_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type->id); ?>"><?php echo e($type->answer_type); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="answerDiv" style="display:none;">
                        <label class="control-label col-lg-2">Answer <span class="text-danger">*</span></label>
                        <div class="col-lg-10" id="answer_view_1" style="display:none;">
                            <div class="checkbox checkbox-switch">
                                
                                <label>
                                    <input type="checkbox" data-on-text="True" data-off-text="False" class="switch" id="answer" name="answer_tf" value="1" checked="checked">
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-10" id="answer_view_2_3" style="display:none;">
                            <div class="row">
                                <div class="col-md-9 pr0 mb10">
                                    <input name="answer[]" placeholder="Answer" class="form-control mb-5">
                                </div>
                                <div class="col-md-3 btnView">
                                    <div class="toggle-custom mr10" style="display: inline-block">
                                        <label class="toggle answerCheck" data-on="Yes" data-off="No">
                                            <input name="true_answer[]" class="trueAnswer mr-5" type="radio" value="0"> <span class="button-radio"></span>
                                        </label>
                                    </div>
                                    <button id="answer_add" class="btn btn-default ml5" type="button"><i class="icon-plus-circle2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /basic textarea -->
                    

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
                    <a href="<?php echo e(route('courseQuestionArchive.index')); ?>" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
                </div>
            </form>

          </div>
        </div>
      </div>


  </div>
  <!-- /.content-wrapper -->


<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        <?php if(session('msgType')): ?>
            setTimeout(function() {$('#msgDiv').hide()}, 6000);
        <?php endif; ?>

        $("#overviewDetails").summernote({
            height: 150
        });

        $('#answer_type').change(function(){
            var answer_type = $(this).val();
            if(answer_type) {
                if(answer_type==1) {
                    $("#answer_view_1").show();
                    $("#answer_view_2_3").hide();
                } else {
                    $("#answer_view_2_3").show();
                    $("#answer_view_1").hide();

                    if(answer_type==2) {
                        $(".answerCheck").find("input").attr("type", "radio");
                        $(".answerCheck").find("span").attr("class", "button-radio");
                    } else {
                        $(".answerCheck").find("input").attr("type", "checkbox");
                        $(".answerCheck").find("span").attr("class", "button-checkbox");
                    }
                }
                $("#answerDiv").show();
            }else{
                $("#answerDiv").hide();
            }
        });
        
        $("#answerDiv").on("click", "#answer_add", function(){
            var answer_type = $("#answer_type").val();
            $("#answer_view_2_3").find("#answer_add").remove();
            var trueAnswer = $("#answer_view_2_3").find(".trueAnswer:last").val();
            $("#answer_view_2_3").append('<div class="row"><div class="col-md-9 pr0 mb10"><input name="answer[]" placeholder="Answer" class="form-control mb-5"></div><div class="col-md-3 btnView"><div class="toggle-custom mr10" style="display: inline-block"><label class="toggle answerCheck" data-on="Yes" data-off="No"><input name="true_answer[]" class="trueAnswer mr-5" value="'+(parseInt(trueAnswer)+1)+'" type="'+((answer_type==2)?'radio':'checkbox')+'"> <span class="button-'+((answer_type==2)?'radio':'checkbox')+'"></span></label></div><button id="answer_remove" class="btn btn-default ml5" type="button"><i class="icon-minus-circle2"></i></button><button id="answer_add" class="btn btn-default ml5" type="button"><i class="icon-plus-circle2"></i></button></div></div>');

            if($("#answer_view_2_3").find(".btnView:first").find("#answer_remove").length<=0) {
                $("#answer_view_2_3").find(".btnView:first").append('<button id="answer_remove" class="btn btn-default ml5" type="button"><i class="icon-minus-circle2"></i></button>');
            }
        });

        $("#answerDiv").on("click", "#answer_remove", function(){
            $(this).parents(".row").first().remove();
            if($("#answer_view_2_3").find("#answer_add").length<=0) {
                $("#answer_view_2_3").find(".btnView:last").append('<button id="answer_add" class="btn btn-default ml5" type="button"><i class="icon-plus-circle2"></i></button>');
            }
            if($("#answer_view_2_3").find(".btnView").length==1) {
                $("#answer_view_2_3").find(".btnView").find("#answer_remove").remove();
            }
            $("#answer_view_2_3").find(".trueAnswer").each(function(index){
                $(this).val(index);
            });
        });
    })
</script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel-blog-v1\resources\views/super-admin/archiveQuestion/create.blade.php ENDPATH**/ ?>