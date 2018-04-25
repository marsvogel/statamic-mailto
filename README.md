# MailtoLink

Generate a `mailto` link element with the value as the email address. If it's _not_ an email address, it's going to be one busted link. Obfuscates an email address with special characters making it hard for spam bots to sniff out and scrape off your site. Still reads like an email address as far as readers are concerned.
 
 Obfuscation is a method of encoding content so that the source code is hard or impossible to understand. This is generally used on email addresses to prevent spambots from recognizing it as an email address and keeping you safe from unwanted emails.
 
## Basic Usage

This AddOn provides a modifier, a tag and an API. Head over to the documentation to get the details.

```
{{ mailto_link email="mail@example.com" }}
```

```.language-output
<a href="mailto:mail@example.com">mail@example.com</a>
```

Photo by [Mathyas Kurmann] on [Unsplash]

[Mathyas Kurmann]: https://unsplash.com/photos/fb7yNPbT0l8?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText
[Unsplash]: https://unsplash.com/search/photos/mail?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText
