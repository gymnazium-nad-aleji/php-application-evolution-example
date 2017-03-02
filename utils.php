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
 * Example: to create <a href="machine.php?id=alpha&style=blue">Alpha</a>, call
 * make_link("Alpha", "machine.php", [ "id" => "alpha", "style" => "blue" ]);
 * 
 * @param $text The clickable text of the link.
 * @param $page Target page.
 * @param $params Array of query parameters for the page.
 */
function make_link($text, $page, $params) {
    $p = array();
    foreach ($params as $key => $value) {
        $p[] = $key . '=' . $value;
    }
    return sprintf('<a href="%s?%s">%s</a>', $page, implode('&amp;', $p), $text);
}
