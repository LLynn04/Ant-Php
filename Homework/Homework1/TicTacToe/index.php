<?php
// Initialize board and state
$board = $_POST['board'] ?? array_fill(0, 9, '');
$currentPlayer = $_POST['current_player'] ?? 'X';
$winner = '';
$gameOver = false;

// All winning combinations
$checkWiner = [
    [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
    [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
    [0, 4, 8], [2, 4, 6] // Diagonals
];

// Function to check win
function checkWon($board, $checkWiner) {
    foreach ($checkWiner as $won) {
        if (
            $board[$won[0]] !== '' &&
            $board[$won[0]] === $board[$won[1]] &&
            $board[$won[1]] === $board[$won[2]]
        ) {
            return $board[$won[0]];
        }
    }
    return '';
}

// Handle move
if (isset($_POST['cell']) && !$gameOver) {
    $cell = (int)$_POST['cell'];

    if ($board[$cell] === '') {
        $board[$cell] = $currentPlayer;

        // Check for win
        $winner = checkWon($board, $checkWiner);
        if ($winner !== '') {
            $gameOver = true;
        } else {
            // Switch player
            $currentPlayer = $currentPlayer === 'X' ? 'O' : 'X';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Tic Tac Toe</title>
    <style>
        .board {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            gap: 5px;
            width: fit-content;
            margin: 20px auto;
        }
        button {
            width: 100px;
            height: 100px;
            font-size: 48px;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2><?php
        if ($winner) {
            echo "Player $winner wins!";
        } else {
            echo "Current Player: $currentPlayer";
        }
    ?></h2>

    <form method="POST" class="board">
        <?php foreach ($board as $i => $val): ?>
            <input type="hidden" name="board[<?php echo $i; ?>]" value="<?php echo $val; ?>">
        <?php endforeach; ?>
        <input type="hidden" name="current_player" value="<?php echo $currentPlayer; ?>">

        <?php foreach ($board as $i => $val): ?>
            <button type="submit" name="cell" value="<?php echo $i; ?>" <?php echo ($val || $winner) ? 'disabled' : ''; ?>>
                <?php echo $val; ?>
            </button>
        <?php endforeach; ?>
    </form>
</body>
</html>
