<div id="emailILCModal" class="modal fade in" role="dialog" aria-hidden="false" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="emailModalHeader">EMAIL TO CLIENT</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" id="bodyTag" style="text-align: left">EMAIL BODY</label>
                    <div class="col-md-9 input-group">
                     <textarea rows="10" class="form-control cleanBorder" id="emailILCText"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <i class="fa fa-paperclip fa-lg pull-left attachFileEmILC" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Attach Files"></i>
                <label class="pull-left attachFileEmILC" style="cursor: pointer;">Add Attachment</label>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn btn-success" id="sendEmILC">Send</button>
                <br>
                <div id="attachments-container-emIlc" class="col-md-12"></div>
            </div>
        </div>
    </div>
</div>
