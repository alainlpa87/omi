<div id="setPPAProjectModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Set PPA Settings</h4>
            </div>
            <div class="modal-body" style="min-height: 110px;">

                <div class="form-group">
                    <label class="col-md-3">PPA STATUS:</label>
                    <select id="setPPAType">
                        <option value="">--SELECT OPTION--</option>
                        <option value="OLD">Existing Executed PPA</option>
                        <option value="NEW">New PPA</option>
                    </select>
                </div>

                <div class="form-group" id="setPPAUtilityTypeSelect" style="display: none">
                    <label class="col-md-3">PPA TYPE:</label>
                    <select id="setPPAUtilityType" disabled>
                        <option value="">--SELECT PPA TYPE--</option>
                        <option value="IMG">IMG</option>
                        <option value="Utility">Utility</option>
                        <option value="U_D">Utility & Design</option>
                    </select>
                </div>
                <div class="form-group" id="setPPATimeSelect" style="display: none">
                    <label class="col-md-3" >PPA TIME SENT:</label>
                    <select id="setPPATime">
                        <option value="">--SELECT PPA TIME--</option>
                        <option value="OLD">OLD (Before Jan 1,2016)</option>
                        <option value="NEW">NEW (After Jan 1,2016)</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                {{--<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>--}}
                <button class="btn green btn-primary" id="setPPAProjectButton">Save</button>
            </div>
        </div>
    </div>
</div>
