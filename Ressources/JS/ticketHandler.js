
$('.removeTicketForm').on('submit', function(e) {
    e.preventDefault();
    if (confirm('Are you sure you want to delete this item from the database completly?')) {
        RemoveTicketId($(this).children().data('ticket-id'));
        $(this).parent().parent().remove();
    }
});

function RemoveTicketId(ticketId) {
    
    var data = {controller: 'TicketController', methodName: 'RemoveTicketById', ticketId:ticketId};

    // Lets make the controller delete the record in db
    $.ajax({
        url: "/Ressources/requestHandler.php",
        type: 'POST',
        data: data,
        dataType: 'application/json',
        format: 'json',
        success: function (data) {
            console.log(data);
        }
    });
}


