

<?php $__env->startSection('content'); ?>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row align-items-stretch retro-layout-2">

          <div class="col-md-4">
            <?php $__currentLoopData = $firstTwoBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e(url('single/'.$blog->id)); ?>" class="h-entry mb-30 v-height gradient" style="background-image: url('<?php echo e(asset('uploads/blog/'.$blog->photo_name)); ?>');">
                <div class="text">
                  <h2>The AI magically removes moving objects from videos.</h2>
                  <span class="date"><?php echo e(date('F j, Y', strtotime($blog->created_at))); ?></span>
                </div>
              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <div class="col-md-4" style="height:430px">
            <?php $__currentLoopData = $middleBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <a href="<?php echo e(url('single/'.$blog->id)); ?>" class="h-entry img-5 h-100 gradient" style="background-image: url('<?php echo e(asset('uploads/blog/'.$blog->photo_name)); ?>');">
                    <div class="text">
                      <h2>The AI magically removes moving objects from videos.</h2>
                      <span class="date"><?php echo e(date('F j, Y', strtotime($blog->created_at))); ?></span>
                    </div>
                  </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>


          <div class="col-md-4">
            <?php $__currentLoopData = $lastTwoBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e(url('single/'.$blog->id)); ?>" class="h-entry mb-30 v-height gradient" style="background-image: url('<?php echo e(asset('uploads/blog/'.$blog->photo_name)); ?>');">
                <div class="text">
                  <h2>The AI magically removes moving objects from videos.</h2>
                  <span class="date"><?php echo e(date('F j, Y', strtotime($blog->created_at))); ?></span>
                </div>
              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

        </div>
      </div>
    </div>



    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12">
            <h2>Recent Posts</h2>
          </div>
        </div>
        <div class="row">

         

              <?php $__currentLoopData = $recent_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 mb-4">
                  <div class="entry2">
                      <a href="<?php echo e(url('single/'.$post->id)); ?>"><img src="<?php echo e(asset('uploads/blog/'.$post->photo_name)); ?>" alt="Image" class="img-fluid rounded" style="width: 370px;height: 250px;"></a>
                      <div class="excerpt">
                        <span class="post-category text-white bg-secondary mb-3">All</span>

                        <h2><a href="<?php echo e(url('single/'.$post->id)); ?>">The AI magically removes moving objects from videos.</a></h2>
                        <div class="post-meta align-items-center text-left clearfix">
                          <figure class="author-figure mb-0 mr-3 float-left"><img src="<?php echo e(asset('uploads/userProfile/'.$post->authorImage)); ?>" alt="Image" class="img-fluid"></figure>
                          <span class="d-inline-block mt-1">By <a href="<?php echo e(url('single/'.$post->id)); ?>"><?php echo e($post->authorName); ?></a></span>
                          <span>&nbsp;-&nbsp; <?php echo e(date('F j, Y', strtotime($post->created_at))); ?></span>
                        </div>
                        
                          <p><?php echo Str::words($post->blog_description, 60, '.....'); ?></p>
                          <p><a href="<?php echo e(url('single/'.$post->id)); ?>">Read More</a></p>
                      </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>

      </div>
    </div>

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\laravel-blog-v1\resources\views/website/home.blade.php ENDPATH**/ ?>