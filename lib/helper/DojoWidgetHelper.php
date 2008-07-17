<?php

use_helper( 'Javascript' );

/**
 * Generates a div usable as a dialog box in Dojo.  This is very similar to a
 * lightbox effect.
 *
 * @param string $title The title of the dialog box
 * @param string $content Content of the dialog box.  Can be pretty much
 *                        anything.
 * @param mixed $options Various options for the tag
 * @return string The finished content tag for the dialog box
 */
function dojo_dialog( $title, $content = '', $options = array() )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	$options['title'] = $title;
	$options['dojoType'] = DojoTypes::DIALOG;
	dojo_require( $options['dojoType'] );
	
	if ( isset($options['open'] ) )
	{
		$options['open'] = _bool_to_str( $options['open'] );
	}
	
	return content_tag( 'div', $content, $options );
}

/**
 * Creates a button that is tied to a tooltip dialog box.  This is useful for
 * putting clickable data in a tooltip.
 *
 * @param string $title What the button will say
 * @param mixed $content Content to be put in the dialog
 * @param mixed $options Set of HTML attributes for the tooltip dialog div
 * @return string The created HTML to create a tooltip dialog with a button
 */
function dojo_tooltip_dialog( $title, $content = '', $options = array() )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	$options['title'] = $title;
	$options['dojoType'] = DojoTypes::TOOLTIP_DIALOG;
	dojo_require( array( DojoTypes::DIALOG, DojoTypes::BUTTON ) );
	
	if ( isset($options['open'] ) )
	{
		$options['open'] = _bool_to_str( $options['open'] );
	}
	
	return content_tag( 'div', "<span>$title</span>".content_tag( 'div', $content, $options ), array('dojoType' => DojoTypes::DROPDOWN_BUTTON));
}

/**
 * Starts a Dojo title pane div.  This div must be closed by the user for this
 * to work properly
 *
 * @param string $title Title of the titlepane.  This overrides the option 
 * 						array
 * @param mixed $options Set of options for the titlepane
 * @return string The created open div tag for a titlepane
 */
function dojo_titlepane( $title, $options = array() )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	$options['title'] = $title;
	$options['dojoType'] = DojoTypes::TITLEPANE;
	dojo_require( DojoTypes::TITLEPANE );
	
	if ( isset($options['open'] ) )
	{
		$options['open'] = _bool_to_str( $options['open'] );
	}
	
	return tag( 'div', $options, true );	
}

/**
 * Creates a progress bar div in Dojo.
 *
 * @param string $jsId The javascript ID for this div.  Used for updating the
 * 					   progress bar
 * @param mixed $options Set of HTML attributes for the div tag
 * @return string The created tag for a progress bar
 */
function dojo_progress_bar( $jsId, $options = array() )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	$options['jsId'] = $jsId;
	$options['dojoType'] = DojoTypes::PROGRESS_BAR;
	dojo_require( $options['dojoType'] );
	
	if ( isset($options['indeterminate'] ) )
	{
		$options['indeterminate'] = _bool_to_str( $options['indeterminate'] );
	}
	
	return content_tag( 'div', '', $options );
}

/**
 * Converts anything that evalutates as a boolean into 'true' or 'false'
 * strings
 *
 * @param mixed $boolean Anything that can resolve as a boolean
 * @return string 'true' or 'false' depending on $boolean
 */
function _bool_to_str( $boolean )
{
	if ( $boolean )
		$boolean = 'true';
	else
		$boolean = 'false';
	
	return $boolean;
}

/**
 * Creates a link that opens a dialog box in Dojo.
 *
 * @param string $name Link text
 * @param string $dialogId The ID of the dialog box to open
 * @param mixed $options Options for the tag
 * @return string The created link
 */
function dojo_open_dialog_link( $name, $dialogId, $options = array() )
{
	// eh, I'm lazy, let symfony do the work on this
	return link_to_function( $name, "dijit.byId('$dialogId').show()", $options );
}

/**
 * Creates a dojo button that opens a specified dialog box.
 *
 * @param string $name Text the button displays
 * @param string $dialogId The ID for the dialog box to open
 * @param mixed $options Options for the tag
 * @return string The created button tag
 */
function dojo_open_dialog_button( $name, $dialogId, $options = array() )
{	
	return dojo_button_to_function( $name, "dijit.byId('$dialogId').show()", $options );
}

/**
 * Returns a Dojo button whose text matches $text.
 *
 * @param string $text Text for the created button
 * @param mixed $options Options for the button tag
 * @return DojoButton The created button
 */
function dojo_button( $text, $options = array() )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	return new DojoButton( $text, array(), $options );
}

/**
 * Create a tooltip for a particular item.
 *
 * @param string $connectId The ID, or list of IDs, for the object to link the
 * 							tooltip to 
 * @param string $text Text for the tooltip.  Can include HTML
 * @param mixed $options Options for the div tag created
 * @return string The div for creating a tooltip
 */
function dojo_tooltip( $connectId, $text, $options = array() )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	$options['connectId'] = $connectId;
	$options['label'] = $text;
	$options['dojoType'] = 'dijit.Tooltip';
    
	dojo_require( $options['dojoType'] );
	
	return content_tag( 'div', '', $options );
}

/**
 * Returns an open div tag that house the proper information for a Dojo tab
 * div.
 *
 * @param mixed $options Options for the tag itself
 * @return string An open div tag with all the needed information
 */
function dojo_tabs( $options = array() )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	$options['dojoType'] = DojoTypes::TAB_CONTAINER;
	dojo_require( $options['dojoType'] );
	
	return tag( 'div', $options, true );
}

/**
 * Returns an open div tag that houses the correct information for a Dojo
 * Stack Container.  Any content panes that are inside of this div will
 * become part of the stack container.
 *
 * @param mixed $options Attributes for the div tag
 * @return string The created open div tag
 */
function dojo_stack( $options = array() )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	$options['dojoType'] = DojoTypes::STACK_CONTAINER;
	dojo_require( $options['dojoType'] );
	
	if ( isset( $options['doLayout'] ) )
		$options['doLayout'] = _bool_to_str( $options['doLayout'] );
	
	return tag( 'div', $options, true );
}

/**
 * Creates a button for selecting the next page in a stack container.  This
 * will also work with tab and accordion containers.
 *
 * @param string $stackId The stack ID for the stack we're moving through
 * @param string $text Text for the button.  Default is '>'
 * @param mixed $options Options for the HTML tag or Dojo
 * @return DojoButton The created button
 */
function dojo_button_stack_forward( $stackId, $text = '>', $options = array() )
{
	return dojo_button_to_function( $text, "dijit.byId('$stackId').forward()", $options );
}

/**
 * Creates a button for selecting the previous page in a stack container.  This
 * will also work with tab and accordion containers.
 *
 * @param string $stackId The stack ID for the stack we're moving through
 * @param string $text Text for the button.  Default is '<'
 * @param mixed $options Options for the HTML tag or Dojo
 * @return DojoButton The created button
 */
function dojo_button_stack_back( $stackId, $text = '<', $options = array() )
{
	return dojo_button_to_function( $text, "dijit.byId('$stackId').back()", $options );
}

/**
 * Creates a button that selects a particular page in a stack. This will also
 * work with tab and accordion containers.
 *
 * @param string $stackId The stack ID for the stack we're moving through
 * @param string $paneId ID for the content pane we are selecting
 * @param string $text Text for the button.  Will show paneId if not provided
 * @param mixed $options Options for the HTML tag or Dojo
 * @return DojoButton The created button
 */
function dojo_button_stack_select( $stackId, $paneId, $text = null, $options = array() )
{
	if ( is_null( $text ) )
		$text = $paneId;
	
	return dojo_button_to_function( $text, "dijit.byId('$stackId').selectChild(dijit.byId('$paneId'))", $options );
}

/**
 * Creates a div for an accordion container.
 *
 * @param mixed $options Options for the HTML tag or Dojo
 * @return string The created div tag for the container
 */
function dojo_accordion( $options = array() )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	$options['dojoType'] = DojoTypes::ACCORDION_CONTAINER;
	dojo_require( $options['dojoType'] );
	
	return tag( 'div', $options, true );
}

/**
 * Creates a div for an accordion pane.
 *
 * @param string $title Title for the accordion pane
 * @param mixed $options Options for the HTML tag or Dojo
 * @return string The created div tag for the pane
 */
function dojo_accordion_pane( $title, $options = array() )
{
	$options = _parse_pane_options( $options );
	$options['title'] = $title;
	$options['dojoType'] = DojoTypes::ACCORDION_PANE;
	dojo_require( DojoTypes::ACCORDION_CONTAINER );
	
	return tag( 'div', $options, true );
}

/**
 * This starts a div for a Dojo border container.  This can do tons of
 * different things and you should look at the Dojo reference book to get an
 * idea of what can be done.
 *
 * @param mixed $options Set of HTML options for the div tag
 * @return string The completed HTML div tag for a Dojo border container
 */
function dojo_border( $options = array() )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	$options['dojoType'] = DojoTypes::BORDER_CONTAINER;
	dojo_require( $options['dojoType'] );
	
	return tag( 'div', $options, true );
}

/**
 * Parses a list of options for panes.  This is for content and accordion
 * panes.
 *
 * @param mixed $options Set of options for HTML or Dojo
 * @return mixed $options fixed for content panes
 */
function _parse_pane_options( $options )
{
	if ( $options === null ) $options = array();
	$options = _parse_attributes( $options );
	
	$valid_regions = array( 'top', 'bottom', 'center', 'left', 'right' );
	
	if ( isset( $options['extractContent'] ) )
		$options['extractContent'] = _bool_to_str( $options['extractContent'] );
	if ( isset( $options['isLoaded'] ) )
		$options['isLoaded'] = _bool_to_str( $options['isLoaded'] );
	if ( isset( $options['parseOnLoad'] ) )
		$options['parseOnLoad'] = _bool_to_str( $options['parseOnLoad'] );
	if ( isset( $options['preload'] ) )
		$options['preload'] = _bool_to_str( $options['preload'] );
	if ( isset( $options['preventCache'] ) )
		$options['preventCache'] = _bool_to_str( $options['preventCache'] );
	if ( isset( $options['refreshOnShow'] ) )
		$options['refreshOnShow'] = _bool_to_str( $options['refreshOnShow'] );
	if ( isset( $options['closable'] ) )
		$options['closable'] = _bool_to_str( $options['closable'] );
	if ( isset( $options['persist'] ) )
		$options['persist'] = _bool_to_str( $options['persist'] );
	if ( isset( $options['splitter'] ) )
		$options['splitter'] = _bool_to_str( $options['splitter'] );
	if ( isset( $options['selected'] ) )
		$options['selected'] = _bool_to_str( $options['selected'] );
	
	if ( isset( $options['region'] ) && !in_array( strtolower( $options['region'] ), $valid_regions ) )
	{
		throw new InvalidArgumentException( 'Invalid region '.$options['region'].' spcified.  Must be one of '.implode( ', ', $valid_regions ) );
	}
		
	return $options;
}

/**
 * Returns an open div tag for housing a content pane.  Useful for creating
 * tabbed content.
 *
 * @param string $title The title of the content pane
 * @param mixed $options Various options for the div tag
 * @return string The open div tag with evertyhing set up
 */
function dojo_content_pane( $title, $options = array() )
{
	$options = _parse_pane_options( $options );
	$options['title'] = $title;
	$options['dojoType'] = DojoTypes::CONTENT_PANE;
	dojo_require( $options['dojoType'] );
	
	return tag( 'div', $options, true );
}

/**
 * Renders the needed require statements from the DojoManager class.
 *
 */
function dojo_includes()
{
	echo DojoManager::renderRequires();
}

/**
 * Prints the currently set style for Dojo including the class declaration.  
 * This should be placed in your body tag at the beginning of the layout.  If
 * you set the style to null or '', it will not add any style to the layout.
 *
 */
function dojo_style()
{
    if (DojoManager::getStyle())
        echo 'class="'.DojoManager::getStyle().'"';
}

/**
 * Adds an item, or a list of items, to the list of dojo requires.  The list is
 * kept unique.
 *
 * @param mixed $dojoItems Array of required Dojo items
 */
function dojo_require( $dojoItems )
{
	DojoManager::addRequire( $dojoItems );
}
?>