<div id="adminActionModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Admin Action</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="adminActionForm" class="form-horizontal">
                    <div class="form-group filenoDivAdminAction">
                        <label class="control-label col-md-4">FILENO</label>
                        <div class="col-md-8">
                            <input id="filenoAdminAction" class="editableval" type="text" placeholder="FILENO">
                        </div>
                    </div>
                    <div class="form-group createSubAdminAction" hidden="hidden">
                        <label class="control-label col-md-4">IDEA NAME</label>
                        <div class="col-md-8">
                            <input id="ideaNameAdminAction" class="editableval" type="text" placeholder="IDEANAME">
                        </div>
                    </div>
                    <div class="form-group reassignAdminAction reassignAdminActionForms" hidden="hidden"></div>
                    <div class="form-group reassignAdminAll reassignAdminActionAllForms" hidden="hidden"></div>
                    <div class="form-group reassignAdminActionAllForms">
                        <label class="control-label col-md-4">RANDOM CONSULTANTS</label>
                        <div class="col-md-8">
                            <input type='checkbox' id='reassignAdminRandom'>
                        </div>
                    </div>
                    <div class="form-group reassignAdminActionAllForms">
                        <label class="control-label col-md-4">ALL THE LEADS</label>
                        <div class="col-md-8">
                            <input type='checkbox' id='reassignAdminAllLeads'>
                        </div>
                    </div>
                    <div class="form-group reassignAdminAmount reassignAdminActionAllForms">
                        <label class="control-label col-md-4">NUMBER OF LEADS</label>
                        <div class="col-md-8">
                            <input id="amountAdminAction" class="editableval" type="text" placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group reassignAdminActionForms" hidden="hidden">
                        <label class="control-label col-md-4">REASON</label>
                        <div class="col-md-8">
                            <textarea rows="5" class="form-control" id="reasonAdminAction" name="NOTE"></textarea>
                        </div>
                    </div>

                    <div class="form-group createLeadAdminAction" hidden="hidden">
                        <label class="control-label col-md-4">First Name</label>
                        <div class="col-md-8">
                            <input class="editableval" placeholder="First Name" id="fnameAction" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group createLeadAdminAction" hidden="hidden">
                        <label class="control-label col-md-4">Last Name</label>
                        <div class="col-md-8">
                            <input class="editableval" placeholder="Last Name" id="lnameAction" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group createLeadAdminAction" hidden="hidden">
                        <label class="control-label col-md-4">Email</label>
                        <div class="col-md-8">
                            <input class="editableval" placeholder="Email" id="emailAction" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group createLeadAdminAction" hidden="hidden">
                        <label class="control-label col-md-4">Phone</label>
                        <div class="col-md-8">
                            <input class="editableval" placeholder="Phone" id="phoneAction" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group createLeadAdminAction" hidden="hidden">
                        <label class="control-label col-md-4">Street</label>
                        <div class="col-md-8">
                            <input class="editableval" placeholder="Street" id="streetAction" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group createLeadAdminAction" hidden="hidden">
                        <label class="control-label col-md-4">Street2</label>
                        <div class="col-md-8">
                            <input class="editableval" placeholder="Street2" id="street2Action" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group createLeadAdminAction" hidden="hidden">
                        <label class="control-label col-md-4">City</label>
                        <div class="col-md-8">
                            <input class="editableval" placeholder="City" id="cityAction" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group createLeadAdminAction" hidden="hidden">
                        <label class="control-label col-md-4">State</label>
                        <div class="col-md-8">
                            <input class="editableval" placeholder="State" id="stateAction" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group createLeadAdminAction" hidden="hidden">
                        <label class="control-label col-md-4">Zip</label>
                        <div class="col-md-8">
                            <input class="editableval" placeholder="Zip" id="zipAction" type="text" value="" />
                        </div>
                    </div>
                    <div class="form-group consultantsComboAdminAction createLeadAdminAction" hidden="hidden"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn green btn-primary" id="submitAdminAction">Submit</button>
            </div>
        </div>
    </div>
</div>
