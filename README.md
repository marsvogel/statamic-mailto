# Tag: mailto

Generate a `mailto` link element with the value as the email address. If it's _not_ an email address, it's going to be one busted link. Obfuscates an email address with special characters making it hard for spam bots to sniff out and scrape off your site. Still reads like an email address as far as readers are concerned.
 
 Obfuscation is a method of encoding content so that the source code is hard or impossible to understand. This is generally used on email addresses to prevent spambots from recognizing it as an email address and keeping you safe from unwanted emails.
 
## Usage

This tag takes all parameters, and formats it for HTML attribute key:value pairs.

```html
{{ mailto:mail@example.com title="Drop me a nice compliment" }}
```

```html
<a href="&#x6d;&#x61;i&#x6c;&#116;o&#58;&#109;&#97;&#x69;l&#64;e&#120;&#97;&#x6d;&#112;&#108;&#101;&#46;c&#111;m" title="Drop me a nice compliment">&#109;&#97;&#x69;l&#64;e&#120;&#97;&#x6d;&#112;&#108;&#101;&#46;c&#111;m</a>
```

## Arguments

Argument | Description
-------- | -----------
`subject` | Sets the subject of the mail. `{{ mailto:mail@example.com subject="Want to buy a package" }}`
`cc` | Indicates those who are to receive a copy of a message addressed primarily to another (CC is the abbreviation of carbon copy). The list of recipients in copy is visible to all other recipients of the message. `{{ mailto:mail@example.com cc="anothermail@example.com" }}`
`bcc` | An additional BCC (blind carbon copy) field is available for hidden notification; recipients listed in the BCC field receive a copy of the message, but are not shown on any other recipient's copy (including other BCC recipients). `{{ mailto:mail@example.com bcc="anothermail@example.com" }}`
`body` | Allows you to specify a short content message for the new email. `{{ mailto:mail@example.com body="Hy there!" }}`
`display` | The visible text shown instead of the email address `{{ mailto:mail@example.com display="Drop me a mail" }}`
`*` | Any other argument will be used as html attribute `{{ mailto:mail@example.com class="link email-link" }}`

## Examples

Show some text instead the actual email address.

```html
<!-- In your template -->
{{ mailto:someone@example.com display="Send email" }}
<!-- What the user will see -->
<a href="mailto:someone@example.com">Send email</a>
<!-- What actually will be rendered -->
<a href="&#x6d;ai&#x6c;&#116;&#x6f;&#x3a;&#115;o&#x6d;&#101;&#111;&#110;e&#64;&#x65;&#120;&#x61;&#x6d;&#x70;l&#x65;&#x2e;co&#109;">Send email</a>
```

Add a title attribute for a nice tooltips (The `title` attribute contains a text representing advisory information related to the element it belongs to. Such information can typically, but not necessarily, be presented to the user as a tooltip.)

```html
<!-- In your template -->
{{ mailto:mail@example.com title="Drop me a nice compliment" }}
<!-- What the user will see -->
<a href="mailto:mail@example.com" title="Drop me a nice compliment">mail@example.com</a>
<!-- What actually will be rendered -->
<a href="&#109;&#x61;&#x69;&#108;&#x74;o:m&#97;&#x69;l&#x40;&#x65;&#x78;a&#x6d;pl&#101;.&#99;&#111;&#109;" title="Drop me a nice compliment">m&#97;&#x69;l&#x40;&#x65;&#x78;a&#x6d;pl&#101;.&#99;&#111;&#109;</a>
```

Suggest a mail subject.

```html
<!-- In your template -->
{{ mailto:mail@example.com subject="Want to buy a package" }}
<!-- What the user will see -->
<a href="mailto:mail@example.com?subject=Want%20to%20buy%20a%20package">mail@example.com</a>
<!-- What actually will be rendered -->
<a href="&#109;&#97;&#105;&#x6c;t&#111;&#x3a;&#x6d;&#97;i&#108;&#64;&#x65;&#x78;a&#x6d;&#112;l&#101;&#x2e;&#99;&#x6f;m&#63;su&#x62;j&#101;&#x63;t=&#87;an&#116;&#x25;2&#x30;to&#37;&#50;&#x30;&#98;&#117;&#121;%&#x32;&#x30;&#97;%&#50;&#x30;p&#x61;ck&#x61;g&#101;">&#x6d;&#97;i&#108;&#64;&#x65;&#x78;a&#x6d;&#112;l&#101;&#x2e;&#99;&#x6f;m</a>
```

CC another email address.

```html
<!-- In your template -->
{{ mailto:mail@example.com cc="anothermail@example.com" }}
<!-- What the user will see -->
<a href="mailto:mail@example.com?cc=anothermail%40example.com">mail@example.com</a>
<!-- What actually will be rendered -->
<a href="&#x6d;&#x61;&#x69;l&#x74;o&#58;&#x6d;&#97;&#105;l&#64;exa&#x6d;&#112;&#108;e&#x2e;&#99;&#111;&#109;&#x3f;cc&#x3d;&#97;&#110;&#x6f;ther&#x6d;&#97;&#x69;&#108;%4&#48;exampl&#x65;&#x2e;&#99;&#x6f;m">&#x6d;&#97;&#105;l&#64;exa&#x6d;&#112;&#108;e&#x2e;&#99;&#111;&#109;</a>
```

BCC another email address.

```html
<!-- In your template -->
{{ mailto:mail@example.com bcc="anothermail@example.com" }}
<!-- What the user will see -->
<a href="mailto:mail@example.com?bcc=anothermail%40example.com">mail@example.com</a>
<!-- What actually will be rendered -->
<a href="m&#97;il&#x74;&#111;&#x3a;ma&#x69;l&#x40;e&#x78;a&#x6d;p&#x6c;&#x65;&#x2e;&#99;&#111;&#109;?&#x62;&#99;&#99;&#61;a&#110;&#111;&#x74;h&#101;&#114;&#109;&#x61;&#105;&#108;%&#52;0&#101;&#x78;&#97;&#x6d;&#x70;&#x6c;&#x65;&#46;&#x63;&#x6f;&#x6d;">ma&#x69;l&#x40;e&#x78;a&#x6d;p&#x6c;&#x65;&#x2e;&#99;&#111;&#109;</a>
```

Suggest a mail body.

```html
<!-- In your template -->
{{ mailto:mail@example.com body="Hy there!" }}
<!-- What the user will see -->
<a href="mailto:mail@example.com?body=Hy%20there%21">mail@example.com</a>
<!-- What actually will be rendered -->
<a href="&#109;&#97;il&#x74;o:m&#x61;i&#x6c;&#64;&#101;&#120;&#97;&#x6d;&#x70;&#108;e&#x2e;&#x63;om?&#98;&#111;&#x64;&#x79;&#61;&#x48;y%2&#x30;t&#104;e&#114;&#101;&#37;2&#49;">m&#x61;i&#x6c;&#64;&#101;&#120;&#97;&#x6d;&#x70;&#108;e&#x2e;&#x63;om</a>
```

Show some text instead the actual email address.

```html
<!-- In your template -->
{{ mailto:mail@example.com display="Drop me a mail" }}
<!-- What the user will see -->
<a href="mailto:mail@example.com">Drop me a mail</a>
<!-- What actually will be rendered -->
<a href="&#109;&#97;i&#108;&#116;o&#58;&#x6d;&#x61;&#105;&#x6c;&#64;e&#120;a&#x6d;p&#108;&#x65;.co&#x6d;">Drop me a mail</a>
```

Add some classes to the anchor tag.

```html
<!-- In your template -->
{{ mailto:mail@example.com class="link email-link" }}
<!-- What the user will see -->
<a href="mailto:mail@example.com" class="link email-link">mail@example.com</a>
<!-- What actually will be rendered -->
<a href="&#109;&#x61;i&#108;&#x74;o&#x3a;ma&#105;&#x6c;&#64;&#101;&#x78;&#97;&#109;&#112;le.&#99;&#111;&#109;" class="link email-link">ma&#105;&#x6c;&#64;&#101;&#x78;&#97;&#109;&#112;le.&#99;&#111;&#109;</a>
```

Use multiple email addresses.

```html

<!-- In your template -->
{{ mailto:first@example.com,second@example.com cc="third@example.com,fourth@example.com" bcc="fifth@example.com,sixth@example.com" display="Spam everyone!" }}
<!-- What the user will see -->
<a href="mailto:first@example.com,second@example.com?cc=third%40example.com%2Cfourth%40example.com&amp;bcc=fifth%40example.com%2Csixth%40example.com">Spam everyone!</a>
<!-- What actually will be rendered -->
<a href="&#109;&#x61;&#x69;&#108;&#x74;&#x6f;:&#102;&#x69;&#114;&#115;&#116;&#x40;&#x65;&#x78;&#97;&#x6d;p&#x6c;&#x65;.c&#111;&#109;&#x2c;&#115;&#101;&#99;&#111;n&#x64;&#64;&#x65;&#x78;&#x61;mp&#x6c;&#101;&#46;c&#x6f;m?&#x63;&#x63;=&#116;h&#105;r&#100;%&#52;0&#101;&#120;&#97;&#x6d;&#x70;&#x6c;e&#x2e;co&#x6d;&#x25;&#50;&#x43;&#x66;&#111;&#x75;&#114;&#116;&#x68;&#37;4&#x30;e&#x78;&#97;m&#112;le&#x2e;&#x63;&#x6f;&#109;&&#98;&#x63;&#x63;&#61;&#102;&#x69;&#x66;&#116;&#104;&#x25;&#52;0&#x65;&#x78;&#x61;&#109;&#x70;&#108;e&#x2e;&#99;&#x6f;&#109;%&#50;&#x43;&#115;&#x69;&#120;th&#x25;&#x34;&#48;&#x65;&#120;&#97;m&#112;l&#x65;.&#x63;&#x6f;&#x6d;">Spam everyone!</a>
```
