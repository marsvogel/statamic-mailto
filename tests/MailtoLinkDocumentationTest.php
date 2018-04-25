<?php

namespace Statamic\Addons\MailtoLink\Tests;

use Statamic\Addons\MailtoLink\MailtoLinkModel;
use Statamic\API\Parse;
use Statamic\Testing\TestCase;

class MailtoLinkDocumentationTest extends TestCase
{
    public function test_basic_tag_example()
    {
        $expected = '<a href="mailto:mail@example.com">mail@example.com</a>';
        $template = '{{ mailto_link :email="contact" }}';
        $variables = ['contact' => 'mail@example.com'];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_basic_tag_shorthand_example()
    {
        $expected = '<a href="mailto:mail@example.com">mail@example.com</a>';
        $template = '{{ mailto_link:contact }}';
        $variables = ['contact' => 'mail@example.com'];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_multiple_addresses_tag_example()
    {
        $expected = '<a href="mailto:one@example.com">one@example.com</a><a href="mailto:two@example.com">two@example.com</a>';
        $template = '{{ contacts }}{{ mailto_link :email="value" }}{{ /contacts }}';
        $variables = ['contacts' => ['one@example.com','two@example.com'] ];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_multiple_addresses_tag_shorthand_example()
    {
        $expected = '<a href="mailto:one@example.com">one@example.com</a><a href="mailto:two@example.com">two@example.com</a>';
        $template = '{{ contacts }}{{ mailto_link:value }}{{ /contacts }}';
        $variables = ['contacts' => ['one@example.com','two@example.com'] ];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_complex_tag_example()
    {
        $expected = '<a href="mailto:mail@example.com">mail@example.com</a>';
        $template = '{{ mailto_link }}{{ contact }}{{ /mailto_link }}';
        $variables = ['contact' => 'mail@example.com' ];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_specify_details_tag_example()
    {
        $expected = '<a href="mailto:mail@example.com?subject=Interest in Bacon&cc=two@example.com">mail@example.com</a>';
        $template = '{{ mailto_link :email="contact" :subject="subject" :cc="cc" }}';
        $variables = ['contact' => 'mail@example.com', 'subject' => 'Interest in Bacon', 'cc' => 'two@example.com'];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_specify_details_tag_shorthand_example()
    {
        $expected = '<a href="mailto:mail@example.com?subject=Interest in Bacon&cc=two@example.com">mail@example.com</a>';
        $template = '{{ mailto_link:contact :subject="subject" :cc="cc" }}';
        $variables = ['contact' => 'mail@example.com', 'subject' => 'Interest in Bacon', 'cc' => 'two@example.com'];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_specify_textnode_tag_example()
    {
        $expected = '<a href="mailto:mail@example.com">Get in Touch</a>';
        $template = '{{ mailto_link :email="contact" display="Get in Touch" }}';
        $variables = ['contact' => 'mail@example.com'];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_specify_html_attributes_tag_example()
    {
        $expected = '<a href="mailto:mail@example.com" class="link email-link">mail@example.com</a>';
        $template = '{{ mailto_link :email="contact" class="link email-link" }}';
        $variables = ['contact' => 'mail@example.com'];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_specify_html_attributes_tag_shorthand_example()
    {
        $expected = '<a href="mailto:mail@example.com" class="link email-link">mail@example.com</a>';
        $template = '{{ mailto_link:contact class="link email-link" }}';
        $variables = ['contact' => 'mail@example.com'];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_consuming_arrays_tag_shorthand_example()
    {
        $expected = '<a href="mailto:Jane Bacon <one@example.com>?cc=John Bacon <two@example.com>&bcc=Eliah Bacon <three@example.com>&subject=Interest in Bacon&body=Don\'t forget to add your contact informations :)" class="link email-link">Get in Touch</a>';
        $template = '{{ mailto_link:contact class="link email-link" }}';
        $variables = [
            'contact' => [
                'email' => "Jane Bacon <one@example.com>",
                'cc' => "John Bacon <two@example.com>",
                'bcc' => "Eliah Bacon <three@example.com>",
                'subject' => "Interest in Bacon",
                'body' => "Don't forget to add your contact informations :)",
                'display' => "Get in Touch",
            ]
        ];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_basic_modifier_example()
    {
        $expected = '<a href="mailto:mail@example.com">mail@example.com</a>';
        $template = '{{ contact | mailto_link }}';
        $variables = ['contact' => 'mail@example.com'];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_consuming_arrays_modifier_example()
    {
        $expected = '<a href="mailto:Jane Bacon <one@example.com>?cc=John Bacon <two@example.com>&bcc=Eliah Bacon <three@example.com>&subject=Interest in Bacon&body=Don\'t forget to add your contact informations :)">Get in Touch</a>';
        $template = '{{ contact | mailto_link }}';
        $variables = [
            'contact' => [
                'email' => "Jane Bacon <one@example.com>",
                'cc' => "John Bacon <two@example.com>",
                'bcc' => "Eliah Bacon <three@example.com>",
                'subject' => "Interest in Bacon",
                'body' => "Don't forget to add your contact informations :)",
                'display' => "Get in Touch",
            ]
        ];

        $actual = Parse::template($template, $variables);
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }

    public function test_api_constructor_example()
    {
        $mailto = addon('MailtoLink')->create();

        $this->assertInstanceOf(MailtoLinkModel::class, $mailto);
    }

    public function test_api_parameter_example()
    {
        $mailto = addon('MailtoLink')->create();

        $mailto->email = "Jane Bacon <one@example.com>";
        $mailto->cc = "John Bacon <two@example.com>";
        $mailto->bcc = "Eliah Bacon <three@example.com>";
        $mailto->subject = "Interest in Bacon";
        $mailto->body = "Don't forget to add your contact informations :)";
        $mailto->display = "Get in Touch";

        $this->assertEquals("Jane Bacon <one@example.com>", $mailto->email);
        $this->assertEquals("John Bacon <two@example.com>", $mailto->cc);
        $this->assertEquals("Eliah Bacon <three@example.com>", $mailto->bcc);
        $this->assertEquals("Interest in Bacon", $mailto->subject);
        $this->assertEquals("Don't forget to add your contact informations :)", $mailto->body);
        $this->assertEquals("Get in Touch", $mailto->display);
    }

    public function test_api_output_example()
    {
        $expected = '<a href="mailto:Jane Bacon <one@example.com>?cc=John Bacon <two@example.com>&bcc=Eliah Bacon <three@example.com>&subject=Interest in Bacon&body=Don\'t forget to add your contact informations :)">Get in Touch</a>';
        $mailto = addon('MailtoLink')->create();

        $mailto->email = "Jane Bacon <one@example.com>";
        $mailto->cc = "John Bacon <two@example.com>";
        $mailto->bcc = "Eliah Bacon <three@example.com>";
        $mailto->subject = "Interest in Bacon";
        $mailto->body = "Don't forget to add your contact informations :)";
        $mailto->display = "Get in Touch";

        $actual = $mailto->html();
        $actual = html_entity_decode($actual);
        $actual = urldecode($actual);

        $this->assertEquals($expected, $actual);
    }
}
