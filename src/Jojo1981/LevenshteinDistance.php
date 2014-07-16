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
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
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

            $vectorMap1 = $this->buildVectorMap1($string2);
            $vectorMap2 = array();

            for ($i = 0; $i < strlen($string1); $i++) {
                $vectorMap2[0] = $i + 1;
                for ($j = 0; $j < strlen($string2); $j++) {
                    $cost = ($string1[$i] == $string2[$j] ? 0 : 1);
                    $vectorMap2[$j + 1] = min($vectorMap2[$j] + 1, $vectorMap1[$j + 1] + 1, $vectorMap1[$j] + $cost);
                }
                for ($j = 0; $j < count($vectorMap1); $j++) {
                    $vectorMap1[$j] = $vectorMap2[$j];
                }
            }

            $result = $vectorMap2[strlen($string2)];
        }

        return $result;
    }

    /**
     * @param string $string
     * @return array
     */
    private function buildVectorMap1($string)
    {
        $vectorMap = array();
        for ($i = 0; $i <= strlen($string); $i++) {
            $vectorMap[$i] = $i;
        }

        return $vectorMap;
    }
}
 