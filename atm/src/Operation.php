<?php

namespace App;

class Operation{
    /**
     * @var int
     */
    private $timestamp;

    /**
     * @var float
     */
    private $amount;

    /**
     * Operation constructor.
     * @param int $timestamp
     * @param float $amount
     */
    public function __construct(int $timestamp, float $amount){
        $this->timestamp = $timestamp;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getTimeStamp(): int{
        return $this->timestamp;
    }

    /**
     * @return int
     */
    public function getAmount(): int{
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getFormattedDate(): string{
        return date("Y-m-d", $this->timestamp);
    }

    /**
     * @return float|string
     */
    public function getDebit(){
        return $this->amount < 0 ? $this->amount : '';
    }

    /**
     * @return float|string
     */
    public function getCredit(){
        return $this->amount > 0 ? $this->amount : '';
    }
}