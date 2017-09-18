<div id="shareNoteModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">SHARE NOTE</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3">SHARE WITH:</label>
                        <div class="col-md-9">
                            <p class="col-md-6">CONSULTANT <input type="checkbox" class="receiverNote" data-usr="consultant" data-currentusr="<?php echo e($consultant->usr); ?>" data-rol="<?php echo e($consultant->rol); ?>"></p>
                            <p class="col-md-6">CLIENT SERVICES <input type="checkbox" class="receiverNote" data-usr="clientservices" data-currentusr="<?php echo e($consultant->usr); ?>" data-rol="<?php echo e($consultant->rol); ?>"></p>
                            <p class="col-md-6">PRODUCTION <input type="checkbox" class="receiverNote" data-usr="production" data-currentusr="<?php echo e($consultant->usr); ?>" data-rol="<?php echo e($consultant->rol); ?>"></p>
                            <p class="col-md-6">ADMIN <input type="checkbox" class="receiverNote" data-usr="admin" data-currentusr="<?php echo e($consultant->usr); ?>" data-rol="<?php echo e($consultant->rol); ?>"></p>
                            <p class="col-md-6">ILC <input type="checkbox" class="receiverNote" data-usr="ilc" data-currentusr="<?php echo e($consultant->usr); ?>" data-rol="<?php echo e($consultant->rol); ?>"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Note</label>
                        <div class="col-md-9">
                            <textarea rows="5" class="form-control" id="noteToShare" name="NOTE"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" id="shareNote" data-id="0" data-dismiss="modal">Share Note</button>
            </div>
        </div>
    </div>
</div>
