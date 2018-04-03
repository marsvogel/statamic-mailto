<?php

namespace Statamic\Addons\Mailto;

use Statamic\Extend\Tags;

/**
 * Class MailtoTags
 *
 * Generate a mailto link element with the value as the email address.
 * If it’s not an email address, it’s going to be one busted link.
 *
 * @package Statamic\Addons\Mailto
 */
class MailtoTags extends Tags
{

    /**
     * Maps to {{ mailto:[mail] }}
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        $html = app('html');

        $mail = $this->tag_method;
        $address = array_get($this->context, $mail, $mail);
        $email = $html->email(trim($address));

        return $this->html($email);
    }

    /**
     * Generates the html anchor tag
     *
     * @param $email
     * @return string
     */
    private function html($email)
    {
        $href = $this->href($email);
        $attributes = trim($this->attributes());
        $text = $this->text($email);

        if ($attributes) {
            return "<a href=\"{$href}\" {$attributes}>{$text}</a>";
        }
        return "<a href=\"{$href}\">{$text}</a>";
    }

    /**
     * Takes all parameters, and formats it for HTML attribute key:value pairs
     *
     * @return string
     */
    private function attributes()
    {
        $html = app('html');
        $attributes = array_except($this->parameters, ['subject', 'cc', 'bcc', 'body', 'display', 'href']);

        return $html->attributes($attributes);
    }

    /**
     * Specify initial values for headers (e.g. subject, cc, etc.)
     * and message body in the URL. Blanks, carriage returns,
     * and line feeds will be percent-encoded.
     *
     * @return null|string
     */
    private function queries()
    {
        $params = array_only($this->parameters, ['subject', 'cc', 'bcc', 'body']);

        if ($params) {
            return '?' . http_build_query($params, null, ini_get('arg_separator.output'), PHP_QUERY_RFC3986);
        }

        return '';
    }

    /**
     * Generate and obfuscate the href attribute
     *
     * @param $email
     * @return string
     */
    private function href($email)
    {
        $html = app('html');

        if ($this->queries()) {
            return $html->obfuscate('mailto:') . $email . $html->obfuscate($this->queries());
        }
        return $html->obfuscate('mailto:') . $email;
    }

    /**
     * Generate the inner html of the anchor tag.
     *
     * @param $email
     * @return mixed
     */
    private function text($email)
    {
        $html = app('html');

        $display = $this->getParam('display', $email);
        $text = $html->entities($display);
        return $text;
    }
}
