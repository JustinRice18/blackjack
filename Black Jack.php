<?php session_start(); ?>

<form action="bj.php" method="get">
    <input type="submit" value="hit" name="action">
    <input type="submit" value="pass" name="action" >
    <input type="submit" value="newgame" name="action">

</form>

<?php
if (!isset($_SESSION["deck"])) {
	$_SESSION['pTotal'] = 0;
	$_SESSION['dTotal'] = 0;
	$_SESSION['dShowing'] = 0;
	$_SESSION["deck"] = [
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
        "King of Spades" => 10];
	
	$keys = array_keys($_SESSION['deck']);
	$newDeck = []; 
	foreach ($keys as $key) {
		$newDeck[] = ['name' => $key, 'value' => $_SESSION['deck'][$key]];
	}
	$_SESSION['deck'] = $newDeck;
	shuffle($_SESSION['deck']);
}

if(isset($_GET['action'])) {
	switch ($_GET['action']) {
		case "newgame":
			session_unset();
            break;
        case 'hit':
            dealTwoBoth();
            break;
        case 'pass':
			dealcomputer();
			break;
    }
}

//deal player and computer two cards ran on hit;
function dealTwoBoth() {
	if($_SESSION['pTotal'] === 0) {
		$p1 = array_pop($_SESSION['deck']);
		$p2 = array_pop($_SESSION['deck']);
		$d1 = array_pop($_SESSION['deck']);
		$d2 = array_pop($_SESSION['deck']);
		$_SESSION['pTotal'] += $p1['value'] + $p2['value'];		
        echo "Player dealt {$p1['name']} and {$p2['name']} with value {$_SESSION['pTotal']} <br><br>";
		$_SESSION['dTotal'] += $d1['value'] + $d2['value'];
		$_SESSION['dShowing'] += $d1['value'];
		echo "<br>";
        echo "Dealer dealt {$d1['name']} and Face Down Card with value showing of {$d1['value']} <br><br>";        
    } else {
        dealplayer();
    }
}
// comment to change
//deal player one card
function dealplayer() {
    $p1 = array_pop($_SESSION['deck']);
	$_SESSION['pTotal'] += $p1['value'];	
	echo "Player dealt {$p1['name']} with total value now equaling: {$_SESSION['pTotal']} <br><br>";
	if ($_SESSION['pTotal'] > 21) {
		echo "Player Busts! Dealer Wins. Click New Game! <br><br>";
	}
}

//deal computer one card if less than 17
function dealcomputer() {
	while ($_SESSION['dTotal'] < 17) {
		$d1 = array_pop($_SESSION['deck']);
		$_SESSION['dTotal'] += $d1['value'];
		$_SESSION['dShowing'] += $d1['value'];
		echo "Dealer dealt {$d1['name']} with total value showing now equaling: {$_SESSION['dShowing']} <br><br>";
	}
	echo "Dealer: {$_SESSION['dTotal']} | Player: {$_SESSION['pTotal']} <br><br>";
	if ($_SESSION['dTotal'] > 21) {		
		echo "Dealer Busts! Player Wins. Click New Game! <br><br>";
	} else {
		echo "Dealer stays with {$_SESSION['dTotal']} <br><br>";
		
		if ($_SESSION['dTotal'] >= $_SESSION['pTotal']) {
			echo "Dealer Wins. Click New Game! <br><br>";
		} else {
			echo "Player Wins. Click New Game! <br><br>";
		}
	}
}
