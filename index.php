<?php
    $result = "";
    $operations = isset($_COOKIE['operations']) ? json_decode($_COOKIE['operations'], true) : [];

    if(isset($_POST['clear'])) {
        $result = "";
        setcookie('num', '', time() - 3600, "/");
        setcookie('op', '', time() - 3600, "/");
    }
    elseif (isset($_POST['num'])) {
        $result .= $_POST['num'];
    }
    elseif (isset($_POST['op'])){
        $result .= $_POST['op'];
        setcookie('num', floatval($_POST['current_input']), time()+120, "/");
        setcookie('op', $_POST['op'], time()+120, "/");
    }
    elseif (isset($_POST['result'])){
        if(isset($_COOKIE['num']) && isset($_COOKIE['op'])) {
            $num = floatval($_COOKIE['num']);
            $op = $_COOKIE['op'];
            $input = floatval($_POST['current_input']);
            $operation = "$num $op $input";
            switch($op){
                case "+":
                    $result = $num + $input;
                    break;
                case "-":
                    $result = $num - $input;
                    break;
                case "*":
                    $result = $num * $input;
                    break;
                case "/":
                    if($input != 0) {
                        $result = $num / $input;
                    } else {
                        $result = "Error: Division by zero!";
                    }
                    break;
                default :
                    $result = "Error: Invalid operator.";
            }
            $operations[] = ["operation" => $operation, "result" => $result];
            setcookie('operations', json_encode($operations), time()+120, "/");
        }
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
                <input type="hidden" name="current_input" id="current_input" value="<?php echo $result ?>">
                <input type="text" class="out" name="out" value="<?php echo $result ?>" readonly autofocus >
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var buttons = document.querySelectorAll('input[type="submit"]');
        var output = document.querySelector('.out');
        var currentInput = document.getElementById('current_input');

        buttons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                if (this.name === 'num' || this.name === 'op') {
                    output.value += this.value;
                    currentInput.value = output.value;
                } else if (this.name === 'clear') {
                    output.value = '';
                    currentInput.value = '';
                }
            });
        });
    });
    </script>
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