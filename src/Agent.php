<?php

namespace ElfSundae\Agent;

use ArrayAccess;
use JsonSerializable;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent as BaseAgent;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class Agent extends BaseAgent implements ArrayAccess, Arrayable, Jsonable, JsonSerializable
{
    use Concerns\HasAttributes;

    /**
     * The additional properties.
     *
     * @var array
     */
    protected static $addedProperties = [
        'WeChat' => 'MicroMessenger/[VER]',
        'QQ' => 'QQ/[VER]',
        'NetType' => 'NetType/[VER]',
        'Language' => 'Language/[VER]',
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct(array $headers = null, $userAgent = null)
    {
        parent::__construct($headers, $userAgent);

        $this->addProperties();
    }

    /**
     * Add the additional properties.
     */
    protected function addProperties()
    {
        if (! empty(static::$addedProperties)) {
            parent::$properties = array_merge(
                parent::$properties,
                static::$addedProperties
            );

            static::$addedProperties = [];
        }
    }

    /**
     * Get the version number of the given property in the User-Agent.
     *
     * @param  string  $propertyName
     * @return float
     */
    public function versionNumber($propertyName)
    {
        return $this->version($propertyName, self::VERSION_TYPE_FLOAT);
    }

    /**
     * Get the operating system name.
     *
     * @return string
     */
    public function os()
    {
        return $this->platform() ?: null;
    }

    /**
     * Get the operating system version.
     *
     * @return string
     */
    public function osVersion()
    {
        if ($version = $this->version($this->os())) {
            return str_replace('_', '.', $version);
        }
    }

    /**
     * Get the accept language.
     *
     * @param  string|null  $preferLanguage
     * @return string|bool
     */
    public function language($preferLanguage = null)
    {
        $languages = $this->languages();

        if (is_null($preferLanguage)) {
            return reset($languages);
        }

        $preferLanguage = strtolower($preferLanguage);
        foreach ($languages as $lang) {
            if (Str::startsWith($lang, $preferLanguage)) {
                return true;
            }
        }

        return false;
    }
}
