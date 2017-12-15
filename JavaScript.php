<?php
/**
  * JavaScript extension - Includes all *.js files found in the directory
  * containing this extension
  *
  * @package MediaWiki
  * @subpackage Extensions
  * @author [http://www.organicdesign.co.nz/nad User:Nad] Revised by [http://www.irhb.org Henrik Thiil Nielsen]
  * @license GNU General Public Licence 2.0 or later
  * 
  */
if ( !defined( 'MEDIAWIKI' ) ) die( 'Not an entry point.' );

define( 'JAVASCRIPT_VERSION', '4.0.0' );

$wgUseMWJquery = true;

$wgExtensionCredits['other'][] = array(
        'name'        => "JavaScript",
        'author'      => "[http://www.organicdesign.co.nz/nad User:Nad]. Rev. [http://www.irhb.org Henrik Thiil Nielsen]",
        'description' => "Includes all *.js files found in the directory containing this extension",
        'url'         => "http://www.mediawiki.org/wiki/Extension:Javascript",
        'version'     => JAVASCRIPT_VERSION
);

$wgJavaScriptExternalPath = wfJavaScriptExternalPath( dirname( __FILE__ ) );

$wgResourceModules['ext.JavaScript'] = array(
        'scripts' => array(),
        'styles' => array(),
        'dependencies' => array(),
        'localBasePath' => dirname( __FILE__ ),
        'remoteExtPath' => basename( dirname( __FILE__ ) ),
        'position' => 'top'
);


foreach( glob( dirname( __FILE__ ) . "/*.js" ) as $file ) {
        $wgResourceModules['ext.JavaScript']['scripts'][] = basename( $file );
}


$wgHooks['BeforePageDisplay'][] = 'wfJavaScriptAddModules';
                 
function wfJavaScriptAddModules( &$out, $skin = false ) {
        $out->addModules( array('ext.JavaScript') );
        return true;
}

/**
  * Convert an internal resource path to an external one
*/
function wfJavaScriptExternalPath( $internalPath ) {
        global $wgScriptPath;
        return preg_replace( "|^.*/extensions|", "$wgScriptPath/extensions", $internalPath );
}

?>
