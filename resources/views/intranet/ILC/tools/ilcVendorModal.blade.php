<div id="ilcVendorModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">ILC Vendor</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4">Select Vendor: </label>
                    <div style="display: inline;">
                        <select id="ilcVendorsSelect">
                            <option value="0">Select Vendor</option>
                            <option value="47">Jorge</option>
                            <option value="71">Abdallah</option>
                            <option value="2">Jesus</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Select Design Type: </label>
                    <div style="display: inline;">
                        <label>2D: </label> <input type="radio" id="design2D" name="designType" value="2d" >
                        <label style="margin-left: 20px;">3D: </label> <input type="radio" id="design3D" name="designType" value="3d">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Text: </label>
                    <div style="display: inline;">
                        <textarea rows="10" style="width: 300px;" id="ilcVendorText"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="sendIlcVendor" aria-hidden="true">Send</button>
            </div>
        </div>
    </div>
</div>
