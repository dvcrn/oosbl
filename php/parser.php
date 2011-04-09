<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'classes/StringRunner.php';
require_once 'classes/Parser.php';
require_once 'classes/Sprite.php';
require_once 'classes/Effect.php';

$oosbl = $_POST['oosbl'];
$_SESSION['songlength'] = $_POST['songlength'];


$parser = new Parser();

$osb = $parser->stripComments($oosbl);
$osb = $parser->convertQuote($osb);
$osb = $parser->stripWhitelines($osb);
$osb = $parser->stripWhitespaces($osb);

// TODO: Don't use convert2php. Write a own parser to execute this!
$osb = $parser->convert2Php($osb);

// TODO: Same as above. eval is EVIL!
eval($osb);
