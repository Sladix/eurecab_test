<?php

namespace Tests;

use App\ATM;
use App\Exceptions\AmountTooBigException;
use App\Exceptions\DebtException;
use App\Exceptions\DepositException;
use App\Exceptions\WithdrawException;
use App\FileDataStore;
use App\Operation;
use PHPUnit\Framework\TestCase;

require __DIR__ . '/../vendor/autoload.php';

class ATMTest extends TestCase
{

    public function testNotFailing()
    {
        $this->assertTrue(true);
    }

    public function testGetOperationsIsCalled()
    {
        $ds = $this->createMock(FileDataStore::class);
        $ds->expects($this->once())->method('getOperations');

        new ATM($ds);
    }

    public function testCanDeposit()
    {
        $ds = $this->createMock(FileDataStore::class);
        $ds->expects($this->once())->method('addOperation');

        $atm = new ATM($ds);
        $this->assertTrue($atm->deposit(50));
    }

    public function testCanWithdraw()
    {
        $operation = new Operation(time(), 100);
        $ds = $this->createMock(FileDataStore::class);
        $ds->method('getOperations')->willReturn([$operation]);
        $ds->expects($this->once())->method('addOperation');

        $atm = new ATM($ds);
        $this->assertTrue($atm->withdraw(50));
    }

    public function testNoDebtPossible()
    {
        $this->expectException(DebtException::class);
        $ds = $this->createMock(FileDataStore::class);
        $atm = new ATM($ds);
        $atm->withdraw(100);
    }

    public function testNoNegativeWithdraw()
    {
        $this->expectException(WithdrawException::class);
        $ds = $this->createMock(FileDataStore::class);
        $atm = new ATM($ds);
        $atm->withdraw(-100);
    }

    public function testNoNegativeDeposit()
    {
        $this->expectException(DepositException::class);
        $ds = $this->createMock(FileDataStore::class);
        $atm = new ATM($ds);
        $atm->deposit(-100);
    }

    public function testCantDepositTooMuch()
    {
        $this->expectException(AmountTooBigException::class);
        $ds = $this->createMock(FileDataStore::class);
        $atm = new ATM($ds);
        $atm->deposit(1000);
    }

}
