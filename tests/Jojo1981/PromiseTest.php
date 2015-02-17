<?php
/*
 * (c) Sqills Products B.V. 2015 <php-dev-enschede@sqills.com>
 */
namespace tests\Jojo1981;

use Jojo1981\Promise;

/**
 * tests\Jojo1981\PromiseTest
 */
class PromiseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Promise
     */
    private $promise;

    /**
     * @var null|bool
     */
    public $state;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $callback = function(\CLosure $success, \CLosure $failure, $context) {
            if ($context === 'success') {
                call_user_func_array($success, array());
            } else {
                call_user_func_array($failure, array());
            }
        };

        $this->state = null;
        $that = $this;

        $this->promise = new Promise($callback);
        $this->promise
            ->success(
                function() use ($that) {
                    $that->state = true;
                }
            )->failure(
                function () use ($that) {
                    $that->state = false;
                }
            )
        ;
    }

    public function testPromiseWhichSucceeded()
    {
        $this->promise->execute('success');
        $this->assertTrue($this->state);
    }

    public function testPromiseWhichFailed()
    {
        $this->promise->execute();
        $this->assertFalse($this->state);
    }
}
