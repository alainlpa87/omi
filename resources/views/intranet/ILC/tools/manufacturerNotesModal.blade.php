<div id="manufacturerNotesModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">NOTES</h4>
            </div>
            <div class="modal-body" style="min-height: 360px;">
                <div id="formManufacturerNote" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-2">Note</label>
                        <div class="col-md-9">
                            <textarea rows="5" class="form-control" id="noteManf" name="NOTE"></textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-12" id="divNotes" style="border: 1px solid cornflowerblue;overflow-y: scroll;min-height: 100px;max-height: 150px;">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" data-dismiss="modal" id="btnCreateNote" >Save Note</button>
            </div>
        </div>
    </div>
</div>
