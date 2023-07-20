<?php $__env->startSection('title', __('Not Found')); ?>
<?php $__env->startSection('code', 'Sorry, You do not have access on the system.'); ?>
<?php $__env->startSection('message', __('Please contact IAS at local number 124')); ?>

<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox/resources/views/errors/404.blade.php ENDPATH**/ ?>