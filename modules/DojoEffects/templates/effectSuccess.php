<?php use_helper('Dojo') ?>

<div id="container" style="margin: 10px auto; width: 750px;">
<?php echo link_to('Dojo Effect Home', 'DojoEffects/index') ?>

<h1 id="top">Available Effects from Dojo</h1>

<h2>Highlight Effect</h2>
<p>The highlight effect is nice for brining attention.  Dojo allows you to even
choose the highlighting color.</p>
<?php
$highlight = new DojoHighlightEffect('highlight', array('duration' => 1));
$highlightRed = new DojoHighlightEffect('highlight', array('color'    => 'red',
                                                           'duration' => 1));
?>
<?php echo dojo_button_to_function('Highlight', $highlight->play()) ?>
<?php echo dojo_button_to_function('Highlight Red', $highlightRed->play()) ?>
<div id="highlightContainer" style="border: solid 1px black; padding: 10px;">
    <div id="highlight" style="height: 100px; width: 100px;">
        I love putting random text in a div.  Doesn't it look nice?
    </div>
</div>

<h2>Fade Effect</h2>
<p>The Dojo fade effect can be configured to do a fade in or a fade out.</p>
<?php
$fadeIn = new DojoFadeEffect('fade', array('duration' => 1,
                                           'delay'    => 1));
$fadeOut = new DojoFadeEffect('fade', array('duration' => 1,
                                            'dir'      => 'out'));
$fadeOutIn = new DojoChainEffect($fadeOut, $fadeIn);
?>
<?php echo dojo_button_to_function('Fade Out/In', $fadeOutIn->play()) ?>
<div id="fadeContainer" style="border: solid 1px black; padding: 10px;">
    <div id="fade" style="height: 100px; width: 100px; background: blue;">
        &nbsp;
    </div>
</div>

<h2>Wipe and Wipe To Effect</h2>
<p>The Dojo wipe effect can be configured to do a wipe in or a wipe out. What
you need to remember about the wipe in effect is that Dojo uses the scrollHeight
attribute.  This means that the div will only wipe to it's original height if
the content in the div makes it that height.  See the source code to see what
this means.</p>
<?php
$wipeIn = new DojoWipeEffect('wipe', array('duration' => 1,
                                           'delay'    => 1));
$wipeOut = new DojoWipeEffect('wipe', array('duration' => 1,
                                            'dir'      => 'out'));
$wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
$wipeTo1 = new DojoWipeToEffect('wipe', array('width' => 1));
$wipeTo100 = new DojoWipeToEffect('wipe', array('width' => 100,
                                                'delay' => 1));
$wipeTo = new DojoChainEffect($wipeTo1, $wipeTo100);
?>
<?php echo dojo_button_to_function('Wipe Out / In', $wipeOutIn->play()) ?>
<?php echo dojo_button_to_function('Wipe To 1px / 100px', $wipeTo->play()) ?>
<div id="wipeContainer" style="border: solid 1px black; padding: 10px; height: 100px;">
    <div id="wipe">
        <div id="wipeSubContainer" style="background: blue; height: 100px; width: 100px;">
            &nbsp;
        </div>
    </div>
</div>

<h2>Size To Effect</h2>
<p>Another nice effect is resizing an element.  This gives you the ability to
make an element grow or shrink to a desired size.  Be careful with this.  I use
'position: relative' for this element so that it doesn't leave the enclosing
div.  You can also specify whether the effect is done in combination or as a
chain of effects.</p>
<?php
$sizeTo50 = new DojoSizeToEffect('sizeTo', array('height' => 50,
                                                 'width'  => 50,
                                                 'method' => 'combine'));
$sizeTo100 = new DojoSizeToEffect('sizeTo', array('height' => 100,
                                                  'width'  => 100));
?>
<?php echo dojo_button_to_function('Shrink To 50 x 50 (Combine)', $sizeTo50->play()) ?>
<?php echo dojo_button_to_function('Enlarge To 100 x 100 (Chain)', $sizeTo100->play()) ?>
<div id="sizeToContainer" style="border: solid 1px black; padding: 10px; height: 100px;">
    <div id="sizeTo" style="background: blue; height: 100px; width: 100px; position: relative;">
        &nbsp;
    </div>
</div>

<h2>Animate Properties Effect</h2>
<p>The Dojo animate effect allows you to animate specific properties of an
element.  It essentially animates from some start point, defaults to the current
point, and goes to the specified end point.  This takes an CSS property when
dashes are removed and replaced by the uppercase of the next letter 
(ex. font-size =&gt; fontSize).</p>
<?php
$animBigFont = new DojoAnimateEffect('anim', array('duration'   => 1,
                                                   'properties' => array('width'    => array('end'   => 730,
                                                                                             'units' => 'px'),
                                                                         'fontSize' => 24)));
$animSmallFont = new DojoAnimateEffect('anim', array('duration'   => 1,
                                                     'delay'      => 1,
                                                     'properties' => array('width'    => array('end'   => 200,
                                                                                               'units' => 'px'),
                                                                           'fontSize' => 14)));
$animFontWidth = new DojoChainEffect($animBigFont, $animSmallFont);
$animLeftPad = new DojoAnimateEffect('anim', array('duration'   => 1,
                                                   'properties' => array('marginLeft' => array('end'   => 530,
                                                                                               'units' => 'px'),
                                                                         'paddingTop' => 20)));
$animRightPad = new DojoAnimateEffect('anim', array('duration'   => 1,
                                                    'delay'      => 1,
                                                    'properties' => array('marginLeft' => array('end'   => 0,
                                                                                                'units' => 'px'),
                                                                          'paddingTop' => 1)));
$animLeftTop = new DojoChainEffect($animLeftPad, $animRightPad);
?>
<?php echo dojo_button_to_function('marginLeft / paddingTop', $animLeftTop->play()) ?>
<?php echo dojo_button_to_function('fontSize / width', $animFontWidth->play()) ?>
<div id="animContainer" style="border: solid 1px black; padding: 10px; height: 120px;">
    <div id="anim" style="background: #DDDDDD; height: 100px; width: 200px;">
        Just some delightful text for your reading pleasure.
    </div>
</div>

<h2>Slide To and Slide By Effect</h2>
<p>The Dojo slide to and slide by effects allow you to move elements around the
page.</p>
<?php
$slideToLeft = new DojoSlideToEffect('slide', array('top'      => 0,
                                                    'duration' => 1,
                                                    'left'     => 'dojo.marginBox("slideContainer").w - 120'));
$slideToRight = new DojoSlideToEffect('slide', array('delay'    => 1,
                                                     'duration' => 1,
                                                     'top'      => 0,
                                                     'left'     => 1));
$slide = new DojoChainEffect($slideToLeft, $slideToRight);
$fadeOut->setNode('slide');
$fadeIn->setNode('slide');
$fadeIn->setOption('delay', 1.5);
$fade = new DojoChainEffect($fadeOut, $fadeIn);
$slideFade = new DojoCombineEffect($slide, $fade);
$slideByx50 = new DojoSlideByEffect('slide', array('left' => 50));
$slideBackx50 = new DojoSlideByEffect('slide', array('left' => -50));
?>
<?php echo dojo_button_to_function('Slide', $slide->play()) ?>
<?php echo dojo_button_to_function('Slide and Fade', $slideFade->play()) ?>
<?php echo dojo_button_to_function('Slide Right', $slideByx50->play()) ?>
<?php echo dojo_button_to_function('Slide Left', $slideBackx50->play()) ?>
<div id="slideContainer" style="border: solid 1px black; padding: 10px; height: 100px;">
    <div id="slide" style="background: blue; height: 100px; width: 100px; position: relative;">
        &nbsp;
    </div>
</div>

<h2>Smooth Scroll Effect</h2>
<p>This allows you to scroll the page to a point in a sort of smooth action.  
This can also scroll certain elements instead of the whole window.  You can
change the element by using the 'win' option.</p>
<?php
$smooth = new DojoSmoothScrollEffect('top', array('duration' => 2));
?>
<?php echo dojo_button_to_function('Scroll To Top', $smooth->play()) ?>

<h2>Cross Fade Effect</h2>
<p>This allows you to do some interesting fade effects.  This fades one element
out while fading another in.  It makes for some dramatic fades.</p>
<?php
$cross = new DojoCrossFadeEffect('cross1', 'cross2', array('duration' => 1));
?>
<?php echo dojo_button_to_function('Cross Fade', $cross->play()) ?>
<div id="crossContainer" style="border: solid 1px black; padding: 10px; height: 100px; position: relative;">
    <div id="cross1" style="background: red; height: 100px; width: 200px; position: absolute; opacity: 0; color: white;">
        This is a different message! ;)
    </div>
    <div id="cross2" style="background: blue; height: 100px; width: 200px; position: absolute; color: white;">
        Just some delightful text for your reading pleasure.
    </div>
</div>

<h2>Adding and Removing Class Effects</h2>
<p>Dojo gives some ability to add and remove classes from an element with some
effect work done for the transition.  They seem a bit buggy, as in I couldn't
get them to chain without having a bit of a glitch when the class was added.</p>
<?php
$addGray = new DojoAddClassEffect('changeClass', array('class' => 'gray'));
$removeGray = new DojoRemoveClassEffect('changeClass', array('class' => 'gray'));
$toggleFun = new DojoToggleClassEffect('changeClass', array('class' => 'fun'));
$gray = new DojoChainEffect($addGray, $removeGray);
?>
<?php echo dojo_button_to_function('Add gray Class', $addGray->play()) ?>
<?php echo dojo_button_to_function('Remove gray Class', $removeGray->play()) ?>
<?php echo dojo_button_to_function('Toggle fun Class', $toggleFun->play()) ?>
<!-- Wrong place, but what the hell? -->
<style type="text/css">
.fun {
    line-height: 22pt;
    margin-left: 50px;
    font-size: 16pt;
}
.gray {
    background: #DDDDDD;
    color: black;
}
</style>
<div id="classContainer" style="border: solid 1px black; padding: 10px; height: 100px; position: relative;">
    <div id="changeClass" style="height: 100px; width: 200px;">
        Just some delightful text for your reading pleasure.
    </div>
</div>
</div>