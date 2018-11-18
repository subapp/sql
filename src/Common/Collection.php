<?php

namespace Subapp\Sql\Common;

use ArrayIterator;
use JsonSerializable;
use Closure;
use Subapp\Sql\Exception\InvalidValueException;

/**
 * Class Collection
 * @package Subapp\Sql\Common
 */
class Collection implements CollectionInterface, JsonSerializable
{

    /**
     * @var array
     */
    private $elements;

    /**
     * @var string
     */
    private $class;

    /**
     * Collection constructor.
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @param $element
     * @throws InvalidValueException
     */
    private function validate($element)
    {
        if (!$this->isElementInstanceOf($element)) {
            throw new InvalidValueException(sprintf('Collection accept only objects (%s) but (%s) passed',
                $this->getClass(), (is_object($element) ? get_class($element) : gettype($element))));
        }
    }

    /**
     * @param $element
     * @return boolean
     */
    private function isElementInstanceOf($element)
    {
        $class = $this->getClass();

        $isClassExist = class_exists($class);
        $isInstanceOf = $isClassExist && is_object($element) && !($element instanceOf $class);

        return !$isClassExist || ($isClassExist && !$isInstanceOf);
    }

    /**
     * @return string
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class = null): void
    {
        $this->class = $class;
    }

    /**
     * @inheritdoc
     */
    public function add($element): void
    {
        $this->validate($element);

        $this->elements[] = $element;
    }

    /**
     * @inheritdoc
     */
    public function clear(): void
    {
        $this->elements = [];
    }

    /**
     * @inheritdoc
     */
    public function contains($element): bool
    {
        return in_array($element, $this->elements, true);
    }

    /**
     * @inheritdoc
     */
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    /**
     * @inheritDoc
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * @inheritdoc
     */
    public function remove($key)
    {
        $removed = $this->elements[$key] ?? null;

        unset($this->elements[$key]);

        return $removed;
    }

    /**
     * @inheritdoc
     */
    public function removeElement($element): bool
    {
        $key = array_search($element, $this->elements, true);

        if (false === $key) {
            return false;
        }

        unset($this->elements[$key]);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function containsKey($key): bool
    {
        return array_key_exists($key, $this->elements);
    }

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        return $this->elements[$key];
    }

    /**
     * @inheritdoc
     */
    public function getKeys(): array
    {
        return array_keys($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function getValues(): array
    {
        return array_values($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value): void
    {
        $this->validate($value);

        $this->elements[$key] = $value;
    }

    /**
     * @inheritDoc
     */
    public function append($value): void
    {
        $this->validate($value);

        $this->add($value);
    }

    /**
     * @inheritDoc
     */
    public function prepend($value): void
    {
        array_unshift($this->elements, $value);
    }

    /**
     * @inheritdoc
     */
    public function asBatch(array $elements, bool $append = false): void
    {
        foreach ($elements as $index => $element) {
            $this->offsetSet($append ? null : $index, $element);
        }
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return $this->elements;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @inheritdoc
     */
    public function getFirst()
    {
        return reset($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function getLast()
    {
        return end($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return key($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return current($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        return next($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function exists(Closure $predicate): bool
    {
        foreach ($this->elements as $key => $element) {
            if ($predicate($key, $element)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function filter(Closure $predicate): self
    {
        return $this->createFrom(array_filter($this->elements, $predicate));
    }

    /**
     * @inheritdoc
     */
    public function forAll(Closure $predicate): bool
    {
        foreach ($this->elements as $key => $element) {
            if (!$predicate($key, $element)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function map(Closure $func)
    {
        return $this->createFrom(array_map($func, $this->elements));
    }

    /**
     * @inheritdoc
     */
    public function partition(Closure $predicate)
    {
        $matches = $noMatches = [];

        foreach ($this->elements as $key => $element) {
            if ($predicate($key, $element)) {
                $matches[$key] = $element;
            } else {
                $noMatches[$key] = $element;
            }
        }

        return [$this->createFrom($matches), $this->createFrom($noMatches)];
    }

    /**
     * @inheritdoc
     */
    public function indexOf($element)
    {
        return array_search($element, $this->elements, true);
    }

    /**
     * @inheritdoc
     */
    public function slice($offset, $length = null)
    {
        return array_slice($this->elements, $offset, $length, true);
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->elements);
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return $this->containsKey($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        if (!isset($offset)) {
            $this->add($value);
        } else {
            $this->set($offset, $value);
        }
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * Creates a new instance from the specified elements.
     *
     * This method is provided for derived classes to specify how a new
     * instance should be created when constructor semantics have changed.
     *
     * @param array $elements Elements.
     *
     * @return static
     */
    protected function createFrom(array $elements)
    {
        return new static($elements);
    }
}
