<?php
require_once 'StringRunner.php';

/**
 * Description of Parser
 *
 * @author dmohl
 */
class Parser {
    //put your code here

    public function stripComments($string)
    {
        $sr = new StringRunner($string);

        for ( $i = 0; $i < $sr->getLines(); $i++ ) {

            $content = trim($sr->getContent());

            // Strip Comments with // in the Code
            $str = strstr($content, '//', true);
            if ( $str )
            {
                $sr->setContent(trim($str)); // Set Content to everything before the '//'
            }

            // Delete Comments with // in the Beginning
            if ( preg_match('/^\/\//s', $content) ) {
                $sr->removeLine(); // Remove the Line + set Pointer to next Element
                $i--; // Prevent i from couting + 1.
            }
            else
            {
                $sr->nextLine(); // No Comment found? Next Line
            }
        }

        return $sr->getString();
    }

    public function stripWhitespaces($string)
    {
        $sr = new StringRunner($string);
        for ( $i = 0; $i < $sr->getLines(); $i++ ) {
            $sr->setContent(trim($sr->getContent()));
            $sr->nextLine();
        }

        return $sr->getString();
    }

    public function stripWhitelines($string)
    {
        $sr = new StringRunner($string);

        for ( $i = 0; $i < $sr->getLines(); $i++ ) {

            $content = trim($sr->getContent()); // Trim whitespaces in Line

            // Check if there are any Characters in the Line
            if ( strlen($content) == 0  )
            {
                $sr->removeLine(); // Remove the Line + set Pointer to next Element
                $i--; // Again, prevent i from counting +1.
            }
            else
            {
                $sr->nextLine(); // Comment not 0, count next Line
            }
        }

        return $sr->getString();
    }

    public function convertQuote($string)
    {
        //return preg_replace("/\\\"/", "\"", $string);
        $string = str_replace("\'", "'", $string);
        return str_replace('\"', '"', $string);
    }

    public function convert2Php($string)
    {
        $sr = new StringRunner($string);
        $matches = array();
        $expr = "/^(var *)([a-zA-Z0-9]*)( *=)/i";

        for ( $i = 0; $i < $sr->getLines(); $i++ ) {

            $content = trim($sr->getContent()); // Trim whitespaces in Line
            $regex = preg_match($expr, $content, $match);

            if ( $regex )
                $matches[] = $match[2];

            $sr->nextLine();
        }

        foreach ($matches as $value) {
            // Replace all variable with $variable
            $string = preg_replace("/(^|[^a-zA-Z0-9]+|\()($value)(\.| |\)|, )/", "$1".'$'.$value."$3", $string);
        }
        // Replace all '.' to '->', except they are in brackets
        $string = preg_replace("/(\.)(.*\()/", '->' . "$2", $string);

        // Remove all 'var'
        $string = preg_replace("/var */", '', $string);

        return $string;
    }
}
?>
