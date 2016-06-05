---
currentSection: v1
currentItem: DispatchTables
pageflow_prev_url: index.html
pageflow_prev_text: DispatchTables
pageflow_next_url: ObjectsOnlyDispatchTable.html
pageflow_next_text: ObjectsOnlyDispatchTable class
---

# AllPurposeDispatchTable

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`AllPurposeDispatchTable` is a caching [`DispatchTable`](../Interfaces/DispatchTable.html). It provides the best blend of performance and accuracy.

Use `AllPurposeDispatchTable` unless you know that one of the other dispatch table types is more optimal for your particular polymorphic method.

Cache Strategy | Used?
---------------|---------
pre-cache? | No
post-cache? | Yes: `NULL`, `boolean`, `double`, `integer`, objects, `resource`
pass-through? | Yes: `array`, `string`

## Public Interface

`AllPurposeDispatchTable` has the following public interface:

```php
// AllPurposeDispatchTable lives in this namespace
namespace GanbaroDigital\Polymorphism\V1\DispatchTables;

// our base classes and interfaces
use GanbaroDigital\Polymorphism\V1\Interfaces\DispatchTable;

// our input type(s) and return type(s)
use GanbaroDigital\Polymorphism\V1\Interfaces\TypeMapper;

class AllPurposeDispatchTable implements DispatchTable
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

`AllPurposeDispatchTable` takes:

* a list of supported types and method names (the dispatch table)
* an object that will work out which types map onto which method names (the `TypeMapper`)
* and a value to return when there's no match (the fallback)

You can safely use any of our type mapper objects with the `AllPurposeDispatchTable`.

Here's an example (taken from the [`MapDuckTypeToMethodName`](../TypeMapping/MapDuckTypeToMethodName.html) docs) which shows you how to use the `AllPurposeDispatchTable` in a class.

```php
use GanbaroDigital\Polymorphism\V1\DispatchTables\AllPurposeDispatchTable;
use GanbaroDigital\Polymorphism\V1\Interfaces\DispatchTable;
use GanbaroDigital\Polymorphism\V1\TypeMapping\MapDuckTypeToMethodName;

class TrimWhitespace
{
    /**
     * @var DispatchTable
     */
    private static $dispatchTable;

    /**
     * called once, when the class is autoloaded
     *
     * DO NOT CALL THIS YOURSELF
     *
     * @return void
     */
    public static function initDispatchTable()
    {
        self::$dispatchTable = new AllPurposeDispatchTable(
            [
                'Traversable' => 'trimFromTraversable',
                'string' => 'trimFromString'
            ],
            new MapDuckTypeToMethodName
        );
    }

    /**
     * our polymorphic method
     *
     * @param  mixed $item
     *         the variable to trim whitespace from
     * @return mixed
     *         the (possibly) modified variable
     */
    public static function from($item)
    {
        // instead of calling MapDuckTypeToMethodName directly, we let our
        // DispatchTable object do it for us
        //
        // it will only call MapDuckTypeToMethodName if it has no cached
        // result for $item
        $method = self::$dispatchTable->mapTypeToMethodName($item);

        // this is the same as our earlier example
        return self::$method($item);
    }

    /**
     * called from our `from()` method
     *
     * @param  array|stdClass|Traversable $item
     *         the item to iterate over
     * @return array
     *         the result of trimming everything inside $item
     */
    private static function trimFromTraversable($item)
    {
        $retval = [];
        foreach ($item as $key => $value) {
            $retval[$key] = self::from($value);
        }
        return $retval;
    }

    /**
     * called from our `from()` method
     *
     * @param  string $item
     *         the string to trim
     * @return string
     *         the trimmed string
     */
    private static function trimFromString($item)
    {
        // PHP will coerce into a string for us
        return trim($item);
    }

    /**
     * called from our `from()` method
     *
     * @param  mixed $item
     *         the item that we don't know how to trim
     * @return mixed
     *         the unmodified $item
     */
    private static function nothingMatchesTheInputType($item)
    {
        // we don't know how to process $item, so let's just
        // send back exactly what we received
        return $item;
    }
}

// SECRET SAUCE
// this creates our DispatchTable object when the class
// is auto-loaded
TrimWhitespace::initDispatchTable();
```

## Class Contract

Here is the contract for this class:

    GanbaroDigital\Polymorphism\V1\DispatchTables\AllPurposeDispatchTable
     [x] Can instantiate
     [x] is DispatchTable
     [x] starts with empty cache
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
