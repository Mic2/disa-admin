<?php
session_start();
if(!isset($_SERVER['membership'])) {
    require_once('ldap.php');
}

?>
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
            <div id="headline-wrapper"  class="row">
                <h1>DISA Bio Administration</h1>                
            </div>
            <div class="row">  
                <div id="main-menu-wrapper">
                    <div id="main-menu" class="col-md-2">
                        <?php if($_SERVER['membership'] == "Management") { ?>
                            <a href="insert-movie"><div class="glyphicon glyphicon-edit"></div>Insert movie</a>
                            <a href="edit-movie-tabel"><div class="glyphicon glyphicon-eye-open"></div>Show movies</a>
                            <a href="statistics"><div class="glyphicon glyphicon-signal"></div>Statistics</a>
                        <?php } elseif($_SERVER['membership'] == "Cashier") { ?>
                            <a href="edit-ticket-tabel"><div class="glyphicon glyphicon-check"></div>Show tickets</a>
                        <?php } else {
                            require_once('views/403.php');
                        } ?>
                        
                    </div>
                </div>
                <div id="site-headline" class="col-md-10">                   
                    <div id="main-content">
                        <?php require_once('includes/pageSwitcher.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="Ressources/JS/movieHandler.js"></script>
    <script type="text/javascript" src="Ressources/JS/ticketHandler.js"></script>
</html>
