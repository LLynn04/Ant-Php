<pre><?php
        $jsonFile = 'data.json';

        $data = json_decode((file_get_contents($jsonFile)),true);
        $board = $data['board'];
        $currentPlayer = $data['currentPlayer'];
        $message = '';

        if (isset($_POST['move'])) {
            $move = (int)($_POST['move']);

            if ($board[$move] === '' || !checkWinner($board) ) {
                $board[$move] = $currentPlayer;

                $winner = checkWinner($board);

                if ($winner) {
                    $message = "player $winner wins";
                } elseif (!in_array('',$board)) {
                    $message = "it's a draw";
                } else {
                    $currentPlayer = $currentPlayer === 'X'? 'O' : 'X';
                    $message = "Player $currentPlayer's turn";
                }
                
            }
            saveBackData($board, $currentPlayer, $message); 
        }

        function checkWinner ($board) {

            // global $board;
            $winningCombinations = [
                [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
                [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
                [0, 4, 8], [2, 4, 6] // Diagonals
            ];

            foreach ($winningCombinations as $combination) {
                if ($board[$combination[0]] && 
                    $board[$combination[0]] === $board[$combination[1]] && 
                    $board[$combination[0]] === $board[$combination[2]]) {
                    return $board[$combination[0]];
                }
            }
            // return false;

        }

        function saveBackData ($board, $currentPlayer, $message) {
            $data = [
                'board' => $board,
                'currentPlayer' => $currentPlayer,
                'message' => $message
            ];
            file_put_contents('data.json', json_encode($data));
        }
        saveBackData($board, $currentPlayer, $message);

        if (isset($_POST['reset'])) {
            $board = array_fill(0, 9, '');
            $currentPlayer = 'X';
            $message = '';
            saveBackData($board, $currentPlayer, $message);
        }

        ?></pre>

<!DOCTYPE html>
<html>

<head>
    <title>Tic Tac Toe with JSON</title>
    <style>
        .board {
            display: grid;
            grid-template-columns: repeat(3, 80px);
            gap: 5px;
            margin: 20px auto;
            width: fit-content;
        }

        .board button {
            width: 80px;
            height: 80px;
            font-size: 24px;
        }

        .message {
            text-align: center;
            font-size: 20px;
        }

        .reset {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center;">PHP Tic Tac Toe (with JSON)</h2>
    <form method="POST">
        <div class="board">
            <?php for ($i = 0; $i < 9; $i++): ?>
                <button
                    type="submit"
                    name="move"
                    value="<?= $i ?>" <?= $board[$i] || checkWinner($board) ? 'disabled' : '' ?>>
                    <?= htmlspecialchars($board[$i]) ?>
                </button>
            <?php endfor; ?>
        </div>
        <div class="message"><?= $message ?: "Player $currentPlayer's turn" ?></div>
        <div class="reset">
            <button type="submit" name="reset">Reset Game</button>
        </div>
    </form>
</body>

</html>