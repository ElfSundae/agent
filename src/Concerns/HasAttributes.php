<?php

namespace ElfSundae\Agent\Concerns;

use Illuminate\Support\Arr;

trait HasAttributes
{
    /**
     * All of the attributes set.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Get all of the attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Determine if the given attribute value exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function has($key)
    {
        return Arr::has($this->attributes, $key);
    }

    /**
     * Get the specified attribute.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return Arr::get($this->attributes, $key, $default);
    }

    /**
     * Set the given attributes.
     *
     * @param  string|array  $key
     * @param  mixed  $value
     * @return $this
     */
    public function set($key, $value = null)
    {
        $data = is_array($key) ? $key : [$key => $value];

        foreach ($data as $k => $v) {
            Arr::set($this->attributes, $k, $v);
        }

        return $this;
    }

    /**
     * Remove the given attributes.
     *
     * @param  string|array  $keys
     * @return $this
     */
    public function remove($keys)
    {
        $keys = is_array($keys) ? $keys : func_get_args();

        Arr::forget($this->attributes, $keys);

        return $this;
    }

    /**
     * Remove all attributes.
     *
     * @return $this
     */
    public function flush()
    {
        $this->attributes = [];

        return $this;
    }

    /**
     * Convert the instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getAttributes();
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to JSON.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Determine if the given offset exists.
     *
     * @param  string  $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * Get the value for a given offset.
     *
     * @param  string  $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Set the value at the given offset.
     *
     * @param  string  $offset
     * @param  mixed   $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * Unset the value at the given offset.
     *
     * @param  string  $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}
