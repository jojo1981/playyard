<?php
/**
 * @category Jojo1981
 * @package CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace Jojo1981\CompilerDesign;

use Jojo1981\CompilerDesign\Lexer\LexerAbstract;

/**
 * @category Jojo1981
 * @package CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * Jojo1981\CompilerDesign\ListLexer
 */
class ListLexer extends LexerAbstract
{
    /** Token type constants */
    const TOKEN_TYPE_NAME          = 2;
    const TOKEN_TYPE_COMMA         = 3;
    const TOKEN_TYPE_LEFT_BRACKET  = 4;
    const TOKEN_TYPE_RIGHT_BRACKET = 5;

    /**
     * @var array
     */
    protected $tokenNames = array(
        self::TOKEN_TYPE_NA            => 'n/a',
        self::TOKEN_TYPE_EOF           => '<EOF>',
        self::TOKEN_TYPE_NAME          => 'NAME',
        self::TOKEN_TYPE_COMMA         => 'COMMA',
        self::TOKEN_TYPE_LEFT_BRACKET  => 'LEFT BRACKET',
        self::TOKEN_TYPE_RIGHT_BRACKET => 'RIGHT BRACKET'
    );

    /**
     * {@inheritDoc}
     */
    public function getNextToken()
    {
        $token = null;

        while ($this->getCurrentChar() != self::EOF) {

            $this->skipWhiteSpace();

            switch ($this->getCurrentChar()) {
                case ',':
                    $this->consume();
                    $token = new Token(self::TOKEN_TYPE_COMMA, ",", $this);
                    break;
                case '[':
                    $this->consume();
                    $token = new Token(self::TOKEN_TYPE_LEFT_BRACKET, "[", $this);
                    break;
                case ']':
                    $this->consume();
                    $token = new Token(self::TOKEN_TYPE_RIGHT_BRACKET, "]", $this);
                    break;
                default:
                    if ($this->isLetter()) {
                        $token = $this->name();
                    } else {
                        throw new \Exception(sprintf(
                            'invalid character: %s',
                            $this->getCurrentChar()
                        ));
                    }
            }

            return $token;
        }

        return new Token(self::TOKEN_TYPE_EOF, "<EOF>", $this);
    }

    /**
     * Check if the current character is a letter
     *
     * @return bool
     */
    protected function isLetter()
    {
        return ($this->getCurrentChar() >= 'a'
            && $this->getCurrentChar() <= 'z'
            || $this->getCurrentChar() >= 'A'
            && $this->getCurrentChar() <= 'Z'
        );
    }

    /**
     * Find all up following letters (called a name)
     * ('a'..'z'|'A'..'Z')+;
     * a 'name' is a sequence of 1 letter or more letters
     *
     * @return Token
     */
    protected function name()
    {
        $buffer = '';

        do {
            $buffer .= $this->getCurrentChar();
            $this->consume();
        } while ($this->isLetter());

        return new Token(self::TOKEN_TYPE_NAME, $buffer, $this);
    }

    /**
     * {@inheritDoc}
     */
    public function getTokenName($tokenType)
    {
        return $this->tokenNames[$tokenType];
    }
}
