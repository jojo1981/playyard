<?php
/**
 * @category Jojo1981
 * @package Tree
 * @subpackage BinaryTree
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace Jojo1981\Tree\BinaryTree;

/**
 * @category Jojo1981
 * @package Tree
 * @subpackage BinaryTree
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * Jojo1981\Tree\BinaryTree\Node
 *
 * Node class which is part of a binary tree structure.
 * A binary tree can have only two children per node, a left and a right
 * child node. The child nodes can also have two child nodes each.
 * The best binary tree is a balanced one. There are lots of algorithm's for
 * balancing trees like: red-black tree, AVL tree, AA tree and so on...
 * This is NOT a: Self-balancing binary search tree.
 *
 * Also convenient to know: binary tree can be search with the: Binary search
 * algorithm. split sorted tree (this is not a sorted tree) in two amd decide
 * if the searched item must be on the left or right side then split that part
 * again in two and so on... until you have found what you have been searching for.
 *
 * Big O notation (also called order n): Average case performance: O(log n)
 *
 * example:
 *
 * 1024 / 2 = 512
 * 512 / 2 = 256
 * 256 / 2 = 128
 * 128 / 2 = 64
 * 64 / 2 = 32
 * 32 / 2 = 16
 * 16 / 2 = 8
 * 8 / 2 = 4
 * 4 / 2 = 2
 * 2 / 2 = 1
 *
 * Ten steps max to find the value you're looking for.
 */
class Node
{
    /**
     * The left child node or null
     *
     * @var null|Node
     */
    protected $left;

    /**
     * The right child node or null
     *
     * @var null|Node
     */
    protected $right;

    /**
     * The parent node or null
     *
     * @var null|Node
     */
    protected $parent;

    /**
     * Label of the node.
     *
     * @var string
     */
    protected $label;

    /**
     * Callable function which will be triggered when set when the
     * pre-order point per node will be reached.
     *
     * @var null|\Closure
     */
    protected $visitPreOrderClosure;

    /**
     * Callable function which will be triggered when set when the
     * in-order point per node will be reached.
     *
     * @var null|\Closure
     */
    protected $visitInOrderClosure;

    /**
     * Callable function which will be triggered when set when the
     * post-order point per node will be reached.
     *
     * @var null|\Closure
     */
    protected $visitPostOrderClosure;

    /**
     * Constructor
     *
     * @param string $label
     */
    public function __construct($label)
    {
        $this->label = $label;
    }

    /**
     * Get the label of this node
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get parent when it exists, otherwise return null
     *
     * @return Node|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set left child node and return this node.
     *
     * @param Node $node
     * @return Node
     */
    public function setLeft(Node $node)
    {
        $this->left = $this->prepareChildNode($node);

        return $node;
    }

    /**
     * Get left child node if it exists, otherwise return null
     *
     * @return Node|null
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Set right child node and return this node.
     *
     * @param Node $node
     * @return Node
     */
    public function setRight(Node $node)
    {
        $this->right = $this->prepareChildNode($node);

        return $node;
    }

    /**
     * Get right child node if it exists, otherwise return null
     *
     * @return Node|null
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Set parent node to which this node will become a child.
     *
     * @param Node $node
     * @return Node
     */
    public function setParent(Node $node)
    {
        $this->parent = $node;

        return $this;
    }

    /**
     * Check if this node is a root node, a root node do not have
     * a parent node, a root node can have children but this is not
     * restricted to be a root node.
     *
     * @return bool
     */
    public function isRootNode()
    {
        return (!$this->parent instanceof Node);
    }

    /**
     * Check if this a leave node, a leave node do not have any children.
     *
     * @return bool
     */
    public function isLeaveNode()
    {
        return (!$this->left instanceof Node && !$this->right instanceof Node);
    }

    /**
     * Recursive travers method, Turn left at the root node and travel around
     * all the nodes in the tree. Throw events when passing the virtual points
     * called: pre order, in order and post order. When drawing a binary tree
     * on paper you can mark these point at the left, bottom and right side of
     * every node drawn as a circle, the connection lines to the left child node
     * and the right child node will be between these points.
     * The left child node connection line will be in between the left point (pre order)
     * and the bottom point (in order), the right child node connection line will
     * be in between the bottom point (in order) and the right point (post order).
     */
    public function traverse()
    {
        $this->visitPreOrder();
        if ($this->left instanceof Node) {
            $this->left->traverse();
        }
        $this->visitInOrder();
        if ($this->right instanceof Node) {
            $this->right->traverse();
        }
        $this->visitPostOrder();
    }

    /**
     * Set callback function to call when the traversing starts and per
     * node the in order position will be reached.
     *
     * @param \Closure $visitInOrderClosure
     * @return Node
     */
    public function setVisitInOrderClosure(\Closure $visitInOrderClosure)
    {
        $this->visitInOrderClosure = $visitInOrderClosure;
        if ($this->left instanceof Node) {
            $this->left->setVisitInOrderClosure($visitInOrderClosure);
        }
        if ($this->right instanceof Node) {
            $this->right->setVisitInOrderClosure($visitInOrderClosure);
        }

        return $this;
    }

    /**
     * Set callback function to call when the traversing starts and per
     * node the post order position will be reached.
     *
     * @param \Closure $visitPostOrderClosure
     * @return Node
     */
    public function setVisitPostOrderClosure(\Closure $visitPostOrderClosure)
    {
        $this->visitPostOrderClosure = $visitPostOrderClosure;
        if ($this->left instanceof Node) {
            $this->left->setVisitPostOrderClosure($visitPostOrderClosure);
        }
        if ($this->right instanceof Node) {
            $this->right->setVisitPostOrderClosure($visitPostOrderClosure);
        }

        return $this;
    }

    /**
     * Set callback function to call when the traversing starts and per
     * node the pre order position will be reached.
     *
     * @param \Closure $visitPreOrderClosure
     * @return Node
     */
    public function setVisitPreOrderClosure(\Closure $visitPreOrderClosure)
    {
        $this->visitPreOrderClosure = $visitPreOrderClosure;
        if ($this->left instanceof Node) {
            $this->left->setVisitPreOrderClosure($visitPreOrderClosure);
        }
        if ($this->right instanceof Node) {
            $this->right->setVisitPreOrderClosure($visitPreOrderClosure);
        }

        return $this;
    }

    /**
     * Will be called when the traversing is started and per node the
     * pre-order position is reached (pre-order = left point).
     */
    public function visitPreOrder()
    {
        if ($this->visitPreOrderClosure instanceof \Closure) {
            call_user_func_array($this->visitPreOrderClosure, array($this));
        }
    }

    /**
     * Will be called when the traversing is started and per node the
     * in-order position is reached (in-order = bottom point).
     */
    public function visitInOrder()
    {
        if ($this->visitInOrderClosure instanceof \Closure) {
            call_user_func_array($this->visitInOrderClosure, array($this));
        }
    }

    /**
     * Will be called when the traversing is started and per node the
     * post-order position is reached (post-order = right point).
     */
    public function visitPostOrder()
    {
        if ($this->visitPostOrderClosure instanceof \Closure) {
            call_user_func_array($this->visitPostOrderClosure, array($this));
        }
    }

    /**
     * The passed node will be a child node of this node and the callback
     * functions set in this node will also be passed to the child node.
     * When done return the passed child node back.
     *
     * @param Node $node
     * @return Node
     */
    protected function prepareChildNode(Node $node)
    {
        $node->setParent($this);

        if ($this->visitPreOrderClosure instanceof \Closure) {
            $node->setVisitPreOrderClosure($this->visitPreOrderClosure);
        }

        if ($this->visitInOrderClosure instanceof \Closure) {
            $node->setVisitInOrderClosure($this->visitInOrderClosure);
        }

        if ($this->visitPostOrderClosure instanceof \Closure) {
            $node->setVisitPostOrderClosure($this->visitPostOrderClosure);
        }

        return $node;
    }
}
