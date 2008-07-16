<?php

class DojoToolbar extends DojoMenu
{	
	protected function configure( $options = array(), $attributes = array() )
	{
		$this->addOption( 'subItems', 'DojoButton' );
		$this->setAttribute( 'dojoType', DojoTypes::TOOLBAR );
		$this->addProtectedAttribute( 'dojoType' );
	}
}
?>