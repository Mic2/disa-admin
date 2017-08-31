<?php       
    if(!isset($_GET['page'])) {
        include ('/views/frontpage.php');
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
        case 'edit-movie':
            include ('/views/editMovie.php');
            break;
        case 'insert-movie':
            include ('/views/insertMovie.php');
            break;
        default:
            include('/views/validate.php');
    }
}
