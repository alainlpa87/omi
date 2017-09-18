<div id="productionSetShippingDateModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog dialogVendorFilesModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Select Shipping Date for <span id="spanFilenoShippingSelected"></span> </h4>
            </div>
            <div class="modal-body" style="min-height: 120px;">
                <div class="form-group">
                    <label class="col-md-3">Shipping Date:</label>
                    <div class="col-md-8">
                        <input class="form-control datepicker" id="dateShipping" name="DATE" readonly="readonly" size="30" type="text">
                    </div>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="col-md-3">Project Utility:</label>
                    <div class="col-md-8">
                        <select id="selectUtility">
                            <option value="">Select One</option>
                            <option value="U_D">U&D</option>
                            <option value="Utility">U</option>
                            <option value="Design">D</option>
                            <option value="IMG">IMG</option>
                            <option value="Provisional">PROVISIONAL</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" id="setShippingValue">Save</button>
            </div>
        </div>
    </div>
</div>
