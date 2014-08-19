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
    
    // set ace value equal to selected radio value
    if (isset($_GET['ace'])){
        switch($_GET['ace']) {
            case "1":
                $ace = "1";
                break;
            case "11":
                $ace = "11";
                break;
        }
    }
    
    // convert j,q,k,a to numbers
    for ($i = 0; $i < count($cards_array); $i++) {
        if (($cards_array[$i] == "j") || ($cards_array[$i] == "q") || ($cards_array[$i] == "k")) {    
        $cards_array[$i] = "10";
        }
        elseif ($cards_array[$i] == "a") {
            $cards_array[$i] = $ace;
        }
    }
    
    // get the sum of all possible combinations
    for ($i = 0; $i < $num_variations; $i++) {
        $combination = 0;
        for ($j = 0; $j < count($cards_array); $j++) {
            if (pow(2, $j) & $i) {
                $combination = $combination + (int)$cards_array[$j];
            }
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
    
// show radio inputs for Ace if "a" gets entered
$("#cards").keyup(function () {
    var cardsArray = document.getElementById('cards').value.split("");
    if (cardsArray[cardsArray.length-1] == "a") {
        $("#ace_input").show();
    }
})


///     SHOW HIGHEST SUM OF CARDS LESS THAN OR EQUAL TO 21      ///

$("#js_submit").click(function () {
    var cardsArray = document.getElementById('cards').value.split("");  // turn card input into an array
    var numVariations = Math.pow(2, cardsArray.length);   // calculate the number of combinations possible
    var sumArray = [];
    
    // set ace value equal to selected radio value
    if (document.getElementById("ace_one").checked) {
        var ace = "1";
    }
    if (document.getElementById("ace_eleven").checked) {
        var ace = "11";
    }
    
    // convert j,q,k,a to numbers
    for (i = 0; i < cardsArray.length; i++) {
        if ((cardsArray[i] == "j") || (cardsArray[i] == "q") || (cardsArray[i] == "k")) {    
        cardsArray[i] = "10";
        }
        else if (cardsArray[i] == "a") {
            cardsArray[i] = ace;
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