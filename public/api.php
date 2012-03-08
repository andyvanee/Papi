<?php

require_once '../lib/papi.php';

/*
A sample api using papi.
data is returned to the client using render() objects or arrays

*/

// Change this if using a non-homebrew install of figlet
$figlet_font_path = '/usr/local/Cellar/figlet/*/share/figlet/fonts/*.flf';

// First, define allowable GET parameters
$params = array('font', 'text', 'width', 'fonts');

// The request object attaches the defined GET parameters to itself
$req = new Request($params);

// Add objects or arrays to this array to send them to the client
$output = array();

// $_GET['fonts'] request returns a list of all fonts
if ($req->fonts) {
    $output['fonts'] = array();

    // shellout() defines a safe interface for passing user supplied arguments
    // to a shell command.
    $fonts = shellout('ls '.$figlet_font_path)->exec()->out;
    foreach ($fonts as $font) {
        $fontpath = pathinfo($font);
        $output['fonts'][] = $fontpath['filename'];
    }
}

// If we have $_GET['text'], render it with figlet
if ($req->text) {
    // The Shellout object is chainable. The following lines add arguments
    // to the command and finally exec() it. Any args passed as an array
    // are escaped to prevent executing arbitrary commands.
    $s = shellout('figlet -c');

    if ($req->font) $s->args('-f')->args(array($req->font));
    if ($req->width) $s->args('-w')->args(array($req->width));

    $s->args(array($req->text));
    $output['lines'] = $s->exec()->lines();
}

render($output);
