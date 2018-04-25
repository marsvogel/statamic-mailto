<?php

namespace Statamic\Addons\MailtoLink;

use Statamic\Extend\Tags;

class MailtoLinkTags extends Tags
{
    /**
     * The {{ mailto }} tag or tag pair
     *
     * @return string|array
     * @throws \Statamic\Exceptions\ApiNotFoundException
     */
    public function index()
    {
        $email = $this->parse([]);
        $parameters = $this->parameters;

        if ($email) {
            array_set($parameters, 'email', $email);
        }

        return $this->output($parameters);
    }

    /**
     * The {{ mailto:[context_variable] }} tag
     *
     * @param $method
     * @param $args
     * @return string|array
     * @throws \Statamic\Exceptions\ApiNotFoundException
     */
    public function __call($method, $args)
    {
        $email = explode(':', $this->tag, 2)[1];
        $email = array_get($this->context, $email);
        $parameters = $this->parameters;

        if (is_array($email)) {
            $parameters = array_merge($email, $parameters);
        } else {
            array_set($parameters, 'email', $email);
        }

        return $this->output($parameters);
    }

    /**
     * @param $parameters
     * @return mixed
     * @throws \Statamic\Exceptions\ApiNotFoundException
     */
    private function output($parameters)
    {
        return $this->api()->create($parameters)->html();
    }


}
