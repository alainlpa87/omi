<div id="declineEmailModal" class="modal fade in" role="dialog" aria-hidden="false" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Decline Email to Manufacturer</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-3" style="text-align: left">MANUFACTURER: </label>
                    <div class="col-md-8 input-group">
                        <span class="input-group-addon"><i class="fa fa-tasks"></i></span>
                        <select id="selectManufacturerToDecline" class="form-control">
                            <option value="0">Select Manufacturer</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-3" style="text-align: left">TO: </label>
                    <div class="col-md-8 input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email"  class="form-control cleanBorder" id="emailDecline" name="emailDecline"></textarea>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-3" style="text-align: left">TEXT</label>
                    <div class="col-md-8 input-group">
                     <textarea rows="10" class="form-control cleanBorder" id="textDecline" name="textDecline"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <i class="fa fa-paperclip fa-lg pull-left attachFileDecline hidden" style="cursor: pointer;" id="attachFileDecline" data-toggle="tooltip" data-placement="bottom" title="Attach Files"></i>
                <label class="pull-left attachFileDecline hidden" style="cursor: pointer;" id="attachFileDecline">Add Attachment</label>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn btn-success" id="sendDecline">Send</button>
                <br>
                <div id="attachments-container-decline " class="col-md-12"></div>
            </div>
        </div>
    </div>
</div>
