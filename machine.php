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

require_once 'data.php';

/*
 * Check that the machine id is set and it is a valid entry.
 */
$id = @$_GET['id'];
if (!isset($MACHINES[$id])) {
    Header("Location: index.php");
    exit();
}
$info = $MACHINES[$id];
?>
<html>
<head>
<title><?php echo $id; ?></title>
</head>

<body>
<h1><?php echo $id; ?></h1>

<h2>Owner</h2>
<p><?php echo $info['owner']; ?></p>

<h2>Services</h2>
<table border="1">
    <tr>
        <th>Name</th>
        <th>State</th>
        <th>Events</th>
    </tr>
<?php foreach ($info['services'] as $srv => $details) { ?>
    <tr>
        <td><a href="service.php?machine=<?php echo $id; ?>&amp;service=<?php echo $srv; ?>"><?php echo $details['description']; ?></a></td>
        <td><?php echo $details['state']; ?></td>
        <td><a href="events.php?machine=<?php echo $id; ?>&amp;service=<?php echo $srv; ?>">View event log</a></td>
    </tr>
<?php } ?>
</table>

</body>
</html>
