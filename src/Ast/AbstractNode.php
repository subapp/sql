<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Common\ClassNameTrait;

/**
 * Class AbstractExpression
 * @package Subapp\Sql\Ast
 */
abstract class AbstractNode implements NodeInterface
{

    use ClassNameTrait;

    /**
     * @inheritDoc
     */
    public function getNodeName()
    {
        return $this->getObjectName(static::class, 'ASTNode');
    }

}