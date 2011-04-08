<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Effect
 *
 * @author dmohl
 */
class Effect {
    //put your code here

    private $_chain;

    function  __construct() {
        $this->_chain = array();
    }

    public function add($param)
    {
        $this->_chain[] = $param;
    }

    public function getChain()
    {
        return $this->_chain;
    }
}
?>
