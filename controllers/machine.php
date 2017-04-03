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
 * Displays homepage of a specific machine.
 */
function page_machine_index() {
    $info = data_get_machine_details(params('machine'));
    if ($info === false) {
        flash('error', 'Unknown machine.');
        redirect_to('/');
    }
    
    set('title', $info['hostname']);
    set('machine', $info['hostname']);
    set('owner', $info['owner']['name']);
    set('services', $info['services']);
    
    return html('machine.html.php');
}

function page_machine_edit() {
    $info = data_get_machine_details(params('machine'));
    if ($info === false) {
        flash('error', 'Unknown machine.');
        redirect_to('/');
    }
    
    set('title', $info['hostname']);
    set('machine', $info['hostname']);
    set('owners', data_get_user_list());
    
    
    if (!isset($_POST['f_sent'])) {
        // Form was not sent, fill-in current values.
        set('f_hostname', $info['hostname']);
        set('e_hostname', '');
        set('f_owner', $info['owner']['id']);
        set('e_owner', '');
    } else {
        // Set missing fields as empty.
        foreach (['f_hostname', 'f_owner'] as $i) {
            if (!isset($_POST[$i])) {
                $_POST[$i] = '';
            }
        }
        
        // Fill-in sent values (prevent loosing data).
        set('f_hostname', $_POST['f_hostname']);
        set('e_hostname', '');
        set('f_owner', $_POST['f_owner']);
        set('e_owner', '');
        
        
        // Check input data
        $everything_ok = true;
        
        if (preg_match('/^[-_.a-zA-Z0-9]+$/', $_POST['f_hostname']) !== 1) {
            $everything_ok = false;
            set('e_hostname', 'invalid hostname');
        }
        
        if (data_get_user_details($_POST['f_owner']) === false) {
            $everything_ok = false;
            set('e_owner', 'unknown owner selected');
        }
        
        if ($everything_ok) {
            data_update_machine_details($info['id'], [
                'hostname' => $_POST['f_hostname'],
                'owner' => $_POST['f_owner']
            ]);
            
            flash('info', 'Entry updated.');
            redirect_to('/');
        }
    }
    
    return html('machine_edit.html.php');
}
