<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Common\Bit\AbstractBit;
use Subapp\Sql\Converter\ConverterInterface;

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

    const MODIFIER_LOW_PRIORITY = 1;
    const MODIFIER_HIGH_PRIORITY = 2;
    const MODIFIER_DELAYED = 4;
    const MODIFIER_IGNORE = 8;
    const MODIFIER_ALL = 16;
    const MODIFIER_DISTINCT = 32;
    const MODIFIER_DISTINCTROW = 64;
    const MODIFIER_SQL_SMALL_RESULT = 128;
    const MODIFIER_SQL_BIG_RESULT = 256;
    const MODIFIER_SQL_BUFFER_RESULT = 512;
    const MODIFIER_SQL_CACHE = 1024;
    const MODIFIER_SQL_NO_CACHE = 2048;
    const MODIFIER_SQL_CALC_FOUND_ROWS = 4096;
    const MODIFIER_QUICK = 8192;

    /**
     * @var array
     */
    protected static $modifiersMap = [
        self::MODIFIER_LOW_PRIORITY => 'LOW_PRIORITY',
        self::MODIFIER_HIGH_PRIORITY => 'HIGH_PRIORITY',
        self::MODIFIER_DELAYED => 'DELAYED',
        self::MODIFIER_IGNORE => 'IGNORE',
        self::MODIFIER_ALL => 'ALL',
        self::MODIFIER_DISTINCT => 'DISTINCT',
        self::MODIFIER_DISTINCTROW => 'DISTINCTROW',
        self::MODIFIER_SQL_SMALL_RESULT => 'SQL_SMALL_RESULT',
        self::MODIFIER_SQL_BIG_RESULT => 'SQL_BIG_RESULT',
        self::MODIFIER_SQL_BUFFER_RESULT => 'SQL_BUFFER_RESULT',
        self::MODIFIER_SQL_CACHE => 'SQL_CACHE',
        self::MODIFIER_SQL_NO_CACHE => 'SQL_NO_CACHE',
        self::MODIFIER_SQL_CALC_FOUND_ROWS => 'SQL_CALC_FOUND_ROWS',
        self::MODIFIER_QUICK => 'QUICK',
    ];

    /**
     * @var AbstractBit
     */
    protected $modifiers;

    /**
     * Modifiers constructor.
     * @param integer $modifiers
     */
    public function __construct($modifiers = 0)
    {
        $this->modifiers = new class($modifiers, static::class, 'MODIFIER') extends AbstractBit {};
    }

    /**
     * @param integer|string $modifier
     *
     * @return $this
     */
    public function remove($modifier)
    {
        $this->modifiers->remove($modifier);

        return $this;
    }

    /**
     * @param integer $modifier
     *
     * @return $this
     */
    public function set($modifier)
    {
        $this->modifiers->setBitMask($modifier);

        return $this;
    }

    /**
     * @param integer|string $modifier
     *
     * @return $this
     */
    public function add($modifier = 0)
    {
        $this->modifiers->add($modifier);

        return $this;
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->modifiers->reset();

        return $this;
    }

    /**
     * @return integer
     */
    public function getModifiers()
    {
        return $this->modifiers->getBitMask();
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