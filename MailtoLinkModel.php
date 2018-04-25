<?php

namespace Statamic\Addons\MailtoLink;

/**
 * Class MailtoModel
 *
 * @property string email
 * @property string cc
 * @property string bcc
 * @property string body
 * @property string subject
 * @property string display
 *
 * @package Statamic\Addons\MailtoLink
 */
class MailtoLinkModel
{
    private $parameters = [];

    /**
     * MailtoLinkModel constructor.
     *
     * @param array $parameters
     */
    public function __construct($parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function __set($name, $value)
    {
        return array_set($this->parameters, $name, $value);
    }

    public function __get($name)
    {
        return array_get($this->parameters, $name);
    }

    /**
     * Generates the html anchor tag
     *
     * @return string
     */
    public function html()
    {
        $href = $this->href();
        $attributes = $this->attributes();
        $display = $this->display();

        if ($attributes) {
            return "<a href=\"{$href}\" {$attributes}>{$display}</a>";
        }

        return "<a href=\"{$href}\">{$display}</a>";
    }

    /**
     * Takes all parameters, and formats it for HTML attribute key:value pairs
     *
     * @return string
     */
    private function attributes()
    {
        $html = app('html');

        $attributes = array_except($this->parameters, ['email', 'subject', 'cc', 'bcc', 'body', 'display', 'href']);
        $attributes = $html->attributes($attributes);
        $attributes = trim($attributes);

        return $attributes;
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
     * @return string
     */
    private function href()
    {
        $html = app('html');
        $queries = $this->queries();
        $email = $this->email();

        if ($queries) {
            return $html->obfuscate('mailto:') . $email . $html->obfuscate($queries);
        }

        return $html->obfuscate('mailto:') . $email;
    }

    /**
     * Generate the inner html of the anchor tag.
     *
     * @return mixed
     */
    private function display()
    {
        $html = app('html');
        $email = $this->email();
        $display = array_get($this->parameters, 'display', $email);

        $display = $html->entities($display);
        return $display;
    }

    /**
     * @return mixed
     */
    private function email()
    {
        $html = app('html');
        $email = array_get($this->parameters, 'email');
        $email = $html->email(trim($email));
        return $email;
    }

}
