<?php

    /**
    *   Cyrillic letters transliteration.
    *   Usually is a requirement and very useful to convert cyrillic-only titles of cloned pages into a translit version to be used in page names/urls.
    *
    *   @link   https://www.couchcms.com/forum/viewtopic.php?f=8&t=7916#p20364
    *   @author Anton Smirnov aka Trendoman <tony.smirnov@gmail.com>
    *   @author Musman  https://www.couchcms.com/forum/memberlist.php?mode=viewprofile&u=18329
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @date   28.06.2019
    *   @last   25.05.2022
    */

    $FUNCS->add_event_listener( 'transliterate_clean_url', function(&$title){
        $charlist = array(
            "А"=>"A", "Б"=>"B", "В"=>"V", "Г"=>"G", "Д"=>"D", "Е"=>"E",
            "Ж"=>"ZH","З"=>"Z", "И"=>"I", "Й"=>"Y", "К"=>"K", "Л"=>"L",
            "М"=>"M", "Н"=>"N", "О"=>"O", "П"=>"P", "Р"=>"R", "С"=>"S",
            "Т"=>"T", "У"=>"U", "Ф"=>"F", "Х"=>"H", "Ц"=>"TS","Ч"=>"CH",
            "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"", "Ы"=>"Y", "Ь"=>"",  "Э"=>"JE", "Ю"=>"YU", "Я"=>"YA",

            "а"=>"a", "б"=>"b", "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e",
            "ж"=>"zh","з"=>"z", "и"=>"i", "й"=>"y", "к"=>"k", "л"=>"l",
            "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p", "р"=>"r", "с"=>"s",
            "т"=>"t", "у"=>"u", "ф"=>"f", "х"=>"h", "ц"=>"ts","ч"=>"ch",
            "ш"=>"sh","щ"=>"sch","ъ"=>"", "ы"=>"y", "ь"=>"",  "э"=>"je", "ю"=>"yu", "я"=>"ya"
        );
        $title = strtr( $title, $charlist );
    });

    /*
    // ~~~~~~~~~~~~~
    // Credits
    // ~~~~~~~~~~~~~
    // You should have downloaded this code from https://github.com/trendoman
    // ~~~~~~~~~~~~~
    // Support
    // ~~~~~~~~~~~~~
    // Ask any question via forum or email <anton.cms@ya.ru>, <tony.smirnov@gmail.com> "Anton S aka Trendoman"
    // My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts
    // New Telegram channel: https://t.me/couchcms
    */
