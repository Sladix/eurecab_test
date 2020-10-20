<?php

require_once './vendor/autoload.php';

$allowedCommands = ["withdraw", "deposit", "statement"];
$atm = new \App\ATM(new \App\FileDataStore());

if(empty($argv[1]) || !in_array($argv[1], $allowedCommands)){
    echo "Available commands are: deposit, withdraw, statement";
    return;
}

if($argv[1] === "statement"){
    $atm->printStatement();
} else {
    if(empty($argv[2])){
        echo sprintf("You must enter an amount to %s", $argv[1]);
        return;
    }
    try{
        switch ($argv[1]){
            case "deposit":
                $atm->deposit((float)$argv[2]);
                break;
            case "withdraw":
                $atm->withdraw((float)$argv[2]);
                break;
            default:
                echo sprintf("unknown behavior for command %s", $argv[1]);
                break;
        }
    } catch(Exception $exception){
        echo sprintf("/!\ %s /!\\", $exception->getMessage());
    }
}

