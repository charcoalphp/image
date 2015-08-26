<?php

namespace Charcoal\Image\Effect;

use \Exception as Exception;
use \InvalidArgumentException as InvalidArgumentException;

use \Charcoal\Image\AbstractEffect as AbstractEffect;

/**
* Resize an image to given dimensions
*/
abstract class AbstractResizeEffect extends AbstractEffect
{
    /**
    * @var string $_mode
    */
    private $_mode = 'auto';

    /**
    * @var integer $_width
    */
    private $_width = 0;
    /**
    * @var integer $_height
    */
    private $_height = 0;

    /**
    * @var integer $_min_width
    */
    private $_min_width = 0;
    /**
    * @var integer $_min_height
    */
    private $_min_height = 0;

    /**
    * @var integer $_max_width
    */
    private $_max_width = 0;
    /**
    * @var integer $_max_height
    */
    private $_max_height = 0;

    /**
    * @var string $_gravity
    */
    private $_gravity = 'center';

    /**
    * @var string $_background_color
    */
    private $_background_color = 'rgba(100%, 100%, 100%, 0)';

    /**
    * @var bool $adaptive
    */
    private $_adaptive = false;

    /**
    * @param array $data
    * @return AbstractResizeEffect Chainable
    */
    public function set_data(array $data)
    {
        if (isset($data['mode']) && $data['mode'] !== null) {
            $this->set_mode($data['mode']);
        }
        if (isset($data['width']) && $data['width'] !== null) {
            $this->set_width($data['width']);
        }
        if (isset($data['height']) && $data['height'] !== null) {
            $this->set_height($data['height']);
        }
        if (isset($data['min_width']) && $data['min_width'] !== null) {
            $this->set_min_width($data['min_width']);
        }
        if (isset($data['min_height']) && $data['min_height'] !== null) {
            $this->set_min_height($data['min_height']);
        }
        if (isset($data['max_width']) && $data['max_width'] !== null) {
            $this->set_max_width($data['max_width']);
        }
        if (isset($data['max_height']) && $data['max_height'] !== null) {
            $this->set_max_height($data['max_height']);
        }
        if (isset($data['gravity']) && $data['gravity'] !== null) {
            $this->set_gravity($data['gravity']);
        }
        if (isset($data['background_color']) && $data['background_color'] !== null) {
            $this->set_background_color($data['background_color']);
        }
        if (isset($data['adaptive']) && $data['adaptive'] !== null) {
            $this->set_adaptive($data['adaptive']);
        }
        return $this;
    }

    /**
    * @param string $mode
    * @throws InvalidArgumentException
    * @return AbstractResizeEffect Chainable
    */
    public function set_mode($mode)
    {
        $allowed_modes = [
            'auto',
            'exact',
            'width',
            'height',
            'best_fit',
            'crop',
            'fill',
            'none'
        ];
        if (!is_string($mode) || (!in_array($mode, $allowed_modes))) {
            throw new InvalidArgumentException('Mode is not valid');
        }
        $this->_mode = $mode;
        return $this;
    }

    /**
    * @return string
    */
    public function mode()
    {
        return $this->_mode;
    }

    /**
    * @param int $width
    * @throws InvalidArgumentException
    * @return Rotate Chainable
    */
    public function set_width($width)
    {
        if (!is_int($width) || ($width < 0)) {
            throw new InvalidArgumentException('Width must be a a positive integer');
        }
        $this->_width = $width;
        return $this;
    }

    /**
    * @return float
    */
    public function width()
    {
        return $this->_width;
    }

    /**
    * @param integer $height
    * @throws InvalidArgumentException
    * @return Rotate Chainable
    */
    public function set_height($height)
    {
        if (!is_int($height) || ($height < 0)) {
            throw new InvalidArgumentException('Height must be a positive integer');
        }
        $this->_height = $height;
        return $this;
    }

    /**
    * @return float
    */
    public function height()
    {
        return $this->_height;
    }

    /**
    * @param int $min_width
    * @throws InvalidArgumentException
    * @return Rotate Chainable
    */
    public function set_min_width($min_width)
    {
        if (!is_int($min_width) || ($min_width < 0)) {
            throw new InvalidArgumentException('Min Width must be a a positive integer');
        }
        $this->_min_width = $min_width;
        return $this;
    }

    /**
    * @return float
    */
    public function min_width()
    {
        return $this->_min_width;
    }

    /**
    * @param integer $min_height
    * @throws InvalidArgumentException
    * @return Rotate Chainable
    */
    public function set_min_height($min_height)
    {
        if (!is_int($min_height) || ($min_height < 0)) {
            throw new InvalidArgumentException('Min Height must be a positive integer');
        }
        $this->_min_height = $min_height;
        return $this;
    }

    /**
    * @return float
    */
    public function min_height()
    {
        return $this->_min_height;
    }

    /**
    * @param int $max_width
    * @throws InvalidArgumentException
    * @return Rotate Chainable
    */
    public function set_max_width($max_width)
    {
        if (!is_int($max_width) || ($max_width < 0)) {
            throw new InvalidArgumentException('Max Width must be a a positive integer');
        }
        $this->_max_width = $max_width;
        return $this;
    }

    /**
    * @return float
    */
    public function max_width()
    {
        return $this->_max_width;
    }

    /**
    * @param integer $max_height
    * @throws InvalidArgumentException
    * @return Rotate Chainable
    */
    public function set_max_height($max_height)
    {
        if (!is_int($max_height) || ($max_height < 0)) {
            throw new InvalidArgumentException('Height must be a positive integer');
        }
        $this->_max_height = $max_height;
        return $this;
    }

    /**
    * @return float
    */
    public function max_height()
    {
        return $this->_max_height;
    }

    /**
    * @param string $gravity
    * @throws InvalidArgumentException
    * @return AbstractWatermarkEffect Chainable
    */
    public function set_gravity($gravity)
    {
        if (!in_array($gravity, $this->image()->available_gravities())) {
            throw new InvalidArgumentException('Gravity is not valid');
        }
        $this->_gravity = $gravity;
        return $this;
    }

    /**
    * @return string
    */
    public function gravity()
    {
        return $this->_gravity;
    }

    /**
    * @param string $color
    * @throws InvalidArgumentException
    * @return AbstractRotateEffect Chainable
    */
    public function set_background_color($color)
    {
        if (!is_string($color)) {
            throw new InvalidArgumentException('Color must be a string');
        }
        $this->_background_color = $color;
        return $this;
    }

    /**
    * @return string
    */
    public function background_color()
    {
        return $this->_background_color;
    }


    /**
    * @param boolean $adaptive
    * @throws InvalidArgumentException
    * @return AbstractRotateEffect Chainable
    */
    public function set_adaptive($adaptive)
    {
        if (!is_bool($adaptive)) {
            throw new InvalidArgumentException('Adaptive flag must be a boolean');
        }
        $this->_adaptive = $adaptive;
        return $this;
    }

    /**
    * @return boolean
    */
    public function adaptive()
    {
        return $this->_adaptive;
    }

    /**
    * @return string
    */
    public function auto_mode()
    {
        $width = $this->width();
        $height = $this->height();

        if ($width > 0 && $height > 0) {
            return 'exact';
        } elseif ($width > 0) {
            return 'width';
        } elseif ($height > 0) {
            return 'height';
        } else {
            if ($this->min_width() || $this->min_height() || $this->max_width() || $this->max_height()) {
                return 'constraints';
            } else {
                return 'none';
            }
        }
    }

    /**
    * @param array $data
    * @throws Exception
    * @return AbstractResizeEffect Chainable
    */
    public function process(array $data = null)
    {
        if ($data !== null) {
            $this->set_data($data);
        }

        $mode = $this->mode();
        if ($mode == 'auto') {
            $mode = $this->auto_mode();
        }

        if ($mode == 'none') {
            return;
        }

        $img_w = $this->image()->width();
        $img_h = $this->image()->height();

        switch ($mode) {
            case 'exact':
                if (($this->width() <= 0) || ($this->height() <= 0)) {
                    throw new Exception('Missing parameters to perform exact resize');
                }
                if ($img_w != $this->width() || $img_h != $this->height()) {
                    $this->do_resize($this->width(), $this->height(), false);
                }
                break;

            case 'width':
                if ($this->width() <= 0) {
                    throw new Exception('Missing parameters to perform exact width resize');
                }
                if ($img_w != $this->width()) {
                    $this->do_resize($this->width(), 0, false);
                }
                break;

            case 'height':
                if ($this->height() <= 0) {
                    throw new Exception('Missing parameters to perform exact height resize');
                }
                if ($img_h != $this->height()) {
                    $this->do_resize(0, $this->height(), false);
                }
                break;

            case 'best_fit':
                if (($this->width() <= 0) || ($this->height() <= 0)) {
                    throw new Exception('Missing parameters to perform "best fit" resize');
                }
                if ($img_w != $this->width() || $img_h != $this->height()) {
                    $this->do_resize($this->width(), $this->height(), true);
                }
                break;

            case 'constraints':
                $min_w = $this->min_width();
                $min_h = $this->min_height();
                $max_w = $this->max_width();
                $max_h = $this->max_height();

                if (array_sum([$min_w, $min_h, $max_w, $max_h]) == 0) {
                    throw new Exception('Missing parameter(s) to perform "constraints" resize');
                }

                if (($min_w && ($min_w > $img_w)) || ($min_h && ($min_h > $img_h))) {
                    // Must scale up, keeping ratio
                    $this->do_resize($min_w, $min_h, true);
                    break;
                }

                if (($max_w && ($max_w < $img_w)) || ($max_h && ($max_h < $img_h))) {
                    // Must scale down. keeping ratio
                    $this->do_resize($max_w, $max_h, true);
                    break;
                }
                break;

            case 'crop':
                $ratio = $this->image()->ratio();

                throw new Exception('Crop resize mode is not (yet) supported');
                //break;

            case 'fill':
                $img_class = get_class($this->image());
                $canvas = new $img_class;
                $canvas->create($this->width(), $this->width(), $this->background_color());
                throw new Exception('Crop resize mode is not (yet) supported');
                //break;
        }

        return $this;
    }

    /**
    * @param integer $width
    * @param integer $height
    * @param boolean $best_fit
    * @return void
    */
    abstract protected function do_resize($width, $height, $best_fit = false);
}