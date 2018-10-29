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
     * @param ExpressionInterface $expression
     * @param RendererInterface   $renderer
     *
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer);

    /**
     * @return string
     */
    public function getName();

}