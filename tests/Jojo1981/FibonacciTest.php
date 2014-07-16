<?php
/**
 * @category tests
 * @package Jojo1981
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace tests\Jojo1981;

use Jojo1981\Fibonacci;

/**
 * @category tests
 * @package Jojo1981
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * tests\Jojo1981\FibonacciTest
 */
class FibonacciTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Fibonacci
     */
    private $fibonacci;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->fibonacci = new Fibonacci();
    }

    /**
     * test it should return true when cache is enabled
     */
    public function testItShouldReturnTrueWhenCacheIsEnabled()
    {
        $this->fibonacci->enableCache();
        $this->assertTrue($this->fibonacci->isCacheEnabled());
    }

    /**
     * test it should return false when cache is disabled
     */
    public function testItShouldReturnFalseWhenCacheIsDisabled()
    {
        $this->fibonacci->disableCache();
        $this->assertFalse($this->fibonacci->isCacheEnabled());
    }

    /**
     * test calculate method while cache is enabled
     */
    public function testCalculateWhileCacheIsEnabled()
    {
        $this->fibonacci->enableCache();

        foreach ($this->getRows() as $index => $expected) {
            $this->assertEquals($expected, $this->fibonacci->calculate($index));
        }
    }

    /**
     * test calculate method while cache is disabled
     */
    public function testCalculateWhileCacheIsDisabled()
    {
        $this->fibonacci->disableCache();

        foreach ($this->getRows() as $index => $expected) {
            $this->assertEquals($expected, $this->fibonacci->calculate($index));
        }
    }

    /**
     * test calculate method using a value higher than thousand and with cache enabled should throw an exception
     */
    public function testCalculateUsingAValueHigherThanThousandAndWithCacheEnabledShouldThrowAnException()
    {
        $this->fibonacci->enableCache();

        $this->setExpectedException(
            '\Exception',
            'Max lookup index: 1000. Passed index: 1001'
        );

        return $this->fibonacci->calculate(1001);
    }

    /**
     * @return array
     */
    private function getRows()
    {
        return array(
            0, 1, 1, 2, 3, 5, 8, 13, 21, 34,
            55, 89, 144, 233, 377, 610, 987,
            1597, 2584, 4181, 6765, 10946
        );
    }
}
 