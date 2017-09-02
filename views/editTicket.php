<?php
session_start();
if(!isset($_SESSION['membership'])) {
    require_once('ldap.php');
    if(empty($_SESSION['membership'])) {
    	header('Location: views/403.php');
    }
}
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/TicketController.php');
$tc = new TicketController();
$ticket = $tc->GetTicketById(rawurldecode($_GET['ticketId']));

?>
<h1>Edit - <?php echo $ticket->GetTicketId(); ?></h1>
<div id="post-response"></div>
<div class="row">
    <form id="editTicketForm" method="post" enctype="multipart/form-data">
        <div class="col-lg-6">
            <div class="form-group">
                <div id="ticketToEdit"></div>
                <label for="customerNameInput">Customer name:</label>
                <input id="customerNameInput" data-movie-to-edit="<?php echo $ticket->GetCustomerName(); ?>" type="text" name="customerName" placeholder="Customer fullname" class="form-control" value="<?php echo $ticket->GetCustomerName(); ?>" />
            </div>
            <div class="form-group">
                <label for="customerPhoneNumber">Customer phonenumber:</label>
                <input id="customerPhoneNumber" type="text" name="customerPhoneNumber" placeholder="Customer phonenumber" class="form-control" value="<?php echo $ticket->GetPhoneNumber(); ?>"/>
            </div>
            
            <!--Tell the user to leav empty if they wonna keep it.-->
            <div class="form-group">
                <input type="submit" id="editTicketButton" name="submitEditTicket" class="btn btn-warning" />             
            </div>
        </div>
    </form>
</div>

