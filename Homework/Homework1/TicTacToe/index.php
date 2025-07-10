<pre><?php
        $jsonFile = 'data.json';

        $data = json_decode((file_get_contents($jsonFile)), true);
        $board = $data['board'];
        $currentPlayer = $data['currentPlayer'];
        $message = $data['message'];
        $winnerLine = $data['winnerLine'];



        if (isset($_POST['move'])) {
            $move = (int)($_POST['move']);

            if ($board[$move] === '' and !checkWinner($board)) {
                $board[$move] = $currentPlayer;

                $winnerData = checkWinner($board);

                if ($winnerData) {
                    $message = "player $currentPlayer wins";
                    $winnerLine = $winnerData['winnerLine'];
                } elseif (!in_array('', $board)) {
                    $message = "it's a draw";
                    $winnerLine = [];
                    // saveBackData($board, $currentPlayer, $message);
                } else {
                    $currentPlayer = $currentPlayer === 'X' ? 'O' : 'X';
                    $message = "Player $currentPlayer's turn";
                    $winnerLine = [];
                    // saveBackData($board, $currentPlayer, $message);
                }
                saveBackData($board, $currentPlayer, $message, $winnerLine);
            }
        }

          if (isset($_POST['reset'])) {
            $board = array_fill(0, 9, '');
            $currentPlayer = 'X';
            $message = '';
            $winnerLine = [];
            saveBackData($board, $currentPlayer, $message, $winnerLine);
        }

        function checkWinner($board)
        {

            // global $board;
            $checkWon = [
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8],
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8],
                [0, 4, 8],
                [2, 4, 6]
            ];

            foreach ($checkWon as $lines) {
                if (
                    $board[$lines[0]] &&
                    $board[$lines[0]] === $board[$lines[1]] &&
                    $board[$lines[0]] === $board[$lines[2]]
                ) {
                    return [
                        'winner' => $board[$lines[0]],
                        'winnerLine' => $lines
                    ];
                }
            }
            return false;
        }

        function saveBackData($board, $currentPlayer, $message, $winnerLine = [])
        {
            $data = [
                'board' => $board,
                'currentPlayer' => $currentPlayer,
                'message' => $message,
                'winnerLine' => $winnerLine
            ];
            file_put_contents('data.json', json_encode($data));
        }
        // saveBackData($board, $currentPlayer, $message, $winnerLine);

      

        ?></pre>

<!DOCTYPE html>
<html>

<head>
    <!-- <title>Tic Tac Toe</title> -->
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            margin: 0;
        }

        .board-container {
            position: relative;
            width: fit-content;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .board {
            display: grid;
            grid-template-columns: repeat(3, 80px);
            grid-template-rows: repeat(3, 80px);
            gap: 5px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            margin-bottom: 20px;
            position: relative;
        }

        .board button {
            width: 80px;
            height: 80px;
            font-size: 2.2em;
            font-weight: bold;
            background: #e3e3e3;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
            position: relative;
            z-index: 1;
        }

        .board button:disabled {
            background: #d1d1d1;
            cursor: default;
        }

        .winner-cell {
            background-color: #ffeb3b !important;
        }

        .win-line {
            position: absolute;
            height: 5px;
            background-color: red;
            width: 260px;
            top: 0;
            left: 0;
            right: 0;
            margin: auto;
            z-index: 2;
            transform-origin: center;
            pointer-events: none;
        }

        /* Horizontal wins */
        .line-0-1-2 {
            top: 40px;
            transform: rotate(0deg);
        }

        .line-3-4-5 {
            top: 130px;
            transform: rotate(0deg);
        }

        .line-6-7-8 {
            top: 220px;
            transform: rotate(0deg);
        }

        /* Vertical wins */
        .line-0-3-6 {
            top: 130px;
            transform: rotate(90deg);
            left: -90px;
        }

        .line-1-4-7 {
            top: 130px;
            transform: rotate(90deg);
        }

        .line-2-5-8 {
            top: 130px;
            transform: rotate(90deg);
            left: 90px;
        }

        /* Diagonal wins */
        .line-0-4-8 {
            top: 130px;
            transform: rotate(45deg);
        }

        .line-2-4-6 {
            top: 130px;
            transform: rotate(-45deg);
        }

        .message {
            text-align: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .reset {
            text-align: center;
            margin-top: 10px;
        }
    </style>

</head>

<body>
    <!-- <h2 style="text-align:center;">PHP Tic Tac Toe using json</h2> -->
    <form method="POST">
        <div class="board">
            <?php for ($i = 0; $i < 9; $i++): ?>
                <?php
                $isWinnerCell = isset($winnerLine) && in_array($i, $winnerLine);
                ?>
                <button
                    type="submit"
                    name="move"
                    value="<?= $i ?>"
                    class="<?= $isWinnerCell ? 'winner-cell' : '' ?>"
                    <?= $board[$i] || !empty($winnerLine) ? 'disabled' : '' ?>>
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