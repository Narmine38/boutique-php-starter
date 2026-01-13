<?php

namespace Entity;

use DateTime;

class User {
    public string $name;
    public string $email;
    public string $password;
    public DateTime $dateInscription;

    public function __construct(string $name, string $email, string $password, ?DateTime $dateInscription = null) {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->dateInscription = $dateInscription ?? new DateTime();
    }

    public function isNewMember(): bool {
        $now = new DateTime();
        $interval = $this->dateInscription->diff($now);
        return $interval->days < 30;
    }
}
