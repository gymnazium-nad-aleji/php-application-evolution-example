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
 * This is the default layout (top-level template) for the whole application.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo htmlspecialchars($title);  ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="main.css" />
		<link rel="stylesheet" type="text/css" href="css/zebra_form.css" />
		<script type="text/javascript" language="JavaScript" src="js/jquery-3.2.0.min.js"></script>
		<script type="text/javascript" language="JavaScript" src="js/zebra_form.js"></script>
	</head>
<body>
<h1><?php echo htmlspecialchars($title);  ?></h1>

<?php
/*
 * Display so-called flashes - messages from the previous page
 * (before call to redirect_to).
 */
if (@$glob_flash != "") { ?>
<div id="flashes">
<?php echo $glob_flash;  ?>
</div>
<?php } ?>

<?php
/*
 * Actual content of the page (as set-up by individual functions
 * in controllers).
 */
echo $content;
?>

<address>&copy; Me</address>

</body>
</html>
