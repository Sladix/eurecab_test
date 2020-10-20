<?php


namespace App\Exceptions;


class DepositException extends \Exception
{

    /**
     * DepositException constructor.
     * @param float $amount
     */
    public function __construct(float $amount)
    {
        parent::__construct(sprintf("Can't deposit an amount of %f", $amount));
    }
}