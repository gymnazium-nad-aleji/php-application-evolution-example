Example of an evolution of a PHP application
============================================

This repository demonstrates how a typical PHP application evolves.
Starting from multiple stand-alone pages to a MVC-based system using
[Limonade PHP](https://limonade-php.github.io/).

The application also uses [Zebra_Form](http://stefangabos.ro/php-libraries/zebra-form/)
to validate and render input forms.

How to run
----------

 * Clone this repository into a directory accessible by your web server
 * Ensure you have PHP set-up
   * Including support for SQLite (using some other engine is possible:
     change connection string in `lib/db.php`)
 * Ensure that `db` folder is writable for your web server
 * Open the directory in your web browser
 * Add `?/sql` to the URL to go to the SQL on-line editor
 * Paste contents of `db/init.sql` and execute it (as a multi-query)
 * You should be ready to go :-)
