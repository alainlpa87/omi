<div id="emailCSModal" class="modal fade in" role="dialog" aria-hidden="false" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="emailModalHeader"></h4>
            </div>
            <div class="modal-body">
                <div class="row hidden" style="margin-top: 10px !important;" id="typeEmailModal">
                    <label class="control-label col-md-2" style="text-align: left">TYPE</label>
                    <div class="col-md-5" id="chooseType">
                        <label class="control-label">UT</label>
                        <input type="checkbox" name="revisionUT" id="revisionUT" data-val="UT">
                        <label class="control-label">DESIGN</label>
                        <input type="checkbox" name="revisionDESIGN" id="revisionDESIGN" data-val="DESIGN">
                        <label class="control-label">PROV</label>
                        <input type="checkbox" name="revisionPROV" id="revisionPROV" data-val="PROV">
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" id="bodyTag" style="text-align: left">NOTES</label>
                    <div class="col-md-9 input-group">
                     <textarea rows="10" class="form-control cleanBorder" id="revisionNotes" name="revisionNotes"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <i class="fa fa-paperclip fa-lg pull-left attachFileRevision" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Attach Files"></i>
                <label class="pull-left attachFileRevision" style="cursor: pointer;">Add Attachment</label>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn btn-success" id="sendRevision">Send</button>
                <br>
                <div id="attachments-container-revision" class="col-md-12"></div>
            </div>
        </div>
    </div>
</div>
