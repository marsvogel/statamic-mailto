<?php

namespace Statamic\Addons\MailtoLink\Tests;

use Statamic\Addons\MailtoLink\MailtoLinkModel;
use Statamic\API\Parse;
use Statamic\Testing\TestCase;

class MailtoLinkTest extends TestCase
{
    private $configurations = [

        [
            'templates' => [
                [ 'template' => '{{ mailto_link email="mail@example.com" }}', 'context' => [] ],
                [ 'template' => '{{ mailto_link:context_variable }}', 'context' => [ 'context_variable' => 'mail@example.com' ] ],
                [ 'template' => '{{ mailto_link:context_variable }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com'] ] ],
                [ 'template' => '{{ context_variable | mailto_Link }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com'] ] ],
                [ 'template' => '{{ context_variable | mailto_Link }}', 'context' => [ 'context_variable' => 'mail@example.com' ] ],
            ],
            'parameters' => ['email' => 'mail@example.com'],
            'expected' => '<a href="mailto:mail@example.com">mail@example.com</a>',
        ],

        [
            'templates' => [
                [ 'template' => '{{ mailto_link email="mail@example.com" display="Send email" }}', 'context' => [] ],
                [ 'template' => '{{ mailto_link:context_variable display="Send email" }}', 'context' => [ 'context_variable' => 'mail@example.com' ] ],
                [ 'template' => '{{ mailto_link:context_variable display="Send email" }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'display' => 'Send email'] ] ],
                [ 'template' => '{{ context_variable | mailto_Link }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'display' => 'Send email'] ] ],
            ],
            'parameters' => ['email' => 'mail@example.com', 'display' => 'Send email'],
            'expected' => '<a href="mailto:mail@example.com">Send email</a>',
        ],

        [
            'templates' => [
                [ 'template' => '{{ mailto_link email="mail@example.com" title="Drop me a nice compliment" }}', 'context' => [] ],
                [ 'template' => '{{ mailto_link:context_variable title="Drop me a nice compliment" }}', 'context' => [ 'context_variable' => 'mail@example.com' ] ],
                [ 'template' => '{{ mailto_link:context_variable title="Drop me a nice compliment" }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'title' => 'Drop me a nice compliment'] ] ],
                [ 'template' => '{{ context_variable | mailto_Link }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'title' => 'Drop me a nice compliment'] ] ],
            ],
            'parameters' => ['email' => 'mail@example.com', 'title' => 'Drop me a nice compliment'],
            'expected' => '<a href="mailto:mail@example.com" title="Drop me a nice compliment">mail@example.com</a>',
        ],

        [
            'templates' => [
                [ 'template' => '{{ mailto_link email="mail@example.com" subject="Want to buy a package" }}', 'context' => [] ],
                [ 'template' => '{{ mailto_link:context_variable subject="Want to buy a package" }}', 'context' => [ 'context_variable' => 'mail@example.com' ] ],
                [ 'template' => '{{ mailto_link:context_variable subject="Want to buy a package" }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'subject' => 'Want to buy a package'] ] ],
                [ 'template' => '{{ context_variable | mailto_Link }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'subject' => 'Want to buy a package'] ] ],
            ],
            'parameters' => ['email' => 'mail@example.com', 'subject' => 'Want to buy a package'],
            'expected' => '<a href="mailto:mail@example.com?subject=Want to buy a package">mail@example.com</a>',
        ],

        [
            'templates' => [
                [ 'template' => '{{ mailto_link email="mail@example.com" cc="another.mail@example.com" }}', 'context' => [] ],
                [ 'template' => '{{ mailto_link:context_variable cc="another.mail@example.com" }}', 'context' => [ 'context_variable' => 'mail@example.com' ] ],
                [ 'template' => '{{ mailto_link:context_variable cc="another.mail@example.com" }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'cc' => 'another.mail@example.com'] ] ],
                [ 'template' => '{{ context_variable | mailto_Link }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'cc' => 'another.mail@example.com'] ] ],
            ],
            'parameters' => ['email' => 'mail@example.com', 'cc' => 'another.mail@example.com'],
            'expected' => '<a href="mailto:mail@example.com?cc=another.mail@example.com">mail@example.com</a>',
        ],

        [
            'templates' => [
                [ 'template' => '{{ mailto_link email="mail@example.com" bcc="another.mail@example.com" }}', 'context' => [] ],
                [ 'template' => '{{ mailto_link:context_variable bcc="another.mail@example.com" }}', 'context' => [ 'context_variable' => 'mail@example.com' ] ],
                [ 'template' => '{{ mailto_link:context_variable bcc="another.mail@example.com" }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'bcc' => 'another.mail@example.com'] ] ],
                [ 'template' => '{{ context_variable | mailto_Link }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'bcc' => 'another.mail@example.com'] ] ],
            ],
            'parameters' => ['email' => 'mail@example.com', 'bcc' => 'another.mail@example.com'],
            'expected' => '<a href="mailto:mail@example.com?bcc=another.mail@example.com">mail@example.com</a>',
        ],

        [
            'templates' => [
                [ 'template' => '{{ mailto_link email="mail@example.com" body="Lorem ipsum dolores." }}', 'context' => [] ],
                [ 'template' => '{{ mailto_link:context_variable body="Lorem ipsum dolores." }}', 'context' => [ 'context_variable' => 'mail@example.com' ] ],
                [ 'template' => '{{ mailto_link:context_variable body="Lorem ipsum dolores." }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'body' => 'Lorem ipsum dolores.'] ] ],
                [ 'template' => '{{ context_variable | mailto_Link }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'body' => 'Lorem ipsum dolores.'] ] ],
            ],
            'parameters' => ['email' => 'mail@example.com', 'body' => 'Lorem ipsum dolores.'],
            'expected' => '<a href="mailto:mail@example.com?body=Lorem ipsum dolores.">mail@example.com</a>',
        ],

        [
            'templates' => [
                [ 'template' => '{{ mailto_link email="mail@example.com" class="link email-link" }}', 'context' => [] ],
                [ 'template' => '{{ mailto_link:context_variable class="link email-link" }}', 'context' => [ 'context_variable' => 'mail@example.com' ] ],
                [ 'template' => '{{ mailto_link:context_variable class="link email-link" }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'class' => 'link email-link'] ] ],
                [ 'template' => '{{ context_variable | mailto_Link }}', 'context' => [ 'context_variable' => ['email' => 'mail@example.com', 'class' => 'link email-link'] ] ],
            ],
            'parameters' => ['email' => 'mail@example.com', 'class' => 'link email-link'],
            'expected' => '<a href="mailto:mail@example.com" class="link email-link">mail@example.com</a>',
        ],

        [
            'templates' => [
                [ 'template' => '{{ mailto_link email="one@example.com,two@example.com" cc="three@example.com,four@example.com" bcc="five@example.com,six@example.com" display="Spam everyone!" }}', 'context' => [] ],
                [ 'template' => '{{ mailto_link:context_variable cc="three@example.com,four@example.com" bcc="five@example.com,six@example.com" display="Spam everyone!" }}', 'context' => [ 'context_variable' => 'one@example.com,two@example.com' ] ],
                [ 'template' => '{{ mailto_link:context_variable cc="three@example.com,four@example.com" bcc="five@example.com,six@example.com" display="Spam everyone!" }}', 'context' => [ 'context_variable' => ['email' => 'one@example.com,two@example.com', 'cc' => 'three@example.com,four@example.com', 'bcc' => 'five@example.com,six@example.com', 'display' => 'Spam everyone!'] ] ],
                [ 'template' => '{{ context_variable | mailto_Link }}', 'context' => [ 'context_variable' => ['email' => 'one@example.com,two@example.com', 'cc' => 'three@example.com,four@example.com', 'bcc' => 'five@example.com,six@example.com', 'display' => 'Spam everyone!'] ] ],
            ],
            'parameters' => ['email' => 'one@example.com,two@example.com', 'cc' => 'three@example.com,four@example.com', 'bcc' => 'five@example.com,six@example.com', 'display' => 'Spam everyone!'],
            'expected' => '<a href="mailto:one@example.com,two@example.com?cc=three@example.com,four@example.com&bcc=five@example.com,six@example.com">Spam everyone!</a>',
        ],

    ];

    public function test_model()
    {
        foreach ($this->configurations as $configuration) {

            $expected = $configuration['expected'];
            $parameters = $configuration['parameters'];

            $actual = new MailtoLinkModel($parameters);
            $actual = $actual->html();
            $actual = html_entity_decode($actual);
            $actual = urldecode($actual);

            $this->assertEquals($expected, $actual);
        }
    }

    public function test_api()
    {
        foreach ($this->configurations as $configuration) {

            $expected = $configuration['expected'];
            $parameters = $configuration['parameters'];

            $actual = addon('MailtoLink');
            $actual = $actual->create($parameters);
            $actual = $actual->html();
            $actual = html_entity_decode($actual);
            $actual = urldecode($actual);

            $this->assertEquals($expected, $actual);
        }
    }

    public function test_templates()
    {
        foreach ($this->configurations as $configuration) {

            $expected = $configuration['expected'];
            $templates = $configuration['templates'];

            foreach ($templates as $template) {
                $actual = Parse::template($template['template'], $template['context']);
                $actual = html_entity_decode($actual);
                $actual = urldecode($actual);

                $this->assertEquals($expected, $actual);
            }
        }
    }

}
