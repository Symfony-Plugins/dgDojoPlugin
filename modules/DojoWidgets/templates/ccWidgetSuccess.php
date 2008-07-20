<?php use_helper('DojoWidget') ?>

<div id="container" style="width: 750px; margin: 50px auto;">
<?php echo link_to('Dojo Widget Home', 'DojoWidgets/index') ?>

<h1>Set of Command and Control Widgets</h1>

<h2>Dojo Button</h2>
<p>This is just a generic form button that has some attributes brought in by
Dojo.  It has the capability of being a regular button, a drop down button, or a
combo button.  You make it a drop down button by adding DojoMenuItems to it.  If
you then add something to the onclick attribute of the button, it will become a
combo button.</p>

<?php echo dojo_button('Simple Button', array('href' => '#')) ?>
<?php
$dropButton = new DojoButton('Drop Down Button');
$dropButton['home'] = new DojoMenuItem('Home', array(), array('href' => '#'));
$dropButton['conf'] = new DojoMenuItem('Configuration', array(), array('href' => '#'));
$dropButton['conf']['main'] = new DojoMenuItem('Main Configuration', array(), array('href' => '#'));
$dropButton['conf']['back'] = new DojoMenuItem('Backend Configuration', array(), array('href' => '#'));
echo $dropButton;

$comboButton = $dropButton;
$comboButton->setName('Combo Button');
$comboButton->onclick = 'alert("You clicked me!")';
echo $comboButton;
?>

<h2>Dojo Menu</h2>
<p>The DojoMenu is majorly important for things like the toolbar and the drop 
down and combo buttons, but it can also be used as a right click menu either
anywhere in the window or in a specific div.  If you specify the node IDs for
the menu to be active in, it does override any other menu that may affect the
area around those node IDs.</p>
<?php
$menu = new DojoMenu();
$menu->popupDelay = 0;
$menu->style = 'display: none;';
$menu->targetNodeIds = 'menuDiv';
$menu['main1'] = new DojoMenuItem('Main Item 1');
$menu['main1']->onclick = 'alert("You clicked main item 1!")';
$menu['sub1'] = new DojoMenuItem('Main Item 2');
$menu['sub1']['subitem1'] = new DojoMenuItem('Sub Item 1');
$menu['sub1']['subitem1']->onclick = 'alert("You clicked sub item 1!")';
$menu['sub1']['subitem2'] = new DojoMenuItem('Sub Item 2');
$menu['sub1']['subitem2']->onclick = 'alert("You clicked sub item 2!")';
echo $menu;
?>
<p>Right click in gray area for menu.</p>
<div style="height: 100px; border: solid 1px black; background: #DDDDDD;" id="menuDiv">
    &nbsp;
</div>

<h2>Dojo Toolbar</h2>
<p>The DojoToolbar allows you to create a toolbar in PHP.  It acts much like the
DojoMenu except that it has to take DojoButtons to build it up.  It can be quite
handy.</p>
<?php
$toolbar = new DojoToolbar();
// one way to add a button
$toolbar->addItem('Home');
$toolbar['Home']->setAttribute('onclick', '#');
$toolbar['Home']->id = 'home2';

// second method for adding button
$toolbar['Site'] = new DojoButton('Site');
$toolbar['Site']->setAttribute('id', 'site1');
$toolbar['Site']->setMenuAttribute('popupDelay', 0);

$toolbar['Site']['gConf'] = new DojoMenuItem('Global Configuration');
$toolbar['Site']['gConf']->setAttribute('iconClass', 'configuration');
$toolbar['Site']['gConf']->setMenuAttribute('id', 'conf_submenu2');

$toolbar['Site']['gConf']['front'] = new DojoMenuItem('Frontend Configuration');
$toolbar['Site']['gConf']['front']->setAttribute('iconClass', 'configuration');
$toolbar['Site']['gConf']['front']->onClick = "location.href='#'";

$toolbar['Site']['gConf']['back'] = new DojoMenuItem('Backend Configuration');
$toolbar['Site']['gConf']['back']->setAttribute('iconClass', 'configuration');
$toolbar['Site']['gConf']['back']->onClick = "location.href='#'";

echo $toolbar;
?>

</div>