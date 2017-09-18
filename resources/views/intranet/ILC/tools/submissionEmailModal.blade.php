<div id="subEmailModal" class="modal fade in" role="dialog" aria-hidden="false" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Submission Email</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-3" style="text-align: left">MANUFACTURER: </label>
                    <div class="col-md-8 input-group">
                        <span class="input-group-addon"><i class="fa fa-tasks"></i></span>
                        <select id="selectManfSub" class="form-control">
                            <option value="0">Select Manufacturer</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-3" style="text-align: left">EMAIL</label>
                    <div class="col-md-8 input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email"  class="form-control cleanBorder" id="emailSubm" name="emailSubm"></textarea>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-3" style="text-align: left">BCC</label>
                    <div class="col-md-8 input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email"  class="form-control cleanBorder" id="bccSubmission" name="bccSubmission"></textarea>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">TEXT</label>
                    <div class="col-md-9 input-group">
                     <textarea rows="10" class="form-control cleanBorder" id="textSubmission" name="textSubmission"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <i class="fa fa-paperclip fa-lg pull-left attachFileSub" style="cursor: pointer;" id="attachFileSub" data-toggle="tooltip" data-placement="bottom" title="Attach Files"></i>
                <label class="pull-left attachFileSub" style="cursor: pointer;" id="labelAttachSub">Add Attachment</label>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn btn-success" id="sendSubmission">Send</button>
                <br>
                <div id="attachments-container-sub" class="col-md-12"></div>
            </div>
        </div>
    </div>
</div>
