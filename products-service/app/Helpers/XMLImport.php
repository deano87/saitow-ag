<?php

namespace App\Helpers;

use App\Helpers\Contracts\DataImport;

class XMLImport extends DataImport {
    private $rawData = [];

    public function fetch() {
        $path = $this->getFilePath();

        if(!file_exists($path)) return false;

        $products = simplexml_load_file($path);
        if(!$products) return false;

        $prodArray = (array) $products;
        if(sizeof($prodArray)) {
            $this->rawData = current($prodArray); // current returns false if the array is empty
            foreach ($this->rawData as &$v) {
                $v = (array) $v;
            }
        }

        return $this->rawData;
    }

    public function normalize() {
        // TODO: Implement normalize() method.
    }

    public function store() {
        // TODO: Implement store() method.
    }

}
