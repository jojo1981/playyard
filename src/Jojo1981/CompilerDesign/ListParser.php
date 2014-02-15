<?php
/**
 * @category Jojo1981
 * @package CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 */
namespace Jojo1981\CompilerDesign;

use Jojo1981\CompilerDesign\Parser\ParserAbstract;

/**
 * @category Jojo1981
 * @package CompilerDesign
 * @author Joost Nijhuis <jnijhuis81@gmail.com>
 * @copyright Copyright (c) 2014, Joost Nijhuis
 * @license MIT
 *
 * Jojo1981\CompilerDesign\ListParser
 */
class ListParser extends ParserAbstract
{
    /**
     * {@inheritDoc}
     */
    public function parse()
    {
        $this->match(ListLexer::LEFT_BRACKET);
        $this->elements();
        $this->match(ListLexer::RIGHT_BRACKET);
    }

    /**
     * Try to match all list elements separated by a comma
     */
    protected function elements()
    {
        $this->element();
        while ($this->getCurrentToken()->getType() == ListLexer::COMMA) {
            $this->match(ListLexer::COMMA);
            $this->element();
        }
    }

    /**
     * Try to match a name or left bracket token type
     * Throw an exception if an invalid token will be found
     *
     * @throws \Exception
     */
    protected function element()
    {
        if ($this->getCurrentToken()->getType() == ListLexer::NAME) {
            $this->match(ListLexer::NAME);
        } else if ($this->getCurrentToken()->getType() == ListLexer::LEFT_BRACKET) {
            $this->parse();
        } else {
            throw new \Exception(sprintf(
                'Expecting token: %s or %s Found token: %s',
                $this->getLexer()->getTokenName(ListLexer::NAME),
                $this->getLexer()->getTokenName(ListLexer::LEFT_BRACKET),
                $this->getLexer()->getTokenName($this->getCurrentToken()->getType())
            ));
        }
    }
}
