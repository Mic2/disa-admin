<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/editMovieController.php');

$editController = new EditMovieController();

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
            <td><button class="btn btn-danger">Delete</button></td>
        </tr>
        <?php } ?>
    </tbody>
</table>