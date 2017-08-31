<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="Ressources/css/style.css" />
        <link rel="stylesheet" href="Ressources/css/insertMovie.css" />
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div id="main-menu" class="col-md-2">
                    <a href="statistics">Home</a>
                    <a href="insert-movie">Insert movie</a>
                    <a href="edit-movie-tabel">Show movies</a>
                </div>
                <div id="site-headline" class="col-md-10">
                    <h1>DISA Bio Administration</h1>
                    <div id="main-content">
                        <?php require_once('includes/pageSwitcher.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
        
        ?>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="Ressources/JS/insertMovieHandler.js"></script>
</html>
