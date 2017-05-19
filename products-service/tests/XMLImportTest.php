<?php

use App\Helpers\XMLImport;

class XMLImportTest extends TestCase
{
    public function testFetch() {
        $csvImport = new XMLImport();
        $csvImport->mock();
        $csvImport->setFile('products.xml');
        var_dump($csvImport->fetch());
        $this->assertEquals(sizeof($csvImport->fetch()),2);
    }

    public function testColumns() {
        $csvImport = new XMLImport();
        $csvImport->mock();
        $csvImport->setFile('products.xml');
        $rows = $csvImport->fetch();
        foreach($rows as $row) {
            $this->assertEquals(sizeof($row), 7);
        }
    }
}
