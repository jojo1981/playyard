<?php
/**
 * @category spec
 * @package Jojo1981
 * @subpackage CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace spec\Jojo1981\CompilerDesign;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Jojo1981\CompilerDesign\ListLexer;

/**
 * @category spec
 * @package Jojo1981
 * @subpackage CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * spec\Jojo1981\CompilerDesign\ListLexerSpec
 *
 * @mixin ListLexer
 */
class ListLexerSpec extends ObjectBehavior
{
    /**
     * @var string
     */
    protected $input = '[a,b,c,d]';

    function let()
    {
        $this->beConstructedWith($this->input);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jojo1981\CompilerDesign\ListLexer');
    }

    function it_should_be_a_lexer()
    {
        $this->shouldImplement('Jojo1981\CompilerDesign\Lexer\LexerInterface');
    }

    function it_should_thrown_an_Exception_when_input_contains_an_invalid_character()
    {
        $this->beConstructedWith("(");

        $this->shouldThrow(new \Exception('invalid character: ('))->during('getNextToken');
    }

    function it_should_return_a_left_bracket_token_when_calling_getNextToken_for_the_first_time()
    {
        $this->getNextToken()->shouldBeAnInstanceOf('Jojo1981\CompilerDesign\Token\TokenInterface');
    }

    function it_should_do()
    {
        $this->beConstructedWith("aap [b  ,done
d]");

        $expectedTokenTypes = array(
            ListLexer::NAME,
            ListLexer::LEFT_BRACKET,
            ListLexer::NAME,
            ListLexer::COMMA,
            ListLexer::NAME,
            ListLexer::NAME,
            ListLexer::RIGHT_BRACKET,
            ListLexer::EOF_TYPE
        );

        foreach ($expectedTokenTypes as $expectedTokenType) {
            $token = $this->getNextToken();
            $token->getType()->shouldReturn($expectedTokenType);
        }
    }
}
