<?php

    /**
    *   New variable to various defined constants
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   12.06.2022
    */

    $FUNCS->add_event_listener( 'add_render_vars', function () {
        global $CTX;

        $kvars = array(
              'K_ADDONS_DIR' => K_ADDONS_DIR
           ,  'K_SNIPPETS_DIR' => K_SNIPPETS_DIR
           ,  'K_UPLOAD_DIR' => K_UPLOAD_DIR
           ,  'K_GMT_OFFSET' => K_GMT_OFFSET
           ,  'K_CACHE_OPCODES' => K_CACHE_OPCODES
           ,  'K_CACHE_SETTINGS' => K_CACHE_SETTINGS
           ,  'K_USE_CACHE' => K_USE_CACHE
           ,  'K_MAX_CACHE_AGE' => K_MAX_CACHE_AGE
           ,  'K_CACHE_PURGE_INTERVAL' => K_CACHE_PURGE_INTERVAL
           ,  'K_SITE_OFFLINE' => K_SITE_OFFLINE
           ,  'K_ADMIN' => defined('K_ADMIN') ? 1 : 0
           ,  'K_ADMIN_LANG' => K_ADMIN_LANG
           ,  'K_HTTPS' => K_HTTPS
           ,  'K_IS_MY_TEST_MACHINE' => K_IS_MY_TEST_MACHINE
           ,  'K_COMMENTS_INTERVAL' => K_COMMENTS_INTERVAL
           ,  'K_COMMENTS_REQUIRE_APPROVAL' => K_COMMENTS_REQUIRE_APPROVAL
           ,  'K_PAID_LICENSE' => K_PAID_LICENSE
           ,  'K_REMOVE_FOOTER_LINK' => K_REMOVE_FOOTER_LINK
           ,  'K_DB_HOST' => K_DB_HOST
           ,  'K_DB_NAME' => K_DB_NAME
           ,  'K_DB_PASSWORD' => K_DB_PASSWORD
           ,  'K_DB_TABLES_PREFIX' => K_DB_TABLES_PREFIX
           ,  'K_DB_USER' => K_DB_USER
           ,  'K_TBL_ATTACHMENTS' => K_TBL_ATTACHMENTS
           ,  'K_TBL_COMMENTS' => K_TBL_COMMENTS
           ,  'K_TBL_DATA_NUMERIC' => K_TBL_DATA_NUMERIC
           ,  'K_TBL_DATA_TEXT' => K_TBL_DATA_TEXT
           ,  'K_TBL_FIELDS' => K_TBL_FIELDS
           ,  'K_TBL_FOLDERS' => K_TBL_FOLDERS
           ,  'K_TBL_FULLTEXT' => K_TBL_FULLTEXT
           ,  'K_TBL_PAGES' => K_TBL_PAGES
           ,  'K_TBL_RELATIONS' => K_TBL_RELATIONS
           ,  'K_TBL_SETTINGS' => K_TBL_SETTINGS
           ,  'K_TBL_TEMPLATES' => K_TBL_TEMPLATES
           ,  'K_TBL_USER_LEVELS' => K_TBL_USER_LEVELS
           ,  'K_TBL_USERS' => K_TBL_USERS
           ,  'K_TBL_VOTES_CALC' => defined('K_TBL_VOTES_CALC') ? K_TBL_VOTES_CALC : ""
           ,  'K_TBL_VOTES_RAW' => defined('K_TBL_VOTES_RAW') ? K_TBL_VOTES_RAW : ""
           ,  'K_VOTE_VERSION' => defined('K_VOTE_VERSION') ? K_VOTE_VERSION : ""
           ,  'K_VOTE_WINDOW_ANON' => defined('K_VOTE_WINDOW_ANON') ? K_VOTE_WINDOW_ANON : ""
           ,  'K_VOTE_WINDOW_MEMBER' => defined('K_VOTE_WINDOW_MEMBER') ? K_VOTE_WINDOW_MEMBER : ""
           ,  'K_PAYPAL_CURRENCY' => K_PAYPAL_CURRENCY
           ,  'K_PAYPAL_EMAIL' => K_PAYPAL_EMAIL
           ,  'K_PAYPAL_USE_SANDBOX' => K_PAYPAL_USE_SANDBOX
           ,  'K_RECAPTCHA_SECRET_KEY' => K_RECAPTCHA_SECRET_KEY
           ,  'K_RECAPTCHA_SITE_KEY' => K_RECAPTCHA_SITE_KEY
           ,  'K_GOOGLE_KEY' => K_GOOGLE_KEY
           ,  'K_USE_ALTERNATIVE_MTA' => K_USE_ALTERNATIVE_MTA
           ,  'K_USE_KC_FINDER' => K_USE_KC_FINDER
           ,  'K_MASQUERADE_ON' => K_MASQUERADE_ON
           ,  'K_MIN_PASSWORD_LEN' => K_MIN_PASSWORD_LEN
           ,  'K_ACCESS_LEVEL_UNAUTHENTICATED' => K_ACCESS_LEVEL_UNAUTHENTICATED
           ,  'K_ACCESS_LEVEL_AUTHENTICATED' => K_ACCESS_LEVEL_AUTHENTICATED
           ,  'K_ACCESS_LEVEL_AUTHENTICATED_SPECIAL' => K_ACCESS_LEVEL_AUTHENTICATED_SPECIAL
           ,  'K_ACCESS_LEVEL_ADMIN' => K_ACCESS_LEVEL_ADMIN
           ,  'K_ACCESS_LEVEL_SUPER_ADMIN' => K_ACCESS_LEVEL_SUPER_ADMIN
        );

        $CTX->set( 'k__defined', $kvars, 'global' );
    });

    /*
    // ~~~~~~~~~~~~~
    // Credits
    // ~~~~~~~~~~~~~
    // You should have downloaded this code from https://github.com/trendoman/Tweakus-Dilectus
    // ~~~~~~~~~~~~~
    // Support
    // ~~~~~~~~~~~~~
    // Write me at <anton.cms@ya.ru>, <tony.smirnov@gmail.com> "Anton S aka Trendoman"
    // Telegram: https://t.me/s/couchcms
    */
