
<form action="index.php" method="get">
    <input type="hidden" name="New Game" value="run">
    <input type="submit" value="New Game">
    <input type="hidden" name="Hit" value="run">
    <input type="submit" value=" Hit">

</form>
<?php
//requrie_once('index.php');
session_start();

if (isset($_SESSION)) {
    if (isset($_GET['new']) && $_GET['new'] == "New") {
        session_unset();
    }
}
if(!isset($_SESSION["deck"])) $_SESSION["deck"] = array(
        "Ace of Diamonds" => 1,
        "Ace of Hearts" => 1,
        "Ace of Clubs" => 1,
        "Ace of Spades" => 1,
        "Two of Diamonds" => 2,
        "Two of Hearts" => 2,
        "Two of Clubs" => 2,
        "Two of Spades" => 2,
        "Three of Diamonds" => 3,
        "Three of Hearts" => 3,
        "Three of Clubs" => 3,
        "Three of Spades" => 3,
        "Four of Diamonds" => 4,
        "Four of Hearts" => 4,
        "Four of Clubs" => 4,
        "Four of Spades" => 4,
        "Five of Diamonds" => 5,
        "Five of Hearts" => 5,
        "Five of Clubs" => 5,
        "Five of Spades" => 5,
        "Six of Diamonds" => 6,
        "Six of Hearts" => 6,
        "Six of Clubs" => 6,
        "Six of Spades" => 6,
        "Seven of Diamonds" => 7,
        "Seven of Hearts" => 7,
        "Seven of Clubs" => 7,
        "Seven of Spades" => 7,
        "Eight of Diamonds" => 8,
        "Eight of Hearts" => 8,
        "Eight of Clubs" => 8,
        "Eight of Spades" => 8,
        "Nine of Diamonds" => 9,
        "Nine of Hearts" => 9,
        "Nine of Clubs" => 9,
        "Nine of Spades" => 9,
        "Ten of Diamonds" => 10,
        "Ten of Hearts" => 10,
        "Ten of Clubs" => 10,
        "Ten of Spades" => 10,
        "Jack of Spades" => 10,
        "Jack of Hearts" => 10,
        "Jack of Diamonds" => 10,
        "Jack of Clubs" => 10,
        "Queen of Clubs" => 10,
        "Queen of Spades" => 10,
        "Queen of Hearts" => 10,
        "Queen of Diamonds" => 10,
        "King of Clubs" => 10,
        "King of Diamonds" => 10,
        "King of Hearts" => 10,
        "King of Spades" => 10,);
{
    $_SESSION['house'] = 0;
    $_SESSION['player'] = 0;
    $_SESSION['Used'] =[];

    if (!empty($_GET['Hit'])) {
        hit();
    }
    if (!empty($_GET['New Game'])) {
        newGame();
if(    $_SESSION['player'] == 21 and $_SESSION['house'] > 21 ){
    echo "You Win";

}elseif($_SESSION['house'] == 21 and $_SESSION['player'] > 21 ){
    echo "You Lose. Play Again?";




    }

}




Function hit(){
    echo array_rand($_SESSION["deck"]);
}

Function newGame(){
    $play = array_rand($_SESSION["deck"],2);
  echo $play;
}


}
/*if(isset($_GET['action'])){
    switch($_GET('action')){
        case'shuffle';
            shuffle($_SESSIOn['deck']);
            break;
        case 'reset';
            session_unnset();
    }
}
function printDeck(){
    foreahc ($deck as $cards);
    echo $cards['name']
}
*/