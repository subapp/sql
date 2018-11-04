<?php

namespace Subapp\Sql\Render;

use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Interface SqlizerInterface
 * @package Subapp\Sql\Render
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