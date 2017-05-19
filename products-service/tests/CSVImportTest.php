<?php

use App\Helpers\CSVImport;

class CSVImportTest extends TestCase
{
    public function testFetch() {
        $csvImport = new CSVImport();
        $csvImport->mock();
        $csvImport->setFile('products.csv');
        $this->assertEquals(sizeof($csvImport->fetch()),3);
    }

    public function testColumns() {
        $csvImport = new CSVImport();
        $csvImport->mock();
        $csvImport->setFile('products.csv');
        $rows = $csvImport->fetch();
        foreach($rows as $row) {
            $this->assertEquals(sizeof($row), 7);
        }
    }
}
