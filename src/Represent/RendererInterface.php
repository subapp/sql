<?php

namespace Subapp\Sql\Represent;

use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Interface RendererInterface
 * @package Subapp\Sql\Represent
 */
interface RendererInterface
{
    
    /**
     * @param RendererSetupLoaderInterface $loader
     */
    public function setup(RendererSetupLoaderInterface $loader);
    
    /**
     * @param ExpressionInterface $expression
     * @return string
     */
    public function render(ExpressionInterface $expression);
    
    /**
     * @param SqlizerInterface $sqlizer
     */
    public function addSqlizer(SqlizerInterface $sqlizer);
    
    /**
     * @param string $name
     */
    public function removeSqlizer($name);
    
    /**
     * @param string $name
     * @return boolean
     */
    public function hasSqlizer($name);
    
    /**
     * @param string $name
     * @return SqlizerInterface
     */
    public function getSqlizer($name);

}