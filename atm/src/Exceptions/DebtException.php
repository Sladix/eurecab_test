<?php


namespace App\Exceptions;


class DebtException extends \Exception
{

    /**
     * DebtException constructor.
     * @param float $amount
     */
    public function __construct(float $amount, float $total)
    {
        parent::__construct(sprintf("You can't withdraw %f , otherwise your new total would be %f", $amount, $total));
    }
}