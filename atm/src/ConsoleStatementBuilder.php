<?php

namespace App;

class ConsoleStatementBuilder extends StatementBuilder
{

    public static function buildStatementFromOperations(array $operations)
    {
        $mask = "|%10.10s |%-10.10s |%-10.10s |%-10.10s|\n";
        printf($mask, "Date", "Credit", "Debit", "Balance");
        for($i = 0; $i < count($operations); $i++){
            $o = $operations[$i];
            printf($mask, $o->getFormattedDate(), $o->getCredit(), $o->getDebit(), self::getTotalUntilOperation($operations, $i));
        }
    }
}