<?php

/*
  For this tutorial we will use the file "genealogy.json", you can find it inside the PHP repository
*/


// We start by getting the JSON file path, in this case using a relative path
$jsonPath = "./genealogy.json";

// Now we have to read the file to get its content
$jsonString = file_get_contents($jsonPath);

// Finally we convert the file content into an array. 
// Note: When using json_decode, use param true to get an associative array and false to get an array of objects
// Let's create two arrays to see how both options would work
$assocArrayGenealogy = json_decode($jsonString, true);
$objArrayGenealogy = json_decode($jsonString);

// Now that we have our file data in an array, we can loop through it to output the data or perform any other operation

?>
<!-- Let's add some HTML to make this example look a bit nicer -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using JSON files in PHP</title>
</head>
<body>
    <h1>Looping JSON files in PHP</h1>
    <?php
        // This is how we could loop through the file data using an associative array
        echo "<h2>Associative array</h2>";
        foreach ($assocArrayGenealogy as $dataset) {

            // We can access the data values using its keys like this
            echo "<strong>".$dataset["familyName"]."</strong>";
            // Let's make a series of nested lists to output the data in a more understandble manner
            echo "<ul>";
            // We can access any level of the JSON data by looping over the parent element
            foreach ($dataset["familyTree"] as $firstGen) {

                echo "<li>".$firstGen["name"]." ".$firstGen["birth"]." - ".$firstGen["death"]."</li>";

                // When there is a key that may not be present in every element we can check for it using isset
                if (isset($firstGen["children"])) {

                    echo "<ul>";
                    foreach ($firstGen["children"] as $secondGen) {

                        echo "<li>".$secondGen["name"]." ".$secondGen["birth"]." - ".$secondGen["death"]."</li>";

                        if (isset($secondGen["children"])) {

                            echo "<ul>";
                            // It's a good idea to keep an eye on the original JSON structure to avoid getting lost in all the possible data subdivisions
                            foreach ($secondGen["children"] as $thirdGen) {
                                echo "<li>".$thirdGen["name"]." ".$thirdGen["birth"]." - ".$thirdGen["death"]."</li>";
                            }
                            echo "</ul>";
                        }
                    }
                    echo "</ul>";
                }
            }
            echo "</ul>";
        }
        echo "<br><br>";

        echo "<h2>Objects array</h2>";
        // This is how we would do the same thing using an objects array
        foreach ($objArrayGenealogy as $dataset) {

            // We can access the data values using its keys like this
            echo "<strong>".$dataset->familyName."</strong>";
            echo "<ul>";
            foreach ($dataset->familyTree as $firstGen) {

                echo "<li>".$firstGen->name." ".$firstGen->birth." - ".$firstGen->death."</li>";

                if (isset($firstGen->children)) {

                    echo "<ul>";
                    foreach ($firstGen->children as $secondGen) {

                        echo "<li>".$secondGen->name." ".$secondGen->birth." - ".$secondGen->death."</li>";

                        if (isset($secondGen->children)) {

                            echo "<ul>";
                            foreach ($secondGen->children as $thirdGen) {
                                echo "<li>".$thirdGen->name." ".$thirdGen->birth." - ".$thirdGen->death."</li>";
                            }
                            echo "</ul>";
                        }
                    }
                    echo "</ul>";
                }
            }
            echo "</ul>";
        }
    ?>
</body>
</html>
