<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="styles.css">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

</head>
<body>

<form>
    <label for="cards">Cards:</label>
    <input type="text" id="cards" name="cards" placeholder="Enter cards here">
    <div id="ace_input">
        <label for="ace">Please select a value for Ace:</label>
        <input type="radio" id ="ace_one" name="ace" value="1">One(1)
        <input type="radio" id ="ace_eleven" name="ace" value="11">Eleven(11)
    </div>
    <button id="php_submit" type="submit">Run with PHP</button>
    <button id="js_submit" type="reset">Run with JavaScript</button>
</form>






<!--**--**--**--**--**--**      RUN WITH PHP      **--**--**--**--**--**-->

<?php


///     SHOW HIGHEST SUM OF CARDS LESS THAN OR EQUAL TO 21      ///

if (isset($_GET['cards'])) {
    $cards_array = str_split($_GET['cards']);  // turn card input into an array
    $num_variations = pow(2, count($cards_array));   // calculate the number of combinations possible
    $sum_array = array();
    $ace = false;

    // convert j,q,k to 10
    for ($i = 0; $i < count($cards_array); $i++) {
        if (($cards_array[$i] == "j") || ($cards_array[$i] == "q") || ($cards_array[$i] == "k")) {    
        $cards_array[$i] = "10";
        }
        // convert ace to 0
        elseif ($cards_array[$i] == "a") {
            $cards_array[$i] = 0;
            $ace = true;
        }
    }
    
    // get the sum of all possible combinations
    for ($i = 0; $i < $num_variations; $i++) {
        $combination = 0;
        for ($j = 0; $j < count($cards_array); $j++) {
            if (pow(2, $j) & $i) {
                if(!$ace) {$combination = $combination + (int)$cards_array[$j];}
                
                // re-enter ace as combinations of 1 and 11 if it was entered
                if($ace) {
                    for($k = 0; $k < 2; $k++) {
                        if($k = 0) {$combination = $combination + 1;}
                        if($k = 1) {$combination = $combination + 11; $ace = false;}
                    }
                }
            }
            echo $combination . "<br>";
        }

        
        // add the sums to $sum_array if they are less than or equal to 21
        if ($combination <= 21) {
            $sum_array[$i] = $combination;
        }
    }
    
    // get the highest number in the $sum_array
    $sum_array = array_filter($sum_array, 'is_int');    // filter out non-interger values
    $num = max($sum_array);
    echo "The highest winning combination is: " . $num;

}
?>






<!--**--**--**--**--**--**      RUN WITH JAVASCRIPT      **--**--**--**--**--**-->

</body>
<script>


///     SHOW HIGHEST SUM OF CARDS LESS THAN OR EQUAL TO 21      ///

$("#js_submit").click(function () {
    var cardsArray = document.getElementById('cards').value.split("");  // turn card input into an array
    var numVariations = Math.pow(2, cardsArray.length);   // calculate the number of combinations possible
    var sumArray = [];
    var ace = false;
    
    // set ace value equal to selected radio value
    if (document.getElementById("ace_one").checked) {
        var ace = "1";
    }
    if (document.getElementById("ace_eleven").checked) {
        var ace = "11";
    }
    
    // convert j,q,k to 10
    for (i = 0; i < cardsArray.length; i++) {
        if ((cardsArray[i] == "j") || (cardsArray[i] == "q") || (cardsArray[i] == "k")) {    
        cardsArray[i] = "10";
        }
        // convert ace to 0
        else if (cardsArray[i] == "a") {
            cardsArray[i] = 0;
            ace = true;
        }
    }
    
    // get the sum of all possible combinations
    for (i = 0; i < numVariations; i++) {
        var combination = 0;
        for (j = 0; j < cardsArray.length; j++) {
            if (Math.pow(2, j) & i) {
                combination = combination + parseInt(cardsArray[j]);
            }
        }
        
        // re-enter ace as combinations of 1 and 11 if it was entered
        for(k = 0; k < 2; k++) {
            if(ace) {
                if(k = 0) {combination = combination + 1;}
                if(k = 1) {combination = combination + 11;}
            }
        }
        
        // add the sums to sumArray if they are less than or equal to 21
        if (combination <= 21) {
            sumArray[i] = combination;
        }
    }
    
    // get the highest number in the sumArray
    sumArray = sumArray.filter(Boolean);    // filter out undefined values
    var num = Math.max.apply(null, sumArray);
    alert("The highest winning combination is: " + num);
    
});

</script>

</html>