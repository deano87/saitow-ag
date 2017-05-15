<?php

namespace App\Helpers;

use App\Helpers\Contracts\DataImport;

class CSVImport extends DataImport {
    private $rawData = [];

    public function fetch() {
        if($this->isMock()) {
            $path = storage_path('app/import/mock/' . $this->file);
        } else {
            $path = storage_path('app/import/' . $this->file);
        }

        if(!file_exists($path)) return false;

        $delimiter = $this->detectDelimiter($path);
        if(!$delimiter) {
            $delimiter = ',';
        }

        if (($handle = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $this->rawData[] = $data;
            }
            fclose($handle);
        }

        return $this->rawData;
    }

    public function normalize() {
        // TODO: Implement normalize() method.
    }

    public function store() {
        // TODO: Implement store() method.
    }

    public function detectDelimiter($csvPath) {
        $delimiters = [';' => 0, ',' => 0, "\t" => 0, '|' => 0];

        $line = fgets(fopen($csvPath, 'r'));
        foreach ($delimiters as $delimiter => &$count) {
            $count = count(str_getcsv($line, $delimiter));
        }

        return array_search(max($delimiters), $delimiters);
    }
}
