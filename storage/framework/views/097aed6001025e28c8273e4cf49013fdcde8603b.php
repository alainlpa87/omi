<div id="ilcCodesModal" class="modal fade in" role="dialog" aria-hidden="false" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">SIC & NAICS DESCRIPTION</h4>
            </div>
            <div class="modal-body">
                <div>
                    <h5>2016 SIC DESCRIPTION</h5>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">Title</label>
                    <div class="col-md-9">
                        <textarea rows="1" class="form-control" id="title1" name="TITLE1"></textarea>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">Description</label>
                    <div class="col-md-9">
                        <textarea rows="3" class="form-control" id="description1" name="DESCRIPTION1"></textarea>
                    </div>
                </div>
                <div class="row" style="text-align: center;margin-top: 10px !important;">
                    <button class="btn btn-success" id="addDesc11"><i class="fa fa-plus "></i></button>
                    <button class="btn btn-danger" id="removeDesc11"><i class="fa fa-minus"></i></button>
                </div>
                <div class="col-md-12" id="desc11-container" style="margin-top: 10px !important;">
                    <div class="desc11">
                        <div class="col-md-offset-2 col-md-1">
                            <label class="control-label">&bull;</label>
                        </div>
                        <div class="col-md-8">
                            <textarea rows="1" class="form-control description11" ></textarea>
                        </div>
                    </div>
                </div>
                <div>
                    <h5>2016 NAICS DESCRIPTION</h5>
                </div>
                <div  class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">Title</label>
                    <div class="col-md-9">
                        <textarea rows="1" class="form-control" id="title2" name="TITLE2"></textarea>
                    </div>
                </div>
                <div  class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">Description</label>
                    <div class="col-md-9">
                        <textarea rows="3" class="form-control" id="description2" name="DESCRIPTION2"></textarea>
                    </div>
                </div>
                <div class="row" style="text-align: center;margin-top: 10px !important;">
                    <button class="btn btn-success" id="addDesc22"><i class="fa fa-plus "></i></button>
                    <button class="btn btn-danger" id="removeDesc22"><i class="fa fa-minus"></i></button>
                </div>
                <div class="row" id="desc22-container" style="margin-top: 10px !important;">
                    <div class="desc22">
                        <div class="col-md-offset-2 col-md-1">
                            <label class="control-label">&bull;</label>
                        </div>
                        <div class="col-md-8">
                            <textarea rows="1" class="form-control description22"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn btn-success" id="submitbtnIlcCodes">Send</button>
            </div>
        </div>
    </div>
</div>
