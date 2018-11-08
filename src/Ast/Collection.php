<?php

namespace Subapp\Sql\Ast;

use Subapp\Collection\Collection as BaseCollection;
use Subapp\Sql\Common\ClassNameTrait;

/**
 * Class Collection
 * @package Subapp\Sql\Ast
 */
class Collection extends BaseCollection implements ExpressionInterface
{

    use ClassNameTrait;

    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'sqlizer.collection';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getUnderscore(static::class);
    }

}