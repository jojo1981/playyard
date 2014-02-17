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
    function let()
    {
        $this->beConstructedWith('+');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jojo1981\Tree\BinaryTree\Node');
    }

    function it_should_return_the_left_node(Node $leftNode)
    {
        $this->setLeft($leftNode);
        $this->getLeft()->shouldReturn($leftNode);
    }

    function it_should_return_the_right_node(Node $rightNode)
    {
        $this->setRight($rightNode);
        $this->getRight()->shouldReturn($rightNode);
    }

    function it_should_return_the_label_which_is_set_when_constructing()
    {
        $this->getLabel()->shouldReturn('+');
    }

    function it_should_return_null_when_the_node_does_not_have_parent_node()
    {
        $this->getParent()->shouldReturn(null);
    }

    function it_should_return_the_parent_node_because_this_node_is_child_node(Node $rootNode)
    {
        $this->setParent($rootNode);
        $this->getParent()->shouldReturn($rootNode);
    }

    function it_should_return_true_because_this_node_is_the_root_node_without_children()
    {
        $this->isRootNode()->shouldReturn(true);
    }

    function it_should_return_true_because_this_node_is_the_root_node_with_children(
        Node $leftNode,
        Node $rightNode
    ) {
        $this->setLeft($leftNode);
        $this->setRight($rightNode);
        $this->isRootNode()->shouldReturn(true);
    }

    function it_should_return_false_because_this_node_is_a_childNode(Node $rootNode)
    {
        $this->setParent($rootNode);
        $this->isRootNode()->shouldReturn(false);
    }

    function it_should_return_false_because_this_node_is_not_a_leave_node_and_has_a_left_child(
        Node $leftNode
    ) {
        $this->setLeft($leftNode);
        $this->isLeaveNode()->shouldReturn(false);
    }

    function it_should_return_false_because_this_node_is_not_a_leave_node_and_has_a_right_child(
        Node $rightNode
    ) {
        $this->setRight($rightNode);
        $this->isLeaveNode()->shouldReturn(false);
    }

    function it_should_return_false_because_this_node_is_not_a_leave_node_and_has_childs(
        Node $leftNode,
        Node $rightNode
    )
    {
        $this->setLeft($leftNode);
        $this->setRight($rightNode);
        $this->isLeaveNode()->shouldReturn(false);
    }

    function it_should_return_true_because_this_root_node_is_a_leave_node_becaue_it_does_not_have_any_child()
    {
        $this->isLeaveNode()->shouldReturn(true);
    }

    function it_should_return_true_because_this_child_node_is_a_leave_node_becaue_it_does_not_have_any_child(
        Node $rootNode
    ) {
        $this->setParent($rootNode);
        $this->isLeaveNode()->shouldReturn(true);
    }
}
