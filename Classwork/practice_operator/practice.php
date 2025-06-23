<!-- //Arithmetic Operators -->
<?php
$a = 10;
$b = 3;

echo "Addition = " . $a + $b . "<br/>";
echo "Subtract = " . $a - $b . "<br/>";
echo "Multiply = " . $a * $b . "<br/>";
echo "Divide = " . $a / $b . "<br/>";
echo "Divide = " . $a % $b . "<br/>";
echo "<br/><br/><br/>";

// Comparison Operators
$x = 5;
$y = '5';

echo 'Is equal: ' . var_export($x == $y, true) . "<br/>";
echo 'Is identical : ' . var_export($x === $y, true) . "<br/>";
echo 'Is not equal : ' . var_export($x != $y, true) . "<br/>";
echo 'Is greater than : ' . var_export($x > $y, true) . "<br/>";
echo 'Is less than or equal to : ' . var_export($x <= $y, true) . "<br/>";
echo "<br/><br/><br/>";

// Logical Operators
$number = 15;

echo 'is between 10 and 20 : ' . var_export($number > 10 && $number < 20, true) . "<br />";
echo 'is not equal to 0 : ' . var_export($number != 0, true) . "<br />";
echo "<br/><br/><br/>";

// Ternary Operator
$num = 7;
$result = '';

echo $num . (($num % 2 == 0) ? " is even" : " is odd");
echo "<br/><br/><br/>";

// for loop

$numFor = 10;

for ( $numFor ; $numFor >= 0 ; $numFor--) {
    echo $numFor . "<br />";
}
