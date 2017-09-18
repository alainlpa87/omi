
<?php $__env->startSection('title','Patent Services USA'); ?>
<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/common.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/launch.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/bootstrap/bootstrap-datetimepicker.css')); ?>" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php if(setlocale(LC_MONETARY, 'en_US.UTF-8')): ?><?php endif; ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 panel-group" id="accordionTickets">
                <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12 col-sm-12 col-xs-12" id="ticketContainer_<?php echo e($ticket->id); ?>">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordionTickest" href="#collapseTicket_<?php echo e($ticket->id); ?>">
                                <i>
                                    <h4 class="panel-title col-md-6" style="border: solid #000000 1px;"><span style="color: red">&bull;</span><?php echo e($ticket->name."  ------ ".date('m/d/Y',strtotime($ticket->created_at))); ?>:</h4>
                                </i>
                            </a>
                        </div>
                        <div id="collapseTicket_<?php echo e($ticket->id); ?>" class="collapse col-md-12">
                            <div id="containerReplies_<?php echo e($ticket->id); ?>">
                            <?php $__currentLoopData = $replies[$ticket->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-8 col-sm-12 col-xs-12">
                                    <b class="col-md-4"><?php echo e(ucwords($reply->author)); ?> : </b>
                                    <p class="pSmall col-md-8"><?php echo e($reply->message); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-1"><i class="fa fa-reply writeReply" data-tid="<?php echo e($ticket->id); ?>" style="color: lightskyblue;cursor: pointer !important;"></i></div>
                                <div class="col-md-3 col-md-offset-5"><button class="btn btn-danger closeTicket" id="closeTicket" data-tid="<?php echo e($ticket->id); ?>">Close Ticket</button></div>
                                <div class="col-md-8 hidden" id="writeRticket_<?php echo e($ticket->id); ?>" style="margin-top: 10px !important;">
                                    <textarea rows="7" cols="30" name="replyText" id="replyText_<?php echo e($ticket->id); ?>"  class="form-control"></textarea>
                                </div>
                            </div>
                            <div div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px !important;">
                                <div class="col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
                                    <button class="btn btn-danger cancelReplyTicket hidden" id="cancelReplyTicket_<?php echo e($ticket->id); ?>" data-tid="<?php echo e($ticket->id); ?>">Cancel</button>
                                    <button class="btn btn-success addReplyTicket pull-right hidden" id="addReplyTicket_<?php echo e($ticket->id); ?>" data-tid="<?php echo e($ticket->id); ?>">Reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="col-md-12 panel-group" style="margin-top: 30px !important;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" id="openTicket">OPEN TICKET</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('omi.layout.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>