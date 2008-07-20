<?php

/**
 * Class to represent a Dojo Menu Item.  This handles dealing with a submenu so
 * classes like the Dojo Button actually inherit from here.  It automatically
 * will adjust the type to a popup menu item if the submenu is setup.
 *
 */
class DojoMenuItem extends DojoWidget implements ArrayAccess
{
	protected
		/**
		 * Name of the item.
		 */
		$name,
		
		/**
		 * Set of options to be passed to a submenu for this item
		 */
		$menuOptions = array(),
		
		/**
		 * The submenu object if there is one.
		 */
		$menu = null;
	
	/**
	 * Base constructor to set the name and options for the Dojo Menu Item.
	 *
	 * @param string $name Name for the button, the text on the button
	 * @param mixed $options Set of options for the HTML tag
	 */
	public function __construct( $name, $options = array(), $attributes = array() )
	{
		parent::__construct( $options, $attributes );
		$this->name = $name;
	}
	
	/**
	 * Configure this widget by setting the dojoType and protecting that
	 * attribute.
	 *
	 * @param mixed $options Set of options for the widget
	 * @param mixed $attributes Set of HTML options for the created HTML
	 */
	protected function configure( $options = array(), $attributes = array() )
	{
		$this->setAttribute( 'dojoType', DojoTypes::MENU_ITEM );
		$this->addProtectedAttribute( 'dojoType' );
	}
	
	/**
	 * Returns all of the items associated with the submenu.
	 *
	 * @return mixed Null if no submenu, otherwise the items for the menu
	 */
	public function getItems()
	{
		if ( $this->menu === null )
		{
			return null;
		}
		
		return $this->menu->getItems();
	}
	
	/**
	 * Returns all of the positions associated with the submenu.
	 *
	 * @return mixed Null if no submenu, otherwise the set of positions
	 */
	public function getPositions()
	{
		if ( $this->menu === null )
		{
			return null;
		}
		
		return $this->menu->getPositions();
	}
	
	/**
	 * Sets a menu option.  Stores values in a separate array until the menu
	 * object is actually created for this item.
	 *
	 * @param string $option Option to be set
	 * @param mixed $value Value for the option
	 */
	public function setMenuAttribute( $option, $value )
	{
		if ( $this->menu !== null )
		{
			$this->menu->setAttribute( $option, $value );
		}
		else
		{
			$this->menuOptions[$option] = $value;
		}
	}
	
	/**
	 * Determines if a particular menu item exists in the submenu.  Returns
	 * false if there isn't a menu yet.
	 *
	 * @param string $name Name of the item looking for
	 * @return boolean True if the item exists
	 */
	public function offsetExists( $name )
	{
		$rval = false;
		if ( $this->menu !== null )
		{
			$rval = isset( $this->menu[$name] );
		}
		
		return $rval;
	}
	
	/**
	 * Gets a particular menu item from the submenu if it exists.  Returns null
	 * if there is no menu set yet.
	 *
	 * @param string $name Name of the item looking for
	 * @return DojoMenuItem The item looking for if it exists
	 */
	public function offsetGet( $name )
	{
		$rval = null;
		if ( $this->menu !== null )
		{
			$rval = $this->menu[$name];
		}
		
		return $rval;
	}
	
	/**
	 * Sets a particular menu item.  Relies on the menu to decide if the item
	 * is valid.  This method will create the submenu if it doesn't yet exist.
	 *
	 * @param string $name Name of the new item
	 * @param DojoMenuItem $item Item for the submenu
	 */
	public function offsetSet( $name, $item )
	{		
		if ( $this->menu === null )
		{ // create the menu if we haven't yet
			$this->menu = new DojoMenu( array(), $this->menuOptions );
		}
		
		$this->menu[$name] = clone $item;
	}
	
	/**
	 * Unsets a particular item in the submenu.
	 *
	 * @param string $name Name of the item to be unset
	 */
	public function offsetUnset( $name )
	{
		if ( $this->menu !== null )
		{
			unset( $this->menu[$name] );
		}
	}
	
	/**
	 * Adds an item based on a string to the submenu.  This name will be used
	 * in the array offset to access the new menu item.
	 *
	 * @param string $name Name for the new menu item.
	 */
	public function addItem( $name )
	{
		$this[$name] = new DojoMenuItem();
	}
	
	/**
	 * Returns the current name for this item.
	 *
	 * @return string The name for this item
	 */
	public function getName()
	{
	    return $this->name;
	}
	
	/**
	 * Sets the name for this item.  Must be a string or it won't work.
	 *
	 * @param string $name Name for the item
	 */
	public function setName( $name )
	{
	    if (is_string($name))
	       $this->name = $name;
	}
	
	/**
	 * Returns the rendered from of the DojoMenuItem including its submenu if
	 * necessary.  Inheriting classes should override this for printing.
	 *
	 * @return string The rendered menu item
	 */
	public function render( $name, $value = null, $attributes = array(), $errors = array() )
	{
		// adds that the dojo menu is required
		DojoManager::addRequire( DojoTypes::MENU );
		$attributes['dojoType'] = $this->getAttribute( 'dojoType' );
		
		// if we have a submenu, this needs to be a popup menu item in dojo
		if ( $this->menu !== null ) $attributes['dojoType'] = DojoTypes::POPUP_MENU_ITEM;
		
		$rval = '';
		if ( $this->menu !== null )
		{ // submenus require slightly different rendering
			$rval = "<span>$name</span>\n";
			$rval .= $this->menu->__toString();
		}
		else 
		{
			$rval = $name;
		}
		
		return $this->renderContentTag( 'div', $rval, $attributes );
	}

	/**
	 * Returns the string form of this object.
	 *
	 * @return string Rendered form of the object
	 */
	public function __toString()
	{
		return $this->render( $this->name, null, $this->getAttributes() );
	}
}
?>