<?php

namespace Charcoal\Image\Imagemagick\Effect;

use \Exception as Exception;

use \Charcoal\Image\Effect\AbstractThresholdEffect as AbstractThresholdEffect;

class ImagemagickThresholdEffect extends AbstractThresholdEffect
{
    /**
    * @param array $data
    * @return ImagickThresholdEffect Chainable
    */
    public function process(array $data = null)
    {
        if ($data !== null) {
            $this->set_data($data);
        }
        
        $value = ($this->threshold()*100).'%';
        $cmd = '-threshold '.$value;
        $this->image()->apply_cmd($cmd);
        return $this;
    }
}