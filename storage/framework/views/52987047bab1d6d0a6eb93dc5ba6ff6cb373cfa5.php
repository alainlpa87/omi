<div id="adminReassignLeadWithSubModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">REASSIGN SUBMISSIONS</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="formReassignAllSubs" class="form-horizontal">
                    <div class="form-group">
                        <p id="reassignMessage" class="col-md-offset-2">You need to reassign 20 submission from this consultant.</p>
                    </div>
                    <div class="form-group reassignAdminCombo" ></div>
                    <button class="btn col-md-offset-5" id="addConsultantFromCombo">ADD</button>
                    <div class="form-group">
                        <label class="control-label col-md-2">CONSULTANTS</label>
                        <div class="col-md-9 col-md-offset-2">
                            <textarea rows="5" class="form-control" id="consultantList" name="CONSULTANTS" readonly></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Do it later</button>
                <button class="btn green btn-primary" id="reassignAllSubmit">Do it now</button>
            </div>
        </div>
    </div>
</div>
