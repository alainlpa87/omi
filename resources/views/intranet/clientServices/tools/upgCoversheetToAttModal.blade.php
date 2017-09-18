<div id="upgCoversheetModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog dialogFileAdminAccess">
        <div class="modal-content">
            <div class="modal-header bubble-legalA">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Upgrade Coversheet to Attorney</h4>
            </div>
            <div>
                <div class="container-upgCoversheet">
                    <div class="col-md-12 vendorBox" style="margin-top:15px;">
                        <div class="col-md-2">
                            <p><strong>Type :</strong></p>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="typeCoversheet" >
                        </div>
                    </div>
                    <div class="col-md-12 vendorBox">
                        <div class="col-md-2">
                            <p><strong>Received Date:</strong></p>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="upgRcvdDate" id="upgRcvdDate" value="" class="pickDate">
                        </div>
                    </div>
                    <div class="col-md-12 vendorBox">
                        <div class="col-md-2">
                            <p><strong>Upgrade Due Date:</strong></p>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" name="upgDueDate" id="upgDueDate" value="11-23-2016" class="pickDate">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button id="sendUpgCoversheet" class="btn btn-primary" aria-hidden="true">Send</button>
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
</div>
