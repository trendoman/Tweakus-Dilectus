# `<cms:xquery>`

Extract content from HTML string via XPath[^1] queries.

```xml
<cms:xquery html=html query='//p'>
   <cms:dump />
</cms:xquery>
```

The PHP DOM extension[^2] is the basis of the tag. It allows you to operate on XML documents through the DOM API. This extension is enabled by default.

[^2]: [https://www.php.net/manual/en/book.dom.php](https://www.php.net/manual/en/book.dom.php)
[^1]: [https://en.wikipedia.org/wiki/XPath](https://en.wikipedia.org/wiki/XPath)

## Parameters

* html
* query

## Usage

First and foremost, make sure the Xpath query works. Load the HTML in Firefox / Chrome, open console and validate your query —

```js
$x("//div")
```

If the queried elements exist (***div*** in the snippet above), browser will return an array of all such elements. Take the validated query and use it in tag.

Create sofisticated queries with this awesome **[Xpath cheatsheet](#related-pages).** For instance: `//body//div[@class="table-responsive"]/table/tbody[count(tr)>1]/tr`

Also query allows to pass PHP functions.[^3] Following snippet finds **a** nodes with attribute *href* starting with ***https*** e.g.

```xml
//a[php:functionString("strpos", @href, "https")]
```

[^3]: [https://www.php.net/manual/en/domxpath.registerphpfunctions-examples](https://www.php.net/manual/en/domxpath.registerphpfunctions.php#refsect1-domxpath.registerphpfunctions-examples)

## Example

### Weather forecast

Built with the help of [AccuWeather](https://www.accuweather.com). The URL which shows hourly forecast for my city is copied from browser –

```
https://www.accuweather.com/en/ru/ryazan/561677/hourly-weather-forecast/561677
```

\- and requested programmatically -

```xml
<cms:capture into='curl' trim='1' is_json='1' scope='global'>
{ "useragent" : <cms:escape_json>Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0</cms:escape_json> }
</cms:capture>
<cms:capture into='html' trim='1' scope='global'>
   <cms:call 'fetch-url' 'https://www.accuweather.com/en/ru/ryazan/561677/hourly-weather-forecast/561677' as_ajax='0'/>
</cms:capture>
```

\- and passed to **xquery** -

```xml
<cms:xquery html '//div[starts-with(@id, "hourlyCard")]'>
   <cms:if k_first_item><ul></cms:if>

   <li>at <cms:show nodeValue_lines.0 />: <cms:show nodeValue_lines.3 /> (<cms:show nodeValue_lines.4 />)</li>

   <cms:if k_last_item></ul></cms:if>
</cms:xquery>
```

\- with output:

```txt
at 2 PM: 30° (Very Warm)
at 3 PM: 29° (Very Warm)
at 4 PM: 28° (Very Warm)
at 5 PM: 26° (Pleasant)
at 6 PM: 25° (Pleasant)
at 7 PM: 23° (Pleasant)
at 8 PM: 22° (Pleasant)
at 9 PM: 22° (Pleasant)
at 10 PM: 21° (Pleasant)
at 11 PM: 20° (Pleasant)
```

## Variables

* ### k_success
* ### k_error

   Either *k_success* is ***1*** with success or ***0*** with *k_error* showing the error. Three possible error values:

   - "HTML is empty"
   - "HTML loading failed"
   - "QUERY is malformed"

* ### k_total_items
* ### k_count
* ### k_first_item
* ### k_last_item

   Variables similar to those of tag 'cms:each'

* ### nodeName
* ### nodeValue

   Name of selected node e.g. ***p, div, a***, etc..

   Text content of the node, including its all children.

* ### nodeValue_lines

   Array of lines from **nodeValue** content split by newlines with skipped empty lines and each line trimmed off spaces around it.

* ### nodePath

   Exact path to current node, i.e. internal representation of the path created by the parser.

* ### parentNode
* ### parentValue

   Parent node with its text content (including all children)

* ### hasAttributes

   Has ***1*** if attributes (*class, id, href, data-toggle*, etc) are present.

* ### _{attribute}

   If the attributes are present, each attribute's value will be set to a separate variable prepended with underscore e.g.

   - **_class**
   - **_id**
   - **_href**, etc...

## Variables expected

* _xquery_skip
* _xquery_stop

   Set the variable within your code to skip the node (i.e. synonym of *continue*) or fully stop enumerating nodes (synonym of *break*). Tag will look upon those variables in the inner scope and act accordingly. Following snippet only allows the first 5 (starting from ***0***) items.

   ```xml
   <cms:if k_count eq '5'><cms:set _xquery_stop = '1' /></cms:if>
   ```

## Related pages

* **[Rico's cheatsheets » XPath cheatsheet](https://devhints.io/xpath)**
* **[MDN » XPath Functions Reference](https://developer.mozilla.org/en-US/docs/Web/XPath/Functions)**
* **[Cms-Fu Funcs » fetch-url](https://github.com/trendoman/Cms-Fu/tree/master/Server/fetch-url#fetch-url)**

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

[![Mail](https://img.shields.io/badge/gmail-%23539CFF.svg?&style=for-the-badge&logo=gmail&logoColor=white)](mailto:"Anton"<tony.smirnov@gmail.com>?subject=[xquery])

See dedicated [**SUPPORT**](/SUPPORT.md) page.
