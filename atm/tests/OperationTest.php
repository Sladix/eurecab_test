<?php
namespace Tests;

use App\Operation;
use PHPUnit\Framework\TestCase;

require __DIR__ . '/../vendor/autoload.php';

class OperationTest extends TestCase {

    public function testFormatDate(){
        $operation = new Operation(1603219857, 20);
        $this->assertSame("2020-10-20", $operation->getFormattedDate());
    }
}