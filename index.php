<?php
session_start();

// Initialize the operations array if not already set
if (!isset($_SESSION['operations'])) {
    $_SESSION['operations'] = [];
}

// Initialize variables
$result = '';
$current_input = isset($_POST['current_input']) ? $_POST['current_input'] : '';
$operations = $_SESSION['operations'];

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['clear'])) {
        // Clear the input and result
        $result = '';
    } elseif (isset($_POST['num']) || isset($_POST['op'])) {
        // Continue building the current input
        $result = $current_input . (isset($_POST['num']) ? $_POST['num'] : $_POST['op']);
    } elseif (isset($_POST['result'])) {
        // Calculate the result
        try {
            // Evaluate the expression
            $result = eval("return " . $current_input . ";");

            // Store the operation in the session
            $_SESSION['operations'][] = [
                'operation' => $current_input,
                'result' => $result
            ];
        } catch (Exception $e) {
            // Handle invalid expressions
            $result = 'Error';
        }
    }

    // Update the current input
    $current_input = $result;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta name="keywords" content="html, Calculator, small project, php">
    <meta name="description" content="A simple calculator made in HTML and PHP">
    <meta name="author"  content="Bahri Chaher">
    <link  rel="stylesheet" href="./style.css">
    <link rel='icon' href="./icon2.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Calculator</title>
    
</head>
<body>
    <div class="container">
    <div class="calc">
        <div class="title">
            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Smilies/Brown%20Heart.png" alt="Brown Heart" width="25" height="25" id="heart1"/>
            <h2>Calculator</h2>
            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Smilies/Brown%20Heart.png" alt="Brown Heart" width="25" height="25" id="heart2"/>
        </div>    
        <form method="POST">
            <input type="hidden" name="current_input" id="current_input" value="<?php echo htmlspecialchars($current_input); ?>">
            <input type="text" class="out" name="out" value="<?php echo htmlspecialchars($result); ?>" readonly autofocus >
            <input type="submit" class="oprbtn" name="clear" value="C" id="clear">
            <input type="submit" class="oprbtn" name="op" value="/" id="divi">
            <input type="submit" class="oprbtn" name="op" value="*" id="pow">
            <input type="submit" class="oprbtn" name="op" value="-" id="min">
            <input type="submit" class="numbtn" name="num" value="7" id="seven">
            <input type="submit" class="numbtn" name="num" value="8" id="eight">
            <input type="submit" class="numbtn" name="num" value="9" id="nine">
            <input type="submit" class="oprbtn" name="op" value="+" id="plus">
            <input type="submit" class="numbtn" name="num" value="4" id="four">
            <input type="submit" class="numbtn" name="num" value="5" id="five">
            <input type="submit" class="numbtn" name="num" value="6" id="six">
            <input type="submit" class="numbtn" name="num" value="1" id="one">
            <input type="submit" class="numbtn" name="num" value="2" id="two">
            <input type="submit" class="numbtn" name="num" value="3" id="three">
            <input type="submit" class="oprbtn" name="result" value="=" id="result">
            <input type="submit" class="numbtn" name="num" value="0" id="zero">
            <input type="submit" class="numbtn" name="num" value="." id="point">
        </form>
    </div>
        <div class="operations">
            <h3>Operations Book</h3>
            <div class="operations-list">
                <?php
                foreach(array_reverse($operations) as $op) {
                    echo "<p>{$op['operation']} = {$op['result']}</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <footer>
        <p>Created by <a href="https://www.linkedin.com/in/chaher-bahri/"  target="_blank" >Chaher Bahri</a></p>
        <div >
        <a  href="https://www.linkedin.com/in/chaher-bahri/" target="_blank" ><i id="logo" class="fa fa-linkedin" ></i></a>
        <a  href="https://github.com/chaher-bah"  target="_blank" ><i id="logo" class="fa fa-github" ></i></a>
        <a href="mailto: bahrichaher.pro@gmail.com"  target="_blank" ><i id="logo" class="fa fa-envelope" ></i></a>
        </div>
    </footer>
</body>
</html>