# [ADDON "SLING"](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms@ya.ru__sling)

After the generated HTML page is sent to a visitor's browser, we ask Couch to continue in the background, for a moment, to do some work for us. Visitor may even close the tab or the browser, it will have no effect, as the code now is fully "detached".

Disclaimer: the introduction and examples are somewhat basic and short. Over time, this page will get a few revisions.

## Tag `<CMS:THEN>`

***When a visitor is served THEN execute.***

If placed anywhere on the page, the enclosed content and parameters of the tag are kept in storage up to the moment when Couch has done its usual business. Then *our* show begins.

```xml
<cms:then>

   <cms:log "Sleepy.." />

   <cms:sleep '10' />

   <cms:log "Awake!" />

</cms:then>
```

The snippet above (with the new tag 'sleep' also present in addon) will firstly log a message, then wait 10 seconds and, finally, log another message.

## FACTS

**\#1** Your code inside the tag will be temporarily saved to database.

**\#2** Tag runs *after* the visited page is sent from server to browser. Any pageview works, including the ones from admin-panel.

**\#3** You can nest tags with interesting effect.

Example:

```xml
<cms:then>
   <cms:log 'Visited page #1:' />
   <cms:log "<cms:get 'k_qs_link' default=k_page_link />" />
   <cms:then>
      <cms:log 'Visited page #2:' />
      <cms:log "<cms:get 'k_qs_link' default=k_page_link />" />
      <cms:then>
         <cms:log 'Visited page #3:' />
         <cms:log "<cms:get 'k_qs_link' default=k_page_link />" />
      </cms:then>
   </cms:then>
</cms:then>
```

Place the snippet above in one page, for example "index.php", load this page once, then visit 2 other pages of the website (even admin-panel). Links of your visits will be logged. You don't need to copy the snippet to other pages, as the following happens:

1. Tag registered on "index.php" immediately runs after the page is loaded → logs current link (expectedly "index.php") then registers the inner "then".
2. You visit any other page (e.g. "blog.php"), which triggers the registered inner code to execute → "blog.php" is logged then code registers the last inner "then".
3. You visit another page, maybe admin-panel page (with its link stored in variable **k_qs_link** vs. the normal **k_page_link** for the front-end pages). The address is logged and since there is no other code, nothing else happens.

\- and `log.txt` will look like ↓↓

```txt
=======================[2022-07-28 14:39:13]=======================
Visited page #1:

=======================[2022-07-28 14:39:13]=======================
http://localhost/index.php

=======================[2022-07-28 14:39:29]=======================
Visited page #2:

=======================[2022-07-28 14:39:29]=======================
http://localhost/blog.php

=======================[2022-07-28 14:39:36]=======================
Visited page #3:

=======================[2022-07-28 14:39:36]=======================
http://localhost/couch/?o=shop%2Findex.php&q=list
```

**\#4** Code, which is executed is deleted from the database.

**\#5** You can run code after redirects and submitted forms, with any action (e.g. set to other pages), with both POST and GET methods.

Example:

```xml
<cms:form name='tricky_form' method="POST" action="<cms:admin_link />">
   <cms:if k_success>
      <cms:log 'SUCCESS' /><!-- never happens! -->
   </cms:if>
   <cms:then>
      <cms:then>
         <cms:if "<cms:gpc 'k_hid_tricky_form' />">
            <cms:log 'SUBMITTED' /><!-- works! -->
         </cms:if>
      </cms:then>
   </cms:then>
   <cms:input type='submit' name='click' value='Click' />
</cms:form>
```

Expectedly, the form sent to admin-panel page via **action** never executes its "k_success" block, because the destination does not have this form. So, while the 'SUCCESS' is never logged, the 'SUBMITTED' *is* logged, because the inner "then" was registered on the form page and executed on subsequent page load, i.e. in the destination page.


**\#6** Variables set in context are shared between tags.

Example:

```xml
<cms:then>
   <cms:set name='Vladimir' />
</cms:then>
<cms:then>
   <cms:log "I know you, <cms:show name />!" />
</cms:then>
```

Both tags were registered and executed after the same page load and shared variables.

**\#7** Tag executed on the same page retains all variables of the current user and the current page, i.e. editable fields data.

**\#8** Tag executed on another page retains all user-defined variables in the global and local scopes set initially, but the page/user data is refreshed.

**\#9** System "k_" variables are from the actual page you are visiting.

**\#A** Normally, only the current user executes tags that his visit brought up to light e.g., as in the above example (without nesting), tag executes immediately for current user. But you may set tag's content to be attached to any visitor.

Example:

```xml
<cms:repeat '5'>
   <cms:then bind='anyone'>
      <cms:log "My name is <cms:show k_user_name />" />
   </cms:then>
</cms:repeat>
```

Above example will create ***5*** copies of the same code that will be picked up by the next 5 visits of any page.

---

**If you mull over this concept, you will see how it is possible to divide a big task into small pieces and run these pieces almost in parallel, with enough pageviews on the website to pick up all the pieces (big traffic).**

---

**\#B** Session ID is used to relate tag to visitor. If you register a few tags and come tomorrow with the same session (same browser), the tags will be picked up and executed.

**\#C** Current visitor takes up to maximum of 25 tags from oldest to newest per a pageview, that are bound to her.

**\#D** Current visitor takes only a single "any"-bound tag per pageview, and only if there are no tags bound to this visitor.

**\#E** There is an **expiration date** set to 1 week in future for each stored tag. Stale tags are removed from storage after they expire. Visit any page in admin-panel and the purge will happen in background at rate of 250 tags per pageview. Such a limit in full takes around ~100ms, so should be tolerable, especially if there are only a handful of expired tags.

**\#F** Tag may execute a known named func with func's parameters, if it is registered (or can be found-on-demand) on the moment of time when "then" is registered.

Example:

```xml
<cms:func 'send-mail' email=''>
   <cms:log "Sending mail to... <cms:show email />" />
</cms:func>

<cms:then 'send-mail' k_user_email />
```

If a named func's name is passed as the first parameter, the tag must be self-closed.

**\#G** Use locks to prevent async execution. Always imagine how a hundred visitors will run your tags. If you want to execute some code one by one and not in parallel, see how.

Example:

```xml
<cms:then bind='anyone'>
   <cms:if "<cms:call 'is-lockable' uid='run_solo'/>">
      <cms:send_mail ... />
   </cms:if>
</cms:then>
```

Snippet above will not clog the server with simultaneous emails; instead emails will be sent one by one in the background while there are visitors with pageviews to pick up tags. Func *is-lockable* is not a part of the addon and is used as an example (can be downloaded separately).

**\#H** Tag tries to maintain overall memory consumption under 32 Mb. Even shared hosts have more, not to mention VPS and VDS.

**\#I** Tag forces the page to be sent gzipped. That's a small bonus, as this is widely supported by all browsers.

**\#J** Database table "sling_jobs" is used as a storage for tags.

**\#K** While the tags are being executed by the visitor, no other pageview of the same visitor could load more tags to run. The sequence 'load-run-remove' does not run in parallel for the same visitor.

**\#L** There is **no limit** on time available for your code, i.e. the code may run for hours and days. Be careful with code design for such long jobs. Some cheap webhosts actually forbid setting unlimited time for PHP, but default value of 60 seconds is enough for 99% of tasks.

## Examples

### query external service API

Responses from 3rd-party services may take unpredictable time. They even may impose some throttle on your requests, if a hundred visitors suddenly decided to visit your website and clog the usual *synchronuos* execution, with pages of your website not loading indefinitely. Let's make the requests *async* and let's give our visitors the first class treatment without waiting time for their page load.

Using the 3rd party geo service (via function **[geoip](#related-funcs)**), we request visitor's data and show it only when it is ready.

```xml
<cms:set visitor = "<cms:call 'geoip' cached_only='1' />" is_json='1' />

<cms:if visitor.city>

   Are you from <cms:show visitor.city />?

<cms:else_if "<cms:not visitor.status />" />

   <cms:then>

      <!-- programming async update of info -->

      <cms:set response = "<cms:call 'geoip' />" is_json='1' />

      <cms:if response.status = '200' && response.city >

         <cms:log "Successfully detected city - <cms:show response.city />" />

      </cms:if>

   </cms:then>

<cms:else_if visitor.status && visitor.status ne '200' />

      <cms:log "Request reported status different from '200'. Review the response:" />
      <cms:log "<cms:show visitor as_json='1' />" />

</cms:if>
```

In the above snippet (hopefully, self-explanatory) there is a lot of 'sugar' i.e. logging some steps in detail. Of course, you don't need much of it. The idea is to not trust the outside API which may deliver a status different from '200' (e.g. '404'), because servers tend to have some downtime once in a while or some other error happened. Therefore, the server's response with visitor's geo data is first stored to cache. Subsequent pageviews will get data from the cache (parameter **cached_only**). And if there was some error in the process, there will not be any requests done anymore for this visitor, at least before you review the log and find out what the issue it.

Logging is important for the operations performed completely in background with no output whatsoever (there is no browser to send the data to). Always prepare for the worst but enjoy the first class solutions.

## Related funcs

* **[CmsFu » geoip](https://github.com/trendoman/Cms-Fu/tree/master/Server/geoip)**

## Install

Everything described on the dedicated [**INSTALL**](/INSTALL.md) page applies.

In short, copy files and enable addon in `couch/addons/kfunctions.php` file.

```php
require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__sling/sling.php' );
```

On the first run addon will automatically create one table in database named 'sling_jobs'.

## Support, suggestions, requests, feedback

Join discussion in the __[Forum » Async | Multi-thread | Cron | Living Couch](https://www.couchcms.com/forum/viewtopic.php?f=2&t=13271)__ thread.

Your feedback is always solicited.

[![Mail](https://img.shields.io/badge/gmail-%23539CFF.svg?&style=for-the-badge&logo=gmail&logoColor=white)](mailto:"Anton"<tony.smirnov@gmail.com>?subject=[Re:Sling])
