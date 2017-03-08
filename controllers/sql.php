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


function page_sql() {
    $db = option('db');
    
    $query = '';
    if (isset($_POST['query'])) {
        $query = $_POST['query'];
    }
    $multi = isset($_POST['multi']);
    
    set('title', 'SQL commands');
    set('query', $query);
    set('multi', $multi);
    
    if ($query == "") {
        set('outcome', 'empty');
        return html('sql.html.php');
    }
    
    if ($multi) {
        $result = $db->exec($query);
    } else {
        $result = $db->query($query);
    }

    if ($result === false) {
        set('outcome', 'error');
        set('reason', implode(' - ', $db->errorInfo()));
        return html('sql.html.php');
    }
    
    if ($multi) {
        set('outcome', 'ok');
        set('affected', $result);
    } else {
        $rows = [];
        $header = [];
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $header = array_unique(array_merge($header, array_keys($row)));
            $rows[] = $row;
        }
        
        set('outcome', 'data');
        set('affected', $result->rowCount());
        
        set('result', [ 'header' => $header, 'data' => $rows]);
    }
    
    
    return html('sql.html.php');
}
