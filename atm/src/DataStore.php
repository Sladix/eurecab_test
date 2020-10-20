<?php

namespace App;

interface DataStore{
    public function getOperations(): array;
    public function addOperation(Operation $s): void;
}