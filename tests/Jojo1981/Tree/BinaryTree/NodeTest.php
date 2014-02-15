<?php
/**
 * @category tests
 * @package Jojo1981
 * @subpackage Tree
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace tests\Jojo1981\Tree\BinaryTree;

use Jojo1981\Tree\BinaryTree\Node;

/**
 * @category tests
 * @package Jojo1981
 * @subpackage Tree
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * tests\Jojo1981\Tree\BinaryTree\NodeTest
 */
class NodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Node
     */
    protected $binaryExpressionTree;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $rootNode = new Node('+');
        $rootNode
            ->setLeft(new Node('3'))
                ->getParent()
            ->setRight(new Node('/'))
                ->setLeft(new Node('*'))
                    ->setLeft(new Node('4'))
                    ->getParent()
                ->setRight(new Node('2'))
                    ->getParent()
                ->getParent()
                ->setRight(new Node('^'))
                    ->setLeft(new Node('-'))
                        ->setLeft(new Node('1'))
                        ->getParent()
                    ->setRight(new Node('5'))
                    ->getParent()
                ->getParent()
                    ->setRight(new Node('^'))
                        ->setLeft(new Node('2'))
                        ->getParent()
                    ->setRight(new Node('3'))
                        ->getParent()
                    ->getParent()
                ->getParent()
            ->getParent()
        ;

        $this->binaryExpressionTree = $rootNode;
    }

    public function testBinaryTreeExpressionTraversWhileOnlyEchoingTheLabelWhenPassingThePostOrderShouldResultInAPostFixNotation()
    {
        $result = '';

        $this->binaryExpressionTree->setVisitPostOrderClosure(function(Node $node) use (&$result) {
            $result .= $node->getLabel() . ' ';
        });

        $this->binaryExpressionTree->traverse();
        $result = trim(preg_replace('/\s+/', ' ', $result));

        $this->assertEquals('3 4 2 * 1 5 - 2 3 ^ ^ / +', $result);
    }

    public function testBinaryTreeExpressionTraversWhileOnlyEchoingTheLabelWhenPassingThePreOrderShouldResultInAPreFixNotation()
    {
        $result = '';

        $this->binaryExpressionTree->setVisitPreOrderClosure(function(Node $node) use (&$result) {
            $result .= $node->getLabel() . ' ';
        });

        $this->binaryExpressionTree->traverse();
        $result = trim(preg_replace('/\s+/', ' ', $result));

        $this->assertEquals('+ 3 / * 4 2 ^ - 1 5 ^ 2 3', $result);
    }

    public function testBinaryTreeExpressionTraversWhileEchoingAParenthesisOpenWhenPassingThePreOrderAndEchoingTheLabelWhenPassingTheInOrderAndEchoingAParenthesisCloseWhenPassingThePostOrderShouldReturnAnInfixNotation()
    {
        $result = '';

        $this->binaryExpressionTree->setVisitPreOrderClosure(function(Node $node) use (&$result) {
            if (!$node->isLeaveNode() && !$node->isRootNode()) {
                $result .= '(';
            }
        });
        $this->binaryExpressionTree->setVisitInOrderClosure(function(Node $node) use (&$result) {
            $result .= ' ' . $node->getLabel() . ' ';
        });
        $this->binaryExpressionTree->setVisitPostOrderClosure(function(Node $node) use (&$result) {
            if (!$node->isLeaveNode() && !$node->isRootNode()) {
                $result .= ')';
            }
        });

        $this->binaryExpressionTree->traverse();
        $result = trim(preg_replace('/\s+/', ' ', $result));

        $this->assertEquals('3 + (( 4 * 2 ) / (( 1 - 5 ) ^ ( 2 ^ 3 )))', $result);
    }
}
