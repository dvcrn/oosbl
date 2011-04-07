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
        return (string)$this->_content[$this->_line];
    }

    /**
     * Overwrite the Content in the actual line with $content
     * @param String $content The Content
     */
    public function setContent($content) {
        $this->_content[$this->_line] = $content;
    }

    /**
     * Returns the Number of Lines in your String
     * @return int The Number of Lines in the String
     */
    public function getLines() {
        return count($this->_content);
    }

    /**
     * Deletes the current Element out of your Content.
     */
    public function removeLine() {
        unset($this->_content[$this->_line]);
        $this->_line++;
    }

    /**
     * Returns the whole Content in a Array Format.
     * @return array The whole Content. Converted to Array
     */
    public function getArray() {
        return $this->_content;
    }

    /**
     * Fixes the ArrayIndex
     */
    public function fixIndex() {
        $this->_content = array_values($this->_content);
    }

    /**
     * Returns the String
     * @return String The whole String
     */
    public function getString() {
        return implode("\n", $this->_content);
    }
}
?>
