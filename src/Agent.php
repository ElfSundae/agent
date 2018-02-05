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
     * {@inheritdoc}
     */
    public function __construct(array $headers = null, $userAgent = null)
    {
        parent::__construct($headers, $userAgent);
    }

    /**
     * {@inheritdoc}
     */
    public function version($propertyName, $type = self::VERSION_TYPE_STRING)
    {
        $version = parent::version($propertyName, $type);

        if (is_string($version)) {
            $version = str_replace(['_', ' ', '/'], '.', $version);
        }

        return $version;
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

    /**
     * Get the operating system name.
     *
     * @return string
     */
    public function os()
    {
        return $this->platform();
    }

    /**
     * Get the operating system version.
     *
     * @return string
     */
    public function osVersion()
    {
        return $this->version($this->os());
    }
}
