
<?php

$a = 3;
$b = "4";

if ($a === $b) {
    echo "same type, and value: " . $a . $b;
} elseif ($a == $b) {
    echo "same value: " . $a . $b;
} elseif ($a != $b) {
    echo "differ type, but same value: " . $a . $b;
} elseif ($a !== $b) {
    echo "type and value differ: " . $a . $b;
}

$num = [1,2,3,4,5];
$i = 0;
while($i < count($num)) {
    echo $num[$i];
    $i++;
}