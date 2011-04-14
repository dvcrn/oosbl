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

    private function _rangeFloat($start, $end)
    {
        return round($start+lcg_value()*(abs($end-$start)), 2);
    }

    public function addEffect($ms_1, $ms_2, $effect, $loop = false)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->addEffect($this->_range($ms_1, $ms_2), $effect, $loop);
        }
    }

    public function fade($ms_1, $ms_2, $duration_1, $duration_2, $trans_1, $trans_2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->resize($this->_range($ms_1, $ms_2), $this->_range($duration_1, $duration_2),
                            $this->_range($trans_1, $trans_2));
        }
    }

    public function rotate($ms_1, $ms_2, $duration_1, $duration_2, $endangle_1, $endangle_2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->resize($this->_range($ms_1, $ms_2), $this->_range($duration_1, $duration_2),
                            $this->_range($endangle_1, $endangle_2));
        }
    }

    public function resize($ms_1, $ms_2, $duration_1, $duration_2, $size_1, $size_2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->resize($this->_range($ms_1, $ms_2), $this->_range($duration_1, $duration_2),
                            $this->_rangeFloat($x_1, $x_2));
        }
    }

    public function moveTo($ms_1, $ms_2, $duration_1, $duration_2, $x_1, $x_2, $y_1, $y_2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->moveTo($this->_range($ms_1, $ms_2), $this->_range($duration_1, $duration_2),
                            $this->_range($x_1, $x_2),$this->_range($y_1, $y_2));
        }
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
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->copy($sprite);
        }
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
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->setLayer($layer);
        }
    }

    public function setPosition($x_1, $x_2, $y_1, $y_2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->setPosition($this->_range($x_1, $x_2), $this->_range($y_1, $y_2));
        }
    }

    public function setRotation($rotation_1, $rotation_2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->setRotation($this->_range($rotation_1, $rotation_2));
        }
    }

    public function setSize($size_1, $size_2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->setSize($this->_rangeFloat($size_1, $size_2));
        }
    }

    public function setTrans($trans_1, $trans_2)
    {
        foreach ( $this->_sprites as $sprite )
        {
            $sprite->setTrans($this->_rangeFloat($trans_1, $trans_2));
        }
    }


}
