<?php

namespace Charcoals\Tests\Image\Effect;

class AbstractMaskEffectTest extends \PHPUnit\Framework\TestCase
{
    public $obj;

    protected function setUp(): void
    {
        $img = $this->getMockForAbstractClass('\Charcoal\Image\AbstractImage');
        $img->method('driverType')->willReturn('imagick');
        $this->obj = $this->getMockForAbstractClass('\Charcoal\Image\Effect\AbstractMaskEffect');
        $this->obj->setImage($img);
    }

    public function testDefaults()
    {
        $obj = $this->obj;

        $this->assertEquals(1.0, $obj->opacity());
        $this->assertEquals('nw', $obj->gravity());
        $this->assertEquals(0, $obj->x());
        $this->assertEquals(0, $obj->y());
    }

    public function testSetData()
    {
        $obj = $this->obj;
        $ret = $obj->setData(
            [
            'mask'=>'foo/bar.png',
            'opacity'=>0.5,
            'gravity'=>'se',
            'x'=>-10,
            'y'=>20
            ]
        );
        $this->assertSame($ret, $obj);

        $this->assertEquals('foo/bar.png', $obj->mask());
        $this->assertEquals(0.5, $obj->opacity());
        $this->assertEquals('se', $obj->gravity());
        $this->assertEquals(-10, $obj->x());
        $this->assertEquals(20, $obj->y());
    }

    public function testSetMask()
    {
        $obj = $this->obj;
        $ret = $obj->setMask('bar/baz.png');
        $this->assertSame($ret, $obj);
        $this->assertEquals('bar/baz.png', $obj->mask());

        $this->expectException('\InvalidArgumentException');
        $obj->setMask(false);
    }

    public function testSetOpacity()
    {
        $obj = $this->obj;
        $ret = $obj->setOpacity(0.42);
        $this->assertSame($ret, $obj);
        $this->assertEquals(0.42, $obj->opacity());

        $this->expectException('\InvalidArgumentException');
        $obj->setOpacity(false);
    }

    public function testSetGravity()
    {
        $obj = $this->obj;
        $ret = $obj->setGravity('se');
        $this->assertSame($ret, $obj);
        $this->assertEquals('se', $obj->gravity());

        $this->expectException('\InvalidArgumentException');
        $obj->setGravity('foobar');
    }

    public function testSetX()
    {
        $obj = $this->obj;
        $ret = $obj->setX(15);
        $this->assertSame($ret, $obj);
        $this->assertEquals(15, $obj->x());

        $this->expectException('\InvalidArgumentException');
        $obj->setX(false);
    }

    public function testSetY()
    {
        $obj = $this->obj;
        $ret = $obj->setY(15);
        $this->assertSame($ret, $obj);
        $this->assertEquals(15, $obj->y());

        $this->expectException('\InvalidArgumentException');
        $obj->setY(false);
    }
}
