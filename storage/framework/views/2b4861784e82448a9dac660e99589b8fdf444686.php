<div id="changePasswordModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="changePasswordForm" class="form-horizontal">
                    <div class="form-group col-md-12">
                        <label>Old Password</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control cleanBorder" id="oldPassword" name="password" value="" />
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>New Password</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control cleanBorder" id="password" name="password" value="" />
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Confirm New Password</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control cleanBorder" id="confirmPassword" name="confirmPassword" value="" />
                        </div>
                    </div>
                </form>
                <p>Password should by at least 7 characters.</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" id="submitbtnChangePassword">Save</button>
            </div>
        </div>
    </div>
</div>
