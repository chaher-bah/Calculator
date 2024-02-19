<?php
    $result="";
    if(isset($_POST['clear'])) {
        $result="";
    }
    elseif (isset( $_POST['num'] )) {
        $result.=$_POST['num'];
    }
    elseif (isset($_POST['op'])){
        $result.=$_POST['op'];
        if (isset($_POST['input'])){ 
            setcookie('num',$_POST['input'],time()+86400,"/");
            setcookie('op',$_POST['op'],time()+86400,"/");
        }
    }elseif (isset($_POST['result'])){
        if(isset($_COOKIE['num']) && isset($_COOKIE['op'])) {
            $num = $_COOKIE['num'];
            $op = $_COOKIE['op'];
            $input = $_POST['input'];
            switch($op){
                case "+":
                    $result=$num+$input;
                    break;
                case "-":
                    $result=$num-$input;;
                    break;
                case "*":
                    $result=$num*$input;
                    break;
                case "/":
                    // check for division by zero error
                    if($input != 0) {
                        $result = $num / $input;
                    } else {
                        $result = "Error: Division by zero!";
                    }
                    break;
                default :
                    $result = "Error: Invalid operator.";
            }
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta name="keywords" content="html, Claculator, small project, php">
    <meta name="description" content="A simple calculator made in HTML and PHP">
    <meta name="author"  content="Bahri Chaher">
    <link  rel="stylesheet" href="style.css">

    <title>Claculator</title>
</head>
<body>
    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Smilies/Brown%20Heart.png" alt="Brown Heart" width="25" height="25" id="heart1"/>
    <h2>Calculator</h2>
    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Smilies/Brown%20Heart.png" alt="Brown Heart" width="25" height="25" id="heart2"/>
    <div class="calc">
        <form  method= "POST">
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
            <input type="submit" class="numbtn" name="num" value="5"id= "five">
            <input type="submit" class="numbtn" name="num" value="6" id="six">
            <input type="submit" class="numbtn" name="num" value="1" id="one">
            <input type="submit" class="numbtn" name="num" value="2" id="two">
            <input type="submit" class="numbtn" name="num" value="3" id="three">
            <input type="submit" class="oprbtn" name="result" value="=" id="result">
            <input type="submit" class="numbtn" name="num" value="0" id="zero">
            <input type="submit" class="numbtn" name="point" value="." id="point">
        </form>
    </div>
</body>
</html>