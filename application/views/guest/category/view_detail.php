<?php
/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 01-Aug-16
 * Time: 9:47 PM
 */
$myfile = fopen($documents[0]->file, "r") or die("Unable to open file!");
echo fread($myfile, filesize($documents[0]->file));
fclose($myfile);
?>