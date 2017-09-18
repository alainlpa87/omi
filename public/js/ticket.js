/**
 * Created by jllopiz on 1/18/2017.
 */
$(document).ready(function(e){
    //$('#loadingModal').modal('hide');
    $('#loadingModal').removeClass('show in');
    $('#loadingModal').addClass('fade in');
});

$(document).on('click','.showTickets',function(){
    var pid = $(this).data('pid');
    ajaxCallback({'PID':pid},'showTicketsFromProject','showTicketDetailsCallBack')
    $('#loadingModal').modal('show');
});

//paint projects from Find Sub
function showTicketDetailsCallBack(tickets)
{
    if(tickets.length>0)
    {
        $('#csTickets').html('');
        $('#prodTickets').html('');
        for(var i =0;i<tickets.length;i++)
        {
            var ticket = $(tickets[i][1]);
            if(tickets[i][0] == 'cs'){
                $('#csTickets').append(ticket);
                $('#csHeader').removeClass('hidden');
            }
            else if(tickets[i][0] == 'production'){
                $('#prodTickets').append(ticket);
                $('#prodHeader').removeClass('hidden');
            }
        }
        $('#loadingModal').modal('hide');
    }
    else
        toastr.error('Sorry no matches',"No Matches");
}

$(document).on('click','.writeReply',function(){
    var tid =$(this).data('tid');
    $('#writeRticket_'+tid).removeClass('hidden');
    $('#cancelReplyTicket_'+tid).removeClass('hidden');
    $('#addReplyTicket_'+tid).removeClass('hidden');
});

$(document).on('click','.cancelReplyTicket',function(){
    var tid =$(this).data('tid');
    $('#writeRticket_'+tid).addClass('hidden');
    $('#cancelReplyTicket_'+tid).addClass('hidden');
    $('#addReplyTicket_'+tid).addClass('hidden');
});

$(document).on('click','.addReplyTicket',function(){
    var tid =$(this).data('tid');
    var message = $('#replyText_'+tid).val();
    ajaxCallback({'TICKETID':tid, 'MESSAGE':message, 'AUTHOR':'Client Services'},'createReplyPSU','createReplyCallBack');
});

function createReplyCallBack(result){
    var tid = result[0].ticket_id;
    var html = '<div class="col-md-8 col-sm-12 col-xs-12">'+
        '<b class="col-md-4">'+ result[0].author+' : </b>'+
        '<p class="pSmall col-md-8">'+ result[0].message+'</p>'+
        '</div>';
    $('#containerReplies_'+tid).append(html);
    $('#replyText_'+tid).val('');
    toastr.success('Reply post!',"Success.");
}

$(document).on('click','#goHome',function(){
    window.location.href = '../public';
});

$(document).on('click','.closeTicket',function(){
    var tid = $(this).data('tid');
    ajaxCallback({'TID':tid},'closeTicketPSU','closeTicketCallback')
});

function closeTicketCallback(result){
    if(result == -1)
        toastr.error('An error has happened, please try later.','Error');
    else{
        $('#ticketContainer_'+result).hide();
        toastr.success('Ticket Closed!','Success');
    }
}
