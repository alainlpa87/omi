<div id="settingsModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Consultant Settings</h4>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="form-group">
                        <h3 class="control-label col-md-12">Consultant User: <span id="settingsUser"><?php echo e($consultant->usr); ?></span></h3>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">DID2</label>
                        <input class="editableval" id="settingsDID2" type="text" value="<?php echo e($consultant->did2); ?>">
                        <i class="fa fa-floppy-o setDID2"></i>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">Allow text notifications:</label>
                        <select id="settingsAllowText">
                            <option value="0" <?php echo e($consultant->leadNotiOpt==0?"selected":""); ?>>NO</option>
                            <option value="1" <?php echo e($consultant->leadNotiOpt==1?"selected":""); ?>>YES</option>
                        </select>
                        <i class="fa fa-floppy-o setAllowTextNotification"></i>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">Text notification number:</label>
                        <input class="editableval" id="settingsTextNotificationNumber" type="text" value="<?php echo e($consultant->notino); ?>">
                        <i class="fa fa-floppy-o setTextNotificationNumber"></i>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">Use Ext Number as outgoing DID:</label>
                        <input type="checkbox" id="useExt" <?php echo e($consultant->useExt!="0"?" checked":""); ?>>
                    </div>
                    <div class="form-group">
                        <h3>VM:</h3>
                        <div class="col-md-3">
                            <?php $__currentLoopData = $voiceMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <input class="setvm btn btn-primary" type="button" data-vm="<?php echo e($vm->id); ?>" value="SET <?php echo e($vm->title); ?>" />
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="col-md-7">
                            <?php $__currentLoopData = $voiceMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="text" id="vmName_<?php echo e($vm->id); ?>" class="editableval" placeholder="VM Name" value="<?php echo e($vm->title); ?>">
                                <i class="fa fa-floppy-o setVMName"  data-vm="<?php echo e($vm->id); ?>"></i>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
</div>
