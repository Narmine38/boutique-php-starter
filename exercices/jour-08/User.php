<?php

class User {
    public string $name;
    public string $email;
    public DateTime $registrationDate;

    public function __construct(string $name, string $email, ?DateTime $registrationDate = null) {
        $this->name = $name;
        $this->email = $email;
        $this->registrationDate = $registrationDate ?? new DateTime();
    }

    public function isNewMember(): bool {
        $now = new DateTime();
        $interval = $this->registrationDate->diff($now);
        return $interval->days < 30;
    }
}

// Tests
$user1 = new User("Alice", "alice@example.com", new DateTime("2026-01-01"));
$user2 = new User("Bob", "bob@example.com", new DateTime("2025-12-01"));

echo "Alice est nouvelle ? " . ($user1->isNewMember() ? "Oui" : "Non") . PHP_EOL;
echo "Bob est nouveau ? " . ($user2->isNewMember() ? "Oui" : "Non") . PHP_EOL;
