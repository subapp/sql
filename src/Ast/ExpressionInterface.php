<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Presenter\PresenterInterface;

/**
 * Interface ExpressionInterface
 * @package Subapp\Sql\Ast
 */
interface ExpressionInterface
{
 
    public function dispatch(PresenterInterface $presenter);
    
}