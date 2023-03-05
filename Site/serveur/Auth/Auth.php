<?php
declare (strict_types=1);

class Auth {
    private $email;
    private $mdp;
    private $role_m;
    private $statut_m;

    function __construct(string $email, string $mdp, string $role_m, string $statut_m) {
        $this->email = $email;
        $this->mdp = $mdp;
        $this->role_m = $role_m;
        $this->statut_m = $statut_m;    
    }

    function getEmail():string {
        return $this->email;
    }
    function getMdp():string {
        return $this->mdp;
    }
    function getRoleM():string {
        return $this->role_m;
    }
    function getStatutM():string {
        return $this->statut_m;
    }

    // ÉTANT UNE CLÉ ÉTRANGÈRE JE PRÉFÈRE DÉSACTIVER PAR PRÉCAUTION -David
    // function setEmail($email):void {
    //     $this->email = $email;
    // }
    function setMdp($mdp):void {
        $this->mdp = $mdp;
    }
    function setRoleM($role_m):void {
        $this->role_m = $role_m;
    }
    function setStatutM($statut_m):void {
        $this->statut_m = $statut_m;
    }
          
}

?>