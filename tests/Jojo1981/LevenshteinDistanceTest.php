<?php
/**
 * @category tests
 * @package Jojo1981
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace tests\Jojo1981;

use Jojo1981\LevenshteinDistance;

/**
 * tests\Jojo1981\LevenshteinDistanceTest
 */
class LevenshteinDistanceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LevenshteinDistance
     */
    private $levenshteinDistance;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->levenshteinDistance = new LevenshteinDistance();
    }

    /**
     * testGetDistance
     */
    public function testGetDistance()
    {
        $string1 = 'kitten';
        $string2 = 'sitting';
        $string3 = 'Saturday';
        $string4 = 'Sunday';

        $this->assertEquals(0, $this->levenshteinDistance->getDistance($string1, $string1));

        $this->assertEquals(6, $this->levenshteinDistance->getDistance($string1, ''));
        $this->assertEquals(6, $this->levenshteinDistance->getDistance('', $string1));
        $this->assertEquals(7, $this->levenshteinDistance->getDistance($string2, ''));
        $this->assertEquals(7, $this->levenshteinDistance->getDistance('', $string2));
        $this->assertEquals(3, $this->levenshteinDistance->getDistance($string1, $string2));
        $this->assertEquals(3, $this->levenshteinDistance->getDistance($string3, $string4));
        $this->assertEquals(3, $this->levenshteinDistance->getDistance($string1, $string2));
    }
}
 