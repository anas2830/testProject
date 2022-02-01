<?php $__env->startSection('content'); ?>
    
    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('<?php echo e(asset('website')); ?>/images/img_4.jpg');">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              <h1 class="">Welcome to <?php echo e(Auth::guard('web')->user()->name); ?></h1>
              <p class="lead mb-4 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, adipisci?</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="site-section bg-light">
      <div class="container">

        

        <div class="row">
          <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">My Blog</a>
              <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
            </div>
          </div>
          <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

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
                  <button type="button" class="btn btn-info btn-xs open-modal" modal-title="Create Blog" modal-type="create" modal-size="medium" modal-class="" selector="Blog" modal-link="<?php echo e(url('userBlog')); ?>" style="margin-bottom:2%"> Add New </button>
                </div>

                <table class="table table-bordered table-hover datatable-highlight data-list" id="blogTable">
                    <thead>
                        <tr>
                            <th width="5%">SL.</th>
                            <th width="20%">Name</th>
                            <th width="10%">Thumb</th>
                            <th width="50%">Description</th>
                            <th width="5%">Status</th>
                            <th width="5%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if(count($all_blogs) > 0): ?>
                            <?php $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo Str::words($blog->blog_title, 20, '.....'); ?></td>
                                <td><img src="<?php echo e(asset('uploads/blog/thumb/'.$blog->photo_name)); ?>" alt=""></td>
                                <td><?php echo Str::words($blog->blog_description, 20, '.....'); ?></td>
                                <td class="text-center">Active</td>
                                <td class="text-center">
          
                                    <a href="#" class="open-modal action-icon" modal-title="Update Blog" modal-type="update" modal-size="medium" modal-class="" selector="BlogUpdate" modal-link="<?php echo e(url('userBlog/'.$blog->id.'/edit')); ?>"><i class="icon-pencil"></i></a>
                                    
                                    <a href="#" class="action-icon"><i class="icon-trash" id="delete" delete-link="<?php echo e(url('userBlog', [$blog->id])); ?>"><?php echo csrf_field(); ?> </i></a>
                                </td>
                            </tr> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No Data Found!</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
              
              </div>


              
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              
                <h4 class="text-center">Update Your Porfile</h4>
                <div class="card-body">

                    <div class="alert alert-dismissible" role="alert" id="Msg" style="display: none" >
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <span id="text"></span>
                    </div>

                    <form id="updateProfile">

                        <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e($userInfo->name); ?>" required autocomplete="name" autofocus>
                                <span class="text-danger" id="nameErrorMsg"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="userName" class="col-md-3 col-form-label text-md-right">User Name</label>
                            <div class="col-md-6">
                                <input id="userName" type="text" class="form-control" name="userName" value="<?php echo e($userInfo->userName); ?>" required autocomplete="userName" autofocus>
                                <span class="text-danger" id="userNameErrorMsg"></span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                <span class="text-danger" id="passwordErrorMsg"></span> 
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
                                <p style="color:#8bc34a">Already added this image: <?php echo $userInfo->photo_original_name; ?></p>
                                <p>If you want to change this please choose</p>

                                <input type="file" class="file-input" name="photo"> </br>
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
          </div>
        </div>

        
      </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript'); ?>

<script type="text/javascript">
    $(document).ready( function () {
      $('#blogTable').DataTable();
    });

     $("#updateProfile").submit(function(e) {
          e.preventDefault();
          var form = document.getElementById('updateProfile');
          var formdata = new FormData(form);

          $.ajax({
              type: "POST",
              url: "/profileUpdate",
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
              }
          });
      });
    
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel-blog-v1\resources\views/website/profile.blade.php ENDPATH**/ ?>