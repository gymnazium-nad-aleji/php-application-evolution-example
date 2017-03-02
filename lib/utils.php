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
 * Creates HTML link.
 * 
 * make_link($text, $page)
 * 
 * @param $text The clickable text of the link.
 * @param $page Target page (e.g. 'machine', 'alpha', 'service', 'srv').
 */
function make_link($params = null) {
    $params = func_get_args();
    $name = array_shift($params);
    $url = call_user_func_array('url_for', $params);
    
    return sprintf('<a href="%s">%s</a>', $url, $name);
}

/**
 * Format all flashes (e.g. message from previous page).
 */
function flash_format_all() {
    $names = [ 'error', 'info' ];
    
    $result = "";
    
    foreach ($names as $a) {
        $fl = flash_now($a);
        if ($fl != null) {
            $result .= sprintf("<div class=\"%s\">%s</div>\n", $a, $fl);
        }
    }
    
    return $result;
}
