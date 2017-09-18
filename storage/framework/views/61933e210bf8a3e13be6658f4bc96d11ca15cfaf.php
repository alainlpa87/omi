<div id="appointmentModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Create Appointment</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="formAppointment" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-2">Date</label>
                        <div class="col-md-8">
                            <input class="form-control datepicker" id="dateAppointment" name="DATE" readonly="readonly" size="30" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Note</label>
                        <div class="col-md-9">
                            <textarea rows="5" class="form-control" id="noteAppointment" name="NOTE"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="<?php echo e(route('loadAllAppointment')); ?>" target="_blank" style="float: right;margin-right: 20px;"> All Appointments</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn green btn-primary" id="submitbtnAppointment" data-dismiss="modal">Save Appointment</button>
            </div>
        </div>
    </div>
</div>
