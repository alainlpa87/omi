<div id="contractActionsModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Contract Actions</h4>
            </div>
            <div class="modal-body">
                <div class="row noTop">
                    <ul class="nav nav-tabs" role="contractActionsTab">
                        <li id="wp_li"><a href="#wp_tab" data-toggle="tab" role="tab"> {{WELCOME_PACKAGE}} </a></li>
                        <li id="up_li"><a href="#up_tab" data-toggle="tab" role="tab"> {{UPGRADE}} </a></li>
                        <li id="img_li"><a href="#img_tab" data-toggle="tab" role="tab"> IMG </a></li>
                        <li id="iig_li" class="active"><a href="#iig_tab" data-toggle="tab" role="tab"> IIG </a></li>
                    </ul>
                    <form id="formContractAction">
                        <div class="col-md-6">
                            <label>Client Name:</label>
                            <p><input id="contract_name" name="contract_name" type="text" class="col-md-12 form-control inputContractAction"></p>
                            <label>Email:</label>
                            <p><input id="contract_email" name="contract_email" type="text" class="col-md-12 form-control inputContractAction"></p>
                            <label>Phone:</label>
                            <p><input id="contract_phone" name="contract_phone" type="text" class="col-md-12 form-control inputContractAction"></p>
                            <label>Phone 2:</label>
                            <p><input id="contract_phone2" name="contract_phone2" type="text" class="col-md-12 form-control inputContractAction"></p>
                            <label>Invention Name:</label>
                            <p><input id="contract_invention" name="contract_invention" type="text" class="col-md-12 form-control inputContractAction"></p>
                            <label>Consultant:</label>
                            <p><input id="contract_consultant" type="text" class="col-md-12 form-control inputContractAction" disabled></p>
                        </div>
                        <div class="col-md-6">
                            <label>Address:</label>
                            <p><input id="contract_address" name="contract_address"  type="text" class="col-md-12 form-control save_data inputContractAction"></p>
                            <label>State:</label>
                            <p><input id="contract_state" name="contract_state" type="text" class="col-md-12 form-control inputContractAction"></p>
                            <label>City:</label>
                            <p><input id="contract_city" name="contract_city" type="text" class="col-md-12 form-control inputContractAction"></p>
                            <label>Zip:</label>
                            <p><input id="contract_zip" name="contract_zip" type="text" class="col-md-12 form-control inputContractAction"></p>
                            <label>Date:</label>
                            <p><input id="contract_date" type="text" class="col-md-12 form-control inputContractAction" disabled></p>
                            <p>&nbsp;</p>

                        </div>
                    </form>
                    <div class="col-md-12" style="padding: 15px;">
                        <span id="allowIigUpgradeSpan" style="display: none;"><label>UPGRADE IIG PACKAGE: &nbsp;&nbsp;</label><input type="checkbox" id="allowIigUpgrade"></span>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-danger btnUpdateContractActions" disabled>Update</button>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane" id="wp_tab" role="tabpanel">
                            <div class="col-md-3 boxButtonContracts">
                                <button class="btn btn-primary reviewWP btnContract">Review WP</button>
                            </div>
                            <div class="col-md-2 boxButtonContracts">
                                <button class="btn btn-primary emailWP btnContract" data-send="0">Web WP</button>
                            </div>
                            <div class="col-md-2 boxButtonContracts">
                                <button class="btn btn-primary emailWP btnContract" data-send="1">Email WP</button>
                            </div>
                            <div class="col-md-3 boxButtonContracts">
                                <button class="btn btn-primary requestWP btnContract">Request Mail WP</button>
                            </div>
                        </div>
                        <div class="tab-pane" id="up_tab" role="tabpanel">
                            <div class="col-md-6 padding15 col-md-offset-6">
                                <label>Final Price:</label>
                                <input id="contract_upgrade_price" readonly type="text" placeholder="Total Price" class="col-md-6 form-control priceContract"  data-a-sep="," data-a-dec="." data-v-max="9999.00" data-v-min="0.00">
                            </div>
                            <div class="col-md-3 boxButtonContracts">
                                <button class="btn btn-primary reviewUp btnContract">Review IGUP</button>
                            </div>
                            <div class="col-md-2 boxButtonContracts">
                                <button class="btn btn-primary emailUp btnContract"  data-send="0">Web IGUP</button>
                            </div>
                            <div class="col-md-2 boxButtonContracts">
                                <button class="btn btn-primary emailUp btnContract"  data-send="1">Email IGUP</button>
                            </div>
                            <div class="col-md-3 boxButtonContracts">
                                <button class="btn btn-primary requestUp btnContract">Request Mail IGUP</button>
                            </div>
                        </div>
                        <div class="tab-pane" id="img_tab" role="tabpanel">
                            <div class="col-md-6 padding15 col-md-offset-6">
                                <label>Final Price:</label>
                                <input id="contract_img_price" type="text" value="449.00" readonly placeholder="Total Price" class="col-md-6 form-control priceContract"  data-a-sep="," data-a-dec="." data-v-max="9999.00" data-v-min="0.00">
                                <span id="minimumPriceSpan" style="font-style: italic;">Price: $449.00</span>
                                {{--cambiar--}}
                            </div>
                            <div class="col-md-3 boxButtonContracts">
                                <button class="btn btn-primary reviewIMG btnContract">Review IMG</button>
                            </div>
                            <div class="col-md-2 boxButtonContracts">
                                <button class="btn btn-primary emailIMG btnContract"  data-send="0">Web IMG</button>
                            </div>
                            <div class="col-md-2 boxButtonContracts">
                                <button class="btn btn-primary emailIMG btnContract"  data-send="1">Email IMG</button>
                            </div>
                            <div class="col-md-3 boxButtonContracts">
                                <button class="btn btn-primary requestIMG btnContract">Request Mail IMG</button>
                            </div>
                        </div>
                        <div class="tab-pane active" id="iig_tab" role="tabpanel">
                            <div class="col-md-6 padding15 col-md-offset-6">
                                <label>Final Price:</label>
                                <input id="contract_iig_price" type="text" placeholder="Total Price" readonly value="879.00" class="col-md-6 form-control priceContract"  data-a-sep="," data-a-dec="." data-v-max="9999.00" data-v-min="0.00">
                                <span id="minimumPriceSpan" style="font-style: italic;">Price: $879.00</span>
                            </div>
                            <div class="col-md-3 boxButtonContracts">
                                <button class="btn btn-primary reviewIIG btnContract">Review IIG</button>
                            </div>
                            <div class="col-md-2 boxButtonContracts">
                                <button class="btn btn-primary emailIIG btnContract" data-send="0">Web IIG</button>
                            </div>
                            <div class="col-md-2 boxButtonContracts">
                                <button class="btn btn-primary emailIIG btnContract" data-send="1">Email IIG</button>
                            </div>
                            <div class="col-md-3 boxButtonContracts">
                                <button class="btn btn-primary requestIIG btnContract">Request Mail IIG</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
</div>