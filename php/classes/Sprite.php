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
    public $rotation = 0;

    private $_songlength;
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
        $this->_songlength = $_SESSION['songlength'];
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

    public function setRotation($rotation)
    {
        $this->rotation = $rotation;
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
            $this->_osb->rotate(0, 0, $this->rotation, $this->rotation);
        }
        $this->_osb->fade($ms, $ms, 0, $this->trans); // Write the Fadevent

        if ( !$this->_rendered )
            $this->_osb->scale($this->_songlength, $this->_songlength, 1, 1);

        $this->_rendered = true;
    }

    public function copy($sprite)
    {
        
        $this->layer = $sprite->layer;
        $this->position = $sprite->position;
        $this->size = $sprite->size;
        $this->trans = $sprite->trans;
        $this->rotation = $sprite->rotation;

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
            $this->_osb->scale(0, 0, $this->size, $this->size, $duration);

            $this->_osb->fade(0, 0, 1, 0); // Set visibility at the beginning to 0
            $this->_osb->rotate(0, 0, $this->rotation, $this->rotation, $duration);
        }
        
        $this->_osb->fade($ms, $ms + $duration, 0, $this->trans, $duration);

        if ( !$this->_rendered )
            $this->_osb->scale($this->_songlength, $this->_songlength, 1, 1, $duration);

        $this->_rendered = true;
    }

    public function fadeOut($ms, $duration)
    {
        $this->_osb->fade($ms, $ms + $duration, $this->trans, 0, $duration);
    }

    public function moveTo($ms, $duration, $x, $y)
    {
        $this->_osb->move($ms, $ms + $duration, $this->position['x'], $this->position['y'], $x, $y, $duration);
        $this->position['x'] = $x;
        $this->position['y'] = $y;
    }

    public function resize($ms, $duration, $size)
    {
        $this->_osb->scale($ms, $ms + $duration, $this->size, $size, $duration);
        $this->size = $size;
    }

    public function rotate($ms, $duration, $endangle)
    {
        $this->_osb->rotate($ms, $ms + $duration, $this->rotation, $endangle, $duration);
        $this->rotation = $endangle;
    }

    public function fade($ms, $duration, $trans)
    {
        $this->_osb->fade($ms, $ms + $duration, $this->trans, $trans, $duration);
        $this->trans = $trans;
    }

    public function addEffect($ms, $effect, $loop = false)
    {
        $chain = array();
        $chain = $effect->getChain();

        if ( $loop )
        {
            $this->_osb->initLoop($ms, $loop);
        }

        // render(%ms)

        foreach ($chain as $element)
        {
            $element = preg_replace("/%ms/", $ms, $element);
            $element = '$this->' . $element . ';';
            eval($element);
        }

        $this->_osb->endLoop();
    }
}
?>
