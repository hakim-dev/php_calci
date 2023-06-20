<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Title</title>
    </head>
    <body>
        <form action= " <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="number" name="num1" placeholder="Number 1" required>
            <input type="number" name="num2" placeholder="Number 2" required>
            <select name="operator" >
                <option value="add">Add</option>
                <option value="subtract">Subtract</option>
                <option value="multiply">Multiply</option>
                <option value="divide">Divide</option>
            </select>
            <br>
            <button type="submit" name="submit" value="submit">Calculate</button>
        </form>

        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $num1 = filter_input(INPUT_POST, "num1", FILTER_SANITIZE_NUMBER_FLOAT);
                $num2 = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_FLOAT);
                $operator = htmlspecialchars($_POST["operator"]);

                $errors = false;
                if (empty($num1) || empty($num2) || empty($operator)){
                    echo "<p class='calc_error'> Fill in all fields!</p>";
                    $errors = true;
                }
                if (!is_numeric($num1) || !is_numeric($num2)){
                    echo "<p class='calc_error'> Numbers ONLY!</p>";
                    $errors = true;
                }

                if (!$errors) {
                    $value = 0;
                    switch ($operator){
                        case "add":
                            $value = $num1 + $num2;
                            break;
                        
                        case "subtract":
                            $value = $num1 - $num2;
                            break;
                        
                        case "multiply":
                            $value = $num1 * $num2;
                            break;
                                
                        case "divide":
                            $value = $num1 / $num2;
                            break;
                        
                        default:
                        echo "<p class='calc_error'> Somthing went wrong!</p>";

                    }

                    echo "<p class='calc_result'> Result = " . $value . "</p>";
                }
            }
        ?>
    </body>
</html>
