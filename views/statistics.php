<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/StatisticsController.php');

$sc = new StatisticsController();
?>
<h1>Edit movies tabel</h1>
<table class="table table-striped table-bordered">
    <thead>
    <th>Movie name:</th>
    <th>showtime:</th>
    <th>Tickets reserved:</th>
    </thead>
    <tbody>
        <?php foreach($sc->GetAllMovieShowTimesTicketReservations() as $movieName => $showTime) { ?>
        <tr>
            <td><?php echo $movieName; ?></td>
            <td><?php foreach (array_unique($showTime) as $time) { echo $time; } ?></td>
            <td><?php echo count($showTime); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>