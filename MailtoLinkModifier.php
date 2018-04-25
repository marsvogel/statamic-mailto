<?php

namespace Statamic\Addons\MailtoLink;

use Statamic\Extend\Modifier;

class MailtoLinkModifier extends Modifier
{
    /**
     * Modify a value
     *
     * @param mixed $value The value to be modified
     * @param array $params Any parameters used in the modifier
     * @param array $context Contextual values
     * @return mixed
     * @throws \Statamic\Exceptions\ApiNotFoundException
     */
    public function index($value, $params, $context)
    {
        if (is_array($value)) {
            return $this->api()->create($value)->html();
        }

        return $this->api()->create(['email' => $value])->html();
    }
}
