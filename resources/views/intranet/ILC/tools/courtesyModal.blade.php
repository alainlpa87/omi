<div id="courtesyModal" class="modal fade in" role="dialog" aria-hidden="false" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Courtesy Email</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top: 10px !important;">
                    <div class="col-md-3">
                        <p>Industry:</p>
                        <select id="industrySelectedCourtesy" class="industrySelectedCourtesy" style="margin-top: 15px;">
                            <option value="-1" selected>Select Industry</option>
                            @foreach($industries as $industry)
                                <option value="{{$industry->id}}">{{$industry->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-7">
                        <div class="col-md-6"><p>Add Manufacturers</p></div>
                        <div class="col-md-6">
                            <select id="manufacturerSelectCourtesy" class="manufacturerSelectCourtesy" style="width: 100%;">
                                <option value="-1" selected>Select Manufacturer</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <p>Assigned Manufacturers:</p>
                        </div>
                        <div class="col-md-6">
                            <select size="4" id="manufacturersCourtesy" name="manufacturersCourtesy" style="width: 100%;">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="col-md-12">
                            <button class="btn btn-success" id="addManufacturerCourtesy"><i class="fa fa-plus "></i></button>
                        </div><br>
                        <div class="col-md-12" style="margin-top: 7px;">
                            <button class="btn btn-danger" id="removeManufacturerCourtesy"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn btn-success" data-dismiss="modal" id="sendCourtesy">Send</button>
            </div>
        </div>
    </div>
</div>
