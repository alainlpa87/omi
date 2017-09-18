<div class="col-md-12 col-xs-12 col-lg-12 topBar">
    <span id="spanSettings">
        <i class="fa fa-cog"></i>
    </span>
    <span id="spanUser" data-id="<?php echo e($consultant->id); ?>">
        <?php echo e($consultant->usr); ?><i class="fa fa-sign-out"></i>
    </span>
    <span id="spanPhone" data-phone="<?php echo e($consultant->did); ?>" data-phone2="<?php echo e($consultant->did2); ?>">
        <i class="fa fa-phone"></i><span id="userDID" data-fname="<?php echo e($consultant->fname); ?>" data-lname="<?php echo e($consultant->lname); ?>"><?php echo e($consultant->did); ?></span>
    </span>
    <span id="spanInbox">
        <i class="fa fa-envelope-o"></i>
        <span id="userInbox"><?php echo e($total_inbox); ?></span>
    </span>
</div>

