<div id="ndaActionsModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">NDA ACTIONS</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4">ACTIONS</label>
                    <div style="display: inline;">
                        <select id="ndaActionsSelect">
                            <option value="0">Select Action</option>
                            <option value="client_sign">Client signs NDA</option>
                            <option value="client_not_sign">Client does not sign NDA</option>
                            <option value="client_agree">Client agree without NDA</option>
                            <option value="client_not_agree">Client does not agree without NDA</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">MANUFACTURERS</label>
                    <div style="display: inline;">
                        <select id="manufacturersForActionSelect">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">FILES</label>
                    <div style="display: inline;">
                        <button class="btn btn-primary" id="uploadNDAFile">Upload File</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                {{--<button class="btn green btn-primary" id="" ></button>--}}
            </div>
        </div>
    </div>
</div>
