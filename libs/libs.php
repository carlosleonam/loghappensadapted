<?php
include("config.php");

/*
* Initial configurations
*/
header("Content-type: text/html;charset=utf-8");
session_start();

if (!isset($_SESSION["pagelength"])) {
    $_SESSION["pagelength"] = $pagelength;
}

/*
* Misc functions
*/
function redirect($destination)
{
    header("Refresh:0; url=" . $destination);
}

/*
* Data sanitization
*/
function checkExist($name)
{
    return filter_input(INPUT_GET, $name, FILTER_DEFAULT);
}

function filterString($name)
{
    return filter_input(INPUT_GET, $name, FILTER_SANITIZE_STRING);
}

function filterInt($name)
{
    return filter_input(INPUT_GET, $name, FILTER_SANITIZE_NUMBER_INT);
}

/*
 * Added new functions
 */
function readLastLines($filename, $num, $reverse = false)
{
    $file = new \SplFileObject($filename, 'r');
    $file->seek(PHP_INT_MAX);
    $last_line = $file->key();
    $lines = new \LimitIterator($file, $last_line - $num, $last_line);
    $arr = iterator_to_array($lines);
    if($reverse) $arr = array_reverse($arr);
    // return implode('',$arr);
    return $arr;
}

/*
// use it by
$lines = readLastLines("file.txt", 5) // return string with 5 last lines
*/