<?php

namespace Subapp\Sql\Common\Bit;

/**
 * Class AbstractBitMask
 * @package Subapp\Sql\Common\Bit
 */
abstract class AbstractBitMask implements MaskInterface, \JsonSerializable
{
    
    /**
     * @var int
     */
    private $mask = 0;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $constantPrefix = 'MASK';

    /**
     * AbstractMask constructor.
     *
     * @param int $bit
     * @param null|string $class
     * @param null|string $prefix
     */
    public function __construct($bit = 0, $class = null, $prefix = null)
    {
        $this->setBitMask((integer)$bit);
        $this->setClass($class ?? static::class);
        $this->setConstantPrefix(strtoupper($prefix ?? 'MASK'));
    }

    /**
     * @param mixed $mask
     *
     * @return $this
     */
    public function setBitMask($mask)
    {
        try {
            $this->mask = $this->resolve($mask);
        } catch (\Throwable $exception) {
            $this->mask = 0;
        }
        
        return $this;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        if (!class_exists($class)) {
            $class = static::class;
        }

        $this->class = $class;
    }

    /**
     * @return \Generator
     */
    public function getAccessConstants()
    {
        $reflection = new \ReflectionClass($this->getClass());
        $constantPrefix = $this->getConstantPrefix();
        $prefixLength = strlen($constantPrefix);

        foreach ($reflection->getConstants() as $constantName => $constantValue) {
            if (strpos($constantName, $constantPrefix) === 0) {
                yield strtolower(
                    substr($constantName, - $prefixLength)
                ) => $constantValue;
            }
        }
    }

    /**
     * @return string
     */
    public function getConstantPrefix()
    {
        return $this->constantPrefix;
    }

    /**
     * @param string $constantPrefix
     */
    public function setConstantPrefix($constantPrefix)
    {
        $this->constantPrefix = $constantPrefix;
    }
    
    /**
     * @param int|string $mask
     *
     * @throws InvalidArgumentException
     * @return int
     */
    public function resolve($mask)
    {
        if (is_string($mask)) {
            $constant = sprintf('%s::%s_%s', $this->class, strtoupper($this->constantPrefix), strtoupper($mask));

            if (!defined($constant)) {
                throw new InvalidArgumentException("Constant does not exists $constant");
            }
            
            return constant($constant);
        }
        
        if (!is_int($mask)) {
            throw new InvalidArgumentException("Mask is invalid. Should be an integer");
        }
        
        return $mask;
    }

    /**
     * @param integer|string $mask
     *
     * @return $this
     */
    public function add($mask)
    {
        $this->mask |= $this->resolve($mask);
        
        return $this;
    }

    /**
     * @param integer|string $mask
     *
     * @return MaskInterface
     */
    public function remove($mask)
    {
        // a &= ~ b | a ^= b;
        $this->mask ^= $this->resolve($mask);
        
        return $this;
    }
    
    /**
     * @return MaskInterface
     */
    public function reset()
    {
        $this->mask = 0;
        
        return $this;
    }

    /**
     * @param $mask
     *
     * @return bool
     */
    public function has($mask)
    {
        return (boolean) ($this->mask & $this->resolve($mask));
    }
    
    /**
     * @inheritdoc
     */
    function jsonSerialize()
    {
        return $this->getBitMask();
    }
    
    /**
     * @return int
     */
    public function getBitMask()
    {
        return $this->mask;
    }
    
    /**
     * @inheritdoc
     */
    function __toString()
    {
        return (string) $this->getBitMask();
    }
    
}