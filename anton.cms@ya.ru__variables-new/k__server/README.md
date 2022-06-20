# k__server

Adds a new variable `k__server` to the global context. It contains values from the `$_SERVER` superlobal array.

## Example

Let's print the variable –

```xml
<cms:test
    ignore='0'
    >
  <cms:if "<cms:tag_exists 'show_json' />">
     <cms:show_json k__server />
  <cms:else />
     <cms:show k__server as_json='1' />
  </cms:if>

</cms:test>
```

Sample output (on my local machine) –

```json
{
   "HTTP_HOST":"my.couch",
   "HTTP_USER_AGENT":"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0",
   "HTTP_ACCEPT":"text/html,
   application/xhtml+xml,
   application/xml;q=0.9,
   image/webp,
   */*;q=0.8",
   "HTTP_ACCEPT_LANGUAGE":"en-US,
   en;q=0.5",
   "HTTP_ACCEPT_ENCODING":"gzip,
    deflate",
   "HTTP_DNT":"1",
   "HTTP_CONNECTION":"keep-alive",
   "HTTP_COOKIE":"KCFINDER_showname=on; KCFINDER_showsize=off; KCFINDER_showtime=off; KCFINDER_order=name; KCFINDER_orderDesc=off; KCFINDER_view=thumbs; KCFINDER_displaySettings=off; PHPSESSID=ad8lvi9q2q3hokc4jf3uen9e0512onbr; couchcms_testcookie=CouchCMS%20test%20cookie; couchcms_0990333521d5c55819147eb7bac23c58=admin%3A1655032998%3Ae82b6e5a18f79fbea014b0d7c3bdfed8; mycookie=test",
   "HTTP_UPGRADE_INSECURE_REQUESTS":"1",
   "PATH":"d:\cloudone\openserver\modules\php\PHP_7.4\ext;d:\cloudone\openserver\modules\php\PHP_7.4\pear;d:\cloudone\openserver\modules\php\PHP_7.4\pear\bin;d:\cloudone\openserver\modules\php\PHP_7.4;d:\cloudone\openserver\modules\imagemagick;d:\cloudone\openserver\modules\wget\bin;d:\cloudone\openserver\modules\database\MySQL-8.0-x64\bin;d:\cloudone\openserver\modules\http\Apache_2.4-PHP_7.2-7.4\bin;d:\cloudone\openserver\modules\http\Apache_2.4-PHP_7.2-7.4;C:\WINDOWS\system32;C:\WINDOWS;C:\WINDOWS\system32\Wbem;C:\WINDOWS\SysWOW64;C:\WINDOWS\system32;C:\WINDOWS;C:\WINDOWS\System32\Wbem;C:\WINDOWS\System32\WindowsPowerShell\v1.0\;C:\WINDOWS\System32\OpenSSH\;C:\Program Files (x86)\Intel\Intel(R) Management Engine Components\DAL;C:\Program Files\Intel\Intel(R) Management Engine Components\DAL;D:\Apps\GPG\..\GnuPG\bin;C:\Program Files\dotnet\;C:\Program Files\NVIDIA Corporation\NVIDIA NvDLISR;C:\Users\Anton\AppData\Local\Microsoft\WindowsApps",
   "SystemRoot":"C:\WINDOWS",
   "COMSPEC":"C:\WINDOWS\system32\cmd.exe",
   "PATHEXT":".COM;.EXE;.BAT;.CMD;.VBS;.VBE;.JS;.JSE;.WSF;.WSH;.MSC",
   "WINDIR":"C:\WINDOWS",
   "SERVER_SIGNATURE":"",
   "SERVER_SOFTWARE":"Apache",
   "SERVER_NAME":"my.couch",
   "SERVER_ADDR":"127.0.0.1",
   "SERVER_PORT":"80",
   "REMOTE_ADDR":"127.0.0.1",
   "DOCUMENT_ROOT":"D:/CloudOne/OpenServer/domains/my.couch",
   "REQUEST_SCHEME":"http",
   "CONTEXT_PREFIX":"",
   "CONTEXT_DOCUMENT_ROOT":"D:/CloudOne/OpenServer/domains/my.couch",
   "SERVER_ADMIN":"[
      no address given
   ]",
   "SCRIPT_FILENAME":"D:/CloudOne/OpenServer/domains/my.couch/index.php",
   "REMOTE_PORT":"52572",
   "GATEWAY_INTERFACE":"CGI/1.1",
   "SERVER_PROTOCOL":"HTTP/1.1",
   "REQUEST_METHOD":"GET",
   "QUERY_STRING":"test=true&pg=2",
   "REQUEST_URI":"/?test=true&pg=2",
   "SCRIPT_NAME":"/index.php",
   "PHP_SELF":"/index.php",
   "REQUEST_TIME_FLOAT":1655018867.903,
   "REQUEST_TIME":1655018867,
   "argv":[
      "test=true&pg=2"
   ],
   "argc":1
}
```

Output of the tag `<cms:dump_all/>` displays this variable before the user-defined variables with value *Array*:

`k__server: Array`

## Usage

If you are interested in one of the values, e.g. a visitor's user agent or ip address, print it with 'cms:show' and use CAPITAL LETTERS &mdash;

```xml
<cms:show k__server.HTTP_USER_AGENT />
```

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
