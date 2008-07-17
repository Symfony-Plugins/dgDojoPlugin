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
        /**
         * This houses the set of requires that have been mentioned to the
         * manager.
         */
        $requires     = array(),
        /** Maintains if Dojo JS has been included or not. */
        $dojoIncluded = false,
        /** Maintains the current page style for Dijit items. */
        $style        = 'tundra',
        /** List of available styles in the default Dojo install. */
        $dojo_styles  = array('tundra', 'soria', 'nihilo');
    
    /**
     * Adds the dojo javascript to the response.  Uses dojoIncluded variable to
     * avoid including dojo multiple times.
     *
     */
    public static function addJavascript()
    {
        if ( !self::$dojoIncluded )
        {
            $dojo = sfConfig::get( 'dojo_js', '/js/dojoToolkit' );
            $response = sfContext::getInstance()->getResponse();
            $response->addJavascript( $dojo.'/dojo/dojo.js', '', array( 'djConfig' => 'parseOnLoad: true' ) );
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
     * Sets the style of the body.  If this is one of the base styles in Dojo,
     * the needed stylesheets will also be included.  If you make your own
     * style, be sure to include the right stylesheets.
     *
     * @param string $style New style for the Dojo widgets
     */
    public static function setStyle($style)
    {
        self::$style = strtolower($style);
    }
    
    /**
     * Gets the current style set for Dojo widgets.
     *
     * @return string
     */
    public static function getStyle()
    {
        return self::$style;
    }
    
    /**
     * Generates the list of Dojo require statements that need to be made for
     * the javascript functions to work.  It adds the stylesheets to the
     * response if they are Dojo styles.
     *
     * @return string Dojo require statements put into a javascript tag
     */
    public static function renderRequires()
    {
        
        $dojo = sfConfig::get('dojo_js', '/js/dojoToolkit');
        $response = sfContext::getInstance()->getResponse();
        $response->addStylesheet("$dojo/dojo/resources/dojo.css");
        if (in_array(self::$style, self::$dojo_styles))
        {
            $style = self::$style;
            $response->addStylesheet("$dojo/dijit/themes/$style/$style.css");
        }
        
        
    	$rval = '';
    	$requires = self::getRequires();
    	foreach ( $requires as $require => $count )
    	{
    		if ( $count > 0 )
    		{
    			$rval .= "dojo.require(\"$require\");\n";
    		}
    	}
    	
    	return javascript_tag($rval);
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