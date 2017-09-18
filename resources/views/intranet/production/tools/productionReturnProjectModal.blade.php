<div id="productionReturnProjectModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog dialogVendorFilesModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Return <span id="spanFilenoReturn"></span> </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3">Return to:</label>
                    <select id="selectVendorReturn" class="form-control">
                       <option id="attorney">Attorney</option>
                       <option id="writer">Writer</option>
                       <option id="designer">Designer</option>
                       <option id="university">University</option>
                        <option id="2D">2D</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Reason:</label>
                    <textarea id="textReason" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" id="returnFileBtn">Return</button>
            </div>
        </div>
    </div>
</div>
