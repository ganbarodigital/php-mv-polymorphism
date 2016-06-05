---
currentSection: v1
currentItem: DispatchTables
pageflow_prev_url: AllPurposePreCacheDispatchTable.html
pageflow_prev_text: AllPurposePreCacheDispatchTable class
---

# AllPurposePreCacheDispatchTable

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`AllPurposePreCacheDispatchTable` is a caching [`DispatchTable`](../Interfaces/DispatchTable.html). It provides a good blend of performance and accuracy.

Use `AllPurposePreCacheDispatchTable` if you expect your polymorphic method to be called many times with most or all of the pre-cache types.

Cache Strategy | Used?
---------------|---------
pre-cache? | Yes: `NULL`, `boolean`, `double`, `integer`, `resource`
post-cache? | Yes: objects
pass-through? | Yes: `array`, `string`

## Public Interface

`AllPurposePreCacheDispatchTable` has the following public interface:

```php
// AllPurposePreCacheDispatchTable lives in this namespace
namespace GanbaroDigital\Polymorphism\V1\DispatchTables;

// our base classes and interfaces
use GanbaroDigital\Polymorphism\V1\Interfaces\DispatchTable;

// our input type(s) and return type(s)
use GanbaroDigital\Polymorphism\V1\Interfaces\TypeMapper;

class AllPurposePreCacheDispatchTable implements DispatchTable
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

`AllPurposePreCacheDispatchTable` takes:

* a list of supported types and method names (the dispatch table)
* an object that will work out which types map onto which method names (the `TypeMapper`)
* and a value to return when there's no match (the fallback)

You can safely use any of our type mapper objects with the `AllPurposePreCacheDispatchTable`.

## Class Contract

Here is the contract for this class:

    GanbaroDigital\Polymorphism\V1\DispatchTables\AllPurposePreCacheDispatchTable
     [x] Can instantiate
     [x] is DispatchTable
     [x] populates cache on creation
     [x] each instance has separate cache
     [x] NULL gets cached
     [x] array does not get cached
     [x] true gets cached
     [x] false gets cached
     [x] double gets cached
     [x] integer gets cached
     [x] object gets cached
     [x] resource gets cached
     [x] string does not get cached
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
