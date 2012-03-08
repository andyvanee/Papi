<?php

require_once '../lib/papi.php';

$figlet_font_path = '/usr/local/Cellar/figlet/2.2.4/share/figlet/fonts/*.flf';

$params = array('font', 'text', 'width', 'fonts');
$req = new Request($params);
$output = array();

// font request returns fonts
if ($req->fonts) {
    $output['fonts'] = array();
    $fonts = shellout('ls '.$figlet_font_path)->exec()->out;
    foreach ($fonts as $font) {
        $fontpath = pathinfo($font);
        $output['fonts'][] = $fontpath['filename'];
    }
}

// if we have text, render it with figlet
if ($req->text) {
    $s = shellout('figlet -c');

    if ($req->font) $s->args('-f')->args(array($req->font));
    if ($req->width) $s->args('-w')->args(array($req->width));

    $s->args(array($req->text));
    $output['lines'] = $s->exec()->lines();
}

render($output);
