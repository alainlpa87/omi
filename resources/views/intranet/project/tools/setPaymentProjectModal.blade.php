<div id="setPaymentProjectModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Select Payment Settings</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3">CONTRACT TYPE:</label>
                    <select id="setPaymentContractType">
                        <option value="IMG">IMG</option>
                        <option value="IIG">IIG</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Amount:</label>
                    <input id="setPaymentPrice" class="editableval" type="text" placeholder="Total Price" class="col-md-6 form-control priceContract"  data-a-sep="," data-a-dec="." data-v-max="9999.00" data-v-min="0.00">
                    <span id="setPaymentPriceSpan" style="font-style: italic;">Minimum price: $449.00</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" id="setPaymentProjectButton">Save</button>
            </div>
        </div>
    </div>
</div>
