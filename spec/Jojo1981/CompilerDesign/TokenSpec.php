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

use Jojo1981\CompilerDesign\Lexer\LexerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Jojo1981\CompilerDesign\Token;

/**
 * @category spec
 * @package Jojo1981
 * @subpackage CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * spec\Jojo1981\CompilerDesign\TokenSpec
 *
 * @mixin Token
 */
class TokenSpec extends ObjectBehavior
{
    /**
     * @var LexerInterface
     */
    protected $lexer;

    function let(LexerInterface $lexer)
    {
        $this->beConstructedWith(0, '*', $lexer);
        $this->lexer = $lexer;
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jojo1981\CompilerDesign\Token');
    }

    function it_should_be_a_token()
    {
        $this->shouldImplement('Jojo1981\CompilerDesign\Token\TokenInterface');
    }

    function it_should_return_not_available_string_when_initialize_with_unknow_char_an_convert_object_to_a_string()
    {
        $this->lexer->getTokenName(0)->willReturn('n/a');
        $this->lexer->getTokenName(0)->shouldBeCalledTimes(1);

        $this->__toString()->shouldReturn('<\'*\',n/a>');
    }

    function it_should_return_the_text_which_is_injected_by_the_constructor_by_the_second_argument_when_getText_is_called()
    {
        $this->getText()->shouldReturn('*');
    }

    function it_should_return_the_token_type_which_is_injected_by_the_constructor_by_the_first_argument_when_getType_is_called()
    {
        $this->getType()->shouldReturn(0);
    }
}
