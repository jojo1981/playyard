<?php
/*
 * (c) Sqills Products B.V. 2015 <php-dev-enschede@sqills.com>
 */
namespace Jojo1981;

/**
 * Jojo1981\Promise
 */
class Promise
{
    /**
     * @var \Closure
     */
    private $callback;

    /**
     * @var \Closure
     */
    private $success;

    /**
     * @var \Closure
     */
    private $failure;

    /**
     * Constructor
     *
     * @param \Closure $callback
     */
    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
        $this->success = function() {};
        $this->failure = function() {};
    }

    /**
     * @param \Closure $success
     * @return $this
     */
    public function success(\Closure $success)
    {
        $this->success = $success;

        return $this;
    }

    /**
     * @param \Closure $failure
     * @return $this
     */
    public function failure(\Closure $failure)
    {
        $this->failure = $failure;

        return $this;
    }

    /**
     * @param null|mixed $context
     * @return $this
     */
    public function execute($context = null)
    {
        call_user_func_array(
            $this->callback,
            array(
                $this->success,
                $this->failure,
                $context
            )
        );

        return $this;
    }
}
