<?php

$config = parse_ini_file('./config.ini');

$ini = array('; Themes lists for '.$config['name'],
             '; Generated on '.date('r'),
             '; Version : '.$config['version'],
             '; Build : '.$config['build'],
             PHP_EOL,
             );

if (file_exists('analyzers.ini')) {
    $previous = parse_ini_file('./analyzers.ini');
    unset($previous['All']);
} else {
    $previous = array();
}

$files = glob('Analyzer/*/*.php');
sort($files);
$ini[] = "; All has ".count($files).' analysis';

foreach($files as $file) {
    $conf = substr($file, 9, -4);
    $ini[] = "All[] = \"$conf\";";
}

$folders = glob('Analyzer/*');
foreach($folders as $folder) {
    if (is_file($folder)) { continue; }

    $base = basename($folder);
    unset($previous[$base]);
    $ini[] = PHP_EOL;

    $files = glob("Analyzer/$base/*");
    sort($files);
    $ini[] = "; $base has ".count($files).' analysis';
    foreach($files as $file) {
        $conf = substr($file, 9, -4);
        $ini[] = "{$base}[] = \"$conf\";";
    }
}
$ini[] = PHP_EOL;

foreach($previous as $section => $values) {
    if (empty($values)) {
        continue;
    }
    sort($values);
    $ini[] = "; $section has ".count($values).' analysis';
    foreach($values as $v) {
        $ini[] = "{$section}[] = \"$v\";";
    }
    $ini[] = PHP_EOL;
}

$iniFile = implode(PHP_EOL, $ini);
file_put_contents('Analyzer/analyzers.ini', $iniFile);

print count($ini)." configurations were written\n";

?>