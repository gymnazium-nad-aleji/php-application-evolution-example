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
?>

<form method="post" action="<?php echo url_for('sql'); ?>">
<textarea name="query" style="width: 80%;" rows="5">
<?php echo htmlspecialchars($query); ?>
</textarea>
<p><label><input type="checkbox" name="multi" <?php if ($multi) { echo 'checked="checked"';} ?>/>This is a multi-query.</label></p>
<p>
<input type="submit" value="Execute SQL" />
</form>

<?php
switch ($outcome) {
case 'error': ?>
    <p>SQL query terminated with error: <?php echo $reason; ?></p>
<?php
    break;
case 'empty':
    break;
case 'ok': ?>
    <p>SQL okay, affected <?php echo $affected; ?> rows.</p>
<?php
    break;
case 'data': ?>
    <p>SQL query ok.</p>
    <table>
        <thead>
            <tr>
                <?php
                    foreach ($result['header'] as $name) {?>
                        <th><?php echo htmlspecialchars($name); ?></th><?php 
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($result['data'] as $row) {?>
                    <tr>
                        <?php
                            foreach ($result['header'] as $name) {
                                if (isset($row[$name])) {
                                  ?><td><?php echo htmlspecialchars($row[$name]); ?></td><?php  
                                } else {
                                   ?><td>&mdash;</td><?php
                                }
                            }
                        ?>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
        </table>
<?php
    break;
}
