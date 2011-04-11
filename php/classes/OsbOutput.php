<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Output
 *
 * @author dmohl
 */
class OsbOutput {
    //put your code here

    private $_loop = false;
    private $_loopstart;

    public function put($array)
    {
        echo  implode(",", $array) . '<br />';
    }

    public function sprite($layer, $origin, $filepath, $x = 320, $y = 240)
    {
        $args = array();
        $args[] = 'Sprite';
        $args[] = $layer;
        $args[] = $origin;
        $args[] = '"'.$filepath.'"';
        $args[] = $x;
        $args[] = $y;

        $this->put($args);
    }

    public function fade($startms, $endms, $startop, $endop, $duration = 0, $easing = 0)
    {
        $fade = array();
        if ( $this->_loop )
        {
            $fade['name'] = '__F';
            $startms = $startms - $this->_loopstart;
            $endms = $duration + $startms;
            
        }
        else
        {
            $fade['name'] = '_F';
        }
        
        $fade['easing'] = $easing;
        $fade['startms'] = $startms;
        $fade['endms'] = $endms;
        $fade['startop'] = $startop;
        $fade['endop'] = $endop;

        $this->put($fade);
    }

    public function move($startms, $endms, $startx, $starty, $endx, $endy, $duration = 0, $easing = 0)
    {
        $args = array();
        if ( $this->_loop )
        {
            $args[] = '__M';
            $startms = $startms - $this->_loopstart;
            $endms = $duration + $startms;
        }
        else
        {
            $args[] = '_M';
        }
        
        $args[] = $easing;
        $args[] = $startms;
        $args[] = $endms;
        $args[] = $startx;
        $args[] = $starty;
        $args[] = $endx;
        $args[] = $endy;

        $this->put($args);
    }

    public function scale($startms, $endms, $startscale, $endscale, $duration = 0, $easing = 0)
    {
        $args = array();
        if ( $this->_loop )
        {
            $args[] = '__S';
            $startms = $startms - $this->_loopstart;
            $endms = $duration + $startms;
        }
        else
        {
            $args[] = '_S';
        }
        
        $args[] = $easing;
        $args[] = $startms;
        $args[] = $endms;
        $args[] = $startscale;
        $args[] = $endscale;

        $this->put($args);
    
    }

    public function rotate($startms, $endms, $startrotation, $endrotation, $duration = 0, $easing = 0)
    {
        $args = array();
        if ( $this->_loop )
        {
            $args[] = '__R';
            $startms = $startms - $this->_loopstart;
            $endms = $duration + $startms;
        }
        else
        {
            $args[] = '_R';
        }

        $args[] = $easing;
        $args[] = $startms;
        $args[] = $endms;
        $args[] = $startrotation;
        $args[] = $endrotation;

        $this->put($args);
    }

    public function initLoop($startms, $loopcount)
    {
        $args = array();
        $args[] = '_L';
        $args[] = $startms;
        $args[] = $loopcount;

        $this->put($args);

        $this->_loop = $loopcount;
        $this->_loopstart = $startms;
    }

    public function endLoop()
    {
        $this->_loop = false;
    }

    
}
?>