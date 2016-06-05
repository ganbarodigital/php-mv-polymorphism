---
currentSection: v1
currentItem: Interfaces
pageflow_prev_url: index.html
pageflow_prev_text: Interfaces
pageflow_next_url: TypeMapper.html
pageflow_next_text: TypeMapper interface
---

# DispatchTable

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`DispatchTable` is an interface. It is the interface implemented by all caching dispatch table classes.

## Public Interface

`DispatchTable` has the following public interface:

```php
// DispatchTable lives in this namespace
namespace GanbaroDigital\Polymorphism\V1\Interfaces;

// our input type(s) and return type(s)
use GanbaroDigital\Polymorphism\V1\Interfaces\TypeMapper;

interface DispatchTable
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

### Caching TypeMapper Results

The whole point of a `DispatchTable` is to cache results from a `TypeMapper`. There are three opportunities to do so:

* pre-cache - build up the cache in your `__construct()`
* post-cache - cache results in your `mapTypeToMethodName()`
* pass-through - do not cache some results, because the results depends on the contents of `$item` not just its data type

You can combine these caching approaches in a single class.

For example, the [`AllPurposeDispatchTable`](../DispatchTables/AllPurposeDispatchTable.html) uses both the _post-cache_ and _pass-through_ strategies. This guarantees maximum compatibility with all `TypeMapper`s.

## Notes

None at this time.
