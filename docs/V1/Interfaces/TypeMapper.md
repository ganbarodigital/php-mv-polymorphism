---
currentSection: v1
currentItem: Interfaces
pageflow_prev_url: DispatchTable.html
pageflow_prev_text: DispatchTable interface
---

# TypeMapper

<div class="callout info">
Since v1.2016060501
</div>

## Description

`TypeMapper` is an interface. It is the base interface that all dispatch table-based type mappers implement.

## Public Interface

`TypeMapper` has the following public interface:

```php
// TypeMapper lives in this namespace
namespace GanbaroDigital\Polymorphism\V1\Interfaces;

/**
 * use an input item's data type to work out which method we should call
 */
interface TypeMapper
{
    /**
     * this is the result we return when there's no matching method
     * in the dispatch table that we're given
     */
    const FALLBACK_RESULT = "nothingMatchesTheInputType";

    /**
     * use an input item's data type to work out which method we should
     * call
     *
     * @param  mixed $item
     *         the item we want to dispatch
     * @param  array $dispatchTable
     *         the list of methods that are available
     * @param  string $fallback
     *         the value to return if there's no suitable entry for $item
     *         in $dispatchTable
     * @return string
     *         the name of the method to call
     */
    public function __invoke(
        $item,
        array $dispatchTable,
        $fallback = TypeMapper::FALLBACK_RESULT
    );

    /**
     * use an input item's data type to work out which method we should
     * call
     *
     * @param  mixed $item
     *         the item we want to dispatch
     * @param  array $dispatchTable
     *         the list of methods that are available
     * @param  string $fallback
     *         the value to return if there's no suitable entry for $item
     *         in $dispatchTable
     * @return string
     *         the name of the method to call
     */
    public static function using(
        $item,
        array $dispatchTable,
        $fallback = TypeMapper::FALLBACK_RESULT
    );
}
```

## How To Use

### The Dispatch Table

Each `TypeMapper` needs to support the _dispatch table_.

`$dispatchTable` is an associative array.

* Each array key is a type.

  This can be PHP's built-in types: `NULL`, `array`, `boolean`, `callable`, `double`, `integer`, `object`, `resource`, or `string`.

  It can also be the full name of any classes or interfaces defined by PHP itself, any loaded PHP extensions, and your code.

* Each array value is a method name, as a string.

  This is the string that will be returned by the `::__invoke()` and `::using()` methods if a successful match is found.

## Notes

None at this time.
