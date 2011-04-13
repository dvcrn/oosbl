<?php
/**
 * Created by JetBrains PhpStorm.
 * User: David
 * Date: 13.04.11
 * Time: 21:05
 * To change this template use File | Settings | File Templates.
 */

require_once 'Sprite.php';

class xSprite extends Sprite
{
    private $_sprites;

    public $file;
    public $position;
    public $size = 1;
    public $trans = 1;
    public $layer = "Background";
    public $rotation = 0;

    function  __construct($file, $sprites)
    {
        $this->file = $file;
        $this->_sprites = array();

        for ( $i = 1; $i <= $sprites; $i++ )
        {
            $this->_sprites[] = new Sprite($this->file);
        }
    }

    private function _range($start, $end)
    {
        return rand($start, $end);
    }

    public function addEffect($ms, $effect, $loop = false)
    {

    }

    public function fade($ms, $duration, $trans)
    {

    }

    public function rotate($ms, $duration, $endangle)
    {

    }

    public function resize($ms, $duration, $size)
    {

    }

    public function moveTo($ms, $duration, $x, $y)
    {

    }

    public function fadeOut($startms_1, $startms_2, $duration_1, $duration2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->fadeOut($this->_range($startms_1, $startms_2), $this->_range($duration_1, $duration_2));
        }
    }

    public function fadeIn($startms_1, $startms_2, $duration_1, $duration_2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->fadeIn($this->_range($startms_1, $startms_2), $this->_range($duration_1, $duration_2));
        }
    }

    public function hide($startms, $endms)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->hide($this->_range($startms, $endms));
        }
    }

    public function copy($sprite)
    {
        
    }

    public function render($startms, $endms)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->render($this->_range($startms, $endms));
        }
    }

    public function setLayer($layer)
    {

    }

    public function setPosition($x_1, $x_2, $y_1, $y_2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->setPosition($this->_range($x_1, $x_2), $this->_range($y_1, $y_2));
        }
    }

    public function setRotation($rotation)
    {

    }

    public function setSize($size1)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->setSize($size1);
        }
    }

    public function setTrans($trans)
    {
        
    }


}
