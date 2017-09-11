<?php

class Ldap {
    
    private $ldaphost = "ldap://192.168.0.100";  // your ldap servers
    private $ldapport = 389;
    private $ldaprdn = '<username>';
    private $ldappass = '<password>';
    private $ldapbind = null;
    private $ldapconn = null;

    public function ldapConnect() {
        // Create connection
        $this->ldapconn = ldap_connect($this->ldaphost, $this->ldapport) or die("Could not connect to ldap");
        ldap_set_option($this->ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->ldapconn, LDAP_OPT_REFERRALS, 0);

        // Bind to it
        if ($this->ldapconn) {

            // binding to ldap server
            $this->ldapbind = ldap_bind($this->ldapconn, $this->ldaprdn, $this->ldappass);

            // verify binding
            if (!$this->ldapbind) {
                 echo "LDAP bind FAILED...";
            }
        }
    }
    
    private function getCurrentUser($username) {
        // Post data comming from reservation system - username need to be called with $_SERVER["REMOTE_USER"]

        $samaccountnameArray = explode("@",$username);

        $samaccountname = $samaccountnameArray[0];
        
        return $samaccountname;
    }

    public function getUserMembership() {
        $samaccountname = self::getCurrentUser($_SERVER["REMOTE_USER"]);
        $dn = self::getDN($this->ldapconn, $samaccountname, "DC=DISA,DC=COM");

        $groupsDN = array("Management" => "CN=Management-IM-G,OU=IMPL Grupper,DC=DISA,DC=COM","Cashier" => "CN=Cashier-IM-G,OU=IMPL Grupper,DC=DISA,DC=COM");

        foreach($groupsDN as $groupName => $gDN) {
            $value = self::checkGroupEx($this->ldapconn, $dn, $gDN);

            if($value == true) {
                // Storing this in a session varable, wich will be use on all public html sites.
                return $groupName;
            }
        }
    }
    
    private function getDN($ad, $samaccountname, $basedn) {
        $attributes = array('dn');
        $result = ldap_search($ad, $basedn,"(samaccountname={$samaccountname})", $attributes);
        if ($result === FALSE) { return ''; }
            $entries = ldap_get_entries($ad, $result);
            if ($entries['count']>0) {
                return $entries[0]['dn']; 
            } else {
                return ''; 
            }
    }
    
    private function checkGroupEx($ad, $userdn, $groupdn) {
        $attributes = array('memberof');
        $result = ldap_read($ad, $userdn, '(objectclass=*)', $attributes);
            if ($result === FALSE) { 
                return FALSE; 
            };
            $entries = ldap_get_entries($ad, $result);
            if ($entries['count'] <= 0) { 
                return FALSE; 
                
            }
            if (empty($entries[0]['memberof'])) {
                return FALSE; 
            } else {
                for ($i = 0; $i < $entries[0]['memberof']['count']; $i++) {
                    if ($entries[0]['memberof'][$i] == $groupdn) {
                        return TRUE; 
                    }
                    elseif (self::checkGroupEx($ad, $entries[0]['memberof'][$i], $groupdn)) { 
                        return TRUE; 
                    }
                }
            }
        return FALSE;   
    }
    
    public function ldapClose() {
        ldap_close($this->ldapconn);
    }
    
}

