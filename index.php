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

/*
 * Central script for our application.
 * 
 * We include Limonade and our scripts, set-up the flashes, layout, routes
 * and run the application.
 */

require_once 'lib/limonade.php';
require_once 'lib/inc.php';

function before($route) {
	set('glob_flash', flash_format_all());
}

function configure() {
	db_init('sqlite:db/db.sqlite');
}

session_start();

layout('layout/default.html.php');

dispatch('/', 'page_index');
dispatch('/sql', 'page_sql');
dispatch_post('/sql', 'page_sql');
dispatch('/machine/:machine', 'page_machine_index');
dispatch('/machine/:machine/edit', 'page_machine_edit');
dispatch_post('/machine/:machine/edit', 'page_machine_edit');
dispatch('/user/:user', 'page_user_index');

run();
