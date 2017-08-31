$("#addShowTimeToForm").on("click", function (e) {
    e.preventDefault();

    // Appending to bottom of wrapper div everytime user presses the add button
    $("#multiShowTimeInputWrapper").append('<span class="input-remove-group"><input type="datetime" name="showtime[]" data-showtime-id="not-set" class="form-control showtimeInput" placeholder="YYYY-MM-DD HH:MI:SS" /><input type="number" name="theater[]" class="form-control theaterNumberInput" placeholder="1-10"/><img src="/Ressources/images/Delete-128.png" /></span>');

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
    console.log(showTimeId);
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
    formData.append("controller", "MovieController");
    formData.append("methodName", "InsertMovieToDB");
    request.send(formData);
    
    $('#post-response').append('<div class="alert alert-success"><p>Movie created!</p></div>');
    
});

$('#EditMovieButton').on('click', function(e) {
    e.preventDefault();
    console.log("Edit movie is pressed");
    var url = "/Ressources/requestHandler.php";
    var showTimeIds = [];
    var showTimeIdsElements = document.getElementsByClassName('showtimeInput');
    var movieToEditName = document.getElementById('movieNameInput');
    
    // Taking all of the showtime id even if they are not-set.
    $.each(showTimeIdsElements, function(index, value){
        showTimeIds.push($(value).data('showtime-id'));
    });
    console.log(showTimeIds);
    // Performing the post
    var formElement = document.querySelector("#editMovieForm");
    var formData = new FormData(formElement);
    var request = new XMLHttpRequest();
    request.open("POST", url);
    formData.append("controller", "MovieController");
    formData.append("methodName", "EditMovie");
    formData.append("movieToEdit", $(movieToEditName).data('movie-to-edit'));
    formData.append("showTimeIds", JSON.stringify(showTimeIds));
    request.send(formData);
    
    $('#post-response').append('<div class="alert alert-success"><p>Movie edited!</p></div>');
    
});

$('.removeMovieForm').on('submit', function(e) {
    e.preventDefault();
    if (confirm('Are you sure you want to delete this item from the database completly?')) {
        RemoveMovieByMovieName($(this).children().data('movie-name'));
        $(this).parent().parent().remove();
    }
});

function RemoveShowTimeById(showTimeId) {
    
    var data = {controller: 'MovieController', methodName: 'RemoveShowTimeById', showTimeId:showTimeId};

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

function RemoveMovieByMovieName(movieName) {
    
    var data = {controller: 'MovieController', methodName: 'RemoveMovie', movieName:movieName};

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


