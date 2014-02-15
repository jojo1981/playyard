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
use Jojo1981\CompilerDesign\Token\TokenInterface;

/**
 * @category Jojo1981
 * @package CompilerDesign
 * @subpackage Parser
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * Jojo1981\CompilerDesign\Parser\ParserAbstract
 */
abstract class ParserAbstract implements ParserInterface
{
    /**
     * @var LexerInterface
     */
    private $lexer;

    /**
     * @var TokenInterface
     */
    private $currentToken;

    /**
     * {@inheritDoc}
     */
    public function __construct(LexerInterface $lexer)
    {
        $this->lexer = $lexer;
        $this->consume();
    }

    /**
     * Try to match the current token against the passed type,
     * will throw an exception if matching fails.
     *
     * @throws \Exception
     */
    protected function match($tokenType)
    {
        if ($this->currentToken->getType() == $tokenType) {
            $this->consume();
        } else {
            throw new \Exception(sprintf(
                'Expecting token: %s Found token: %s',
                $this->lexer->getTokenName($tokenType),
                $this->lexer->getTokenName($this->currentToken->getType())
            ));
        }
    }

    /**
     * Get next token and set it as current token
     */
    protected function consume()
    {
        $this->currentToken = $this->lexer->getNextToken();
    }

    /**
     * @return TokenInterface
     */
    protected function getCurrentToken()
    {
        return $this->currentToken;
    }

    /**
     * @return LexerInterface
     */
    protected function getLexer()
    {
        return $this->lexer;
    }
}
