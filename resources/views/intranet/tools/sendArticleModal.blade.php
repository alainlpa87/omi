<div id="sendArticleModal" class="modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Send Article Link</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <h3>
                        <span id="article_to_link"></span>
                        <a href="" class="seeLinkArticle" target="_blank">see Article</a>
                    </h3>
                </div>
                <h4>Send by</h4>
                <div class="col-md-6">
                    <input type="checkbox" class="agree" id="checkEmailArticle"><label> by Email to <span id="email_to_link"></span></label>
                </div>
                <div class="col-md-6">
                    <input type="checkbox" class="agree" id="checkMessageArticle"><label>by Text Message to <span type="text" id="phone_to_link"></span></label>
                </div>
                <input type="hidden" id="lead_to_link" data-article="">
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn green btn-primary" id="sendArticleLink" data-dismiss="modal">Send Link</button>
            </div>
        </div>
    </div>
</div>
