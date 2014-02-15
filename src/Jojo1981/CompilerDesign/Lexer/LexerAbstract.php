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
    /* Token type constants */
    const EOF       = -1; // represent end of file char
    const EOF_TYPE  = 1;  // represent EOF token type

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
     * {@inheritDoc}
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
     * @return string
     */
    protected function getInput()
    {
        return $this->input;
    }

    /**
     * @return int
     */
    protected function getPosition()
    {
        return $this->position;
    }
}
