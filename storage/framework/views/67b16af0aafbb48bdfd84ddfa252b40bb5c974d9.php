
<?php $__env->startSection('title','Patent Services USA'); ?>


<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/omiLogin.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid container-launch divLogoLogin">
        <div class="row">
            <div class="col-md-12 divLogo">
                <img src="<?php echo e(asset('img/logo.png')); ?>">
            </div>
            <div class="col-md-4 col-md-offset-4 boxLogin">
                <h3 class="form-title">Secure Login</h3>
                <div class="panel-body panel-login">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                <li><?php echo e($error); ?></li>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('launch/login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-xs-6">
                                <button type="submit" class="btn btn-success uppercase">Login</button>
                            </div>
                            
                                
                            
                        </div>
                    </form>
                    <div class="form-group"><p id="recoverPswd" class="btn" data-toggle="modal">Did you forget your password?</p></div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('omi.tools.recoverPsswdModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("js/omi/resetPswd.js")); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('omi.layout.headLogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>