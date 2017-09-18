<div id="patentStatusModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">PATENT STATUS</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4">Select Status</label>
                    <div style="display: inline;">
                        <select id="patentStatusSelect">
                            <option value="0">Select Status</option>
                            <option value="PENDING">Patent Pending</option>
                            <option value="GRANTED">Granted Patent</option>
                            <option value="ABANDONED">Abandoned</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="uploadPatentStatus" data-dismiss="modal" aria-hidden="true">Upload File</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div>
    </div>
</div>
