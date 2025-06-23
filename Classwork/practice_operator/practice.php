<!-- //Arithmetic Operators -->
<?php
$a = 10;
$b = 3;

echo "Addition = " . $a + $b . "<br/>";
echo "Subtract = " . $a - $b . "<br/>";
echo "Multiply = " . $a * $b . "<br/>";
echo "Divide = " . $a / $b . "<br/>";
echo "Divide = " . $a % $b . "<br/>";

$x = 5;
$y = '5';

if ($x == $y) {
    echo "is Equal : true<br/>";
} else {
    echo "is not : false<br/>";
}

if ($x === $y) {
    echo "$x === $y : true<br/>";
} else {
    echo "$x === $y : false<br/>";
}

if ($x != $y) {
    echo "$x != $y : true<br/>";
} else {
    echo "$x != $y : false<br/>";
}

if ($x > $y) {
    echo "$x > $y : true<br/>";
} else {
    echo "$x > $y : false<br/>";
}

if ($x <= $y) {
    echo "$x <= $y : true<br/>";
} else {
    echo "$x <= $y : false<br/>";
}
