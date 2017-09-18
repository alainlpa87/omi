<div id="addPpaPlanModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Add Patent Protection Agreement Plan:</h4>
            </div>
            <div class="modal-body">
                <div  class="container">
                    <div class="form-group">
                        <?php if($contract!=null): ?>
                            <form action="<?php echo e(url("launch/addPlan")); ?>"  name="formAddPlan" id="formAddPlan" onsubmit="return checkFormAddPlan();" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="contractId" value="<?php echo e($contract->id); ?>">
                                <select class="col-md-4" id="selectPlan" name="selectPlan">
                                    <option value="0">--SELECT PLAN--</option>
                                    <?php if($contract->type=="PPA" && ($contract->ppapricesplan_id == 1 || $contract->ppapricesplan_id == 2)): ?>
                                        <option value="1">PLAN 1 - UNITED STATES UTILITY PATENT APPLICATION PROGRAM $11,949.00</option>
                                    <?php else: ?>
                                        <option value="1">PLAN 1 - UNITED STATES UTILITY PATENT APPLICATION PROGRAM $10,949.00</option>
                                    <?php endif; ?>
                                    <?php if($project->utility == "U_D"): ?>
                                        <option value="2">PLAN 2 - UNITED STATES DESIGN PATENT APPLICATION PROGRAM $5,949.00</option>
                                        <option value="3">PLAN 3 - UNITED STATES TRADEMARK APPLICATION PROGRAM $1,495.00</option>
                                        <option value="4">PLAN 4 - UNITED STATES COPYRIGHT APPLICATION PROGRAM $995.00</option>
                                        <option value="5">PLAN 5 - EUROPEAN UNION DESIGN PATENT APPLICATION PROGRAM $7,949.00</option>
                                        <option value="6">PLAN 6 - PATENT COOPERATION TREATY (HEREINAFTER "PCT") PROGRAM $8,949.00</option>
                                    <?php else: ?>
                                        <option value="2">PLAN 2 - UNITED STATES TRADEMARK APPLICATION PROGRAM $1,495.00</option>
                                        <option value="3">PLAN 3 - UNITED STATES COPYRIGHT APPLICATION PROGRAM $995.00</option>
                                        <option value="4">PLAN 4 - PATENT COOPERATION TREATY (HEREINAFTER "PCT") PROGRAM $8,949.00</option>
                                    <?php endif; ?>
                                </select>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" onclick="$('#formAddPlan').submit();">Make Payment</button>
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div>
    </div>
</div>
