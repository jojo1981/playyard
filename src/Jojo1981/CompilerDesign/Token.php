<?php
/**
 * @category Jojo1981
 * @package CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace Jojo1981\CompilerDesign;

use Jojo1981\CompilerDesign\Token\TokenInterface;
use Jojo1981\CompilerDesign\Lexer\LexerInterface;

/**
 * @category Jojo1981
 * @package CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * Jojo1981\CompilerDesign\Token
 */
class Token implements TokenInterface
{
    /**
     * @var LexerInterface
     */
    private $lexer;

    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $type;

    /**
     * {@inheritDoc}
     */
    public function __construct($type, $text, LexerInterface $lexer)
    {
        $this->type = $type;
        $this->text = $text;
        $this->lexer = $lexer;
    }

    /**
     * {@inheritDoc}
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        $typeName = $this->lexer->getTokenName($this->type);

        return "<'" . $this->text . "'," . $typeName . ">";
    }
}
