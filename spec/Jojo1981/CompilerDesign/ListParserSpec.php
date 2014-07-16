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
use Jojo1981\CompilerDesign\Lexer\LexerInterface;
use Jojo1981\CompilerDesign\Token\TokenInterface;
use Jojo1981\CompilerDesign\ListLexer;
use Jojo1981\CompilerDesign\ListParser;

/**
 * @category spec
 * @package Jojo1981
 * @subpackage CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * spec\Jojo1981\CompilerDesign\ListParserSpec
 *
 * @mixin ListParser
 */
class ListParserSpec extends ObjectBehavior
{
    /**
     * @var LexerInterface
     */
    protected $lexer;

    function let(LexerInterface $lexer)
    {
        $this->beConstructedWith($lexer);
        $this->lexer = $lexer;
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jojo1981\CompilerDesign\ListParser');
    }

    function it_should_be_a_parser()
    {
        $this->shouldImplement('Jojo1981\CompilerDesign\Parser\ParserInterface');
    }

    function it_should_thrown_an_exception_because_the_lexer_input_could_no_be_parsed_because_it_starts_with_a_right_bracket(
        TokenInterface $token
    ) {
        $token->getType()->willReturn(ListLexer::TOKEN_TYPE_RIGHT_BRACKET);
        $this->lexer->getNextToken()->willReturn($token);
        $this->lexer->getTokenName(ListLexer::TOKEN_TYPE_LEFT_BRACKET)->willReturn('LEFT BRACKET');
        $this->lexer->getTokenName(ListLexer::TOKEN_TYPE_RIGHT_BRACKET)->willReturn('RIGHT BRACKET');

        $this->shouldThrow(new \Exception('Expecting token: LEFT BRACKET Found token: RIGHT BRACKET'))->during('parse');
    }

    function it_should_thrown_an_exception_because_the_lexer_input_could_no_be_parsed_because_it_contains_two_commas_in_sequence()
    {
        $lexer = new ListLexer('[a,b,,c]');
        $this->beConstructedWith($lexer);

        $this->shouldThrow(new \Exception('Expecting token: NAME or LEFT BRACKET Found token: COMMA'))->during('parse');
    }

    function it_should_thrown_an_exception_because_the_lexer_input_could_no_be_parsed_because_it_contains_an_invalid_token()
    {
        $lexer = new ListLexer('[a,1,c]');
        $this->beConstructedWith($lexer);

        $this->shouldThrow(new \Exception('invalid character: 1'))->during('parse');
    }

    function it_should_not_throw_an_exception_because_the_lexer_input_is_valid_and_contains_one_list()
    {
        $lexer = new ListLexer('[a,hello,c]');
        $this->beConstructedWith($lexer);

        $this->parse();
    }

    function it_should_not_throw_an_exception_because_the_lexer_input_is_valid_and_contains_two_list()
    {
        $lexer = new ListLexer('[a,[z,x,q,m],m,and,or]');
        $this->beConstructedWith($lexer);

        $this->parse();
    }
}
