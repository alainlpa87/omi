<div id="sendTextModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content col-md-offset-2">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalFinal">SEND MSG</h4>
            </div>
            <div class="modal-body">
                <div class="slimScrollDiv">
                    <div class="scroller" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                        <div class="row" style="margin-top: 0px !important;">
                            <div class="col-md-12">
                                <h4>Select Message:</h4>
                                <div class="col-md-12">
                                    <select class="form-control" id="messages" name="messages">
                                        <option value="0">Select message....</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>To:</h4>
                                <p>
                                    <input id="msg_number" type="text" class="col-md-6 form-control">
                                </p>
                            </div>
                            <div class="col-md-12">
                                <h4>Message: <span style="font-size: 75%;">Use or modify a template, or write your own.</span></h4>
                                <p>
                                    <textarea id="msg_body" name="msg_body"  type="text" class="col-md-12 form-control" style="min-height: 140px;"></textarea>
                                    <span style="float:right" id="spanCountCaract">0 of 160 caracters</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn green btn-primary" id="modalSendMSG" data-dismiss="modal">Send Message</button>
            </div>
        </div>
    </div>
</div>
