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
    /* Token type constants */
    const NAME          = 2;
    const COMMA         = 3;
    const LEFT_BRACKET  = 4;
    const RIGHT_BRACKET = 5;

    /**
     * @var array
     */
    protected $tokenNames = array(
        "n/a",
        "<EOF>",
        "NAME",
        "COMMA",
        "LEFT BRACKET",
        "RIGHT BRACKET"
    );

    /**
     * @var array
     */
    protected $whiteSpaceChars = array(
        ' ',
        "\t",
        "\n",
        "\r"
    );

    /**
     * {@inheritDoc}
     */
    public function getNextToken()
    {
        $token = null;

        while ($this->getCurrentChar() != self::EOF) {

            // Skip whitespace(s) skip to next char
            if (in_array($this->getCurrentChar(), $this->whiteSpaceChars)) {
                $this->whiteSpace();
                continue;
            }

            switch ($this->getCurrentChar()) {
                case ',':
                    $this->consume();
                    $token = new Token(self::COMMA, ",", $this);
                    break;
                case '[':
                    $this->consume();
                    $token = new Token(self::LEFT_BRACKET, "[", $this);
                    break;
                case ']':
                    $this->consume();
                    $token = new Token(self::RIGHT_BRACKET, "]", $this);
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

        return new Token(self::EOF_TYPE, "<EOF>", $this);
    }

    /**
     * Skip white space and move on until an other character will be found
     * That character will be the current character
     */
    protected function whiteSpace()
    {
        while (ctype_space($this->getCurrentChar())) {
            $this->consume();
        }
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
        $buf = '';

        do {
            $buf .= $this->getCurrentChar();
            $this->consume();
        } while ($this->isLetter());

        return new Token(self::NAME, $buf, $this);
    }

    /**
     * {@inheritDoc}
     */
    public function getTokenName($tokenType)
    {
        return $this->tokenNames[$tokenType];
    }
}
