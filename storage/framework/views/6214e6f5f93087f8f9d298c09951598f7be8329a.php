<div id="setStageAndDateModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content  col-md-8">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">MOVE TO DATE</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label id="labelStage" data-stage="">Stage:</label>
                    <label>Move to Date:</label>
                    <input class="dateMove form-control datepicker" id="dateMove_from_stage" name="DATE" readonly="readonly" size="30" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default moveAndChangeStage" data-action="0">Keep Same Date</button>
                <button class="btn btn-primary moveAndChangeStage" data-action="1">Move to Date</button>
            </div>
        </div>
    </div>
</div>
