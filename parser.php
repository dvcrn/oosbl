<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'classes/StringRunner.php';

$oosbl = $_POST['oosbl'];

$runner = new StringRunner($oosbl);

for ( $i = 0; $i < $runner->getLines(); $i++ ) {
    echo $runner->getContent();
    $runner->nextLine();
}

