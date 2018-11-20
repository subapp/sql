<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Common\ClassNameTrait;

/**
 * Class AbstractExpression
 * @package Subapp\Sql\Ast
 */
abstract class AbstractExpression implements ExpressionInterface
{

    use ClassNameTrait;

    /**
     * @inheritDoc
     */
    public function getNodeName()
    {
        return $this->getUnderscore(static::class);
    }

}