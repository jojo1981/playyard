<?php
/**
 * @category Jojo1981
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace Jojo1981;

/**
 * @category Jojo1981
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * Source is acknowledged: http://en.wikipedia.org/wiki/Levenshtein_distance
 *
 * Jojo1981\LevenshteinDistance
 */
class LevenshteinDistance
{
    /**
     * Get the distance between $string1 and $string2
     *
     * @param string $string1
     * @param string $string2
     * @return int
     */
    public function getDistance($string1, $string2)
    {
        $result = null;
        switch (true) {
            case ($string1 == $string2):
                $result = 0;
                break;
            case (strlen($string1) == 0 ):
                $result = strlen($string2);
                break;
            case (strlen($string2) == 0 ):
                $result = strlen($string1);
                break;
        }

        if ($result === null) {

            $v0 = array();
            $v1 = array();

            for ($i = 0; $i <= strlen($string2); $i++) {
                $v0[$i] = $i;
            }

            for ($i = 0; $i < strlen($string1); $i++) {
                $v1[0] = $i + 1;
                for ($j = 0; $j < strlen($string2); $j++) {
                    $cost = ($string1[$i] == $string2[$j] ? 0 : 1);
                    $v1[$j + 1] = min($v1[$j] + 1, $v0[$j + 1] + 1, $v0[$j] + $cost);
                }
                for ($j = 0; $j < count($v0); $j++) {
                    $v0[$j] = $v1[$j];
                }
            }

            $result = $v1[strlen($string2)];
        }

        return $result;
    }
}
 