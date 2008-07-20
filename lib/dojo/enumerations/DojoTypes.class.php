<?php

/**
 * This class is used for maintaining Dojo types and function calls so that I
 * only have one place to go should Dojo ever change their API.  Don't change
 * these, it may break many things ;).
 *
 */
class DojoTypes
{
	const
		BUTTON = 'dijit.form.Button',
		DROPDOWN_BUTTON = 'dijit.form.DropDownButton',
		COMBO_BUTTON = 'dijit.form.ComboButton',
		TOOLBAR = 'dijit.Toolbar',
		MENU = 'dijit.Menu',
		MENU_ITEM = 'dijit.MenuItem',
		POPUP_MENU_ITEM = 'dijit.PopupMenuItem',
		MENU_SEPARATOR = 'dijit.MenuSeparator',
		DIALOG = 'dijit.Dialog',
		TOOLTIP_DIALOG = 'dijit.TooltipDialog',
		TITLEPANE = 'dijit.TitlePane',
		PROGRESS_BAR = 'dijit.ProgressBar',
		TAB_CONTAINER = 'dijit.layout.TabContainer',
		STACK_CONTAINER = 'dijit.layout.StackContainer',
		ACCORDION_CONTAINER = 'dijit.layout.AccordionContainer',
		ACCORDION_PANE = 'dijit.layout.AccordionPane',
		CONTENT_PANE = 'dijit.layout.ContentPane',
		SPLIT_CONTAINER = 'dijit.layout.SplitContainer',
		BORDER_CONTAINER = 'dijit.layout.BorderContainer',
		DOJO_FX = 'dojo.fx',
		DOJOX_FX = 'dojox.fx',
		CHAIN = 'dojo.fx.chain',
		COMBINE = 'dojo.fx.combine',
		SCROLL = 'dojox.fx.scroll',
		EASING = 'dojox.fx.easing',
		STYLE = 'dojox.fx.style';
}
?>