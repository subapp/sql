<?php

namespace Subapp\Sql\Common;

use ArrayAccess;
use Closure;
use Countable;
use IteratorAggregate;

/**
 * Interface CollectionInterface
 *
 * @package Subapp\Sql\Common
 */
interface CollectionInterface extends Countable, IteratorAggregate, ArrayAccess
{

    /**
     * @return string
     */
    public function getClass(): ?string;

    /**
     * @param string $class
     */
    public function setClass(string $class): void;

    /**
     * @param $element
     */
    public function add($element): void;

    /**
     * @return void
     */
    public function clear(): void;

    /**
     * @param $element
     * @return boolean
     */
    public function contains($element): bool;

    /**
     * @return boolean
     */
    public function isEmpty(): bool;

    /**
     * @return boolean
     */
    public function isNotEmpty(): bool;

    /**
     * @param $key
     * @return CollectionInterface
     */
    public function remove($key);

    /**
     * @param $element
     * @return boolean
     */
    public function removeElement($element): bool;

    /**
     * @param $key
     * @return boolean
     */
    public function containsKey($key): bool;

    /**
     * @param $key
     * @return CollectionInterface
     */
    public function get($key);

    /**
     * @return array
     */
    public function getKeys(): array;

    /**
     * @return array
     */
    public function getValues(): array;

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value): void;

    /**
     * @param $value
     */
    public function append($value): void;

    /**
     * @param $value
     */
    public function prepend($value): void;
    
    /**
     * @param array $elements
     * @param boolean  $append
     */
    public function asBatch(array $elements, bool $append = false): void;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return CollectionInterface
     */
    public function getFirst();

    /**
     * @return CollectionInterface
     */
    public function getLast();

    /**
     * @return CollectionInterface
     */
    public function key();

    /**
     * @return CollectionInterface
     */
    public function current();

    /**
     * @return CollectionInterface
     */
    public function next();

    /**
     * @param Closure $predicate
     * @return boolean
     */
    public function exists(Closure $predicate): bool;

    /**
     * @param Closure $predicate
     * @return CollectionInterface
     */
    public function filter(Closure $predicate);

    /**
     * @param Closure $predicate
     * @return boolean
     */
    public function forAll(Closure $predicate): bool;

    /**
     * @param Closure $closure
     * @return CollectionInterface
     */
    public function map(Closure $closure);

    /**
     * @param Closure $predicate
     * @return CollectionInterface
     */
    public function partition(Closure $predicate);

    /**
     * @param $element
     * @return CollectionInterface
     */
    public function indexOf($element);

    /**
     * @param $offset
     * @param null|integer $length
     * @return CollectionInterface
     */
    public function slice($offset, $length = null);
}
