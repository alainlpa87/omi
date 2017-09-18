<div id="legalMaintenanceModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog dialogFileAdminAccess">
        <div class="modal-content">
            <div class="modal-header bubble-legalA">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">New Legal Maintenance Activity</h4>
            </div>
            <div>
                <div class="container-legal">
                    <div class="col-md-12 vendorBox" style="margin-top:15px;">
                        <div class="col-md-2">
                            <p><strong>Legal Record :</strong></p>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="legalR" >
                        </div>
                    </div>
                    <div class="col-md-12 vendorBox">
                        <div class="col-md-2">
                            <p><strong>Activity Type :</strong></p>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="actTypeSel" style="height: 100%;">
                                    <option value="NONE">
                                        --NONE--
                                    </option>
                                    <option value="Utility">
                                        Utility Patent
                                    </option>
                                    <option value="Trademark">
                                        Trademark
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 vendorBox">
                        <div class="col-md-2">
                            <p><strong>Activity :</strong></p>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="activitySel" id="activitySelect" style="height: 100%;" disabled>
                                    <option value="NONE">
                                        --NONE--
                                    </option>
                                    <option value="Office Action Final">
                                        Office Action Final
                                    </option>
                                    <option value="Office Action Non-Final">
                                        Office Action Non-Final
                                    </option>
                                    <option value=" Notice of Publication">
                                        Notice of Publication
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 vendorBox">
                        <div class="col-md-2">
                            <p><strong>Activity Due Date:</strong></p>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" name="actDueDate" class="pickDate activityDueDate">
                        </div>
                    </div>
                    <div class="col-md-12 vendorBox">
                        <div class="col-md-2">
                            <p><strong>Received Date:</strong></p>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="actRcvdDate" class="pickDate activityRcvdDate">
                        </div>
                    </div>
                    <div class="col-md-12 vendorBox">
                        <div class="col-md-2">
                            <p><strong>Description/Other Info:</strong></p>
                        </div>
                        <div class="form-group col-md-3">
                            <textarea rows="4" cols="50" class="descriptionInfo"></textarea>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button id="createLegalMaintenance" class="btn btn-primary" aria-hidden="true">Save</button>
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
</div>
