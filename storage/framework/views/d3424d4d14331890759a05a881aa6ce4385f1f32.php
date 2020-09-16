<?php $__env->startSection('content'); ?>
<div class="login-register">
    <div class="row margin-unset">
        <div class="col-md-4"></div>
        <div class="col-md-4 ">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" action="<?php echo e(route('register')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                            <h3 class="box-title m-b-20 text-gold">Sign Up</h3>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="name" type="text" class="padding-10 form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" placeholder="Name" autofocus>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="email" type="email" class="padding-10 form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" placeholder="Email">

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="password" type="password" class="padding-10 form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="new-password" placeholder="Password">

                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                </div>
                            </div>
                        
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="contact" type="text" class="padding-10 form-control <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="contact" value="<?php echo e(old('contact')); ?>" required placeholder="Contact No.">

                                    <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <select class="form-control province-change select-change" required name="province" data-url="<?php echo e(route('reg.city')); ?>" data-target=".city-change">
                                        <option value="">Select Province</option>
                                        <?php $__currentLoopData = $_province; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($province->provCode); ?>" <?php echo e(old('province') == $province->provCode ? 'selected="selected"' : ''); ?>><?php echo e($province->provDesc); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <select class="form-control city-change select-change" data-url="<?php echo e(route('reg.brgy')); ?>" data-target=".barangay-change" required name="city">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <select class="form-control barangay-change" required name="barangay">
                                        <option value="">Select Barangay</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <textarea class="form-control" name="street" required placeholder="Street"></textarea>
                                    
                                </div>
                            </div>

                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-gold btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"><?php echo e(__('Register')); ?></button>
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="col-sm-12 text-center">
                                    <div>Already have an account? <a href="<?php echo e(route('login')); ?>" class="text-info m-l-5"><b class="text-gold">Sign In</b></a></div>
                                </div>
                            </div>
                    </form>
                    <form class="form-horizontal" id="recoverform" action="index.html">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/js/register.js?<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lokalseller\resources\views/auth/register.blade.php ENDPATH**/ ?>