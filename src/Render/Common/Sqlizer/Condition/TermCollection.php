<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Condition;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\Common\Sqlizer\Collection;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class TermCollection
 * @package Subapp\Sql\Render\Common\Sqlizer\Condition
 */
class TermCollection extends Collection
{
    
    /**
     * @param ExpressionInterface $collection
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $collection, RendererInterface $renderer)
    {
        return sprintf('(%s)', parent::getSql($collection, $renderer));
    }
    
}