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

require_once('lib/Zebra_Form.php');


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
    
    $all_owners = data_get_user_list();
    
    set('title', $info['hostname']);
    set('machine', $info['hostname']);
    
    // Create the form.
    $form = new Zebra_Form('myform');
    $form->clientside_validation([
        'close_tips' => true,
        'on_ready' => false,
        'disable_upload_validation' => true,
        'scroll_to_error' => false,
        'tips_position' => 'right',
        'validate_on_the_fly' => true,
        'validate_all' => true,
    ]);
    
    // Hostname field.
    $form->add('label', 'label_hostname', 'hostname', 'Hostname');
    $f_hostname = $form->add('text', 'hostname', $info['hostname']);
    $f_hostname->set_rule([
        'required' => [ 'error', 'Hostname cannot be empty.' ],
        'regexp' =>  [ '^[-_.a-zA-Z0-9]+$', 'error', 'Invalid hostname.' ]
    ]);
    
    // Owner field.
    $form->add('label', 'label_owner', 'owner', 'Owner');
    $f_owner = $form->add('select', 'owner', $info['owner']['id']);
    foreach ($all_owners as $o) {
        $f_owner->add_options([
            $o['id'] => $o['name']
        ]);
    }
    $f_owner->set_rule([
        'required' => [ 'error', 'Owner must be set.' ]
    ]);
    
    // Submit button.
    $form->add('submit', 'submitbtn', 'Update ...');
    
    
    // If the form was submitted and data are okay, update the entry
    // in the database and redirect to homepage.
    // Otherwise, display the form again.
    if ($form->validate()) {
        data_update_machine_details($info['id'], [
            'hostname' => $_POST['hostname'],
            'owner' => $_POST['owner']
        ]);
        
        flash('info', 'Entry updated.');
        redirect_to('/');
    }
    
    
    set('form', $form->render('', true));
    
    return html('machine_edit.html.php');
}
