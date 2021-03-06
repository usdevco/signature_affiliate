<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|   http://example.com/
|
| If this is not set then CodeIgniter will try guess the protocol, domain
| and path to your installation. However, you should always configure this
| explicitly and never rely on auto-guessing, especially in production
| environments.
|
*/

// define('APP_BASE_URL','http://ec2-54-163-8-116.compute-1.amazonaws.com/');
define('APP_BASE_URL','http://ec2-34-203-173-159.compute-1.amazonaws.com/');

/*
|--------------------------------------------------------------------------
| Encryption Key
| IMPORTANT: Don't change this EVER
|--------------------------------------------------------------------------
|
| If you use the Encryption class, you must set an encryption key.
| See the user guide for more info.
|
| http://codeigniter.com/user_guide/libraries/encryption.html
|
| Auto updated added on install
*/

define('APP_ENC_KEY','56995b9ac204ace760c70e58a2be358a');

/* Database credentials - Auto added on install */

/* The hostname of your database server. */
define('APP_DB_HOSTNAME','evacrm.cp71zyrlqdh7.us-east-1.rds.amazonaws.com');
/* The username used to connect to the database */
define('APP_DB_USERNAME','evacrm');
/* The password used to connect to the database */
define('APP_DB_PASSWORD','&8(TS35[w1Ox');
/* The name of the database you want to connect to */
define('APP_DB_NAME','avacrm');


/**
 *
 * Session handler driver
 * By default the database driver will be used.
 *
 * For files session use this config:
 * define('SESS_DRIVER','files');
 * define('SESS_SAVE_PATH',NULL);
 * In case you are having problem with the SESS_SAVE_PATH consult with your hosting provider to set "session.save_path" value to php.ini
 *
 */

define('SESS_DRIVER','database');
define('SESS_SAVE_PATH','tblsessions');