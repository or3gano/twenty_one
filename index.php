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
    <div id="button_group">
        <button id="php_submit" type="submit">Run with PHP</button>
        <button id="js_submit" type="reset">Run with JavaScript</button>
    </div>
</form>






<!--**--**--**--**--**--**      RUN WITH PHP      **--**--**--**--**--**-->

<div id="score">
<?php


///     SHOW HIGHEST SUM OF CARDS LESS THAN OR EQUAL TO 21      ///

if (isset($_GET['cards'])) {
    $cards_array = str_split($_GET['cards']);  // turn card input into an array
    $num_variations = pow(2, count($cards_array));   // calculate the number of combinations possible
    $comb_array = array();
    $sum_array = array();
    $ace = false;

    // convert j,q,k to 10
    for ($i = 0; $i < count($cards_array); $i++) {
        if (($cards_array[$i] == "j") || ($cards_array[$i] == "q") || ($cards_array[$i] == "k")) {    
        $cards_array[$i] = "10";
        }
        // convert ace to 0
        elseif (($cards_array[$i] == "a") || ($cards_array[$i] == "A")) {
            $cards_array[$i] = 0;
            $ace = true;
        }
    }
    
    // get the sum of all possible combinations and put them into an array
    for ($i = 0; $i < $num_variations; $i++) {
        $combination = 0;
        for ($j = 0; $j < count($cards_array); $j++) {
            if (pow(2, $j) & $i) {
                $combination = $combination + (int)$cards_array[$j];
            }
        }
        $comb_array[$i] = $combination;
    }
    
    // re-enter ace as combinations of 1 and 11 if it was entered
    for($k = 0; $k < count($comb_array); $k++) {
        for($l = 0; $l < 3; $l++) {
            if($l == 0) {
                $sum_array[] = $comb_array[$k];
            }
            if(($l == 1) && ($ace)) {
                $sum_array[] = $comb_array[$k] + 1;
            }
            if(($l == 2) && ($ace)) {
                $sum_array[] = $comb_array[$k] + 11;
            }
        }
    }

    // sets any values greater than 21 to 0
    for($m = 0; $m < count($sum_array); $m++) {
        if ($sum_array[$m] <= 21) {
            $sum_array[$m] = $sum_array[$m];
        } else {
            $sum_array[$m] = 0;
        }
    }
    
    // get the highest number in the $sum_array
    $sum_array = array_filter($sum_array, 'is_int');    // filter out non-interger values
    $num = max($sum_array);
    echo "The highest winning combination is: " . $num;

}
?>
</div>





<!--**--**--**--**--**--**      RUN WITH JAVASCRIPT      **--**--**--**--**--**-->

</body>
<script>


///     SHOW HIGHEST SUM OF CARDS LESS THAN OR EQUAL TO 21      ///

$("#js_submit").click(function () {
    var cardsArray = document.getElementById('cards').value.split("");  // turn card input into an array
    var numVariations = Math.pow(2, cardsArray.length);   // calculate the number of combinations possible
    var combArray = [];
    var sumArray = [];
    var ace = false;
    
    // convert j,q,k to 10
    for (i = 0; i < cardsArray.length; i++) {
        if ((cardsArray[i] === "j") || (cardsArray[i] === "q") || (cardsArray[i] === "k")) {
            cardsArray[i] = "10";
        } else if ((cardsArray[i] === "a") || (cardsArray[i] === "A")) {
            cardsArray[i] = 0;  // convert ace to 0
            ace = true;
        }
    }
    
    // get the sum of all possible combinations and put them into an array
    for (i = 0; i < numVariations; i++) {
        var combination = 0;
        for (j = 0; j < cardsArray.length; j++) {
            if (Math.pow(2, j) & i) {
                combination = combination + parseInt(cardsArray[j]);
            }
        }
        combArray[i] = combination;
    }
    
    // re-enter ace as combinations of 1 and 11 if it was entered
    for (k = 0; k < combArray.length; k++) {
        for (l = 0; l < 3; l++) {
            if (l === 0) {
                sumArray[sumArray.length] = combArray[k];
            }
            if ((l === 1) && (ace)) {
                sumArray[sumArray.length] = combArray[k] + 1;
            }
            if ((l === 2) && (ace)) {
                sumArray[sumArray.length] = combArray[k] + 11;
            }
        }
    }

    // sets any values greater than 21 to 0
    for (m = 0; m < sumArray.length; m++) {
        if (sumArray[m] <= 21) {
            sumArray[m] = sumArray[m];
        } else {
            sumArray[m] = 0;
        }
    }    
    
    // get the highest number in the sumArray and print it in the score div
    sumArray = sumArray.filter(Boolean);    // filter out undefined values
    var num = Math.max.apply(null, sumArray);
    document.getElementById('score').innerHTML="The highest winning score is " + num;
    
});

</script>

</html>