<?php

class DatabaseTable {
    private $pdo;
    private $table;
    private $primaryKey;

    public function __construct($pdo, $table, $primaryKey) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    public function find($field, $value) {
        $stmt = $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE '. $field . ' = :value');
        $values = ['value' => $value];
        $stmt->execute($values);
        $results = $stmt->fetchAll();
        // returns an array as results could be more than one option
        return $results;
    }

    public function findAll() {
            $stmt = $this->pdo->prepare('SELECT * FROM '.$this->table);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
    }

    public function delete($field, $value) {
        $string = 'DELETE FROM '.$this->table.' WHERE ' .$field. ' = :value';
        $deleteValue = ['value' => $value];
        $stmt = $this->pdo->prepare($string);
        $stmt->execute($deleteValue);
    }

    public function insert($record) {
        $tableKeys = array_keys($record);
        $implodedString = implode(', ', $tableKeys);
        $implodedStringWithColons = implode(', :', $tableKeys);
    
        $insert = 'INSERT INTO '. $this->table . ' ('. $implodedString . ') VALUES (:'. $implodedStringWithColons. ')';
    
        $stmt = $this->pdo->prepare($insert);
        $stmt->execute($record);
    }

    public function update($record) {
        
        $query = 'UPDATE ' . $this->table . ' SET ';
    
        $parameters = [];
        foreach ($record as $key => $value) {
        $parameters[] = $key . ' = :' .$key;
        }
    
        $query .= implode(', ', $parameters);
        $query .= ' WHERE ' . $this->primaryKey . ' = :primaryKey';
    
        $record['primaryKey'] = $record[$this->primaryKey];
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($record);
    }

    public function save($record) {
        try {
            $this->insert($record);
        }
        catch (Exception $e) {
            $this->update($record);
        }
    }
}
?>