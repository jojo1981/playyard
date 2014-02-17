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

use Jojo1981\CompilerDesign\Token\TokenInterface;

/**
 * @category Jojo1981
 * @package CompilerDesign
 * @subpackage Lexer
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * Jojo1981\CompilerDesign\Lexer\LexerInterface
 */
interface LexerInterface
{
    /**
     * Move one character; detect EOF
     */
    public function consume();

    /**
     * @param int $tokenType
     * @return string
     */
    public function getTokenName($tokenType);

    /**
     * @throws \Exception
     * @return TokenInterface
     */
    public function getNextToken();
}
