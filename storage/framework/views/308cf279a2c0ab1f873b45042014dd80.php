<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Balai Bahasa'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>

<body>

    <?php echo $__env->make('user.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('user.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="<?php echo e(asset('js/user.js')); ?>"></script>
</body>


</html>
<?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/layouts/app.blade.php ENDPATH**/ ?>