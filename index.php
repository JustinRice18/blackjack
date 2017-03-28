<?php session_start(); ?>

    <form>
        <input type="submit" value="hit" name="action">
        <input type="submit" value="pass" name="action" >
        <input type="submit" value="newgame" name="action">

    </form>

<?php
if(isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "newgame":
            session_unset();
            setupSession();
            dealTwoBoth();
            break;
        case 'hit':
            dealPlayer();
            break;
        case 'pass':
            dealcomputer();
            checkWinner();
            break;
    }
}

function setupSession() {
    $_SESSION['pTotal'] = 0;
    $_SESSION['pHand'] = [];
    $_SESSION['dHand'] = [];
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

//deal player and computer two cards ran on hit;
function dealTwoBoth() {
    $_SESSION['pHand'][] = array_pop($_SESSION['deck']);
    $_SESSION['pHand'][] = array_pop($_SESSION['deck']);
    $_SESSION['dHand'][] = array_pop($_SESSION['deck']);
    $_SESSION['dHand'][] = array_pop($_SESSION['deck']);

    checkNumAces('pHand');
    checkNumAces('dHand');

    printPlayerHand();
    printDealerHand();
}

function printPlayerHand() {
    $_SESSION['pTotal'] = 0;
    echo "Player dealt: ";

    foreach ($_SESSION['pHand'] as $card) {
        $_SESSION['pTotal'] += $card['value'];
        echo "{$card['name']}, ";
    }

    echo "with value {$_SESSION['pTotal']}<br><br>";

    if ($_SESSION['pTotal'] > 21) {
        echo "Player Busts! Dealer Wins. Click New Game! <br><br>";
    }
}

function printDealerHand() {
    $_SESSION['dTotal'] = 0;
    $_SESSION['dShowing'] = 0;

    echo "Dealer dealt: ";

    for ($x = 0; $x < count($_SESSION['dHand']); $x++) {
        if ($x === 0) {
            $_SESSION['dTotal'] += $_SESSION['dHand'][$x]['value'];
            echo "HIDDEN CARD, ";
        } else {
            $_SESSION['dShowing'] += $_SESSION['dHand'][$x]['value'];
            echo "{$_SESSION['dHand'][$x]['name']}, ";
        }
    }

    $_SESSION['dTotal'] += $_SESSION['dShowing'];
    echo "with value {$_SESSION['dShowing']}<br><br>";
}

function checkNumAces($who) {
    $num = 0;

    foreach ($_SESSION[$who] as $card) {
        if ($card['value'] > 10) {
            if ($num > 1) {
                $_SESSION[$who][$card['name']] = 1;
            }
            $num++;
        }
    }
}

// comment to change
//deal player one card
function dealplayer() {
    $_SESSION['pHand'][] = array_pop($_SESSION['deck']);
    checkNumAces('pHand');
    printPlayerHand();
}
//deal computer one card if less than 17
function dealcomputer() {
    while ($_SESSION['dTotal'] < 17) {
        $_SESSION['dHand'][] = array_pop($_SESSION['deck']);
        checkNumAces('dHand');
        printDealerHand();
    }
}

function checkWinner() {
    echo "Dealer: {$_SESSION['dTotal']} | Player: {$_SESSION['pTotal']} <br><br>";

    if ($_SESSION['dTotal'] > 21) {
        echo "Dealer Busts! Player Wins. Click New Game! <br><br>";
    } elseif ($_SESSION['pTotal'] > 21) {
        echo "Player Busts! Dealer Wins. Click New Game! <br><br>";
    } else {
        echo "Dealer stays with {$_SESSION['dTotal']} <br><br>";

        if ($_SESSION['dTotal'] >= $_SESSION['pTotal']) {
            echo "Dealer Wins. Click New Game! <br><br>";
        } else {
            echo "Player Wins. Click New Game! <br><br>";
        }
    }
    echo "<br><br><br><pre>";
    print_r($_SESSION['dHand']);
    echo "<br><br><br>";
    print_r($_SESSION['pHand']);
    echo "</pre>";

}