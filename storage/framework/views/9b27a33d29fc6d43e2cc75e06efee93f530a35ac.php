<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'LFWF Academy')); ?></title>

    <!-- Favicon -->
    <link href="<?php echo e(asset('web/img/fav.png')); ?>" rel="shortcut icon" type="image/x-icon"/>
    

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('backend/assets/css/icons/icomoon/styles.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('backend/assets/css/minified/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('backend/assets/css/minified/core.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('backend/assets/css/minified/components.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('backend/assets/css/minified/colors.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('backend/assets/css/practiceTime.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('backend/assets/summernote/summernote.css')); ?>" rel="stylesheet" type="text/css"/>
    <!-- /filePond stylesheets --> 
    <link href="<?php echo e(asset('web/filepond/filepond.css')); ?>" rel="stylesheet" type="text/css"/>
    
    <!-- Rang Slider stylesheets --> 
    <link href="<?php echo e(asset('web/rangSlider/rangSlider.css')); ?>" rel="stylesheet" type="text/css"/>

    <!-- /global stylesheets --> 
    <style>
        .add-new {
            color: #fff!important;
        }
        .add-new:hover {
            opacity: 1 !important;
        }
        .panel>.dataTables_wrapper .table-bordered {
            border: 1px solid #ddd;
        }
        .dataTables_length {
            margin: 20px 0 20px 20px;
        }
        .dataTables_filter {
            margin: 20px 0 20px 20px;
        }
        .dataTables_info {
            margin-bottom: 20px;
        }
        .dataTables_paginate {
            margin: 20px 0 20px 20px;
        }
        .action-icon {
            padding: 0px 10px 0 0;
        }

        .kv-fileinput-upload {
            display: none;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
        

</head>
<body class="navbar-top-md-xs sidebar-xs has-detached-left">

    <?php echo $__env->yieldContent('content'); ?>


	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/loaders/pace.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/core/libraries/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/popper.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/core/libraries/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/bootbox.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/bootbox.locales.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/loaders/blockui.min.js')); ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/tables/datatables/datatables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/summernote/summernote.min.js')); ?>"></script>
    
    <!-- Stricky Class menu scrollbar -->
    <?php if(request()->is('class')): ?>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/ui/nicescroll.min.js')); ?>"></script>
    <?php endif; ?>
    <!-- Horizontal Navbar JS files -->
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/ui/drilldown.js')); ?>"></script>
    
    
    <!-- Sweet Alert JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/notifications/sweet_alert.min.js')); ?>"></script>

    <!-- Form JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/validation/validate.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/selects/bootstrap_multiselect.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/inputs/touchspin.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/core/libraries/jquery_ui/interactions.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/selects/select2.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/styling/switch.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/styling/switchery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/styling/uniform.min.js')); ?>"></script>
    <!-- Form JS files -->
    
    <!-- Dashboard JS files -->
    
    <!-- Dashboard JS files -->

    <!-- Uploader JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/uploaders/fileinput.min.js')); ?>"></script>

    <?php if(!request()->is('changeProfile')): ?>
    <!-- Chart JS files -->
	
    <?php endif; ?>
	
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/core/app.js')); ?>"></script>
	
    
    <!-- Datatable JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/pages/datatables_advanced.js')); ?>"></script>

    <!-- Form Validation JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/pages/form_validation.js')); ?>"></script>

    <!-- Select2 JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/pages/form_select2.js')); ?>"></script>

    <!-- Uploader JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/pages/uploader_bootstrap.js')); ?>"></script>
    
    <!-- Stricky Class menu scrollbar -->
    <?php if(request()->is('class')): ?>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/sticky/sidebar_detached_sticky_custom.js')); ?>"></script>
    <?php endif; ?>
    <!-- /Filepond JS files -->
    <script type="text/javascript" src="<?php echo e(asset('web/filepond/filepond.js')); ?>"></script>
    
    <!-- /Filepond JS files -->
    <script src="<?php echo e(asset('web/rangSlider/prefixfree.min.js')); ?>"></script>
    <script src="<?php echo e(asset('web/rangSlider/rangeslider.min.js')); ?>"></script>
    <script src="<?php echo e(asset('web/rangSlider/underscore-min.js')); ?>"></script>

    <!-- /Custom JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/custom_frame.js')); ?>"></script>    

    <!-- Per Page JS files -->
    <?php echo $__env->yieldPushContent('javascript'); ?>
    <!-- /Per Page JS files -->


</body>
</html>
<?php /**PATH D:\xampp\htdocs\laravel-blog-v1\resources\views/layouts/examDefault.blade.php ENDPATH**/ ?>