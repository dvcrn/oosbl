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

    public function put($array)
    {
        echo '<p>' . implode(",", $array) . '</p>';
    }

    public function sprite($layer, $origin, $filepath, $x = 320, $y = 240)
    {
        $args = array();
        $args[] = 'Sprite';
        $args[] = '"'.$layer.'"';
        $args[] = '"'.$origin.'"';
        $args[] = '"'.$filepath.'"';
        $args[] = $x;
        $args[] = $y;

        $this->put($args);
    }

    public function fade($startms, $endms, $startop = 0, $endop = 1, $easing = 0)
    {
        $fade = array();
        $fade['name'] = '_F';
        $fade['easing'] = $easing;
        $fade['startms'] = $startms;
        $fade['endms'] = $endms;
        $fade['startop'] = $startop;
        $fade['endop'] = $endop;

        $this->put($fade);
    }

    public function move($startms, $endms, $startx, $starty, $endx, $endy, $easing = 0)
    {
        $args = array();
        $args[] = '_M';
        $args[] = $easing;
        $args[] = $startms;
        $args[] = $endms;
        $args[] = $startx;
        $args[] = $starty;
        $args[] = $endx;
        $args[] = $endy;

        $this->put($args);
    }

    public function scale($startms, $endms, $startscale, $endscale, $easing = 0)
    {
        $args = array();
        $args[] = '_S';
        $args[] = $easing;
        $args[] = $startms;
        $args[] = $endms;
        $args[] = $startscale;
        $args[] = $endscale;

        $this->put($args);
    
    }

    
}
?>