<div id="clientEmailModal" class="modal fade in" role="dialog" aria-hidden="false" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Email</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">SUBJECT</label>
                    <div class="col-md-9 input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text"  class="form-control cleanBorder" id="subjClientEmail" name="subjClientEmail">
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">TEXT</label>
                    <div class="col-md-9 input-group">
                     <textarea rows="10" class="form-control cleanBorder" id="textClientEmail" name="textClientEmail"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <i class="fa fa-paperclip fa-lg pull-left attachFileClientEmail" data-pid="<?php echo e($project->id); ?>" style="cursor: pointer;" id="attachFileClientEmail" data-toggle="tooltip" data-placement="bottom" title="Attach Files"></i>
                <label class="pull-left attachFileClientEmail" data-pid="<?php echo e($project->id); ?>" style="cursor: pointer;" id="labelAttachClientEmail">Add Attachment</label>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn btn-success" id="sendClientEmail" data-pid="<?php echo e($project->id); ?>">Send</button>
                <br>
                <div id="attachments-container-clientEm" class="col-md-12"></div>
            </div>
        </div>
    </div>
</div>
