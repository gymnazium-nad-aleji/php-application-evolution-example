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
<form method="post" action="<?php echo url_for('machine', $machine, 'edit'); ?>">
<fieldset>
    <legend>Edit machine ...</legend>
    <input type="hidden" name="f_sent" value="sent" />
    <dl>
        <dt><label for="f_hostname">Hostname</label><?php echo format_form_error($e_hostname); ?></dt>
        <dd><input type="text" id="f_hostname" name="f_hostname" value="<?php echo htmlspecialchars($f_hostname); ?>" />
        <dt><label for="f_owner">Owner</label><?php echo format_form_error($e_owner); ?></dt>
        <dd>
            <select id="f_owner" name="f_owner">
            <?php
                foreach ($owners as $o) {
                    printf("                <option value=\"%s\"%s>%s</option>\n",
                        htmlspecialchars($o['id']),
                        $o['id'] == $f_owner ? ' selected="selected"' : '',
                        htmlspecialchars($o['name']));
                }
            ?>
            </select>
        <dt><input type="submit" value="Update ..." />
    </dl>
</fieldset>
</form>
