<?php

/**
 * Here be dragons!
 *
 * TEMPORARY stubs/shims for PHP features required by Twig
 *
 * NOTE: These shims are temporary, and must all be implemented properly in Uniter
 *       and removed from here before a stable release can be tagged!
 */

function truncate($string, $maxLength = 20)
{
    if (strlen($string) > $maxLength) {
        return substr($string, 0, $maxLength) . '...';
    }

    return $string;
}

function addcslashes($string, $charlist)
{
    trigger_error('addcslashes() shim :: Not escaping "' . $charlist . '" for string "' . truncate($string) . '"');

    return $string;
}
function array_chunk(array $array, $size, $preserveKeys = false)
{
    $chunk = 0;
    $counter = 0;
    $result = [];

    if ($preserveKeys) {
        foreach ($array as $key => $element) {
            if ($counter === $size) {
                $counter = 0;
                $chunk++;
            }

            $result[$chunk][$key] = $element;
            $counter++;
        }
    } else {
        foreach ($array as $element) {
            if ($counter === $size) {
                $counter = 0;
                $chunk++;
            }

            $result[$chunk][] = $element;
            $counter++;
        }
    }

    return $result;
}
function array_combine(array $keys, array $values)
{
    $result = [];

    foreach ($keys as $index => $key) {
        $result[$key] = $values[$index];
    }

    return $result;
}
function array_reverse($array, $preserveKeys = false)
{
    $result = [];
    $keys = array_keys($array);

    if ($preserveKeys) {
        for ($i = count($keys) - 1; $i >= 0; $i--) {
            $result[$keys[$i]] = $array[$keys[$i]];
        }
    } else {
        for ($i = count($keys) - 1; $i >= 0; $i--) {
            $result[] = $array[$keys[$i]];
        }
    }

    return $result;
}
function array_unshift(array $array)
{
    $newArray = func_get_args();
    array_shift($newArray);

    foreach ($array as $key => $value) {
        if (is_string($key)) {
            $newArray[$key] = $value;
        } else {
            $newArray[] = $value;
        }
    }

    return $newArray;
}
function arsort($array, $sortFlags = SORT_REGULAR)
{
    trigger_error('arsort() shim :: Not sorting');

    return true;
}
function asort($array, $sortFlags = SORT_REGULAR)
{
    trigger_error('asort() shim :: Not sorting');

    return true;
}
function class_alias($original, $alias, $autoload = true)
{
    trigger_error('class_alias() shim :: Aliasing "' . $original . '" as "' . $alias . '"');
}
function ctype_alpha($text)
{
    trigger_error('ctype_alpha() shim :: Shimming for "' . truncate($text) . '"');

    return preg_match('/^[a-z]+$/i', $text) === 1;
}
function debug_backtrace()
{
    trigger_error('debug_backtrace() shim :: Just returning an empty array');

    return [];
}
function get_class_methods($className)
{
    trigger_error('get_class_methods() shim :: Not returning methods for class "' . truncate((string)$className) . '"');

    return ['getmake_bold'];
}
function hash($algorithm, $data, $rawOutput = false)
{
    trigger_error('hash() shim :: Returning fake hash for "' . $algorithm . '" algo with data "' . truncate($data) . '"');

    return 'this_is_not_a_hash__' . preg_replace('/\W/', '_', $data);
}
function ini_get($varName)
{
    trigger_error('ini_get() shim :: Returning empty string for INI var "' . $varName . '"');

    return '';
}
function ksort($array, $sortFlags = SORT_REGULAR)
{
    trigger_error('ksort() shim :: Not sorting');

    return true;
}
function levenshtein($str1, $str2)
{
    trigger_error(
        sprintf('levenshtein() shim :: Just returning 1 for "%s" and "%s"', $str1, $str2)
    );

    return 1;
}
function ltrim($string)
{
    trigger_error('ltrim() shim :: Not trimming "' . truncate($string) . '"');

    return $string;
}
function setlocale($category, $locale)
{
    trigger_error('setlocale() shim :: Not using category "' . $category . '" / locale "' . $locale . '"');

    return $locale;
}
function sort(array $array)
{
    trigger_error('sort() shim :: Not sorting');

    return true;
}
function str_repeat($string, $multiplier)
{
    $result = '';

    for ($i = 0; $i < $multiplier; $i++) {
        $result .= $string;
    }

    return $result;
}
function stripcslashes($string)
{
    trigger_error('stripcslashes() shim :: Not unescaping string "' . truncate($string) . '"');

    return $string;
}

class ArrayIterator implements Iterator
{
    private $position = 0;
    private $keys;
    private $wrappedArray;

    public function __construct(array $wrappedArray)
    {
        $this->keys = array_keys($wrappedArray);
        $this->wrappedArray = $wrappedArray;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->wrappedArray[$this->keys[$this->position]];
    }

    public function key()
    {
        return $this->keys[$this->position];
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->keys[$this->position]);
    }
}

class ReflectionClass
{
    /**
     * @var string
     */
    private $classNameOrObject;

    /**
     * @param string $classNameOrObject
     */
    public function __construct($classNameOrObject)
    {
        $this->classNameOrObject = $classNameOrObject;
    }

    public function getMethods()
    {
        return [];
    }

    public function getName()
    {
        return $this->classNameOrObject;
    }
}

class ReflectionMethod
{
    /**
     * @var string
     */
    private $methodName;

    /**
     * @var object
     */
    private $object;

    /**
     * @param object $object
     * @param string $methodName
     */
    public function __construct($object, $methodName)
    {
        if ($methodName !== 'initRuntime' && $methodName !== 'getGlobals') {
            throw new \Exception(
                'ReflectionMethod shim :: Unexpected method ' . get_class($object) . '::' . $methodName
            );
        }

        $this->methodName = $methodName;
        $this->object = $object;
    }

    public function getDeclaringClass()
    {
        // Note this should be the class the method is defined in in the hierarchy,
        // not just the class of the object passed into the ctor
        return new ReflectionClass('Twig_Extension');
    }
}
