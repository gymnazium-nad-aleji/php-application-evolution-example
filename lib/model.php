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


function data_get_machine_list() {
    $machines = db_find_objects("get all machines",
        'SELECT hostname FROM machine');
    
    $result = [ ];
    foreach ( $machines as $m ) {
        $result [] = $m ['hostname'];
    }
    
    return $result;
}


function data_get_machine_details($hostname) {
    $info = db_find_object("get machine details",
	   'SELECT id, hostname, owner FROM machine WHERE hostname=:hostname',
       [ 'hostname' => $hostname ]);
    if ($info == null) {
        return false;
    }
    
    $info['owner'] = db_find_object("get machine owner",
       'SELECT id, name, email FROM user WHERE id = :user',
       [ 'user' => $info['owner'] ]);
	
    $info['services'] = db_find_objects("get machine services",
       'SELECT id, name description, state FROM service WHERE machine = :machine',
       [ 'machine' => $info['id'] ]);
    
    return $info;
}


function data_update_machine_details($id, $updates) {
    $updates['id'] = $id;
    db_update_object_from_array("update machine",
         $updates, 'machine',
         [ 'id']);
}

function data_get_user_list() {
    return db_find_objects("get all users",
            'SELECT id, name FROM user');
}

function data_get_user_details($id) {
    $info = db_find_object("get user details",
            'SELECT id, name, email FROM user WHERE id=:id',
            [ 'id' => $id ]);
    if ($info == null) {
        return false;
    }
    
    return $info;
}
