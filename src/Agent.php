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
