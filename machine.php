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
require_once 'utils.php';
require_once 'template.php';

/*
 * Check that the machine id is set and it is a valid entry.
 */
$id = @$_GET['id'];
if (!isset($MACHINES[$id])) {
    Header("Location: index.php");
    exit();
}
$info = $MACHINES[$id];

page_header($id);
?>

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
        <td><?php echo make_link($details['description'], 'service.php', [ 'machine' => $id, 'service' => $srv]); ?></td>
        <td><?php echo $details['state']; ?></td>
        <td><?php echo make_link('View event log', 'events.php', [ 'machine' => $id, 'service' => $srv]); ?></td>
    </tr>
<?php } ?>
</table>

<?php
page_footer();
