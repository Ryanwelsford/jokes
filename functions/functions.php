<?php

function update($pdo, $table, $record, $primaryKey) {
    $query = 'UPDATE ' . $table . ' SET ';

    $parameters = [];
    foreach ($record as $key => $value) {
    $parameters[] = $key . ' = :' .$key;
    }

    $query .= implode(', ', $parameters);
    $query .= ' WHERE ' . $primaryKey . ' = :primaryKey';

    $record['primaryKey'] = $record[$primaryKey];
    
    $stmt = $pdo->prepare($query);
    $stmt->execute($record);
   }
/* old functions that only work for the jokes table
function insertJoke($pdo, $values) {
    $stmt = $pdo->prepare('INSERT INTO joke (joketext,jokedate) VALUES (:joketext, :jokedate)');
    $stmt->execute($values);
}
function deleteJoke($pdo, $values) {
    $stmt = $pdo->prepare('DELETE FROM joke WHERE id = :id');
    $stmt->execute($values);
    //var_dump($values);
}
*/
// pass the db connection table name, field name to search by and the actual search value
function find($pdo, $table, $field, $value) {
    $stmt = $pdo->prepare('SELECT * FROM '.$table.' WHERE '. $field . ' = :value');
    $values = ['value' => $value];
    $stmt->execute($values);
    $results = $stmt->fetchAll();
    // returns an array as results could be more than one option
    return $results;
}
// pass db connection and table name returns all resutlts from the table
function findAll($pdo, $table) {
    $stmt = $pdo->prepare('SELECT * FROM '.$table);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
}

function save($pdo, $table, $record, $primaryKey) {
    try {
        insert($pdo, $table, $record);
    }
    catch (Exception $e) {
        update($pdo, $table, $record, $primaryKey);
    }
}

function insert($pdo, $table, $record) {
    $tableKeys = array_keys($record);
    $implodedString = implode(', ', $tableKeys);
    $implodedStringWithColons = implode(', :', $tableKeys);

    $insert = 'INSERT INTO '. $table . ' ('. $implodedString . ') VALUES (:'. $implodedStringWithColons. ')';

    $stmt = $pdo->prepare($insert);
    $stmt->execute($record);
}

function delete($pdo, $table, $field, $value) {
        $string = 'DELETE FROM '.$table.' WHERE ' .$field. ' = :value';
        $deleteValue = ['value' => $value];
        $stmt = $pdo->prepare($string);
        $stmt->execute($deleteValue);

        //return $stmt->fetch();
}

?>