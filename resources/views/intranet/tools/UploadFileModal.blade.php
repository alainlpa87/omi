<div id="uploadFileModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog dialogUploadFile">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="headUploadFM">Drag and Drop or Select Add Files to Upload Files</h4>
            </div>
            <div class="modal-body uploadFile-body-scroll">
                {{--aki empieza el upload file html--}}
                <div id="actions" class="row">

                    <div class="col-lg-7">
                        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-success fileinput-button dz-clickable">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add files...</span>
        </span>
                        <button type="submit" class="btn btn-primary start aux-class-att">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start upload</span>
                        </button>
                        {{--<button type="reset" class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel upload</span>
                        </button>--}}
                    </div>

                    <div class="col-lg-5">
                        <!-- The global file processing state -->
                        <span class="fileupload-process">
                          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
                          </div>
                        </span>
                    </div>

                </div>
                <div class="table table-striped" class="files" id="previews">

                    <div id="template" class="file-row">
                        <!-- This is used as the file preview template -->
                        <div>
                            <span class="preview"><img data-dz-thumbnail /></span>
                        </div>
                        <div>
                            <p class="name" data-dz-name></p>
                            <strong class="error text-danger" data-dz-errormessage></strong>
                        </div>
                        <div>
                            <p class="size" data-dz-size></p>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary start">
                                <i class="glyphicon glyphicon-upload"></i>
                                <span>Start</span>
                            </button>
                            <button data-dz-remove class="btn btn-warning cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>Cancel</span>
                            </button>
                            {{--<button data-dz-remove class="btn btn-danger delete">--}}
                                {{--<i class="glyphicon glyphicon-trash"></i>--}}
                                {{--<span>Delete</span>--}}
                            {{--</button>--}}
                        </div>
                    </div>

                </div>
                {{--aki termina el upload file html--}}
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" id="closeUploadFile" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
</div>