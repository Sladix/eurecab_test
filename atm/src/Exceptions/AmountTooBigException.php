<?php


namespace App\Exceptions;

use App\ATM;

class AmountTooBigException extends \Exception
{

    /**
     * AmountTooBigException constructor.
     * @param float $amount
     */
    public function __construct(float $amount)
    {
        $message = sprintf("Amount of %f exceeds the maximum of %f", $amount, ATM::MAXIMUM_DEPOSIT_AMOUNT);
        parent::__construct($message, 0, null);
    }
}