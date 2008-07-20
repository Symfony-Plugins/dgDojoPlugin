<?php use_helper('Dojo') ?>
<?php
$wipeOut = new DojoWipeEffect('testDiv1', array('dir'      => 'out',
                                                'duration' => 1));
$wipeIn  = new DojoWipeEffect('testDiv1', array('duration' => 1));
?>
<div id="container" style="margin: 5em;">
    
    <?php echo link_to('Dojo Effect Home', 'DojoEffects/index') ?>
    
    <div id="testDivs" style="float:right; width: 240px; margin-right: 500px;">
        <div id="testContainer1" style="width: 235px; height: 235px; border: solid 1px black; float:right; position:relative; margin-top: 50px;">
            <div id="testDiv1" style="background: blue; position: relative">
                <div id="testSubDiv1" style="height: 235px;">
                    &nbsp;
                </div>
            </div>
        </div>
        <br style="clear:both;" />
        <div id="testContainer2" style="width: 235px; height: 235px; border: solid 1px black; float:right; position:relative; margin-top: 1.25em;">
            <div id="testDiv2" style="background: red; position: relative">
                <div id="testSubDiv2" style="height: 235px;">
                    &nbsp;
                </div>
            </div>
        </div>
        <br style="clear:both;" />
        <div id="testContainer3" style="width: 235px; height: 235px; border: solid 1px black; float:right; position:relative; margin-top: 1.25em;">
            <div id="testDiv3" style="background: black; position: relative">
                <div id="testSubDiv3" style="height: 235px;">
                    &nbsp;
                </div>
            </div>
        </div>
        <br style="clear:both;" />
        <div id="testContainer4" style="width: 235px; height: 235px; border: solid 1px black; float:right; position:relative; margin-top: 1.25em;">
            <div id="testDiv4" style="background: yellow; position: relative">
                <div id="testSubDiv4" style="height: 235px;">
                    &nbsp;
                </div>
            </div>
        </div>
        <br style="clear:both;" />
        <div id="testContainer5" style="width: 235px; height: 235px; border: solid 1px black; float:right; position:relative; margin-top: 1.25em;">
            <div id="testDiv5" style="background: purple; position: relative">
                <div id="testSubDiv5" style="height: 235px;">
                    &nbsp;
                </div>
            </div>
        </div>
        <br style="clear:both;" />
        <div id="testContainer6" style="width: 235px; height: 235px; border: solid 1px black; float:right; position:relative; margin-top: 1.25em;">
            <div id="testDiv6" style="background: orange; position: relative">
                <div id="testSubDiv6" style="height: 235px;">
                    &nbsp;
                </div>
            </div>
        </div>
        <br style="clear:both;" />
        <div id="testContainer7" style="width: 235px; height: 235px; border: solid 1px black; float:right; position:relative; margin-top: 1.25em;">
            <div id="testDiv7" style="background: maroon; position: relative">
                <div id="testSubDiv7" style="height: 235px;">
                    &nbsp;
                </div>
            </div>
        </div>
        <br style="clear:both;" />
        <div id="testContainer8" style="width: 235px; height: 235px; border: solid 1px black; float:right; position:relative; margin-top: 1.25em;">
            <div id="testDiv8" style="background: pink; position: relative">
                <div id="testSubDiv8" style="height: 235px;">
                    &nbsp;
                </div>
            </div>
        </div>
        <br style="clear:both;" />
        <div id="testContainer9" style="width: 235px; height: 235px; border: solid 1px black; float:right; position:relative; margin-top: 1.25em;">
            <div id="testDiv9" style="background: darkblue; position: relative">
                <div id="testSubDiv9" style="height: 235px;">
                    &nbsp;
                </div>
            </div>
        </div>
        <br style="clear:both;" />
        <div id="testContainer10" style="width: 235px; height: 235px; border: solid 1px black; float:right; position:relative; margin-top: 1.25em;">
            <div id="testDiv10" style="background: lightblue; position: relative">
                <div id="testSubDiv10" style="height: 235px;">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
    
    <div style="width: 240px;">
    <h1>Available Easing</h1>
    <ul>
        <li>Back Easing
            <ul>
                <?php
                $wipeOut->setOption('easing', DojoEasing::BACK_IN);
                $wipeIn->setOption('easing', DojoEasing::BACK_IN);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Back In Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::BACK_OUT);
                $wipeIn->setOption('easing', DojoEasing::BACK_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Back Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::BACK_IN_OUT);
                $wipeIn->setOption('easing', DojoEasing::BACK_IN_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Back In and Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Bounce Easing
            <ul>
                <?php
                $wipeOut->setNode('testDiv2');
                $wipeOut->setOption('easing', DojoEasing::BOUNCE_IN);
                $wipeIn->setNode('testDiv2');
                $wipeIn->setOption('easing', DojoEasing::BOUNCE_IN);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Bounce In Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::BOUNCE_OUT);
                $wipeIn->setOption('easing', DojoEasing::BOUNCE_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Bounce Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::BOUNCE_IN_OUT);
                $wipeIn->setOption('easing', DojoEasing::BOUNCE_IN_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Bounce In and Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Circ Easing
            <ul>
                <?php
                $wipeOut->setNode('testDiv3');
                $wipeOut->setOption('easing', DojoEasing::CIRC_IN);
                $wipeIn->setNode('testDiv3');
                $wipeIn->setOption('easing', DojoEasing::CIRC_IN);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Circ In Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::CIRC_OUT);
                $wipeIn->setOption('easing', DojoEasing::CIRC_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Circ Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::CIRC_IN_OUT);
                $wipeIn->setOption('easing', DojoEasing::CIRC_IN_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Circ In and Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Cubic Easing
            <ul>
                <?php
                $wipeOut->setNode('testDiv4');
                $wipeOut->setOption('easing', DojoEasing::CUBIC_IN);
                $wipeIn->setNode('testDiv4');
                $wipeIn->setOption('easing', DojoEasing::CUBIC_IN);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Cubic In Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::CUBIC_OUT);
                $wipeIn->setOption('easing', DojoEasing::CUBIC_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Cubic Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::CUBIC_IN_OUT);
                $wipeIn->setOption('easing', DojoEasing::CUBIC_IN_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Cubic In and Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Elastic Easing
            <ul>
                <?php
                $wipeOut->setNode('testDiv5');
                $wipeOut->setOption('easing', DojoEasing::ELASTIC_IN);
                $wipeIn->setNode('testDiv5');
                $wipeIn->setOption('easing', DojoEasing::ELASTIC_IN);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Elastic In Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::ELASTIC_OUT);
                $wipeIn->setOption('easing', DojoEasing::ELASTIC_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Elastic Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::ELASTIC_IN_OUT);
                $wipeIn->setOption('easing', DojoEasing::ELASTIC_IN_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Elastic In and Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Expo Easing
            <ul>
                <?php
                $wipeOut->setNode('testDiv6');
                $wipeOut->setOption('easing', DojoEasing::EXPO_IN);
                $wipeIn->setNode('testDiv6');
                $wipeIn->setOption('easing', DojoEasing::EXPO_IN);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Expo In Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::EXPO_OUT);
                $wipeIn->setOption('easing', DojoEasing::EXPO_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Expo Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::EXPO_IN_OUT);
                $wipeIn->setOption('easing', DojoEasing::EXPO_IN_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Expo In and Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Quad Easing
            <ul>
                <?php
                $wipeOut->setNode('testDiv7');
                $wipeOut->setOption('easing', DojoEasing::QUAD_IN);
                $wipeIn->setNode('testDiv7');
                $wipeIn->setOption('easing', DojoEasing::QUAD_IN);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Quad In Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::QUAD_OUT);
                $wipeIn->setOption('easing', DojoEasing::QUAD_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Quad Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::QUAD_IN_OUT);
                $wipeIn->setOption('easing', DojoEasing::QUAD_IN_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Quad In and Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Quart Easing
            <ul>
                <?php
                $wipeOut->setNode('testDiv8');
                $wipeOut->setOption('easing', DojoEasing::QUART_IN);
                $wipeIn->setNode('testDiv8');
                $wipeIn->setOption('easing', DojoEasing::QUART_IN);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Quart In Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::QUART_OUT);
                $wipeIn->setOption('easing', DojoEasing::QUART_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Quart Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::QUART_IN_OUT);
                $wipeIn->setOption('easing', DojoEasing::QUART_IN_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Quart In and Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Quint Easing
            <ul>
                <?php
                $wipeOut->setNode('testDiv9');
                $wipeOut->setOption('easing', DojoEasing::QUINT_IN);
                $wipeIn->setNode('testDiv9');
                $wipeIn->setOption('easing', DojoEasing::QUINT_IN);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Quint In Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::QUINT_OUT);
                $wipeIn->setOption('easing', DojoEasing::QUINT_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Quint Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::QUINT_IN_OUT);
                $wipeIn->setOption('easing', DojoEasing::QUINT_IN_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Quint In and Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Sine Easing
            <ul>
                <?php
                $wipeOut->setNode('testDiv10');
                $wipeOut->setOption('easing', DojoEasing::SINE_IN);
                $wipeIn->setNode('testDiv10');
                $wipeIn->setOption('easing', DojoEasing::SINE_IN);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Sine In Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::SINE_OUT);
                $wipeIn->setOption('easing', DojoEasing::SINE_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Sine Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
                <?php
                $wipeOut->setOption('easing', DojoEasing::SINE_IN_OUT);
                $wipeIn->setOption('easing', DojoEasing::SINE_IN_OUT);
                $wipeOutIn = new DojoChainEffect($wipeOut, $wipeIn);
                ?>
                <li>Sine In and Out Easing
                    <ul>
                        <li><?php echo dojo_link_to_function('Wipe Out', $wipeOut->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe In', $wipeIn->play()) ?></li>
                        <li><?php echo dojo_link_to_function('Wipe Out and In', $wipeOutIn->play()) ?></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    </div>
</div>