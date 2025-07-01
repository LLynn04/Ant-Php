<?php
// Initialize game state
$board = array_fill(0, 9, '');
$current_player = 'X';
$game_over = false;
$winner = '';

// Winning combinations
$winnerCombine = [
    [0, 1, 2], 
    [3, 4, 5], 
    [6, 7, 8], 
    [0, 3, 6], 
    [1, 4, 7], 
    [2, 5, 8], 
    [0, 4, 8],
    [2, 4, 6]  
];

// Function to check winner
function checkWinner($board, $winnerCombine) {
    foreach ($winnerCombine as $combo) {
        if ($board[$combo[0]] != '' && 
            $board[$combo[0]] == $board[$combo[1]] && 
            $board[$combo[1]] == $board[$combo[2]]) {
            return $board[$combo[0]];
        }
    }
    return '';
}

// Function to check if board is full
function isBoardFull($board) {
    return !in_array('', $board);
}

// Handle form submission
if ($_POST) {
    // Reconstruct board from form data
    for ($i = 0; $i < 9; $i++) {
        if (isset($_POST['board_' . $i])) {
            $board[$i] = $_POST['board_' . $i];
        }
    }
    
    // Get current player from form
    if (isset($_POST['current_player'])) {
        $current_player = $_POST['current_player'];
    }
    
    // Handle cell click
    if (isset($_POST['cell'])) {
        $cell = $_POST['cell'];
        
        // Check if cell is empty
        if ($board[$cell] == '') {
            $board[$cell] = $current_player;
            
            // Check for winner
            $winner = checkWinner($board, $winnerCombine);
            if ($winner != '') {
                $game_over = true;
            } elseif (isBoardFull($board)) {
                $winner = 'Draw';
                $game_over = true;
            } else {
                // Switch player
                $current_player = ($current_player == 'X') ? 'O' : 'X';
            }
        }
    }
    
    // Handle reset
    if (isset($_POST['reset'])) {
        $board = array_fill(0, 9, '');
        $current_player = 'X';
        $game_over = false;
        $winner = '';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tic Tac Toe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0;
        }
        
        .game-container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .board {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 5px;
            margin: 20px 0;
            max-width: 300px;
            margin: 20px auto;
        }
        
        .cell {
            width: 80px;
            height: 80px;
            font-size: 2em;
            font-weight: bold;
            border: 2px solid #333;
            background-color: #fff;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .cell:hover:not(:disabled) {
            background-color: #f0f0f0;
        }
        
        .cell:disabled {
            cursor: not-allowed;
            background-color: #e9ecef;
        }
        
        .cell.x {
            color: #e74c3c;
        }
        
        .cell.o {
            color: #3498db;
        }
        
        .status {
            font-size: 1.2em;
            margin: 20px 0;
            font-weight: bold;
        }
        
        .winner {
            color: #27ae60;
        }
        
        .draw {
            color: #f39c12;
        }
        
        .current-player {
            color: #2c3e50;
        }
        
        .btn {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <h1>Tic Tac Toe</h1>
        
        <div class="status">
            <span class="current-player">Current Player: X</span>
        </div>
        
        <form method="POST">
            <!-- Hidden fields to maintain game state -->
            <?php for ($i = 0; $i < 9; $i++): ?>
                <input type="hidden" name="board_<?php echo $i; ?>" value="">
            <?php endfor; ?>
            <input type="hidden" name="current_player" value="X">
            
            <div class="board">
                <?php for ($i = 0; $i < 9; $i++): ?>
                    <button 
                        type="submit" 
                        name="cell" 
                        value="<?php echo $i; ?>" 
                        class="cell"
                    >
                    </button>
                <?php endfor; ?>
            </div>
        </form>
        
        <form method="POST">
            <!-- Hidden fields for reset -->
            <?php for ($i = 0; $i < 9; $i++): ?>
                <input type="hidden" name="board_<?php echo $i; ?>" value="">
            <?php endfor; ?>
            <button type="submit" name="reset" class="btn">New Game</button>
        </form>
        
        <div style="margin-top: 20px; font-size: 0.9em; color: #666;">
            <p>Click on any empty cell to make your move!</p>
        </div>
    </div>
</body>
</html>