$("#addShowTimeToForm").on("click", function (e) {
    e.preventDefault();

    // Appending to bottom of wrapper div everytime user presses the add button
    $("#multiShowTimeInputWrapper").append('<span class="input-remove-group"><input type="datetime" name="showtime[]" class="form-control" placeholder="YYYY-MM-DD HH:MI:SS" /><input id="showtimeTheaterInput" type="number" name="theater[]" class="form-control theaterNumberInput" placeholder="1-10"/><img src="/Ressources/images/Delete-128.png" /></span>');

    // removing on user click red cross - this is for the items that document dont know about before they are created.
    $("#multiShowTimeInputWrapper span img").on("click", function () {
        $(this).parent().remove();
        
        var showTimeId = $(this).parent().data('showtime-id');
        
        RemoveShowTimeById(showTimeId);       
    });
});



// removing on user click red cross - This is for the elements the browser do now about.
$("#multiShowTimeInputWrapper span img").on("click", function () {
    $(this).parent().remove();
    
    var showTimeId = $(this).parent().data('showtime-id');
    
    RemoveShowTimeById(showTimeId);
});

$('#InsertMovieButton').on('click', function(e) {
    e.preventDefault();

    var url = "/Ressources/requestHandler.php";
    
    // Performing the post
    var formElement = document.querySelector("#insertMovieForm");
    var formData = new FormData(formElement);
    var request = new XMLHttpRequest();
    request.open("POST", url);
    formData.append("controller", "insertMovie");
    formData.append("methodName", "InsertMovieToDB");
    request.send(formData);
    
    $('#post-response').append('<div class="alert alert-success"><p>Movie created!</p></div>');
    
});

function RemoveShowTimeById(showTimeId) {
    var data = {controller: 'editMovie', methodName: 'RemoveShowTimeById', showTimeId:showTimeId};

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


