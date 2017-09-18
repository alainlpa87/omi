<div id="createManufacturerModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Manufacturer</h4>
            </div>
            <div class="modal-body">
                <div id="formIlcNote" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-9">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Manufacturer Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                    <input type="text" class="form-control cleanBorder" id="manufacturerName" name="manufacturerName" />
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Manufacturer Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="text" class="form-control cleanBorder" id="manufacturerEmail" name="manufacturerEmail" />
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Manufacturer Phone</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control cleanBorder" id="manufacturerPhone" name="manufacturerPhone" />
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Contact First Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                    <input type="text" class="form-control cleanBorder" id="manufacturerFName" name="manufacturerFName" />
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Contact Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                    <input type="text" class="form-control cleanBorder" id="manufacturerLName" name="manufacturerLName" />
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Industry</label>
                                <div class="input-group">
                                    <select id="industrySelect">
                                        <option value="-1" selected>Select Industry</option>
                                        <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($industry->id); ?>"><?php echo e($industry->type); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <div class="input-group">
                                    <input type="checkbox" id="nda" name="nda"><span>WEBSITE NDA SIGN</span>
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <div class="input-group">
                                    <input type="checkbox" id="ndaSign" name="ndaSign"><span>ILC NDA SIGN</span>
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <div class="input-group">
                                    <input type="checkbox" id="manfNda" name="manfNda"><span>MANF NDA</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-6 col-sm-4 col-xs-12">
                                <div class="input-group">
                                    <input type="checkbox" id="cSignManfNda" name="cSignManfNda"><span>CLIENT SIGN MANF NDA</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-4 col-xs-12">
                                <div class="input-group">
                                    <input type="checkbox" id="manfNoNda" name="manfNoNda"><span>MANF WANT"S NO NDA AT ALL</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" id="btnSaveManufacturer" >Save Manufacturer</button>
            </div>
        </div>
    </div>
</div>
