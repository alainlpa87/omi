<div id="setPaymentProjectModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Select Payment Settings</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3">PIN:</label>
                    <input id="setPaymentPin" class="editableval" type="text" placeholder="Project PIN" class="col-md-6 form-control">
                </div>
                <div class="form-group">
                    <label class="col-md-3">CONTRACT TYPE:</label>
                    <select id="setPaymentContractType">
                        <option value="IMG">IMG</option>
                        <option value="IGUP">IGUP</option>
                        <option value="IIG">IIG</option>
                        <option value="PPA">PPA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-md-3">REFUND: </label>
                    <input type="checkbox" id="refund">
                </div>
                <div class="form-group">
                    <label class="col-md-3">Amount:</label>
                    <input id="setPaymentPrice" class="editableval" type="text" placeholder="Total Price" class="col-md-6 form-control priceContract"  data-a-sep="," data-a-dec="." data-v-max="9999.00" data-v-min="0.00">
                </div>
                <div class="form-group">
                    <label class="col-md-3">NOTES:</label>
                    <input id="setPaymentNotes" class="editableval" type="text" placeholder="Notes" class="col-md-6 form-control">
                </div>
                <div class="form-group">
                    <input type="checkbox" id="setPaymentContract">We have a contract signed.
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" id="setPaymentProjectButton">Save</button>
            </div>
        </div>
    </div>
</div>
