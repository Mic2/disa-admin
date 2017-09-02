<?php
session_start();
if(!isset($_SESSION['membership'])) {
    require_once('ldap.php');
    if(empty($_SESSION['membership'])) {
    	header('Location: views/403.php');
    }
}
?>
<div class="row">
    <h1>Administration for Disa Bio</h1>
    <p>On the left you can see the choices that your account has.</p>
</div>

