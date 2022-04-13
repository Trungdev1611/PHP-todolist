<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist With PHP</title>
    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <div class="todolist">

        <form class="inputFiled" method="POST">
            <div class="test">
                <input type="text" placeholder="NewTodo" name="inputtodo">
                <div class="error hide">Input Field is not empty </div>
            </div>


            <button type="submit" name="submit">Add To do</button>
        </form>
        <?php
        $conn = new mysqli("localhost", "root", "", "todolist");
        if ($conn->connect_error) {
            $_SESSION["notify"] = "<p>Connect that bai</p>";
            die();
        } else {
            $_SESSION["notify"] = "<p>Connect thanh cong</p>";
        }

        if (isset($_POST["submit"]) and $_POST['inputtodo'] != "") {

            $inputtodo = $_POST['inputtodo'];
            $sql2 = "INSERT INTO todo_listitems (todo_item) VALUES('$inputtodo')";
            if ($conn->query($sql2) == TRUE) {
                echo ("insert du lieu vao database thanh cong");
                header("location:http://localhost/1.thuchanhphp/1.Todolist/todolist.php");
            } else {
                echo ("insert du lieu that bai");
            }
        }

        ?>
        <ul class="listtodo">
            <?php
            // create a new connection


            //create query to database
            $sql = "SELECT * FROM todo_listitems";
            $res = $conn->query($sql);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
            ?>
                    <li class="listtodo-item">
                        <span><?php echo $row['todo_item'] ?></span><a href="todolist.php?deltask=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash"></i></a></span>
                    </li>

            <?php
                }
            } else {
                echo " failed";
            }
            ?>

        </ul>
        <!-- Delete task -->
        <?php if (isset($_GET['deltask'])) {
            $id  = $_GET['deltask'];
            $sql3 = "DELETE  FROM todo_listitems WHERE id = $id";
            if ($conn->query($sql3) == TRUE) {
                echo ("delete du lieu vao database thanh cong");
                header("location:http://localhost/1.thuchanhphp/1.Todolist/todolist.php");
            } else {
                echo ("delete du lieu that bai");
            }
        } ?>
        <div class="desc">
            <p>Total is <span class="count"></span> todo in your todolist</p>
            <?php echo $_SESSION["notify"] ?>
        </div>
    </div>

</body>

</html>