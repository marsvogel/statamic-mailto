<?php

namespace Statamic\Addons\MailtoLink;

use Statamic\Extend\API;

class MailtoLinkAPI extends API
{
    /**
     * Accessed by $this->api('MailtoLink')->example() from other addons
     * @param array $parameters
     * @return MailtoLinkModel
     */
    public function create($parameters = [])
    {
        return new MailtoLinkModel($parameters);
    }
}
