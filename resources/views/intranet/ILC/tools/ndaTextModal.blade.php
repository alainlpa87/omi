<div id="ndaTextModal" class="modal fade in" role="dialog" aria-hidden="false" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="titleNdaModal">ILC NDA TO MANF</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-3" style="text-align: left">MANUFACTURER: </label>
                    <div class="col-md-8 input-group">
                        <span class="input-group-addon"><i class="fa fa-tasks"></i></span>
                        <select id="selectNdaToManf" class="form-control">
                            <option value="0">Select Manufacturer</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-3" style="text-align: left">EMAIL</label>
                    <div class="col-md-8 input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email"  class="form-control cleanBorder" id="emailNDA" name="emailNDA"></textarea>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px !important;">
                    <label class="control-label col-md-2" style="text-align: left">TEXT</label>
                    <div class="col-md-9 input-group">
                     <textarea rows="10" class="form-control cleanBorder" id="textContent" name="textContent">Hi,&#13;&#10;Thank you for your interest.&#13;&#10;To better clarify, ILC is a licensing consultant company that is in possession of patented or patent-pending innovations. Our goal is to introduce you to an innovation that will encourage your company to retain licensing rights, as the first step to enabling production, distribution and selling of the product to an awaiting consumer base.&#13;&#10;To begin sharing those innovations with you, I have attached our NDA. ILC’s NDA does not obligate you to definitively license one of our products; however, after signing it we will be able to expedite the research and development on innovations specifically to your interest in confidentiality. Should you have any questions about the language of this contract, do not hesitate to ask for clarification.&#13;&#10;If by chance, your company possesses their own Non-Disclosure Agreement, please submit this to me so that we can discuss the conditions of that NDA with our client directly.</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <i class="fa fa-paperclip fa-lg hidden pull-left attachFile" style="cursor: pointer;" id="attachFile" data-toggle="tooltip" data-placement="bottom" title="Attach Files"></i>
                <label class="pull-left hidden attachFile" style="cursor: pointer;" id="labelAttach">Add Attachment</label>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn btn-success" id="sendNda">Send</button>
                <br>
                <div id="attachments-container" class="hidden col-md-12"></div>
            </div>
        </div>
    </div>
</div>
