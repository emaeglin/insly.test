<?php
/*
 * Must be modified for usage with different encodings
 *
 */
if (!isset($argv[1]) || empty($argv[1])) {
    echo "Please, set name.\nExample: php task_1.php Bohdan\n";
    exit();
}
$name = $argv[1];
echo "Simple:\n";
$result  = base_convert(array_shift(unpack('H*', $name)), 16, 2) . "\n";
echo "$result\n";
unset($result);

echo "\n";
echo "With loop:\n";

foreach (str_split($name) as $chr) {
    $result  = base_convert(array_shift(unpack('H*', $name)), 16, 2);
}
echo "$result\n";