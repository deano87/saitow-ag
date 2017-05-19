<?php

namespace App\Helpers\Contracts;

abstract class DataImport {
    protected $file;
    protected $mock = false;

    abstract protected function fetch();
    abstract protected function normalize();
    abstract protected function store();

    public function import() {
      $this-fetch();
      $this-normalize();
      $this-store();
    }

    public function setFile($file = '') {
        $this->file = $file;
    }

    public function mock($active = true) {
      $this->mock = $active;
    }

    public function isMock() {
      return $this->mock;
    }

    public function getFilePath() {
        if($this->mock) {
            $path = storage_path('app/import/mock/' . $this->file);
        } else {
            $path = storage_path('app/import/' . $this->file);
        }
        return $path;
    }
}
