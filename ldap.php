<?php
// Post data comming from reservation system
$fulluserlogin = $_SERVER["REMOTE_USER"];

$samaccountnameArray = explode("@",$fulluserlogin);

$samaccountname =  $samaccountnameArray[0];

// The connection values for the Ldap connection
$ldaphost = "ldap://192.168.0.100";  // your ldap servers
$ldapport = 389;
$ldaprdn = 'Administrator';
$ldappass = 'Abc1234';

// Create connection
$ldapconn = ldap_connect($ldaphost, $ldapport)
or die("Could not connect to ldap");
//ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
//ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);

// Bind to it
if ($ldapconn) {

    // binding to ldap server
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

    // verify binding
    if (!$ldapbind) {
         echo "LDAP bind FAILED...";
    }
}

$dn = getDN($ldapconn, $samaccountname, "DC=DISA,DC=COM");

$groupsDN = array("Management" => "CN=Management-IM-G,OU=IMPL Grupper,DC=DISA,DC=COM","Cashier" => "CN=Cashier-IM-G,OU=IMPL Grupper,DC=DISA,DC=COM");

foreach($groupsDN as $groupName => $gDN) {
$value = checkGroupEx($ldapconn, $dn, $gDN);

if($value == true) {
    $_SESSION['membership'] = $groupName;
}

}

function getDN($ad, $samaccountname, $basedn) {
    $attributes = array('dn');
    $result = ldap_search($ad, $basedn,"(samaccountname={$samaccountname})", $attributes);
    if ($result === FALSE) { return ''; }
    $entries = ldap_get_entries($ad, $result);
    if ($entries['count']>0) { return $entries[0]['dn']; }
    else { return ''; };
}

function checkGroupEx($ad, $userdn, $groupdn) {
    $attributes = array('memberof');
    $result = ldap_read($ad, $userdn, '(objectclass=*)', $attributes);
    if ($result === FALSE) { return FALSE; };
    $entries = ldap_get_entries($ad, $result);
    if ($entries['count'] <= 0) { return FALSE; };
    if (empty($entries[0]['memberof'])) { return FALSE; } else {
        for ($i = 0; $i < $entries[0]['memberof']['count']; $i++) {
            if ($entries[0]['memberof'][$i] == $groupdn) { return TRUE; }
            elseif (checkGroupEx($ad, $entries[0]['memberof'][$i], $groupdn)) { return TRUE; };
        };
    };
    return FALSE;
}


