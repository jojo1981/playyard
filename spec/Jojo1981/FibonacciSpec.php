<?php
/**
 * @category spec
 * @package Jojo1981
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace spec\Jojo1981;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Jojo1981\Fibonacci;
/**
 * @category spec
 * @package Jojo1981
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * spec\Jojo1981\FibonacciSpec
 *
 * @mixin Fibonacci
 */
class FibonacciSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Jojo1981\Fibonacci');
    }

    function it_should_return_true_when_cache_is_enabled()
    {
        $this->enableCache();
        $this->isCacheEnabled()->shouldReturn(true);
    }

    function it_should_return_false_when_cache_is_disabled()
    {
        $this->disableCache();
        $this->isCacheEnabled()->shouldReturn(false);
    }

    function it_should_return_the_correct_value_when_calculate_is_called_and_caching_is_enabled()
    {
        $this->enableCache();

        foreach ($this->getRows() as $index => $expected) {
            $this->calculate($index)->shouldReturn($expected);
        }
    }

    function it_should_return_the_correct_value_when_calculate_is_called_and_caching_is_disabled()
    {
        $this->disableCache();

        foreach ($this->getRows() as $index => $expected) {
            $this->calculate($index)->shouldReturn($expected);
        }
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
