<div id="emailToVendorsModal" class="modal fade in" role="dialog" aria-hidden="false" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="emailModalHeader">EMAIL TO VENDOR</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">Vendor</label>
                    <div class="col-md-4" >
                        <select id="selectVendor" style="width: 100%;">
                            <option value="0">Select Vendor</option>
                            <option value="jdh@ip-pages.com">Jerry D. Haynes</option>
                            <option value="MIKERIES@aol.com">Michael Ries</option>
                            <option value="lana.assaf@hotmail.com">Lana</option>
                            <option value="attorneylev@gmail.com">Lev Iwashko</option>
                            <option value="thompson.sandra.jeann@gmail.com">Sandra Thompson</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">Email</label>
                    <div class="col-md-5" >
                        <input type="text" id="emailToVendor">
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">Subject</label>
                    <div class="col-md-5" >
                        <input type="text" id="subjEmToVendor">
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">BODY EMAIL</label>
                    <div class="col-md-9">
                     <textarea rows="10" class="form-control cleanBorder" id="bodyToVend" name="bodyToVend"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <i class="fa fa-paperclip fa-lg pull-left attachFileToVendor" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Attach Files"></i>
                <label class="pull-left attachFileToVendor" style="cursor: pointer;">Add Attachment</label>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn btn-success" id="sendEmToVendor">Send</button>
                <br>
                <div id="attachments-container-toVendor" class="col-md-12"></div>
            </div>
        </div>
    </div>
</div>
