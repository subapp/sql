<?php

namespace Subapp\Sql;

use Subapp\Sql\Common\Placeholders;

/**
 * Class Context
 * @package Subapp\Sql
 */
class Context
{
    
    /**
     * @var Placeholders
     */
    private $placeholders;
    
    /**
     * Context constructor.
     */
    public function __construct()
    {
        $this->placeholders = new Placeholders();
    }
    
    /**
     * @return Placeholders
     */
    public function getPlaceholders()
    {
        return $this->placeholders;
    }
    
    /**
     * @param Placeholders $placeholders
     */
    public function setPlaceholders(Placeholders $placeholders)
    {
        $this->placeholders = $placeholders;
    }
    
}