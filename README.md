# Simple PHP URL shortener

Requires PHP ≥ 5.4.0 or higher.

## Installation

1. Download the source code as located within this repository, and upload it to your web server.
2. Use `database.sql` to create the tables in a database of choice.
3. Edit `config.php` and enter your database credentials.
4. Generate an alphanumeric token in the `auth` table. An MD5 hash is suitable.

## Features

* Redirect to Twitter when given a numerical slug, e.g. `http://mths.be/8065633451249664` → `http://twitter.com/mathias/status/8065633451249664`.
* Redirect to your Twitter account when `@` is used as a slug, e.g. `http://mths.be/@` → `http://twitter.com/mathias`.
* Redirect to your main website when no slug is entered, e.g. `http://mths.be/` → `http://mathiasbynens.be/`.
* Redirect to a specific page on your main website when an unknown slug (not in the database) is used, e.g. `http://mths.be/demo/jquery-size` → `http://mathiasbynens.be/demo/jquery-size`.
* Ignores weird trailing characters (`!`, `"`, `#`, `$`, `%`, `&`, `'`, `(`, `)`, `*`, `+`, `,`, `-`, `.`, `/`, `@`, `:`, `;`, `<`, `=`, `>`, `[`, `\`, `]`, `^`, `_`, `{`, `|`, `}`, `~`) in slugs — useful when your short URL is run through a crappy link parser, e.g. `http://mths.be/aaa)` → same effect as visiting `http://mths.be/aaa`.
* Generates short, easy-to-type URLs using only `[a-z]` characters.
* Doesn’t create multiple short URLs when you try to shorten the same URL. In this case, the script will simply return the existing short URL for that long URL.
* DRY, minimal code.
* Token-based authentication.
* Correct, semantic use of the available HTTP status codes.
* Can be used with Twitter for iPhone. Just go to _Settings_ › _Services_ › _URL Shortening_ › _Custom…_ and enter `http://yourshortener.ext/shorten?url=%@`.

## Favelets / Bookmarklets

### Prompt

``` js
javascript:(function(){const%20q=prompt('URL:');if(q){location='https://yourshortener.ext/shorten?token=<token>&url='+encodeURIComponent(q)}}());
```

### Shorten this URL

``` js
javascript:(function(){location='https://yourshortener.ext/shorten?token=<token>&url='+encodeURIComponent(location.href)}());
```

### Shorten this URL with custom slug

``` js
javascript:(function(){const%20q=prompt('Slug:');location='https://yourshortener.ext/shorten?token=<token>&url='+encodeURIComponent(location.href) + (q ? '&slug=' + q : '')}());
````

## License

This script is available under the MIT license.

## Original Author

* [Mathias Bynens](http://mathiasbynens.be/)

## Past Contributors

* [Peter Beverloo](http://peter.sh/)
* [Tomislav Biscan](https://github.com/B-Scan)

