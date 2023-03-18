<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <?php
        $fname="Danjan";
        $lname="Tellana";
        $age = 24;
        $shoeSize = 9.5;
        $isKodeGoInstructor = true;
        $hobbies = array('fried chicken', 'chicken adobo', 'chicken inasal');
        echo "<h1>HELLO $fname $lname</h1>"; //double quotes interprets variables
        echo "<h1>Hello " . $fname . " ". $lname . "</h1>"; //concanenated string and variables
        echo "<p>Age: $age</p>";
        echo '<p>Shoe Size: ' . $shoeSize . '</p>'; //using single quotes for concatenation
        echo '<p>Is KodeGo instructor: ' . var_export($isKodeGoInstructor, true) . '</p>'; //using var_export for boolean
        echo "<p>$hobbies[0]</p>"; //using indexing one by one
        echo '<p>' . implode(" & ", $hobbies) . '</p>'; //using implode to join all array items using a glue
        if($age >= 18) {
            echo "<p>you are eligible to vote</p>";
        } else {
            echo "<p>you are still a minor</p>";
        }
        $i = 0;
        echo "<ol>";
        while($i < count($hobbies)) {
            echo "<li>$hobbies[$i]</li>";
            ++$i;
        }
        echo "</ol>";
    ?>
</body>
</html>