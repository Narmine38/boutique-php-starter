<?php

class BankAccount {
    private float $balance = 0;

    public function deposit(float $amount): void {
        if ($amount > 0) {
            $this->balance += $amount;
        }
    }

    public function withdraw(float $amount): void {
        if ($amount > 0 && $this->balance >= $amount) {
            $this->balance -= $amount;
        }
    }

    public function getBalance(): float {
        return $this->balance;
    }
}

// Tests
$account = new BankAccount();
$account->deposit(100);
$account->withdraw(30);
echo "Solde : " . $account->getBalance() . " €" . PHP_EOL; // 70

$account->withdraw(100); // Ne devrait rien faire
echo "Solde après retrait excessif : " . $account->getBalance() . " €" . PHP_EOL; // 70

$account->deposit(-50); // Ne devrait rien faire
echo "Solde après dépôt négatif : " . $account->getBalance() . " €" . PHP_EOL; // 70
