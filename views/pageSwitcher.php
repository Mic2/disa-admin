<?php       
    $page = $_GET['page']; 
    switch($page)
    {
        case 'statistics':
            include ('statistics.php');
            break;
        case 'edit-movie-tabel':
            include ('editMovieTabel.php');
            break;
        case 'edit-ticket-tabel':
            include ('ticketTabel.php');
            break;
        case 'edit-movie':
            include ('editMovie.php');
            break;
        case 'edit-ticket':
            include ('editTicket.php');
            break;
        case 'insert-movie':
            include ('insertMovie.php');
            break;
        default:
            include('statistics.php');
    }

