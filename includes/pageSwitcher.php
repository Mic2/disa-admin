<?php       
    if(!isset($_GET['page'])) {
        include ('/views/statistics.php');
    }
    else {
        
    switch($_GET['page'])
    {
        case 'statistics':
            include ('/views/statistics.php');
            break;
        case 'edit-movie-tabel':
            include ('/views/editMovieTabel.php');
            break;
        case 'edit-ticket-tabel':
            include ('/views/ticketTabel.php');
            break;
        case 'edit-movie':
            include ('/views/editMovie.php');
            break;
        case 'edit-ticket':
            include ('/views/editTicket.php');
            break;
        case 'insert-movie':
            include ('/views/insertMovie.php');
            break;
        default:
            include('/views/validate.php');
    }
}
