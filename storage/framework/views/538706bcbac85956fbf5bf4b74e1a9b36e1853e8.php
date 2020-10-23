<?php $__env->startSection('content'); ?>
<div class="login-register">
    <div class="row margin-unset row">
        <div class="col-md-2"></div>
        <div class="col-md-8 ">
            <div class="col-md-12 text-center">
                <img src="/images/logo-hd.png" class="img-logo-center">
            </div>
            <div class="card" style="color:#d4af37">
                <div class="card-header">Account Declined</div>
                <div class="card-body">
                    <?php
                        $user = isset(Auth::user()->name) ? Auth::user()->name : '';
                    ?>
                    <p style="text-align: justify;">The home seller account approval team has declined your account request because you did not meet the requirements set by the team. If this is a mistake or you want to appeal your account request please call us <a href="tel:+639173100126"><u>+639173100126</u></a>  or email us <a href="mailto:lokaldatph@gmail.com"><u>lokaldatph@gmail.com</u></a></p>
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
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/account/declined.blade.php ENDPATH**/ ?>