<?php $__env->startSection('content'); ?>
<div class="login-register">
    <div class="row margin-unset row">
        <div class="col-md-2"></div>
        <div class="col-md-8 ">
            <div class="col-md-12 text-center">
                <img src="/images/logo-hd.png" class="img-logo-center">
            </div>
            <div class="card" style="color:#d4af37">
                <div class="card-header">Account Pending</div>
                <div class="card-body">
                    <?php
                        $user = isset(Auth::user()->name) ? Auth::user()->name : '';
                    ?>
                    <p>The home seller account approval team is still in the process of setting up your account and will get back to you shortly with all the sweet details once they're finished!</p>
                    <p>
                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">Back to HOME</a>
                                        </li>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/account/pending.blade.php ENDPATH**/ ?>