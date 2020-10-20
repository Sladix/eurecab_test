<?php

namespace App;

abstract class StatementBuilder{
    /**
     * @param array $operations
     */
    abstract public static function buildStatementFromOperations(array $operations);

    protected static function getTotalUntilOperation(array $operations, int $operationIndex): float{
        $total = 0;
        for($i = 0; $i <= $operationIndex; $i++){
            $total+= $operations[$i]->getAmount();
        }
        return $total;
    }
}