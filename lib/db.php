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
 * @param $description Query
 *            description, currently not used.
 * @param $sql SQL
 *            query with placeholders.
 * @param $params Actual
 *            parameters for the SQL query.
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
