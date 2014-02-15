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

use Jojo1981\CompilerDesign\ListLexer;

/**
 * @category tests
 * @package Jojo1981
 * @subpackage CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * tests\Jojo1981\CompilerDesign\ListLexerTest
 */
class ListLexerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ListLexer
     */
    private $listLexer;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $this->listLexer = new ListLexer('[a,b,c,d]');
    }

    public function testGetNextTokenShouldReturnUntilTheWholeInputIsParsed10ValidTokensWithoutThrowingAnException()
    {
        $tokens = array();

        do {
            $token = $this->listLexer->getNextToken();
            $tokens[] = $token;
            $this->assertInstanceOf('Jojo1981\CompilerDesign\Token\TokenInterface', $token);
        } while ($token->getType() !== ListLexer::EOF_TYPE);

        $this->assertCount(10, $tokens);
    }

    public function testGetNextTokenShouldThrowAnExceptionBecauseTheFirstCharacterOfTheInputStringIsAnInvalidCharacter()
    {
        $listLexer = new ListLexer('([a,b,c,d]');

        $this->setExpectedException('Exception', 'invalid character: (');
        $listLexer->getNextToken();
    }

    public function testGetNextTokenShouldReturnValidAndExpectedTokens()
    {
        $listLexer = new ListLexer("aap [b  ,done
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
            $token = $listLexer->getNextToken();
            $this->assertEquals($expectedTokenType, $token->getType());
        }
    }

    public function testGetTokenNameShouldReturnTheCorrectNameForAllAvailableTypes()
    {
        $testData = array(
            0 => 'n/a',
            1 => '<EOF>',
            2 => 'NAME',
            3 => 'COMMA',
            4 => 'LEFT BRACKET',
            5 => 'RIGHT BRACKET',
        );

        foreach ($testData as $tokenType => $expectedName) {
            $this->assertEquals(
                $expectedName,
                $this->listLexer->getTokenName($tokenType)
            );
        }
    }
}
