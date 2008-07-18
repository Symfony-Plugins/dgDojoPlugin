<?php

/**
 * Class to represent a Dojo button.  It automatically detects what king of
 * button it needs to be based on how you add things to it.  This applies to a
 * regular button, drop down button, and combo buttons.
 *
 */
class DojoButton extends DojoMenuItem
{	
    /**
     * Configures the DojoButton with the correct dojoType and protects this
     * attribute.
     *
     * @param mixed $options Set of options for the object
     * @param mixed $attributes Set of HTML attributes for the object
     */
	protected function configure( $options = array(), $attributes = array() )
	{
		$this->setAttribute( 'dojoType', DojoTypes::BUTTON );
		$this->addProtectedAttribute( 'dojoType' );
	}
	
	/**
	 * Renders a Dojo Button as needed.  If there is a menu, this is made into
	 * a drop down button.  If the 'onclick' option is also specified, this
	 * will become a combo button.
	 *
	 * @return string The rendered form of the button
	 */
	public function render( $name, $value = null, $attributes = array(), $errors = array() )
	{
		DojoManager::addRequire( DojoTypes::BUTTON );
		$attributes['dojoType'] = $this->getAttribute( 'dojoType' );
		
		$rval = null;
		if ( $this->menu !== null )
		{
			$attributes['dojoType'] = DojoTypes::DROPDOWN_BUTTON;
			if ( $this->hasOption( 'onclick' ) )
			{
				$attributes['dojoType'] = DojoTypes::COMBO_BUTTON;
			}
			
			$rval = "<span>$name</span>\n";
			$rval .= $this->menu->__toString();
			$rval = $this->renderContentTag( 'div', $rval, $attributes );
		}
		else
		{
			$rval = $this->renderContentTag( 'button', $name, $attributes );
		}
		
		return $rval;
	}
}
?>