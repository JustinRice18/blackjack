<?php
//requrie_once('index.php');
session_start();


?>
<form action="index.php" method="get">
    <input type="submit" value="hit" name="action">
    <input type="submit" value="pass" name="action" >
    <input type="submit" value="newgame" name="action">

</form>
<?php
//requrie_once('index.php');

if (!isset($_SESSION["deck"])) {
    $_SESSION["deck"] = array(
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

}



if(isset($_GET['action'])) {


      switch ($_GET['action']) {
          case "NewGame":
              session_unset();
              break;
          case 'hit':
               dealTwoBoth();
              break;

              break;
          case 'pass';
              dealcomputer();
              break;

      }


  }








//deal player and computer two cards ran on hit;
function dealTwoBoth(){
    if($_SESSION['player']=== 0) {
        $randomkey = array_rand($_SESSION["deck"], 2);
        $end = implode($randomkey, " and ");

        foreach ($randomkey as $key) {
            $_SESSION['player'] = +$_SESSION['deck'][$key];
        }

        echo "you received. " . $end, '<br />';
        echo " adding to " . $_SESSION['player'], '<br />';
        dealComputerTwo();
    }else{
        dealplayer();
    }

}

//deal player one card
function dealplayer(){
    if ($_SESSION['player'] > 0 && $_SESSION['player'] < 21) {
        $randomkeys = array_rand($_SESSION["deck"]);

        foreach ($randomkeys as $keys) {
            ($_SESSION['player'] =+ $_SESSION['deck'][$keys]);
        }
        echo "you received " . $randomkeys . " bringing your total to " . $_SESSION['player'];


    }
}

//deal computer two cards
function dealComputerTwo(){
    $randomkey = array_rand($_SESSION["deck"], 2);
        $end = implode($randomkey, " and ");

        foreach ($randomkey as $key) {
            $_SESSION['dealer'] = $_SESSION['dealer'] + $_SESSION['deck'][$key];

        }

        echo "dealer has. " . $end, '<br />';
        echo " adding to " . $_SESSION['dealer'], '<br />';


}

//deal computer one card if less than 17
function dealcomputer(){
    if ($_SESSION['dealer'] > 0 && $_SESSION['dealer'] < 17) {
            $randomkeys = array_rand($_SESSION["deck"]);

            foreach ($randomkeys as $keys) {
                ($_SESSION['dealer'] =+ $_SESSION['deck'][$keys]);
            }
            echo "dealer has" . $randomkeys . " bringing his total to " . ($_SESSION['dealer']);


        }elseif($_SESSION['dealer']>= 17){
            if($_SESSION['dealer']> $_SESSION['player']){
                echo "dealer wins with". $_SESSION['dealer'], '<br/>';
                echo "you only having ". $_SESSION['player'];
            }


    }

}


/*
if($_SESSION['player']= 0); {
    foreach ($play as $x => $x_value) {
        echo "you pulled" . $x . ", bringing your total to" . $x_value;
        echo "<br>";
    }
*/




Function hit(){
    foreach ($_SESSION['deck'] as $value => $key);

    $play = array_rand($_SESSION["deck"]);
    echo $play;
    echo $_SESSION['player'] =+$play;
}

Function newGame(){
    $play = array_rand($_SESSION["deck"]);
    echo $play;

}
function drawTwo(){
    shuffle($_SESSION['deck']);
}

// echo array_values($play);
   // unset($_SESSION["deck"][$play]);





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