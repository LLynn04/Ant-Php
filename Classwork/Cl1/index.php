<?php

$a = 3;
$b = "3";

if ($a === $b) {
    echo "1 is not equal but data is the same to 2";
} elseif ($a == $b) {
    echo "1 is not equal 1";
} elseif ($a != $b) {
    echo "equal but not the same vlaue";
} elseif ($a !== $b) {
    echo "1 is not equal 2";
}