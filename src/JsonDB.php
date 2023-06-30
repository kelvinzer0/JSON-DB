<?php
class JsonDB {
    private $filename;
    private $data;

    public function __construct($filename) {
        $this->filename = $filename;
        $this->load();
    }

    private function load() {
        if (file_exists($this->filename)) {
            $json = file_get_contents($this->filename);
            $this->data = json_decode($json, true);
        } else {
            $this->data = array();
        }
    }

    private function save() {
        $json = json_encode($this->data, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $json);
    }

    public function get($key) {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        } else {
            return null;
        }
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
        $this->save();
    }

    public function delete($key) {
        unset($this->data[$key]);
        $this->save();
    }

    public function getAll() {
        return $this->data;
    }
}
class JsonDBObject extends JsonDB {
    private $tableName;

    public function __construct($filename, $tableName) {
        parent::__construct($filename);
        $this->tableName = $tableName;
        $this->initializeTable();
    }

    private function initializeTable() {
        if (!$this->get($this->tableName)) {
            $this->set($this->tableName, []);
        }
    }

    public function insert($data) {
        $tableData = $this->get($this->tableName);
        $tableData[] = $data;
        $this->set($this->tableName, $tableData);
    }

    public function update($index, $data) {
        $tableData = $this->get($this->tableName);
        if (isset($tableData[$index])) {
            $tableData[$index] = $data;
            $this->set($this->tableName, $tableData);
        }
    }

    public function delete($index) {
        $tableData = $this->get($this->tableName);
        if (isset($tableData[$index])) {
            unset($tableData[$index]);
            $tableData = array_values($tableData); // Re-index the array
            $this->set($this->tableName, $tableData);
        }
    }

    public function getAll() {
        return $this->get($this->tableName);
    }

    public function getRecord($index) {
        $tableData = $this->get($this->tableName);
        if (isset($tableData[$index])) {
            return $tableData[$index];
        } else {
            return null;
        }
    }
}
?>
