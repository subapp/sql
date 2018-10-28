<?php

namespace Subapp\Sql\Represent;

use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Interface SqlizerInterface
 * @package Subapp\Sql\Represent
 */
interface SqlizerInterface
{
    
    /**
     * @param RendererInterface   $renderer
     * @param ExpressionInterface $expression
     * @return string
     */
    public function getSql(RendererInterface $renderer, ExpressionInterface $expression);
    
    /**
     * @return string
     */
    public function getName();

}