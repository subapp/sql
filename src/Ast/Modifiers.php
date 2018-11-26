<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Converter\ConverterInterface;
use Subapp\Sql\Exception\UnsupportedException;

/**
 * Class Modifiers
 * @package Subapp\Sql\Ast
 */
class Modifiers extends AbstractNode
{

    /**
     * MySQL Allowed Query Modifiers
     *
     * INSERT Modifiers
     * [LOW_PRIORITY | DELAYED | HIGH_PRIORITY] [IGNORE]
     *
     * DELETE Modifiers
     * [LOW_PRIORITY] [QUICK] [IGNORE]
     *
     * UPDATE Modifiers
     * [LOW_PRIORITY] [IGNORE]
     *
     * SELECT Modifiers
     * [ALL | DISTINCT | DISTINCTROW]
     * [HIGH_PRIORITY]
     * [SQL_SMALL_RESULT] [SQL_BIG_RESULT] [SQL_BUFFER_RESULT]
     * [SQL_CACHE | SQL_NO_CACHE] [SQL_CALC_FOUND_ROWS]
     */

    const LOW_PRIORITY = 1;
    const HIGH_PRIORITY = 2;
    const DELAYED = 4;
    const IGNORE = 8;
    const ALL = 16;
    const DISTINCT = 32;
    const DISTINCTROW = 64;
    const SQL_SMALL_RESULT = 128;
    const SQL_BIG_RESULT = 256;
    const SQL_BUFFER_RESULT = 512;
    const SQL_CACHE = 1024;
    const SQL_NO_CACHE = 2048;
    const SQL_CALC_FOUND_ROWS = 4096;
    const QUICK = 8192;

    /**
     * @var array
     */
    protected static $modifiersMap = [
        self::LOW_PRIORITY => 'LOW_PRIORITY',
        self::HIGH_PRIORITY => 'HIGH_PRIORITY',
        self::DELAYED => 'DELAYED',
        self::IGNORE => 'IGNORE',
        self::ALL => 'ALL',
        self::DISTINCT => 'DISTINCT',
        self::DISTINCTROW => 'DISTINCTROW',
        self::SQL_SMALL_RESULT => 'SQL_SMALL_RESULT',
        self::SQL_BIG_RESULT => 'SQL_BIG_RESULT',
        self::SQL_BUFFER_RESULT => 'SQL_BUFFER_RESULT',
        self::SQL_CACHE => 'SQL_CACHE',
        self::SQL_NO_CACHE => 'SQL_NO_CACHE',
        self::SQL_CALC_FOUND_ROWS => 'SQL_CALC_FOUND_ROWS',
        self::QUICK => 'QUICK',
    ];

    /**
     * @var integer
     */
    protected $modifiers = 0;

    /**
     * Modifiers constructor.
     * @param integer $modifiers
     */
    public function __construct($modifiers = 0)
    {
        $this->modifiers = $modifiers;
    }

    /**
     * @param int $modifier
     *
     * @return $this
     */
    public function remove($modifier = 0)
    {
        $this->modifiers &= ~$modifier;

        return $this;
    }

    /**
     * @param int $modifier
     *
     * @return $this
     */
    public function set($modifier = 0)
    {
        $this->modifiers = $this->resolve($modifier);

        return $this;
    }

    /**
     * @param integer $modifier
     * @return integer
     */
    protected function resolve($modifier)
    {
        return $modifier;
    }

    /**
     * @param int $modifier
     *
     * @return $this
     */
    public function add($modifier = 0)
    {
        $this->modifiers |= $this->resolve($modifier);

        return $this;
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->modifiers = 0;

        return $this;
    }

    /**
     * @return integer
     */
    public function getModifiers()
    {
        return $this->modifiers;
    }

    /**
     * @return array
     */
    public function getModifiersMap()
    {
        return self::$modifiersMap;
    }

    /**
     * @inheritDoc
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_MODIFIERS;
    }

}