<?php
/**
 * @category spec
 * @package Jojo1981
 * @subpackage Tree
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace spec\Jojo1981\Tree\BinaryTree;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Jojo1981\Tree\BinaryTree\Node;

/**
 * @category spec
 * @package Jojo1981
 * @subpackage Tree
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * spec\Jojo1981\Tree\BinaryTree\NodeSpec
 *
 * @mixin Node
 */
class NodeSpec extends ObjectBehavior
{
    /**
     * @var Node
     */
    protected $node1;

    /**
     * @var Node
     */
    protected $node2;

    function let(
        Node $node1,
        Node $node2
    ) {
        $this->beConstructedWith('+');
        $this->setLeft($node1);
        $this->setRight($node2);

        $this->node1 = $node1;
        $this->node2 = $node2;
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jojo1981\Tree\BinaryTree\Node');
    }

    function it_should_return_the_left_node()
    {
        $this->getLeft()->shouldReturn($this->node1);
    }

    function it_should_return_the_right_node()
    {
        $this->getRight()->shouldReturn($this->node2);
    }
}
