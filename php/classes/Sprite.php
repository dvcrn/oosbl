<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'OsbOutput.php';
/**
 * Description of Sprite
 *
 * @author dmohl
 */
class Sprite {

    public $file;
    public $position;
    public $size = 1;
    public $trans = 1;
    public $layer = "Background";

    private $_songlength = 30000;
    private $_rendered = false;

    private $_osb;

    function  __construct($file) {
        $this->file = $file;
        //echo $file . '<br />';

        $pos = array();
        $pos['x'] = 320;
        $pos['y'] = 240;

        $this->position = $pos;

        $this->_osb = new OsbOutput();
    }

    public function setLayer($layer)
    {
        $this->layer = $layer;
    }

    public function setPosition($x, $y)
    {
        $pos = array();
        $pos['x'] = $x;
        $pos['y'] = $y;

        $this->position = $pos;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setTrans($trans)
    {
        $this->trans = $trans;
    }

    public function render($ms)
    {
        if ( !$this->_rendered )
        {
            $this->_osb->sprite($this->layer, 'Centre', $this->file, $this->position['x'], $this->position['y']); // Write the Spriteheader
            $this->_osb->scale(0, 0, $this->size, $this->size);
            $this->_osb->fade(0, 0, 1, 0); // Set visibility at the beginning to 0
        }
        $this->_osb->fade($ms, $ms, 0, $this->trans); // Write the Fadevent

        if ( !$this->_rendered )
            $this->_osb->scale(30000, 30000, 1, 1);

        $this->_rendered = true;
    }

    public function copy($sprite)
    {
        
        $this->layer = $sprite->layer;
        $this->position = $sprite->position;
        $this->size = $sprite->size;
        $this->trans = $sprite->trans;

    }

    public function hide($ms)
    {
        $this->_osb->fade($ms, $ms, $this->trans, 0);
    }

    public function fadeIn($ms, $duration)
    {
        if ( !$this->_rendered )
        {
            $this->_osb->sprite($this->layer, 'Centre', $this->file, $this->position['x'], $this->position['y']); // Write the Spriteheader
            $this->_osb->scale(0, 0, $this->size, $this->size);

            $this->_osb->fade(0, 0, 1, 0); // Set visibility at the beginning to 0
        }
        
        $this->_osb->fade($ms, $ms + $duration, 0, $this->trans);

        if ( !$this->_rendered )
            $this->_osb->scale(30000, 30000, 1, 1);

        $this->_rendered = true;
    }

    public function fadeOut($ms, $duration)
    {
        $this->_osb->fade($ms, $ms + $duration, $this->trans, 0);
    }

    public function moveTo($ms, $duration, $x, $y)
    {
        $this->_osb->move($ms, $ms + $duration, $this->position['x'], $this->position['y'], $x, $y);
        $this->position['x'] = $x;
        $this->position['y'] = $y;
    }

    public function resize($ms, $duration, $size)
    {
        $this->_osb->scale($ms, $ms + $duration, $this->size, $size);
        $this->size = $size;
    }

    public function fade($ms, $duration, $trans)
    {
        $this->_osb->fade($ms, $ms + $duration, $this->trans, $trans);
        $this->trans = $trans;
    }

    public function addEffect($ms, $effect)
    {
        $chain = array();
        $chain = $effect->getChain();

        // render(%ms)

        foreach ($chain as $element)
        {
            $element = preg_replace("/%ms/", $ms, $element);
            $element = '$this->' . $element . ';';

            eval($element);
        }
    }
}
?>
