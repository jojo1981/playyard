<?php
/**
 * @category Jojo1981
 * @package CompilerDesign
 * @subpackage Parser
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace Jojo1981\CompilerDesign\Parser;

use Jojo1981\CompilerDesign\Lexer\LexerInterface;

/**
 * @category Jojo1981
 * @package CompilerDesign
 * @subpackage Parser
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * Jojo1981\CompilerDesign\Parser\ParserInterface
 */
interface ParserInterface
{
    /**
     * Start parsing the lexer input thrown an exception if parsing failed.
     * If no exception has been thrown the parsing has been successfully
     *
     * @throws \Exception
     */
    public function parse();
}
