<?php

    if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

    /* Table "sling_jobs" */
    $_sql = "CREATE TABLE `".A_TBL_SLING_JOBS."` (
      `id`       INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
      `bind`     TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
      `session_id` CHAR(32) NOT NULL DEFAULT '' COLLATE 'ascii_bin',
      `user`       VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'ascii_general_ci',
      `params`     BLOB NOT NULL,
      `context`    MEDIUMBLOB NOT NULL,
      `code`       MEDIUMBLOB NOT NULL,
      `expiration_date` DATETIME NOT NULL,
          PRIMARY KEY (`id`) USING BTREE,
          UNIQUE INDEX `session_id` (`session_id`, `bind`, `id`) USING BTREE,
          INDEX `bind` (`bind`) USING BTREE,
          INDEX `expiration_date` (`expiration_date`) USING BTREE
      )
      COLLATE='utf8mb4_unicode_ci'
      ENGINE=InnoDB";
    $DB->_query( $_sql );

    /* finish installation */
    $_sql = "INSERT INTO ".K_TBL_SETTINGS." (k_key, k_value) VALUES ('sling_version', '".A_SLING_VERSION."');";
    $DB->_query( $_sql );
