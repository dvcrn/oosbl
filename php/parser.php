<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'classes/StringRunner.php';
require_once 'classes/Parser.php';

$oosbl = $_POST['oosbl'];
$parser = new Parser();

$test = $parser->stripComments($oosbl);
$test = $parser->stripWhitelines($test);
$test = $parser->stripWhitespaces($test);
$test = $parser->convert2Php($test);

$test2 = 'echo $test;';
eval($test2);