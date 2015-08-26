<?php

namespace Charcoal\Image\Effect;

use \InvalidArgumentException as InvalidArgumentException;

use \Charcoal\Image\AbstractEffect as AbstractEffect;

/**
* Flip an image horizontally or vertically.
*/
abstract class AbstractMirrorEffect extends AbstractEffect
{
    /**
    * Axis can be "x" (flip) or "y" (flop)
    * @var string $_axis
    */
    private $_axis = 'y';

    /**
    * @param array $data
    * @return AbstractMirrorEffect Chainable
    */
    public function set_data(array $data)
    {
        if (isset($data['axis']) && $data['axis'] !== null) {
            $this->set_axis($data['axis']);
        }
        return $this;
    }

    /**
    * @param string $axis
    * @throws InvalidArgumentException
    * @return AbstractMirrorEffect Chainable
    */
    public function set_axis($axis)
    {
        $allowed_vals = ['x', 'y'];
        if (!is_string($axis) || !in_array($axis, $allowed_vals)) {
            throw new InvalidArgumentException('Axis must be "x" or "y"');
        }
        $this->_axis = $axis;
        return $this;
    }

    /**
    * @return string
    */
    public function axis()
    {
        return $this->_axis;
    }
}