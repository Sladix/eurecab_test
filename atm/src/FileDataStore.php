<?php

namespace App;

class FileDataStore implements DataStore{

    private $fileName;
    private $fileFolder = '../db/';
    private $fieldSep = '|';
    private $filePath;

    public function __construct($fileName = 'db.txt'){
        $this->filePath = $this->fileFolder.$fileName;
    }

    public function getOperations(): array
    {
        $data = $this->parseFromFile();
        $operations = [];
        foreach ($data as $d){
            $operations[] = new Operation((int)$d[0], (float)$d[1]);
        }
        return $operations;
    }

    public function addOperation(Operation $o): void
    {
        $this->appendToFile(sprintf("%s|%s", $o->getTimeStamp(), $o->getAmount()));
    }

    private function appendToFile($txt){
        file_put_contents($this->filePath, $txt.PHP_EOL, FILE_APPEND);
    }

    private function parseFromFile(): array{
        $handle = @fopen($this->filePath, "r");
        $data = [];
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                $data[] = explode($this->fieldSep, $buffer);
            }
            if (!feof($handle)) {
                return $data;
            }
            fclose($handle);
        }
        return $data;
    }
}