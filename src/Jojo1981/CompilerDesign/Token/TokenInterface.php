<?php
/**
 * @category Jojo1981
 * @package CompilerDesign
 * @subpackage Token
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace Jojo1981\CompilerDesign\Token;

use Jojo1981\CompilerDesign\Lexer\LexerInterface;

/**
 * @category Jojo1981
 * @package CompilerDesign
 * @subpackage Token
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * Jojo1981\CompilerDesign\Token\TokenInterface
 */
interface TokenInterface
{
    /**
     * Constructor
     *
     * @param int $type
     * @param string $text
     * @param LexerInterface $lexer
     */
    public function __construct($type, $text, LexerInterface $lexer);

    /**
     * @return string
     */
    public function __toString();

    /**
     * @return string
     */
    public function getText();

    /**
     * @return int
     */
    public function getType();
}
