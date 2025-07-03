<?php
// Initialize game state
session_start();

// Initialize board if not exists
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = array_fill(0, 9, ''); // Empty board
}

// Initialize current player if not exists
if (!isset($_SESSION['current_player'])) {
    $_SESSION['current_player'] = 'X'; // X starts first
}

// Handle cell click
if (isset($_POST['cell'])) {
    $cell_index = (int)$_POST['cell'];
    
    // If cell is empty, place current player's symbol
    if ($_SESSION['board'][$cell_index] === '') {
        $_SESSION['board'][$cell_index] = $_SESSION['current_player'];
        
        // Switch player for next turn
        $_SESSION['current_player'] = ($_SESSION['current_player'] === 'X') ? 'O' : 'X';
    }
}

// Reset game
if (isset($_POST['reset'])) {
    $_SESSION['board'] = array_fill(0, 9, '');
    $_SESSION['current_player'] = 'X';
}

$board = $_SESSION['board'];
$current_player = $_SESSION['current_player'];
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
        .cell {
            width: 100px;
            height: 100px;
            font-size: 48px;
            background: #f0f0f0;
            border: 2px solid #333;
            cursor: pointer;
        }
        .cell:hover {
            background: #e0e0e0;
        }
        .info {
            text-align: center;
            margin: 20px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="info">
        Current Player: <strong><?php echo $current_player; ?></strong>
    </div>
    
    <form method="POST">
        <div class="board">
            <?php for ($i = 0; $i < 9; $i++): ?>
                <button
                    type="submit"
                    name="cell"
                    value="<?php echo $i; ?>"
                    class="cell"
                    <?php echo ($board[$i] !== '') ? 'disabled' : ''; ?>>
                    <?php echo $board[$i]; ?>
                </button>
            <?php endfor; ?>
        </div>
        
        <div style="text-align: center; margin: 20px;">
            <button type="submit" name="reset" value="1">Reset Game</button>
        </div>
    </form>
</body>
</html>