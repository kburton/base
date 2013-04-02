<?php

/**
 * DELETE THIS BLOCK WHEN CREATING A NEW SITE
 * 
 * ---
 * 
 * All references to "base" in database variables and comments below should
 * be replaced with the relevant database name and user names for the project.
 * 
 * The defines should be renamed to PW_DB_LIVE_DBNAME and PW_DB_TEST_DBNAME.
 * These names do not need to match the actual database names, so name them
 * consistently even if the live and test database names differ.
 * 
 * The comments should become // MySQL - user_name
 * The user names should exactly match those in the database, so the live and
 * test comments may differ.
 * 
 * All config files should be edited to use the updated database and user names.
 * 
 * ---
 * 
 * The MAIL_SYSTEM_* defines can be refactored out into the main config file,
 * keeping just the password definition in this file.
 */

/**
 * This is the example passwords file that should be checked into source control.
 * This file should be kept updated with any new required passwords.
 * 
 * During initial setup of a dev environment, this file should be copied to
 * passwords.php and all required passwords should be entered in that file.
 * This comment block can then be removed from passwords.php to avoid confusion.
 * 
 * The passwords.php file should not be checked into source control
 * (it is in .gitignore). Do not check any files containing passwords into
 * source control.
 */

if (!defined('PASSWORDS_FILE_LOADED'))
{
	define('PASSWORDS_FILE_LOADED', true);
	
	// LIVE DATABASE PASSWORDS
	define('PW_DB_LIVE_BASE', '');		// MySQL - base
	
	// TEST DATABASE PASSWORDS
	define('PW_DB_TEST_BASE', '');		// MySQL - base
	
	// MAIL CONFIG
	define('MAIL_SYSTEM_HOST', '');		// Mail server host address
	define('MAIL_SYSTEM_PORT', '');		// Mail server port
	define('MAIL_SYSTEM_USER', '');		// Mail server user name
	define('MAIL_SYSTEM_ADDR', '');		// The system email address for outgoing mail
	define('PW_MAIL_SYSTEM', '');		// Password for outgoing mail
}
