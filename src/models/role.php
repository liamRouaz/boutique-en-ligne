<?php
require 'Database.php';

class Role {
    const USER_ROLE = 'user';
    const ADMIN_ROLE = 'admin';

    // Méthode statique pour déterminer le rôle par email
    public static function getRoleByEmail($email) {
        // Vérifier si l'email se termine par "@laplateforme.io"
        if (strpos($email, "@laplateforme.io") !== false) {
            return self::ADMIN_ROLE;
        } else {
            return self::USER_ROLE;
        }
    }
}

?>
