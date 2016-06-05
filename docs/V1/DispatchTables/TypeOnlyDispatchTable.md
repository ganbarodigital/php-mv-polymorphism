---
currentSection: v1
currentItem: DispatchTables
pageflow_prev_url: ObjectsOnlyDispatchTable.html
pageflow_prev_text: ObjectsOnlyDispatchTable class
---

# TypeOnlyDispatchTable

<div class="callout info">
Since v1.2016060501
</div>

## Description

`TypeOnlyDispatchTable` is a caching [`DispatchTable`](../Interfaces/DispatchTable.html). It provides better performance than the [`AllPurposeDispatchTable`](AllPurposeDispatchTable.html) when you want to inspect the contents of an array or a string to determine their type.

<div class="callout danger" markdown="1">
#### Here Be Dragons!

Make sure that your `$typeMethods` constructor parameter includes entries both for `array` and `string`.

If you don't, `TypeOnlyDispatchTable` will call the `$typeMapper` that you supply. Your `$typeMapper` might inspect the contents of the array or string to determine what type it is. This will poison the `TypeOnlyDispatchTable` internal cache. And it will be a complete bugger for you to track down and debug!

If you're not sure what to do, stick with the [`AllPurposeDispatchTable`](AllPurposeDispatchTable.html) instead.
</div>

Cache Strategy | Used?
---------------|---------
pre-cache? | Yes: uses your `$typeMethods` list
post-cache? | Yes: all types
pass-through? | No

## Public Interface

`TypeOnlyDispatchTable` has the following public interface:

```php
// TypeOnlyDispatchTable lives in this namespace
namespace GanbaroDigital\Polymorphism\V1\DispatchTables;

// our base classes and interfaces
use GanbaroDigital\Polymorphism\V1\Interfaces\DispatchTable;

// our input type(s) and return type(s)
use GanbaroDigital\Polymorphism\V1\Interfaces\TypeMapper;

class TypeOnlyDispatchTable implements DispatchTable
{
    /**
     * create a new dispatch table
     *
     * @param array $typeMethods
     *        a list of supported types and the method names they map onto
     * @param TypeMapper $typeMapper
     *        the TypeMapper to use to inspect
     * @param string $fallback
     *        what value do we return if our TypeMapper does not find a match?
     */
    public function __construct(
        $typeMethods,
        TypeMapper $typeMapper,
        $fallback = TypeMapper::FALLBACK_RESULT
    );

    /**
     * inspect a variable, and determine which method name to return
     *
     * @param  mixed $item
     *         the item to describe
     * @return string
     *         the method name that you should call
     */
    public function mapTypeToMethodName($item);
}
```

## How To Use

### Wrapping A TypeMapper

`TypeOnlyDispatchTable` takes:

* a list of supported types and method names (the dispatch table)
* an object that will work out which types map onto which method names (the `TypeMapper`)
* and a value to return when there's no match (the fallback)

You can safely use any of our type mapper objects with the `TypeOnlyDispatchTable`, as long as you provide entries for `array` and `string` in your `$typeMethods` constructor parameter.

## Class Contract

Here is the contract for this class:

    GanbaroDigital\Polymorphism\V1\DispatchTables\TypeOnlyDispatchTable
     [x] Can instantiate
     [x] is DispatchTable
     [x] uses typeMethods to seed the cache
     [x] each instance has separate cache
     [x] NULL gets cached
     [x] array gets cached
     [x] true gets cached
     [x] false gets cached
     [x] double gets cached
     [x] integer gets cached
     [x] object gets cached
     [x] resource gets cached
     [x] string gets cached
     [x] will check the cache first
     [x] returns nothingMatchesTheInputType when no match found
     [x] can change the default fallback when no match found

Class contracts are built from this class's unit tests.

<div class="callout success">
Future releases of this class will not break this contract.
</div>

<div class="callout info" markdown="1">
Future releases of this class may add to this contract. New additions may include:

* clarifying existing behaviour (e.g. stricter contract around input or return types)
* add new behaviours (e.g. extra class methods)
</div>

<div class="callout warning" markdown="1">
When you use this class, you can only rely on the behaviours documented by this contract.

If you:

* find other ways to use this class,
* or depend on behaviours that are not covered by a unit test,
* or depend on undocumented internal states of this class,

... your code may not work in the future.
</div>

## Notes

None at this time.
