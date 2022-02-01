<?php $__env->startSection('content'); ?>
    
    
    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('<?php echo e(asset('uploads/blog/'.$post->photo_name)); ?>');">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              <h1 class="mb-4"><a href="#"><?php echo e($post->blog_title); ?></a></h1>
              <div class="post-meta align-items-center text-center">
                <figure class="author-figure mb-0 mr-3 d-inline-block"><img src="<?php echo e(asset('uploads/userProfile/'.$authorInfo->photo_name)); ?>" alt="Image" class="img-fluid"></figure>
                <span class="d-inline-block mt-1"><?php echo e($authorInfo->name); ?></span>
                <span>&nbsp;-&nbsp; <?php echo e(date('F j, Y', strtotime($post->created_at))); ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">

          <div class="col-md-12 col-lg-8 main-content">
            
            <div class="post-content-body">

              <?php echo $post->blog_description; ?>


            </div>


            <div class="pt-5">
              <h3 class="mb-5"><?php echo e(count($comments)); ?> Comments</h3>
              <ul class="comment-list">

                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="comment">
                      <div class="vcard">
                        <img src="<?php echo e(asset('uploads/userProfile/'.$comment->authorImage)); ?>" alt="Image placeholder">
                      </div>
                      <div class="comment-body">
                        <h3><?php echo e($comment->authorName); ?></h3>
                        <div class="meta"><?php echo e(date("F j, Y, g:i a", strtotime($comment->created_at))); ?></div>
                        <p><?php echo $comment->comment; ?></p>
                      </div>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <div class="alert alert-dismissible" role="alert" id="Msg" style="display: none" >
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span id="text"></span>
                </div>
                <form  class="p-5 bg-light" id="commentForm">
                  <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
                  <div class="form-group">
                    <input type="hidden" name="blog_id" value=<?php echo e($post->id); ?> />
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-control" required></textarea>
                    <span class="text-danger" id="commentErrorMsg"></span>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary">
                  </div>
                </form>
              </div>
            </div>

          </div>

          <!-- END main-content -->

          <div class="col-md-12 col-lg-4 sidebar">
  
            <!-- END sidebar-box -->
            <div class="sidebar-box">
              <div class="bio text-center">
                <img src="<?php echo e(asset('uploads/userProfile/'.$authorInfo->photo_name)); ?>" alt="Image Placeholder" class="img-fluid mb-5">
                <div class="bio-body">
                  <h2><?php echo e($authorInfo->name); ?></h2>
                  <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p>

                </div>
              </div>
            </div>
            <!-- END sidebar-box -->  
            <div class="sidebar-box">
              <h3 class="heading">Latest Posts</h3>
              <div class="post-entry-sidebar">
                <ul>

                  <?php $__currentLoopData = $latest_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li>
                    <a href="<?php echo e(url('single/'.$rec_post->id)); ?>">
                      <img src="<?php echo e(asset('uploads/blog/'.$rec_post->photo_name)); ?>" alt="Image placeholder" class="mr-4">
                      <div class="text">
                        <h4><?php echo e($rec_post->blog_title); ?></h4>
                        <div class="post-meta">
                          <span class="mr-2"><?php echo e(date('F j, Y', strtotime($rec_post->created_at))); ?></span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
              </div>
            </div>
            <!-- END sidebar-box -->

          </div>
          <!-- END sidebar -->

        </div>
      </div>
    </section>

    


    

<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascript'); ?>
    <script type="text/javascript">

        $("#commentForm").submit(function(e) {
            e.preventDefault();
            e.stopPropagation();

            var form = document.getElementById('commentForm');
            var formdata = new FormData(form);

            $.ajax({
                type: "POST",
                url: "/comment",
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('#token').val() },
                data: formdata,
                success: function(data) {
                    console.log('success');
                    console.log(data);
                    
                    if(data.msgtype == "success"){
                        $('#Msg').removeClass('alert-danger');
                        $('#Msg').addClass('alert-success');
                        $('#text').text(data.messege);
                        $('#Msg').show();
                        setTimeout(function(){ 
                            location.reload();
                        }, 2000);
                    }else{
                        $('#Msg').removeClass('alert-success');
                        $('#Msg').addClass('alert-danger');
                        $('#text').text(data.messege);
                        $('#Msg').show();
                    }
                },
                error: function(response) {
                    console.log('error');
                    $('#commentErrorMsg').text(response.responseJSON.errors.comment);
                }
            });
        });

    </script>
<?php $__env->stopPush(); ?>
    


<?php echo $__env->make('layouts.website', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel-blog-v1\resources\views/website/post.blade.php ENDPATH**/ ?>