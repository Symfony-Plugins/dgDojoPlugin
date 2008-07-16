<?php

// unfortunately, this requires access to the Javascript Helper
sfLoader::loadHelpers( array( 'Javascript' ) );

/**
 * Manages some of the backend requires to make Dojo work.  If you don't use
 * DojoHelper, be sure to print DojoManager::renderRequires at the bottom of
 * the page so that Dojo knows about all of the requires.
 *
 */
class DojoManager
{
    protected static
        $requires     = array(),
        $dojoIncluded = false;
    
    /**
     * Adds the dojo javascript to the response.  Uses dojoIncluded variable to
     * avoid including dojo multiple times.
     *
     */
    public static function addJavascript()
    {
        if ( !self::$dojoIncluded )
        {
            $dojo = sfConfig::get( 'dojo_js', '/js/dojoToolkit/dojo/dojo.js' );
            $context = sfContext::getInstance();
            $context->getResponse()->addJavascript( $dojo, '', array( 'djConfig' => 'parseOnLoad: true' ) );
            self::$dojoIncluded = true;
            self::addRequire( 'dojo.parser' );
        }
    }
    
    /**
     * Adds Dojo items to the list of things required for Dojo to function.
     *
     * @param mixed $dojoItems The required Dojo items for the page
     */
    public static function addRequire( $dojoItems )
    {
    	if ( !is_array( $dojoItems ) )
    	{
    		$dojoItems = array( $dojoItems );
    	}
    	
    	$rval = '';
    	foreach ( $dojoItems as $dojoItem )
    	{
    	   if ( !self::hasRequire( $dojoItem ) )
    	   {
    	   	   self::$requires[$dojoItem] = 0;
    	   }
    	   self::$requires[$dojoItem]++;
    	}
    	
    	// add the Dojo javascript file to the response
    	self::addJavascript();
    }
    
    /**
     * Removes a require if it has been required before.
     *
     * @param string $dojoItem Dojo class string to remove
     */
    public static function removeRequire( $dojoItem )
    {
    	if ( self::hasRequire( $dojoItem ) )
    	{
    		self::$requires[$dojoItem]--;
    		if ( self::$requires[$dojoItem] <= 0 )
    		{
    			unset( self::$requires[$dojoItem] );
    		}
    	}
    }
    
    /**
     * Determines if a particular Dojo item has already been required.
     *
     * @param string $dojoItem Dojo class name to be required
     * @return boolean True if the require has already been set
     */
    public static function hasRequire( $dojoItem )
    {
    	return isset( self::$requires[$dojoItem] );
    }
    
    /**
     * Generates the list of Dojo require statements that need to be made for
     * the javascript functions to work.
     *
     * @return string Dojo require statements put into a javascript tag
     */
    public static function renderRequires()
    {
    	$rval = '';
    	$requires = self::getRequires();
    	foreach ( $requires as $require => $count )
    	{
    		if ( $count > 0 )
    		{
    			$rval .= "dojo.require(\"$require\");\n";
    		}
    	}
    	
    	return javascript_tag( $rval );
    }
    
    /**
     * Gets the current set of Dojo requires.
     *
     * @return mixed Array of Dojo requires
     */
    public static function getRequires()
    {
    	return self::$requires;
    }
}
?>