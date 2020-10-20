<?php

namespace App;

use App\Exceptions\AmountTooBigException;
use App\Exceptions\DebtException;
use App\Exceptions\DepositException;
use App\Exceptions\WithdrawException;


class ATM
{
    private $operations = [];
    private $dataStore;

    const MAXIMUM_DEPOSIT_AMOUNT = 999.99;

    public function __construct(DataStore $ds)
    {
        $this->dataStore = $ds;
        $this->operations = $this->dataStore->getOperations();
    }

    public function deposit(float $amount)
    {
        if ($amount > self::MAXIMUM_DEPOSIT_AMOUNT) {
            throw new AmountTooBigException($amount);
        }

        if ($amount <= 0) {
            throw new DepositException($amount);
        }

        return $this->addOperation($amount);
    }

    public function withdraw(float $amount)
    {
        if ($amount <= 0) {
            throw new WithdrawException();
        }

        $total = $this->getAccountTotal() - $amount;
        if ($total < 0) {
            throw new DebtException($amount, $total);
        }

        return $this->addOperation(-$amount);
    }

    private function getAccountTotal()
    {
        return array_reduce($this->operations, function(float $acc, Operation $item) {
            return $acc + $item->getAmount();
        },0);
    }

    /**
     * @param float $amount
     * @return bool
     */
    private function addOperation(float $amount): bool
    {
        $operation = new Operation(time(), $amount);
        $this->dataStore->addOperation($operation);
        $this->operations[] = $operation;
        return true;
    }

    public function printStatement()
    {
        ConsoleStatementBuilder::buildStatementFromOperations($this->operations);
    }
}