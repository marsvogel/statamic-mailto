## Arguments / Parameters

Argument | Description
-------- | -----------
`email` | The email.
`subject` | Sets the subject of the mail.
`cc` | Indicates those who are to receive a copy of a message addressed primarily to another (CC is the abbreviation of carbon copy). The list of recipients in copy is visible to all other recipients of the message.
`bcc` | An additional BCC (blind carbon copy) field is available for hidden notification; recipients listed in the BCC field receive a copy of the message, but are not shown on any other recipient's copy (including other BCC recipients).
`body` | Allows you to specify a short content message for the new email.
`display` | The visible text shown instead of the email address
`*` | Any other argument will be used as html attribute

## Data format for `email`, `cc` and `bcc`

You can use any email notation an email client would understand, you can even use multiple addresses seperated by comma.

```
{{ mailto_link email="mail@example.com" display="Get in Touch" }}
{{ mailto_link email="Jane Bacon <mail@example.com>" display="Get in Touch" }}
{{ mailto_link email="one@example.com, two@example.com" display="Get in Touch" }}
{{ mailto_link email="Jane Bacon <one@example.com>, John Bacon <two@example.com>" display="Get in Touch" }}
```

```.language-output
<a href="mailto:mail@example.com">Get in Touch</a>
<a href="mailto:Jane Bacon <mail@example.com>">Get in Touch</a>
<a href="mailto:one@example.com, two@example.com">Get in Touch</a>
<a href="mailto:Jane Bacon <one@example.com>, John Bacon <two@example.com>">Get in Touch</a>
```

## Usage

## The Tag

Like any other [Tag] you can use variables as parameters. There is also a `{{ glide }}` like shorthand, so you don't have to set the `email` parameter explicit.

```.language-yaml
contact: "mail@example.com"
```

```
{{ mailto_link :email="contact" }}

<!-- shorthand syntax: -->
{{ mailto_link:contact }}
```

```.language-output
<a href="mailto:mail@example.com">mail@example.com</a>
```

### Multiple email addresses

If you have a list of email addresses you can loop over them like you would normaly do.

```.language-yaml
contacts: 
  - "one@example.com"
  - "two@example.com"
```

Since the current iteration of the loop would be output using `{{ value }}`, you can reference that in the tag. This is very much like the `glide` tags behaves.

```
{{ contacts }}
  {{ mailto_link :email="value" }}
{{ /contacts }}

<!-- shorthand syntax: -->
{{ contacts }}
  {{ mailto_link:value }}
{{ /contacts }}
```

```.language-output
<a href="mailto:one@example.com">one@example.com</a>
<a href="mailto:two@example.com">two@example.com</a>
```

### Complex Templates

If you need the email address to be generated with another tag, you can’t just drop that into the email parameter. Instead, use the tag as a tag pair. The contents of the tag will be used as the `email` parameter.

```.language-yaml
contact: "mail@example.com"
```

```
{{ mailto_link }}
  {{ contact }}
{{ /mailto_link }}
```

```.language-output
<a href="mailto:mail@example.com">mail@example.com</a>
```

### Specifying details

In addition to the `email` address, you can provide other information. Supported parameters are `subject`, `cc`, `bcc` and `body`. Each parameter and its value is specified as a query term.

```.language-yaml
contact: "mail@example.com"
subject: "Interest in Bacon"
cc: "two@example.com"
```

```
{{ mailto_link :email="contact" :subject="subject" :cc="cc" }}

<!-- shorthand syntax: -->
{{ mailto_link:contact :subject="subject" :cc="cc" }}
```

```.language-output
<a href="mailto:mail@example.com?subject=Interest in Bacon&cc=two@example.com">mail@example.com</a>
```

If you want to change the text node of the anchor element, you can use the `display` parameter.

```.language-yaml
contact: "mail@example.com"
```

```
{{ mailto_link :email="contact" display="Get in Touch" }}

<!-- shorthand syntax: -->
{{ mailto_link:contact display="Get in Touch" }}
```

```.language-output
<a href="mailto:mail@example.com">Get in Touch</a>
```

### Adding html attributes and classes

Every parameter that is not `email`, `subject`, `cc`, `bcc`, `body`, `display` or `href` will be added as a html attribute. If you want to add a couple of classes to the anchor element, just add a `class` parameter.

```.language-yaml
contact: "mail@example.com"
```

```
{{ mailto_link :email="contact" class="link email-link" }}

<!-- shorthand syntax: -->
{{ mailto_link:contact class="link email-link" }}
```

```.language-output
<a href="mailto:mail@example.com" class="link email-link">mail@example.com</a>
```

### Consuming arrays

When using the short hand syntax, you can add use an array instead of a simple email string.

```.language-yaml
contact:
  email: "Jane Bacon <one@example.com>"
  cc: "John Bacon <two@example.com>"
  bcc: "Eliah Bacon <three@example.com>"
  subject: "Interest in Bacon"
  body: "Don't forget to add your contact informations :)"
  display: "Get in Touch"
```

```
<!-- shorthand syntax: -->
{{ mailto_link:contact class="link email-link" }}
```

```.language-output
<a href="mailto:Jane Bacon <one@example.com>?cc=John Bacon <two@example.com>&bcc=Eliah Bacon <three@example.com>&subject=Interest in Bacon&body=Don't forget to add your contact informations :)" class="link email-link">Get in Touch</a>
```

## The modifier

The modifier takes the same parameters as the tag. The very basic example looks like this:

```.language-yaml
contact: "mail@example.com"
```

```
<!-- shorthand syntax: -->
{{ contact | mailto_link }}
```

```.language-output
<a href="mailto:mail@example.com">mail@example.com</a>
```

### Consuming arrays

You can add use an array instead of a simple email string.

```.language-yaml
contact:
  email: "Jane Bacon <one@example.com>"
  cc: "John Bacon <two@example.com>"
  bcc: "Eliah Bacon <three@example.com>"
  subject: "Interest in Bacon"
  body: "Don't forget to add your contact informations :)"
  display: "Get in Touch"
```

```
<!-- shorthand syntax: -->
{{ contact | mailto_link }}
```

```.language-output
<a href="mailto:Jane Bacon <one@example.com>?cc=John Bacon <two@example.com>&bcc=Eliah Bacon <three@example.com>&subject=Interest in Bacon&body=Don't forget to add your contact informations :)">Get in Touch</a>
```

## The API

In another addon, you may do `$this->api('MailtoLink')->create()` to get a `MailtoLinkModel` object.

``` .language-php
<?php

/**
 * MailtoLinkModel constructor.
 * 
 * @param array $parameters
 */
$mailto = $this->api('MailtoLink')->create()

/**
 * You can set any parameter like so
 */
$mailto->email = "Jane Bacon <one@example.com>";
$mailto->cc = "John Bacon <two@example.com>";
$mailto->bcc = "Eliah Bacon <three@example.com>";
$mailto->subject = "Interest in Bacon";
$mailto->body = "Don't forget to add your contact informations :)";
$mailto->display = "Get in Touch";

/**
 * Access any parameter
 */

echo $mailto->email;
// Jane Bacon <one@example.com>

/**
 * Output your html
 */
echo $mailto->html();
```

```.language-output
<a href="mailto:Jane Bacon <one@example.com>?cc=John Bacon <two@example.com>&bcc=Eliah Bacon <three@example.com>&subject=Interest in Bacon&body=Don't forget to add your contact informations :)">Get in Touch</a>
```

[Tag](https://docs.statamic.com/antlers#tags)
