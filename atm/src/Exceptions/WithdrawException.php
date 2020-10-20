<?php


namespace App\Exceptions;


class WithdrawException extends \Exception
{

    /**
     * WithdrawException constructor.
     */
    public function __construct()
    {
        parent::__construct(sprintf("You can't withdraw a negative amount"));
    }
}