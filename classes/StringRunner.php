<?php
/**
 * Navigate to a String with more then 1 Line.
 *
 * @author dmohl
 */
class StringRunner {

    private $_line = 0;
    private $_content;

    /**
     *
     * @param String $string The String you want to navigate through
     * @param String $newline Your Symbol for 'newline'. Default is \n
     */
    function  __construct($string, $newline = "\n") {
        $this->_content = explode($newline, $string);
    }

    /**
     * Sets the pointer to the next Line
     */
    public function nextLine() {
        $this->_line++;
    }

    /**
     * Sets the pointer to the previous Line
     */
    public function prevLine() {
        $this->_line--;
    }

    /**
     * Sets the pointer to a specific Line
     * @param int $line The Linenumber
     */
    public function jumpTo($line) {
        $this->_line = $line;
    }

    /**
     * Returns the Content of the actual Line
     * @return String The Content of the actual Line
     */
    public function getContent() {
        return $this->_content[$this->_line];
    }

    /**
     * Returns the Number of Lines in your String
     * @return int The Number of Lines in the String
     */
    public function getLines() {
        return count($this->_content);
    }
}
?>
