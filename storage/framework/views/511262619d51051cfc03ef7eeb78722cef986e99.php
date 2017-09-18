

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 divLogo">
                <img src="<?php echo e(asset('img/logo.png')); ?>">
                <span class="spanIntranet">INTRANET</span>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading panel-login">Click where you want to go:</div>
                    <div class="panel-body panel-login">
                        <?php if(strpos(Session::get('user_type'), 'consultant')!== false &&
                        (strpos(Session::get('user_type'), 'vendors')=== false ||Session::get('user_username')=="alain"||Session::get('user_username')=="jesus")): ?>
                            <div class="form-group divLinkIndex" style="<?php echo e(Session::get('user_username')=="ilc"?'display: none;':''); ?>">
                                <span>Lead View</span>
                                <a href="<?php echo e(route('leads')); ?>">[Here]</a>
                                <a href="<?php echo e(route('leads')); ?>" target="_blank">[New Tab]</a>
                            </div>
                            <div class="form-group divLinkIndex" style="<?php echo e(Session::get('user_username')=="ilc"?'display: none;':''); ?>">
                                <span>Project View</span>
                                <a href="<?php echo e(route('projects')); ?>">[Here]</a>
                                <a href="<?php echo e(route('projects')); ?>" target="_blank">[New Tab]</a>
                            </div>
                            <div class="form-group divLinkIndex" style="<?php echo e(Session::get('user_username')=="ilc"?'display: none;':''); ?>">
                                <span>Stats View</span>
                                <a href="<?php echo e(route('stats')); ?>">[Here]</a>
                                <a href="<?php echo e(route('stats')); ?>" target="_blank">[New Tab]</a>
                            </div>
                            <div class="form-group divLinkIndex" style="<?php echo e(Session::get('user_username')=="ilc"?'display: none;':''); ?>">
                                <span>Training Calls View</span>
                                <a href="<?php echo e(route('recordCalls')); ?>">[Here]</a>
                                <a href="<?php echo e(route('recordCalls')); ?>" target="_blank">[New Tab]</a>
                            </div>
                        <?php endif; ?>
                        <?php if(strpos(Session::get('user_type'), 'admin')!== false): ?>
                            <div class="form-group divLinkIndex">
                                <span>Admin View</span>
                                <a href="<?php echo e(route('admin')); ?>">[Here]</a>
                                <a href="<?php echo e(route('admin')); ?>" target="_blank">[New Tab]</a>
                            </div>
                                <div class="form-group divLinkIndex">
                                    <span>Consultant Management</span>
                                    <a href="<?php echo e(route('superadmin')); ?>">[Here]</a>
                                    <a href="<?php echo e(route('superadmin')); ?>" target="_blank">[New Tab]</a>
                                </div>
                        <?php endif; ?>
                        <?php if(strpos(Session::get('user_type'), 'statistics')!== false): ?>
                            <div class="form-group divLinkIndex">
                                <span>Statistics View</span>
                                <a href="<?php echo e(route('statistics')); ?>">[Here]</a>
                                <a href="<?php echo e(route('statistics')); ?>" target="_blank">[New Tab]</a>
                            </div>
                        <?php endif; ?>
                        <?php if(strpos(Session::get('user_type'), 'vendors')!== false): ?>
                            <?php if(Session::get('user_id') == 71): ?>
                                <div class="form-group divLinkIndex">
                                    <span>ILC Vendor View</span>
                                    <a href="<?php echo e(route('ilcVendors')); ?>">[Here]</a>
                                    <a href="<?php echo e(route('ilcVendors')); ?>" target="_blank">[New Tab]</a>
                                </div>
                            <?php elseif(Session::get('user_id') == 30): ?>
                                <div></div>
                            <?php elseif(Session::get('user_id') == 47): ?>
                                <div class="form-group divLinkIndex">
                                    <span>Vendor View</span>
                                    <a href="<?php echo e(route('vendors')); ?>">[Here]</a>
                                    <a href="<?php echo e(route('vendors')); ?>" target="_blank">[New Tab]</a>
                                </div>
                                    <div class="form-group divLinkIndex">
                                        <span>ILC Vendor View</span>
                                        <a href="<?php echo e(route('ilcVendors')); ?>">[Here]</a>
                                        <a href="<?php echo e(route('ilcVendors')); ?>" target="_blank">[New Tab]</a>
                                    </div>
                            <?php else: ?>
                                <div class="form-group divLinkIndex">
                                    <span>Vendor View</span>
                                    <a href="<?php echo e(route('vendors')); ?>">[Here]</a>
                                    <a href="<?php echo e(route('vendors')); ?>" target="_blank">[New Tab]</a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(strpos(Session::get('user_type'), 'production')!== false): ?>
                            <div class="form-group divLinkIndex">
                                <span>Production View</span>
                                <a href="<?php echo e(route('production')); ?>">[Here]</a>
                                <a href="<?php echo e(route('production')); ?>" target="_blank">[New Tab]</a>
                            </div>
                            <div class="form-group divLinkIndex">
                                <span>Stats View</span>
                                <a href="<?php echo e(route('stats')); ?>">[Here]</a>
                                <a href="<?php echo e(route('stats')); ?>" target="_blank">[New Tab]</a>
                            </div>
                        <?php endif; ?>
                        <?php if(strpos(Session::get('user_type'), 'clientservices')!== false): ?>
                            <div class="form-group divLinkIndex">
                                <span>Client Services View</span>
                                <a href="<?php echo e(route('clientServices')); ?>">[Here]</a>
                                <a href="<?php echo e(route('clientServices')); ?>" target="_blank">[New Tab]</a>
                            </div>
                        <?php endif; ?>
                        <?php if(strpos(Session::get('user_type'), 'attorneytest')!== false || strpos(Session::get('user_type'), 'attorneyLev')!== false || strpos(Session::get('user_type'), 'attorneySandra')!== false || strpos(Session::get('user_type'), 'attorneyjh')!== false || strpos(Session::get('user_type'), 'attorneyjk')!== false || strpos(Session::get('user_type'), 'attorneyMike')!== false): ?>
                            <div class="form-group divLinkIndex">
                                <span>Legal View</span>
                                <a href="<?php echo e(route('attClientServices')); ?>">[Here]</a>
                                <a href="<?php echo e(route('attClientServices')); ?>" target="_blank">[New Tab]</a>
                            </div>
                        <?php endif; ?>
                        <?php if(strpos(Session::get('user_type'), 'ilc')!== false): ?>
                            <div class="form-group divLinkIndex">
                                <span>ILC View</span>
                                <a href="<?php echo e(route('ilc')); ?>">[Here]</a>
                                <a href="<?php echo e(route('ilc')); ?>" target="_blank">[New Tab]</a>
                            </div>
                                <div class="form-group divLinkIndex">
                                    <span>Manufacturers View</span>
                                    <a href="<?php echo e(route('manufacturer')); ?>">[Here]</a>
                                    <a href="<?php echo e(route('manufacturer')); ?>" target="_blank">[New Tab]</a>
                                </div>
                        <?php endif; ?>
                        <?php if(Session::get('user_id') == 16 || Session::get('user_id') == 3 || Session::get('user_id') == 5): ?>
                            <div class="form-group divLinkIndex">
                                <span>Calls Manager</span>
                                <a href="<?php echo e(route('recordCallsManager')); ?>">[Here]</a>
                                <a href="<?php echo e(route('recordCallsManager')); ?>" target="_blank">[New Tab]</a>
                            </div>
                        <?php endif; ?>
                        <?php if(Session::get('user_id') == 16 || Session::get('user_id') == 3 || Session::get('user_id') == 24 || Session::get('user_id') == 25 || Session::get('user_id') == 30 || Session::get('user_id') == 89): ?>
                            <div class="form-group divLinkIndex">
                                <span>Attorneys Report</span>
                                <a href="<?php echo e(route('attReport')); ?>">[Here]</a>
                                <a href="<?php echo e(route('attReport')); ?>" target="_blank">[New Tab]</a>
                            </div>
                        <?php endif; ?>
                        <?php if(strpos(Session::get('user_type'), 'fix')!== false): ?>
                            <div class="form-group divLinkIndex">
                                <span>Fix Problems / Tricks</span>
                                <a href="<?php echo e(route('fix')); ?>">[Here]</a>
                                <a href="<?php echo e(route('fix')); ?>" target="_blank">[New Tab]</a>
                            </div>
                        <?php endif; ?>

                        <div class="form-group divLinkIndex">
                            <span id="spanUser">Logout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset("js/common.js")); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('intranet.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>