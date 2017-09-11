<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Ldap.php');

// Getting the current logged in users username, and storing it in a session variable to validate permission accross the site.
$ldap = new Ldap();
$ldap->ldapConnect();
$_SESSION['membership'] = $ldap->getUserMembership();
$ldap->ldapClose();