<?php
session_start();
if(!isset($_SESSION['membership'])) {
    require_once('ldap.php');
    if(empty($_SESSION['membership'])) {
    	header('Location: views/403.php');
    }
}
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/MovieController.php');

$editController = new MovieController();

?>
<h1>Edit movies tabel</h1>
<table class="table table-striped table-bordered">
    <thead>
    <th>Movie names</th>
    <th>Edit</th>
    <th>Delete</th>
    </thead>
    <tbody>
        <?php foreach($editController->GetAllMovieNames() as $movieName) { ?>
        <tr>
            <td><?php echo $movieName->PK_movieName; ?></td>
            <td><form><button class="btn btn-warning" formaction="edit-movie&movieName=<?php echo $movieName->PK_movieName; ?>">Edit</button></form></td>
            <td><form class="removeMovieForm"><button class="btn btn-danger removeMovieFormButton" data-movie-name="<?php echo $movieName->PK_movieName; ?>">Delete</button></form></td>
        </tr>
        <?php } ?>
    </tbody>
</table>