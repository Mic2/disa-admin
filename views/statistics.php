<?php
session_start();
if(!isset($_SESSION['membership'])) {
    require_once('ldap.php');
    if(empty($_SESSION['membership'])) {
    	header('Location: 403.php');
    }
}
?>
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/StatisticsController.php');

$sc = new StatisticsController();

//echo '<pre>';
//print_r();
//echo '</pre>';
?>
<h1>Edit movies tabel</h1>
<table class="table table-striped table-bordered">
    <thead>
    <th>Movie name:</th>
    <th>showtime:</th>
    <th>Reservation on specifik showtime:</th>
    <th>Total reservations on movie:</th>
    </thead>
    <tbody>
        <?php foreach($sc->GetAllMovieShowTimesTicketReservations() as $movieName => $showTime) { ?>
        <tr>
            <td><?php echo $movieName; ?></td>
            <td><?php foreach (array_unique($showTime) as $time) { echo $time . "<br>"; } ?></td>
            <td><?php 
            foreach ($sc->GetShowTimeReservationCount() as $index => $movieTitle) 
            { 
                if($index == $movieName) {

                    foreach ($movieTitle as $value) {

                       echo $value . '<br>';  
                    }
                }
                
            } 
            
            ?>
            </td>
            <td><?php echo count($showTime); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
