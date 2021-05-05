<?php

// Get command line argument which is expected to be a file stream
$input_stream = $argv[1];

// Open file for reading but binary safe mode
$file_handler = fopen($input_stream, 'rb');

// Read the file
$file_content = fread($file_handler, filesize($input_stream));

// Read file by empty separator
$groups_line = explode("\n\n", $file_content);

// remove extra end of line
$groups = array_map(function($group){
    return str_replace("\n", '', $group);
}, $groups_line);

$group_responses_map = [];

foreach ($groups as $key => $group){
    $group_answers_array = str_split($group);
    foreach ($group_answers_array as $group_answer){
        $group_responses_map[$key][$group_answer] = 1;
    }
}

$total_group_response = 0;

foreach ($group_responses_map as $group_response){
    $total_group_response+= count($group_response);
}

print_r($total_group_response .PHP_EOL);

// Close the file resource properly to save resources
fclose($file_handler);
