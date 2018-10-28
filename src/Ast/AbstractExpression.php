<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Presenter\PresenterInterface;

/**
 * Class AbstractExpression
 * @package Subapp\Sql\Ast
 */
abstract class AbstractExpression implements ExpressionInterface
{
    
    /**
     * @param PresenterInterface $presenter
     */
    public function dispatch(PresenterInterface $presenter)
    {
        // todo something like code below...
        // $presenter->render($this);
    }
    
}