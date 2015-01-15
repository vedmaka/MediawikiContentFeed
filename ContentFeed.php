<?php
/**
 * Initialization file for the ContentFeed extension.
 *
 * @file ContentFeed.php
 * @ingroup ContentFeed
 *
 * @licence GNU GPL v3
 * @author Wikivote llc < http://wikivote.ru >
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

if ( version_compare( $wgVersion, '1.17', '<' ) ) {
	die( '<b>Error:</b> This version of ContentFeed requires MediaWiki 1.17 or above.' );
}

global $wgContentFeed;
$wgContentFeedDir = dirname( __FILE__ );

/* Credits page */
$wgExtensionCredits['specialpage'][] = array(
    'path' => __FILE__,
    'name' => 'ContentFeed',
    'version' => '0.1',
    'author' => 'Wikivote! ltd.',
    'url' => '',
    'descriptionmsg' => 'ContentFeed-credits',
);

/* Resource modules */
$wgResourceModules['ext.ContentFeed.main'] = array(
    'localBasePath' => dirname( __FILE__ ) . '/assets/',
    'remoteExtPath' => 'ContentFeed/assets/',
    'group' => 'ext.ContentFeed',
    'scripts' => 'script.js',
    'styles' => 'style.css'
);

/* Message Files */
$wgExtensionMessagesFiles['ContentFeed'] = dirname( __FILE__ ) . '/ContentFeed.i18n.php';

/* Autoload classes */

require_once( dirname(__FILE__) . '/libs/autoloader.php');

$wgAutoloadClasses['ContentFeed'] = dirname( __FILE__ ) . '/ContentFeed.class.php';
$wgAutoloadClasses['ContentFeedSpecial'] = dirname( __FILE__ ) . '/ContentFeedSpecial.class.php';
#$wgAutoloadClasses['ContentFeedHooks'] = dirname( __FILE__ ) . '/ContentFeed.hooks.php';

/* ORM,MODELS */
#$wgAutoloadClasses['ContentFeed_Model_'] = dirname( __FILE__ ) . '/includes/ContentFeed_Model_.php';

/* ORM,PAGES */
#$wgAutoloadClasses['ContentFeedSpecial'] = dirname( __FILE__ ) . '/pages/ContentFeedSpecial/ContentFeedSpecial.php';

/* Rights */
#$wgAvailableRights[] = 'example_rights';

/* Permissions */
$wgGroupPermissions['sysop']['contentfeed'] = true;

/* Special Pages */
$wgSpecialPages['ContentFeed'] = 'ContentFeedSpecial';

/* Hooks */
#$wgHooks['example_hook'][] = 'ContentFeedHooks::onExampleHook';