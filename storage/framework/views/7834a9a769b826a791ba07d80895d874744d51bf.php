
  

<?php $__env->startSection('content'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
              <div class="col-sm-6">
                  <h1 class="m-0">Moderator List</h1>
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

              <div class="data-list text-right">
                <button style="margin-right: 10px;"><a href="<?php echo e(route('courseQuestionArchive.create')); ?>" class="btn btn-primary add-new">Add New</a></button>
              </div>

              <table class="table table-bordered table-hover datatable-highlight data-list" id="blogTable">
                <thead>
                    <tr>
                        <th width="5%">SL.</th>
                        <th width="60%">Question</th>
                        <th width="25%">Answer Type</th>
                        <th width="10%" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($all_quizes)): ?>
                        <?php $__currentLoopData = $all_quizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$key); ?></td>
                            <td><?php echo $quiz->question; ?></td>
                            <td>
                                <?php if($quiz->answer_type == 1): ?>
                                    <span class="label label-info">True/False</span>
                                <?php elseif($quiz->answer_type == 2): ?> 
                                    <span class="label label-info">Single MCQ</span>
                                <?php else: ?> 
                                    <span class="label label-info">Multiple MCQ</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                
                                    <a href="<?php echo e(route('courseQuestionArchive.edit', [$quiz->id])); ?>" class="action-icon"><i class="icon-pencil7"></i></a>
                                    <a href="#" class="action-icon"><i class="icon-trash" id="delete" delete-link="<?php echo e(route('courseQuestionArchive.destroy', [$quiz->id])); ?>"><?php echo csrf_field(); ?> </i></a>
                                
                            </td>
                        </tr> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No Data Found!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

          </div>
        </div>
      </div>


  </div>
  <!-- /.content-wrapper -->


<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascript'); ?>

  <script type="text/javascript">
    $(document).ready( function () {
      $('#blogTable').DataTable();
    });
  </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel-blog-v1\resources\views/super-admin/archiveQuestion/listData.blade.php ENDPATH**/ ?>