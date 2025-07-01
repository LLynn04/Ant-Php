<?php 
function index( string $a,string $b ) {
    return $a .  $b;
}
echo index("Hello, ", "World!");

// showname function
function showName(string $name) {
    return "Hello, " . $name;
}
echo showName("John Doe") . "<br>";

// sumage function
function sumage (int $age1, int $age2): int {
    return $age1 + $age2;
}
echo sumage(25, 30) . "<br>";

// calculate salary function
function calculateSalary(int $rate, int $hours , int $month): float {
    return $rate * $hours * $month;
}
echo calculateSalary(20, 8, 12) . "<br>";

// function average 
function average(array $numbers, int $count): float {
    foreach ($numbers as $number) {
         $count += $number;
    }

    if ($count > 0) {
        return $count / count($numbers);
    } else {
        return 0.0; // Avoid division by zero
    }
}
echo average([10, 20, 30, 40], 0) . "<br>";


?>