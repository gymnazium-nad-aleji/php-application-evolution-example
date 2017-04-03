<?php
/*
 * MIT License
 * Copyright (c) 2017 Vojtech Horky
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

/**
 * Initializes database connection.
 */
function db_init($connection_string) {
    $db = new PDO($connection_string);
    
    option('db', $db);
}

/**
 * Retrieve multiple results from the database.
 *
 * @param $description Query description, currently not used.
 * @param $sql SQL query with placeholders.
 * @param $params Actual parameters for the SQL query.
 */
function db_find_objects($description, $sql, $params = array()) {
    $conn = option('db');
    
    $result = [ ];
    
    $stmt = $conn->prepare($sql);
    if ($stmt->execute($params)) {
        while ( $obj = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            $result [] = $obj;
        }
    }
    
    return $result;
}

/**
 * Retrieve single result from the database.
 *
 * @param $description Query description, currently not used.
 * @param $sql SQL query with placeholders.
 * @param $params Atual parameters for the SQL query.
 */
function db_find_object($description, $sql, $params = array()) {
    $conn = option('db');
    
    $result = null;
    
    $stmt = $conn->prepare($sql);
    if ($stmt->execute($params)) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    return $result;
}

/**
 * Prefix values with colon to be used in SQL binding.
 * 
 * @param $x Column names.
 */
function db_prepare_bind_value_for_insert($x) {
    return ":" . $x;
}

/**
 * Prepare condition for the WHERE clause of UPDATE statement.
 *
 * @param $x Column names.
 */
function db_prepare_bind_value_for_update($x) {
    return sprintf("%s = :%s", $x, $x);
}

/**
 * Create new database entry from given data.
 * 
 * @param $description Query description, currently not used.
 * @param $object_array Associative array describing the new entry.
 * @param $table Table name.
 */
function db_create_object_from_array($description, $object_array, $table) {
    $columns = array_keys($object_array);

    $columns_colons = array_map('db_prepare_bind_value_for_insert', $columns);

    $sql = sprintf("INSERT INTO `%s` ( %s ) VALUES ( %s )",
            $table, implode(', ', $columns), implode(', ', $columns_colons));

    $conn = option('db');
    $stmt = $conn->prepare($sql);
    foreach ($columns as $c) {
        $stmt->bindValue(':' . $c, $object_array[$c]);
    }

    $stmt->execute();
}

/**
 * Update existing database entry with given data.
 *
 * @param $description Query description, currently not used.
 * @param $object_array Associative array describing the new entry.
 * @param $table Table name.
 * @param $id_columns Column names identifying the object (primary keys).
 */
function db_update_object_from_array($description, $object_array, $table, $id_columns) {
    $columns = array_keys($object_array);

    if (!is_array($id_columns)) {
        $id_columns = array($id_columns);
    }

    $columns_assignments = array_map('db_prepare_bind_value_for_update', $columns);
    $id_columns_comparison = array_map('db_prepare_bind_value_for_update', $id_columns);

    $sql = sprintf("UPDATE `%s` SET %s WHERE %s",
            $table, implode(', ', $columns_assignments),
            implode(' AND ', $id_columns_comparison));

    $conn = option('db');
    $stmt = $conn->prepare($sql);
    foreach ($columns as $c) {
        $stmt->bindValue(':' . $c, $object_array[$c]);
    }

    $stmt->execute();
}

/**
 * Delete a database entry.
 *
 * @param $description Query description, currently not used.
 * @param $table Table name.
 * @param $conditions Associative array naming removal conditions.
 */
function db_delete_objects($description, $table, $conditions) {
    $comparisons = array_map('db_prepare_bind_value_for_update', array_keys($conditions));
    $sql = sprintf("DELETE FROM `%s` WHERE %s",
            $table, implode(' AND ', $comparisons));

    $conn = option('db');
    $stmt = $conn->prepare($sql);
    foreach ($conditions as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
    }

    $stmt->execute();
}
