<?php
/**
 * @category tests
 * @package Jojo1981
 * @subpackage CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace tests\Jojo1981\CompilerDesign;

use Jojo1981\CompilerDesign\ListParser;
use Jojo1981\CompilerDesign\ListLexer;

/**
 * @category tests
 * @package Jojo1981
 * @subpackage CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * tests\Jojo1981\CompilerDesign\ListParserTest
 */
class ListParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParseShouldThrowAnExceptionBecauseLexerInputStartsWithALeftBracket()
    {
        $lexer = new ListLexer(']a,b,c]');

        $this->setExpectedException(
            '\Exception',
            'Expecting token: LEFT BRACKET Found token: RIGHT BRACKET'
        );

        $parser = new ListParser($lexer);
        $parser->parse();
    }

    public function testParseShouldThrowAnExceptionBecauseLexerInputContainsTwoCommasInSequence()
    {
        $lexer = new ListLexer('[a,b,,c]');

        $this->setExpectedException(
            '\Exception',
            'Expecting token: NAME or LEFT BRACKET Found token: COMMA'
        );

        $parser = new ListParser($lexer);
        $parser->parse();
    }

    public function testParseShouldThrowAnExceptionBecauseLexerInputContainsAnInvalidCharacter()
    {
        $lexer = new ListLexer('[a,2,c]');

        $this->setExpectedException(
            '\Exception',
            'invalid character: 2'
        );

        $parser = new ListParser($lexer);
        $parser->parse();
    }

    public function testParseShouldNotThrowAnExceptionBecauseTheLexerInputIsValid()
    {
        $lexer = new ListLexer('[a,hello,c,d]');

        $parser = new ListParser($lexer);
        $parser->parse();
    }

    public function testParseShouldNotThrowAnExceptionBecauseTheLexerInputIsValidAndHasASubSequence()
    {
        $lexer = new ListLexer('[a,hello,[c,y,h],d]');

        $parser = new ListParser($lexer);
        $parser->parse();
    }
}

