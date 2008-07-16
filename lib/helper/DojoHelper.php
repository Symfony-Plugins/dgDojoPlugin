<?php

sfLoader::loadHelpers(array('Tag'));

/**
 * Returns a link that will trigger a javascript function using the onclick
 * handler and return false after the fact.
 *
 * @param string $name Text to in the anchor tag
 * @param string $function Function to be called by clicking
 * @param mixed $html_options Set of options for the tag
 * @return string The completed anchor tag
 */
function dojo_link_to_function($name, $function, $html_options = array())
{
    $html_options = _parse_attributes($html_options);

    $html_options['href'] = isset($html_options['href']) ? $html_options['href'] : '#';
    if (isset($html_options['confirm']))
    { // add confirmation if desired
        $confirm = escape_javascript($html_options['confirm']);
        $html_options['onclick'] = "if(confirm('$confirm')){ $function;}; return false;";
    }
    else
    {
        $html_options['onclick'] = $function.'; return false;';
    }

    return content_tag('a', $name, $html_options);
}

/**
 * Creates a link that will execute a remote XMLHttpRequest.  Various options
 * can be sent to this function to control what gets changed or what happens
 * when the request is done.
 *
 * @param string $name Text for the link
 * @param mixed $options Set of options for the remote function
 * @param mixed $html_options Set 
 * @return unknown
 */
function dojo_link_to_remote($name, $options = array(), $html_options = array())
{
    return dojo_link_to_function($name, remote_function($options), $html_options);
}


/**
 * Creates a Dojo button to a particular function in javascript.
 *
 * @param string $name Text for the button
 * @param string $function Javascript function to be executed
 * @param mixed $html_options Set of HTML options for the tag
 * @return DojoButton The created Dojo button
 */
function dojo_button_to_function($name, $function, $html_options = array())
{
    DojoManager::addJavascript();
    
    $html_options = _parse_attributes($html_options);

    $html_options['onclick'] = $function.'; return false;';

    return new DojoButton($name, array(), $html_options);
}

/**
 * Creates a Dojo Button that will execute an XMLHttpRequest when clicked.
 *
 * @param string $name The button text
 * @param mixed $options Set of options for the remote function
 * @param mixed $html_options Set of HTML options for the button
 * @return DojoButton The DojoButton object for the options
 */
function dojo_button_to_remote($name, $options = array(), $html_options = array())
{
    return dojo_button_to_function($name, dojo_remote_function($options), $html_options);
}

/**
 * Periodically calls a Javascript function.  The frequency option sets the
 * interval between executions and defaults to ten.  Its units are seconds.
 *
 * @param string $function Javascript function to be run
 * @param mixed $options Options for the Javascript
 * @return string A javascript tag with the Javascript to do the call
 */
function dojo_periodically_call_function($function, $options = array())
{
    // every 10 seconds by default
    $frequency = isset($options['frequency']) ? $options['frequency'] * 1000 : 10000;
    $code = 'setInterval(dojo.hitch(this, function() {'.$function.';}), '.$frequency.');';
    
    return javascript_tag($code);
}

/**
 * Periodically calls a remote site.  Acts just like the Dojo link to remote
 * and button to remote.
 *
 * @param mixed $options Options for the remote call and the interval
 * @return string The Javascript to do the calling
 */
function dojo_periodically_call_remote($options = array())
{
    return dojo_periodically_call_function(dojo_remote_function($options), $options);
}

/**
 * Returns an open form tag element for submitting data to a remote page using
 * XMLHttpRequests.
 *
 * @param mixed $options Set of options for the remote function
 * @param mixed $html_options Set of options for the HTML form tag
 * @return string The opening tag for a form
 */
function dojo_form_remote_tag($options = array(), $html_options = array())
{
    $options = _parse_attributes($options);
    $html_options = _parse_attributes($html_options);
    
    // can't use 'this' in the XHR function, so put the form element in a var
    // before the function call
    if (!isset($options['form']) && !isset($options['formElement']))
    {
        if (isset($html_options['id']))
            $options['form'] = $html_options['id'];
        else
        {
            $formElement = 'var formElement = this';
            if (isset($options['before']))
                $options['before'] = $options['before'].'; '.$formElement;
            else
                $options['before'] = $formElement;
            $options['formElement'] = 'formElement';
        }
    }
    
    $html_options['action'] = isset($html_options['action']) ? $html_options['action'] : url_for($options['url']);
    $html_options['method'] = isset($options['method']) ? $html_options['method'] : 'post';
    $options['method'] = $html_options['method'];
    $html_options['onsubmit'] = dojo_remote_function($options).' return false;';
    
    return tag('form', $html_options, true);
}

/**
 * Creates an input button that submits a form using XMLHttpRequests.  If you
 * do not specify the form, it will attempt to find it with using
 * 'this.parentNode' for the button.
 *
 * @param string $name Name of the input
 * @param string $value Value for the input button
 * @param mixed $options Set of options for the remote function
 * @param mixed $html_options Set of options for the created HTML tag
 * @return string The completed input with needed javascript
 */
function dojo_submit_to_remote($name, $value, $options = array(), $html_options = array())
{
    $options = _parse_attributes($options);
    $html_options = _parse_attributes($html_options);
    
    // can't use 'this' in the XHR function, so put the form element in a var
    // before the function call
    if (!isset($options['form']) && !isset($options['formElement']))
    {
        $formElement = 'var formElement = this.parentNode';
        if (isset($options['before']))
            $options['before'] = $options['before'].'; '.$formElement;
        else
            $options['before'] = $formElement;
        $options['formElement'] = 'formElement';
    }
    
    $options['method'] = (isset($options['method'])) ? $options['method'] : 'post';
    $html_options['type'] = 'button';
    $html_options['onclick'] = dojo_remote_function($options).' return false;';
    $html_options['name'] = $name;
    $html_options['value'] = $value;

    return tag('input', $html_options, false);
}

/**
 * Creates an input that is an image that submits a form or other data using an
 * XMLHttpRequest.  If you do not specify what form, this will guess it as
 * 'this.parentNode'.  The 'alt' option is also guessed if not set.
 *
 * @param string $name Name for the input
 * @param string $source Image source
 * @param mixed $options Options for the remote function
 * @param mixed $html_options Set of options for the input HTML tag
 * @return string The input tag with all the needed javascript
 */
function dojo_submit_image_to_remote($name, $source, $options = array(), $html_options = array())
{
    $options = _parse_attributes($options);
    $html_options = _parse_attributes($html_options);
    
    // can't use 'this' in the XHR function, so put the form element in a var
    // before the function call
    if (!isset($options['form']) && !isset($options['formElement']))
    {
        $formElement = 'var formElement = this.parentNode';
        if (isset($options['before']))
            $options['before'] = $options['before'].'; '.$formElement;
        else
            $options['before'] = $formElement;
        $options['formElement'] = 'formElement';
    }
    
    $options['method'] = (isset($options['method'])) ? $options['method'] : 'post';
    $html_options['type'] = 'image';
    $html_options['onclick'] = dojo_remote_function($options).' return false;';
    $html_options['name'] = $name;
    $html_options['src'] = image_path($source);

    if (!isset($html_options['alt'])) 
    {
      $path_pos = strrpos($source, '/');
      $dot_pos = strrpos($source, '.');
      $begin = $path_pos ? $path_pos + 1 : 0;
      $nb_str = ($dot_pos ? $dot_pos : strlen($source)) - $begin;
      $html_options['alt'] = ucfirst(substr($source, $begin, $nb_str));
    }
 
    return tag('input', $html_options, false);
}

/**
 * Updates a DOM node specified by the element ID.  You can either update the
 * node with content at a specific location, empty the node, or completely
 * remove the node from the page.
 *
 * @param string $element_id ID of the element being updated
 * @param mixed $options Options to specify what this function does
 * @return string The javascript to do the updates
 */
function dojo_update_element($element_id, $options = array())
{
    DojoManager::addJavascript();

    $content = escape_javascript(isset($options['content']) ? $options['content'] : '');
    
    $js_function = '';
    $value = isset($options['action']) ? strtolower($options['action']) : 'update';
    switch ($value)
    {
        case 'update':
            $js_function = _dojo_build_update($element_id, $options);
            break;
        case 'empty':
            $js_function = "dojo.byId('$element_id').innerHTML = '';";
            break;
        case 'remove':
            $js_function = "var removeNode = dojo.byId('$element_id');";
            $js_function .= "removeNode.parentNode.removeChild(removeNode);";
            break;
        default:
            throw new DojoHelperOptionException('Invalid action, choose one of update, remove, or empty.');
    }
    
    return $js_function;
}

/**
 * Creates Javascript to observe a form field for certain events.  The default
 * event is onchange.  It passes the value of the field on to the server as the
 * parameter 'value'.
 *
 * @param string $field_id ID of the field to be observed
 * @param mixed $options Set of options, majorly for the remove function
 * @return string The completed javascript to do the observing
 */
function dojo_observe_field($field_id, $options = array())
{
    DojoManager::addJavascript();
    
    if (isset($options['frequency']) && $options['frequency'] > 0)
    {
        if (isset($options['withj']))
            $options['withj'] .= " value=dojo.byId('$field_id').value";
        else
            $options['withj'] = "value=dojo.byId('$field_id').value";
        
        return dojo_periodically_call_remote($options);
    }
    else
    {
        $event = isset($options['event']) ? $options['event'] : 'onchange';
        if (isset($options['withj']) && is_array($options['withj']))
            $options['withj']['value'] = 'this.value';
        else if (isset($options['with']) && $options['with'])
            $options['withj'] .= ' value=this.value';
        else
            $options['withj'] = 'value=this.value';
            
        $function = dojo_remote_function($options);
        $script = "dojo.connect(dojo.byId('$field_id'), '$event', dojo.byId('$field_id'), function(event) { $function });";
        
        return javascript_tag($script);
    }
}

/**
 * Creates the Javascript to observe all fields in a form for a certain event.
 * The default event is 'onchange'.  The field that caused the event is sent
 * in the 'target' param and its new value is in the 'value' param.  The whole
 * form is still submitted to the action, though.
 *
 * @param string $form_id What form needs to be watched
 * @param mixed $options Options for the remote function
 * @return string The Javascript in a tag that sets up the observer
 */
function dojo_observe_form($form_id, $options = array())
{
    DojoManager::addJavascript();
    
    $options['form'] = $form_id;
    if (isset($options['frequency']) && $options['frequency'] > 0)
    {
        return dojo_periodically_call_remote($options);
    }
    else
    {
        $event = isset($options['event']) ? $options['event'] : 'onchange';
        if (isset($options['withj']) && is_array($options['withj']))
        {
            $options['withj']['target'] = 'event.target.name';
            $options['withj']['value'] = 'event.target.value';
        }
        else if (isset($options['withj']) && $options['withj'])
            $options['withj'] .= ' target=event.target.name value=event.target.value';
        else
            $options['withj'] = 'target=event.target.name value=event.target.value';
            
        $function = dojo_remote_function($options);
        // attach to event for each child node in the form, have to use jscript
        $script = "var children = dojo.byId('$form_id').childNodes;";
        $script .= "for (i=0; i < children.length; i++) {";
        $script .= "dojo.connect(children[i], '$event', dojo.byId('$form_id'), function(event) { $function });";
        $script .= '}';
        
        return javascript_tag($script);
    }
}

function dojo_visual_effect($name, $element_id = false, $js_options = array())
{
    
}

function dojo_remote_function($options)
{
    DojoManager::addJavascript();
    
    $javascript_options = _dojo_options_for_ajax($options);
    
    $method = 'GET';
    if (isset($options['method']))
    {
        $method = strtoupper($options['method']);
    }
    
    $function = 'dojo.xhr(';
    $function .= "'$method'";
    $function .= ", $javascript_options";
    
    if (isset($options['hasBody']))
    {
        $function .= ', '._dojo_boolean_for_javascript($options['hasBody']);
    }
    
    $function .= ');';
    
    if (isset($options['before']))
        $function = $options['before'].'; '.$function;
    if (isset($options['after']))
        $function = $function.' '.$options['after'].';';
    if (isset($options['condition']))
        $function = 'if ('.$options['condition'].') { '.$function.' }';
    if (isset($options['confirm']))
    {
        $function = 'if (confirm("'.escape_javascript($options['confirm']).'")) { '.$function.' }';
        if (isset($options['cancel']))
            $function .= ' else { '.$options['cancel'].' }';  
    }
            
    return $function;
}

function _dojo_build_ajax_callbacks($options)
{
    $error_function = '';
    $handle_function = '';
    $load_function = '';
    
    if (isset($options['failure']['before']))
    {
        $error_function .= $options['failure']['before'];
    }
    
    if (isset($options['always']['before']))
    {
        $handle_function = $options['always']['before'];
    }
    
    if (isset($options['success']['before']))
    {
        $load_function .= $options['success']['before'];
    }
    
    if (isset($options['update']) && is_array($options['update']))
    {
        if (isset($options['update']['success']))
        {
            $load_function .= _dojo_build_update($options['update']['success'], $options);
        }
        
        if (isset($options['update']['always']))
        {
            $handle_function .= _dojo_build_update($options['update']['always'], $options);
        }
        
        if (isset($options['update']['failure']))
        {
            $error_function .= _dojo_build_update($options['update']['failure'], $options);
        }
    }
    else if (isset($options['update']))
    {
        $handle_function .= _dojo_build_update($options['update'], $options);;
    }
    
    if (isset($options['failure']['after']))
    {
        $error_function .= $options['failure']['after'];
    }
    
    if (isset($options['always']['after']))
    {
        $handle_function = $options['always']['after'];
    }
    
    if (isset($options['success']['after']))
    {
        $load_function .= $options['success']['after'];
    }
    
    $rval = array();
    if ($load_function)
        $rval['load'] = "function(response, ioArgs) { $load_function return response; }";
    if ($error_function)
        $rval['error'] = "function(response, ioArgs) { $error_function return response; }";
    if ($handle_function)
        $rval['handle'] = "function(response, ioArgs) { $handle_function return response; }";
    
    return $rval;
}

function _dojo_build_update($id, $options)
{
    $rval = '';
    if (isset($options['position']) && $options['position'])
    {
        $pos = strtolower($options['position']);
        if ($pos == 'top') $pos = 'first';
        if ($pos == 'bottom') $pos = 'last';
        
        $rval = "var theDiv = document.createElement('div');";
        $rval .= "dojo.place(theDiv, '$id', '$pos');";
        $rval .= "dojo.byId(theDiv).innerHTML = response;";
        if (isset($options['renderWidgets']) && ($options['renderWidgets'] == true))
            $rval .= "dojo.parser.parse(theDiv);";
    }
    else
    {
        $rval = "dojo.byId('$id').innerHTML = response;";
        if (isset($options['renderWidgets']) && ($options['renderWidgets'] == true))
            $rval .= "dojo.parser.parse('$id');";
    }
    
    return $rval;
}

function _dojo_options_for_ajax($options)
{
    $js_options = _dojo_build_ajax_callbacks($options);
    $js_options['url'] = '"'.url_for($options['url']).'"';
    
    $content = array();
    if (isset($options['with']))
    {
        $content = _parse_attributes($options['with']);
        foreach ($content as $key => $value)
            $content[$key] = "'$value'";
    }
    
    if (isset($options['withj']))
    {
        $content = array_merge(_parse_attributes($options['withj']), $content);
    }
    
    if (!empty($content))
    {
        $js_options['content'] = _dojo_options_for_javascript($content);
    }
    
    if (isset($options['form']))
    {
        $js_options['form'] = '"'.$options['form'].'"';
    }
    else if (isset($options['formElement']))
    {
        $js_options['form'] = $options['formElement'];
    }
    
    if (isset($options['handleAs']))
    {
        $js_options['handleAs'] = '"'.$options['handleAs'].'"';
    }
    
    if (isset($options['headers']))
    {
        $headers = _parse_attributes($options['headers']);
        $js_options['headers'] = _dojo_options_for_javascript($headers);
    }
    
    if (isset($options['noCache']))
    {
        $js_options['preventCache'] = $options['noCache'];
    }
    
    if (isset($options['type']) && ($options['type'] == 'synchronous'))
    {
        $js_options['sync'] = true;
    }
    
    if (isset($options['timeout']))
    {
        $js_options['timeout'] = intval($options['timeout']);
    }
    
    return _dojo_options_for_javascript($js_options);
}

function _dojo_options_for_javascript($options)
{
    $opts = array();
    foreach ($options as $key => $value)
    {
        $opts[] = $key.":"._dojo_boolean_for_javascript($value);
    }
    sort($opts);

    return '{'.join(', ', $opts).'}';
}

function _dojo_boolean_for_javascript($bool)
{
    if (is_bool($bool)) 
    { 
        return ($bool === true ? 'true' : 'false'); 
    }
    return $bool;
}
?>