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

Photo by [Mathyas Kurmann] on [Unsplash]

[Mathyas Kurmann]: https://unsplash.com/photos/fb7yNPbT0l8?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText
[Unsplash]: https://unsplash.com/search/photos/mail?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText
