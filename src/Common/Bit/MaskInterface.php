<?php

namespace Subapp\Sql\Common\Bit;

/**
 * Interface MaskInterface
 * @package Subapp\Sql\Common\Bit
 */
interface MaskInterface
{
    
    /**
     * @param integer $mask
     *
     * @throws \InvalidArgumentException
     * @return MaskInterface
     */
    public function setBitMask($mask);
    
    /**
     * @param $mask
     *
     * @return MaskInterface
     */
    public function add($mask);
    
    /**
     * @return integer
     */
    public function getBitMask();
    
    /**
     * @param $mask
     *
     * @return MaskInterface
     */
    public function remove($mask);
    
    /**
     * @return MaskInterface
     */
    public function reset();
    
    /**
     * @param string|integer $mask
     *
     * @throws \InvalidArgumentException
     * @return integer
     */
    public function resolve($mask);
    
    /**
     * @param $mask
     *
     * @return boolean
     */
    public function has($mask);
    
}