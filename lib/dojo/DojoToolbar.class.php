<?php

/**
 * This class represents a DojoToolbar.  It's very much like the DojoMenu
 * except that it requires different subitems and is a different dojoType.
 *
 */
class DojoToolbar extends DojoMenu
{	
    /**
     * Configures things for the toolbar.  It sets up the dojoType attribute
     * and protects this attribute.  It also sets the subItems option as
     * DojoButton.
     *
     * @param mixed $options Set of options for this object
     * @param mixed $attributes Set of HTML attributes for the final tag
     */
	protected function configure( $options = array(), $attributes = array() )
	{
		$this->addOption( 'subItems', 'DojoButton' );
		$this->setAttribute( 'dojoType', DojoTypes::TOOLBAR );
		$this->addProtectedAttribute( 'dojoType' );
	}
}
?>