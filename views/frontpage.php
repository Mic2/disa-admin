<?php
session_start();
if(!isset($_SESSION['membership'])) {
    require_once('ldap.php');
    if(empty($_SESSION['membership'])) {
    	header('Location: 403.php');
    }
}
?>
<div class="row">
  <div class="col-md-12">
    <h1>Administration for Disa Bio</h1>
    <p>On the left you can see the choices that your account has.</p>
  </div>
</div>

