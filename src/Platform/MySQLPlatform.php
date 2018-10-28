<?php

namespace Subapp\Sql\Platform;

/**
 * Class MySQLPlatform
 * @package Subapp\Orm\Schema\Platform
 */
class MySQLPlatform extends AbstractPlatform
{
    
    /**
     * MySQLPlatform constructor.
     */
    public function __construct()
    {
        parent::__construct('MySQL');
    }
    
}