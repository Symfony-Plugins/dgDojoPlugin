<?php

/**
 * This class represents a Dojo menu object.  It implements ArrayAccess to make
 * setting and getting items more intuitive.  This class is used in some other
 * widgets to handle submenu capabilites of those widgets.
 *
 */
class DojoMenu extends DojoWidget implements ArrayAccess
{
	protected
	    /** Set of items for the menu */
		$items = array(),
		/** Positional information for items */
		$positions = array();
		
    /**
     * Configures this object's dojoType attribute and protects this attribute.
     * It also specifies the class for any subItem.
     *
     * @param mixed $options Set of options for the Widget
     * @param mixed $attributes Set of HTML attributes for the item
     */
	protected function configure( $options = array(), $attributes = array() )
	{
		$this->setAttribute( 'dojoType', DojoTypes::MENU );
		$this->addProtectedAttribute( 'dojoType' );
		$this->addOption( 'subItems', 'DojoMenuItem' );
	}
	
	/**
	 * Adds an item of based on the subItems option for the widget.
	 *
	 * @param string $name Name for the new item
	 * @param mixed $options Any options for the new subItem
	 */
	public function addItem( $name, $options = array() )
	{
		$class = $this->getOption( 'subItems' );
		$this[$name] = new $class( $name, $options );
	}
	
	/**
	 * Get the current set of items for this object.
	 *
	 * @return mixed Set of subItems for this object
	 */
	public function getItems()
	{
		return $this->items;
	}
	
	/**
	 * Current set of positional information for subItems.
	 *
	 * @return mixed The current set of positional information
	 */
	public function getPositions()
	{
		return $this->positions;
	}
		
	/**
	 * Determines if a particular offset exists in the items array.
	 *
	 * @param string $name Name of the item being checked
	 * @return boolean True if the offset exists
	 */
	public function offsetExists( $name )
	{
		return isset( $this->items[$name] );
	}
	
	/**
	 * Gets a certain subitem based on its name.
	 *
	 * @param string $name Name of the subItem being sought after
	 * @return mixed The subitem at the offset.  Type depends on class
	 */
	public function offsetGet( $name )
	{
		return isset( $this->items[$name] ) ? $this->items[$name] : null;
	}
	
	/**
	 * Sets an offset subitem.  May through an exception if the class of the
	 * passed in item doesn't match with the type needed by the object.
	 *
	 * @param string $name Name of the offset
	 * @param mixed $item New subitem, type depends on the class
	 */
	public function offsetSet( $name, $item )
	{
		$class = strval( $this->getOption( 'subItems' ) );
		
		if ( !$item instanceof $class )
		{
			throw new InvalidArgumentException( 'A '.$this->getAttribute('dojoType').' item must be an instance of '.$this->getOption( 'subItems' ).'.' );
		}
		
		if ( !isset( $this->items[$name]) )
		{
			$this->positions[] = $name;
		}
		
		$this->items[$name] = clone $item;
	}
	
	/**
	 * Unsets a particular offset in the items array if it exists.  It also
	 * removes the reference to this object in the position array.
	 *
	 * @param string $name Offset being removed
	 */
	public function offsetUnset( $name )
	{
		unset( $this->items[$name] );
		if ( false !== $position = array_search( $name, $this->positions ) )
		{
			unset( $this->positions[$position] );
		}
	}
	
	/**
	 * Renders the HTML for the menu object.  This goes through all of the 
	 * positions and renders each object in the items array.
	 *
	 * @param string $name This is unused, here to match with interface
	 * @param string $value Also unused
	 * @param mixed $attributes Set of attributes for the created tag
	 * @param mixed $errors Unused
	 * @return string The created tag for a DojoMenu
	 */
	public function render( $name, $value = null, $attributes = array(), $errors = array() )
	{
		DojoManager::addRequire( $this->getAttribute( 'dojoType' ) );
		
		$rval = '';
		foreach ( $this->positions as $pos )
		{
			$rval .= $this[$pos]->__toString(); 
		}
		
		return $this->renderContentTag( 'div', $rval, $attributes );
	}
	
	/**
	 * Magic to string method for the object that just calls the render method.
	 *
	 * @return string The completed string for this object
	 */
	public function __toString()
	{
		return $this->render( null, null, $this->getAttributes() );
	}
}
?>