<div id="productionSelectAttorneyModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog dialogVendorFilesModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Select Attorney, Writer,University and Designer for <span id="spanFilenoSelected"></span> </h4>
            </div>
            <div class="modal-body" style="min-height: 350px;">
                <div class="form-group">
                    <label class="col-md-3">Attorney:</label>
                    <select id="selectAttorney">
                        <?php $__currentLoopData = $attorneys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attorney): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($attorney->id); ?>"><?php echo e($attorney->usr); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Letter Of Engagement:</label>
                    <select id="letterOfEng">
                        <option value="0">Not Sent</option>
                        <option value="1">Sent</option>
                        <option value="2">Received</option>
                    </select>
                    <p style="float: right;" id="letterOfEngDate"></p>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Writer:</label>
                    <select id="selectWriter">
                        <?php $__currentLoopData = $writers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($writer->id); ?>"><?php echo e($writer->usr); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-md-3">University:</label>
                    <select id="selectUniversity">
                        <?php $__currentLoopData = $universities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $university): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($university->id); ?>"><?php echo e($university->usr); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Designer:</label>
                    <select id="selectDesigner">
                        <?php $__currentLoopData = $designers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($designer->id); ?>"><?php echo e($designer->usr); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Schedule Date:</label>
                    <div class="col-md-8">
                        <input class="form-control datepicker" id="dateSchedule" name="DATE" readonly="readonly" size="30" type="text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" id="setVendorsValue">Save</button>
            </div>
        </div>
    </div>
</div>
