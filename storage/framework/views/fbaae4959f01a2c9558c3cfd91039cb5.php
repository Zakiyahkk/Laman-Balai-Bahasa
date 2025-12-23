<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?> | Balai Bahasa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <link rel="stylesheet" href="<?php echo e(asset('css/user.css')); ?>">

    <!-- CSS Halaman Spesifik -->
    <?php echo $__env->yieldContent('css'); ?>
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
<?php /**PATH C:\laragon\www\Laman-Balai-Bahasa\resources\views/layouts/user.blade.php ENDPATH**/ ?>