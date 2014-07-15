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
use Jojo1981\LevenshteinDistance;

/**
 * @category spec
 * @package Jojo1981
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * spec\Jojo1981\LevenshteinDistanceSpec
 *
 * @mixin LevenshteinDistance
 */
class LevenshteinDistanceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Jojo1981\LevenshteinDistance');
    }

    function it_should_return_the_right_distance_between_some_strings()
    {
        $string1 = 'kitten';
        $string2 = 'sitting';
        $string3 = 'Saturday';
        $string4 = 'Sunday';
        $emptyString = '';

        $this->getDistance($string1, $string1 )->shouldReturn(0);
        $this->getDistance($string1, $emptyString)->shouldReturn(6);
        $this->getDistance($emptyString, $string1)->shouldReturn(6);
        $this->getDistance($string2, $emptyString)->shouldReturn(7);
        $this->getDistance($emptyString, $string2)->shouldReturn(7);
        $this->getDistance($string1, $string2)->shouldReturn(3);
        $this->getDistance($string3, $string4)->shouldReturn(3);
        $this->getDistance($string1, $string2)->shouldReturn(3);
    }
}
