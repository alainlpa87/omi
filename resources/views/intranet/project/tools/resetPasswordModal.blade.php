<div id="resetPasswordModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">RESTORE PASSWORD</h4>
            </div>
            <div class="modal-body" style="padding-bottom: 40px;">
                <div class="col-md-12 col-md-offset-2">
                    <h3>
                        <span>New Password Created.</span>
                    </h3>
                </div>
                <h4>Send by</h4>
                <div class="col-md-6">
                    <input type="checkbox" class="agree" id="checkEmailPass"><label>  by Email to <span id="email_to_pass"></span></label>
                </div>
                <div class="col-md-6">
                    <input type="checkbox" class="agree" id="checkMessagePass"><label>  by Text Message to <span type="text" id="phone_to_pass"></span></label>
                </div>
                <input type="hidden" id="lead_to_pass">
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" id="resetPassSubmit">Restore</button>
            </div>
        </div>
    </div>
</div>
