<?php

/**
 * Base class for the Dojo widgets that handles the options part of the HTML
 * tags.
 *
 */
abstract class DojoWidget extends sfWidget
{
	protected
		/**
		 * Set of write protected HTML attributes.
		 */
		$protectedAttributes = array();
	
	/**
	 * Adds an item to the protected attribute list.
	 *
	 * @param string $name Name of the attribute to protect
	 */
	protected function addProtectedAttribute( $name )
	{
		$this->protectedAttributes[] = $name;
	}
	
	/**
	 * Removes an item from protected status.
	 *
	 * @param string $name Name of attribute to unprotect
	 */
	protected function removeProtectedAttribute( $name )
	{
		if ( false !== $position = array_search( $name, $this->protectedAttributes ) )
		{
			unset( $this->protectedAttributes[$position] );
		}
	}
	
	/**
	 * Sets a default HTML attribute unless that attribute is protected.
	 *
	 * @param string $name The attribute name
	 * @param string $value The attribute value
	 * @throws InvalidArgumentException If $name is a protected attribute
	 */
	public function setAttribute( $name, $value )
	{
		if ( false !== $position = array_search( $name, $this->protectedAttributes ) )
		{
			throw new InvalidArgumentException( sprintf( '%s has protected the following attribute: \'%s\'.', get_class($this), $name ) );
		}
		parent::setAttribute( $name, $value );
	}
	
	/**
	 * Sets the HTML attributes unless one of them is protected
	 *
	 * @param array $attributes An array of HTML attributes
	 * @throws InvalidArgumentException If one of the attributes is protected
	 */
	public function setAttributes( $attributes )
	{
		if ( $intersect = array_intersect( array_keys( $attributes ), $this->protectedAttributes ) )
		{
			throw new InvalidArgumentException( sprintf( '%s has protected the following attributes: \'%s\'.', get_class($this), implode( '\', \'', $intersect ) ) );
		}
		parent::setAttributes( $attributes );
	}
	
	/**
	 * Sets an attribute value.  This gives a little bit slicker interface to
	 * the attributes of the object.
	 *
	 * @param string $name Name of the attribute to set
	 * @param mixed $value Value for the named attribute
	 */
	public function __set( $name, $value )
	{
		$this->setAttribute( $name, $value );
	}
	
	/**
	 * Gets an attribute value.  This gives a little bit slicker interface to
	 * the attributes of the object
	 *
	 * @param string $name Name of the attribute to retrieve
	 * @return mixed The value for the named attribute
	 */
	public function __get( $name )
	{
		return $this->getAttribute( $name );
	}
}
?>