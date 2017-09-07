<?php
session_start();
if(!isset($_SESSION['membership']) || $_SESSION['membership'] != "Cashier") {
    require_once('ldap.php');
    if(empty($_SESSION['membership']) || $_SESSION['membership'] != "Cashier") {
    	header('Location: 403.php');
    }
}
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/TicketController.php');

$tc = new TicketController();
// print_r($tc->GetAllTickets());
?>
<h1>Edit tickets tabel</h1>
<table class="table table-striped table-bordered">
    <thead>
    <th>Movie names</th>
    <th>Showtime</th>
    <th>Theater</th>
    <th>Line</th>
    <th>Seat</th>
    <th>Customer name</th>
    <th>Customer Phone</th>
    <th>Edit</th>
    <th>Delete</th>
    </thead>
    <tbody>
        <?php foreach($tc->GetAllTickets() as $ticket) { ?>
        <tr>
            <td><?php echo $ticket->GetMovieName(); ?></td>
            <td><?php echo $ticket->GetShowTime(); ?></td>
            <td><?php echo $ticket->GetTheaterNumber(); ?></td>
            <td><?php echo $ticket->GetLineNumber(); ?></td>
            <td><?php echo $ticket->GetSeatNumber(); ?></td>
            <td><?php echo $ticket->GetCustomerName(); ?></td>
            <td><?php echo $ticket->GetPhoneNumber(); ?>
            <td><form><button class="btn btn-warning" formaction="edit-ticket&ticketId=<?php echo  $ticket->GetTicketId(); ?>">Edit</button></form></td>
            <td><form class="removeTicketForm"><button class="btn btn-danger removeTicketFormButton" data-ticket-id="<?php echo $ticket->GetTicketId(); ?>">Delete</button></form></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
