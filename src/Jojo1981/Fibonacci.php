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
 * Jojo1981\Fibonacci
 */
class Fibonacci
{
    /**
     * @var bool
     */
    private $useCache = true;

    /**
     * @var array
     */
    private $cache = array();

    /**
     * @var int
     */
    private $max = 1000;

    /**
     * @return $this
     */
    public function enableCache()
    {
        $this->useCache = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function disableCache()
    {
        $this->useCache = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function isCacheEnabled()
    {
        return $this->useCache;
    }

    /**
     * @param int $inputInteger
     * @return int
     */
    public function calculate($inputInteger)
    {
        if ($this->useCache) {
            $result = $this->runUsingCache($inputInteger);
        } else {
            $result = $this->runWithoutUsingCache($inputInteger);
        }

        return $result;
    }

    /**
     * @param int $inputInteger
     * @throws \Exception
     * @return int
     */
    private function runUsingCache($inputInteger)
    {
        if (!$this->hasCache()) {
            $this->buildCache();
        }

        if ($inputInteger > $this->max) {
            throw new \Exception(sprintf(
                'Max lookup index: %s. Passed index: %s',
                $this->max,
                $inputInteger
            ));
        }

        return $this->cache[$inputInteger];
    }

    /**
     * @param int $inputInteger
     * @return int
     */
    private function runWithoutUsingCache($inputInteger)
    {
        $result = 0;

        if ($inputInteger == 0 || $inputInteger == 1) {
            $result = $inputInteger;
        } else {
            for ($i = 2; $i <= $inputInteger; $i++) {
                $result = $this->runUsingCache($i-1) + $this->runUsingCache($i-2);
            }
        }

        return $result;
    }

    /**
     * Build up te cache
     */
    private function buildCache()
    {
        if (!$this->hasCache()) {
            $this->cache = array(0,1);
            $counter = 0;

            $step1 = 0;
            $step2 = 1;

            while ($counter < $this->max - 2) {
                $counter++;
                $result = $step1 + $step2;
                $this->cache[] = $result;
                $step1 = $step2;
                $step2 = $result;
            }
        }
    }

    /**
     * @return bool
     */
    private function hasCache()
    {
        return !empty($this->cache);
    }
}
 