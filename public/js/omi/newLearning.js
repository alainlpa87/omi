$(document).ready(function(e) {});


//learning center
$(document).on('click','.learningTopic',function(){
    var title=$(this).data('title');
    ajaxCallback({'TITLE':title},'../learningArt','learningBack');

});

function learningBack(article){
    if(article != '-1'){
        $('#articleTitle').html(article.title);
        $('#artContent').html(article.content);

        //changing url
        var urlArray = location.href.split('/');
        var lastSection = urlArray[urlArray.length-2]
        var title = article.title.replace(new RegExp(' ', 'g'), '-');
        history.pushState(null, null, '/'+urlArray[3]+'/public/learn/'+title);

        //title
        var title = "Patent Services USA Learning Center - Articles & Resources for Inventors";
        if (article.titlehtml != '') {
            title = article.titlehtml;
        }
        document.title = title;

        //description
        var description = "The Patent Services USA learning center is a great resource of potential & established inventors to learn about patents, the patenting process, licensing, invention protection &  more.";
        if (article.descriptionhtml != '') {
            description = article.descriptionhtml;
        }
        $('meta[name="description"]').attr("content", description);

    }else{
        toastr.error('An error has happened, please try later.','Error');
    }
}