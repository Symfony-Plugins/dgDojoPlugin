<?php

class DojoMenu extends DojoWidget implements ArrayAccess
{
	protected
		$items = array(),
		$positions = array();
		
	protected function configure( $options = array(), $attributes = array() )
	{
		$this->setAttribute( 'dojoType', DojoTypes::MENU );
		$this->addProtectedAttribute( 'dojoType' );
		$this->addOption( 'subItems', 'DojoMenuItem' );
	}
	
	public function addItem( $name, $options = array() )
	{
		$class = $this->getOption( 'subItems' );
		$this[$name] = new $class( $name, $options );
	}
	
	public function getItems()
	{
		return $this->items;
	}
	
	public function getPositions()
	{
		return $this->positions;
	}
		
	public function offsetExists( $name )
	{
		return isset( $this->items[$name] );
	}
	
	public function offsetGet( $name )
	{
		return isset( $this->items[$name] ) ? $this->items[$name] : null;
	}
	
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
	
	public function offsetUnset( $name )
	{
		unset( $this->items[$name] );
		if ( false !== $position = array_search( $name, $this->positions ) )
		{
			unset( $this->positions[$position] );
		}
	}
	
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
	
	public function __toString()
	{
		return $this->render( null, null, $this->getAttributes() );
	}
}
?>