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

use Jojo1981\CompilerDesign\Token;
use Jojo1981\CompilerDesign\Lexer\LexerInterface;
use Jojo1981\CompilerDesign\ListLexer;

/**
 * @category tests
 * @package Jojo1981
 * @subpackage CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * tests\Jojo1981\CompilerDesign\TokenTest
 */
class TokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Token
     */
    private $token;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        /** @var LexerInterface $lexer */
        $lexer = $this->getMock('Jojo1981\CompilerDesign\Lexer\LexerInterface');

        $this->token = new Token(ListLexer::TOKEN_TYPE_RIGHT_BRACKET, ']', $lexer);
    }

    public function testGetTextShouldReturnAStringContainingOnlyOneRightBracketCharacter()
    {
        $this->assertEquals(']', $this->token->getText());
    }

    public function testGetTypeShouldReturnRightBracketTypeWhichIsPassedAsFirstArgumentToTheConstructor()
    {
        $this->assertEquals(ListLexer::TOKEN_TYPE_RIGHT_BRACKET, $this->token->getType());
    }

    public function testConvertObjectToAStringShouldReturnTheStringRepresentationOfTheToken()
    {
        $lexer = $this->getMock('Jojo1981\CompilerDesign\Lexer\LexerInterface');
        $lexer->expects($this->once())
              ->method('getTokenName')
              ->with($this->equalTo(ListLexer::TOKEN_TYPE_RIGHT_BRACKET))
              ->will($this->returnValue('RIGHT_BRACKET'))
        ;

        /** @var LexerInterface $lexer */
        $token = new Token(ListLexer::TOKEN_TYPE_RIGHT_BRACKET, ']', $lexer);

        $this->assertEquals('<\']\',RIGHT_BRACKET>', (string) $token);
    }
}

