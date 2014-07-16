<?php
/**
 * @category Jojo1981
 * @package CompilerDesign
 * @subpackage Lexer
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace Jojo1981\CompilerDesign\Lexer;

/**
 * @category Jojo1981
 * @package CompilerDesign
 * @subpackage Lexer
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * Jojo1981\CompilerDesign\Lexer\LexerAbstract
 */
abstract class LexerAbstract implements LexerInterface
{
    /** Token type constants */
    const EOF = -1; // represent end of file char

    /** Token type constants */
    const TOKEN_TYPE_NA   = 0;  // Not available token type
    const TOKEN_TYPE_EOF  = 1;  // represent EOF token type

    /**
     * @var string
     */
    private $currentChar;

    /**
     * @var string
     */
    private $input;

    /**
     * @var int
     */
    private $position = 0;

    /**
     * Constructor
     *
     * @param string $input
     */
    public function __construct($input)
    {
        $this->input = $input;
        $this->currentChar = substr($input, $this->position, 1);
    }

    /**
     * {@inheritDoc}
     */
    public function consume()
    {
        $this->position++;

        if ($this->position >= strlen($this->input)) {
            $this->currentChar = self::EOF;
        } else {
            $this->currentChar = substr($this->input, $this->position, 1);
        }
    }

    /**
     * @return string
     */
    protected function getCurrentChar()
    {
        return $this->currentChar;
    }

    /**
     * Skip white space and move on until an other character will be found
     * That character will be the current character
     */
    protected function skipWhiteSpace()
    {
        while (ctype_space($this->getCurrentChar())) {
            $this->consume();
        }
    }
}
