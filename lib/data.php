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
 * List of all users in the system.
 * They are indexed by their id.
 */
$USERS = [
    "alice" => [
        "name" => "Alice",
        "mail" => "alice@somewhere.net",
    ],
    "bob" => [
        "name" => "Bob",
        "mail" => "bob@mail.somewhere.net",
    ],
    "charlie" => [
        "name" => "Charlie",
        "mail" => "ch@somewhere.net",
    ],
];

/**
 * List of all machines in the system.
 * They are indexed by their hostname; for each machine we remember its
 * owner (as index to $USERS) and services.
 */
$MACHINES = [
    "www.somewhere.net" => [
        "owner" => "bob",
        "services" => [
            "web" => [
                "description" => "Main web server",
                "state" => "up",
                "events" => [
                    [ "2016-02-02T07:30", "service is down" ],
                    [ "2016-02-02T07:35", "service is up" ],
                ],
            ],
        ],
    ],
    "testing.somewhere.net" => [
        "owner" => "charlie",
        "services" => [
            "web" => [
                "description" => "Front-end for testing services",
                "state" => "up",
                "events" => [],
            ],
            "hudson" => [
                "description" => "Main CI server",
                "state" => "down",
                "events" => [],
            ],
        ],
    ],      
];

