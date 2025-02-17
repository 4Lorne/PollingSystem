<?php
    include "config.php";
    session_start();
    $con = connect();

    //collect top 2 voted
    //https://www.simplilearn.com/tutorials/sql-tutorial/second-highest-salary-in-sql#:~:text=To%20find%20the%20second%20highest%20salary%20in%20the%20above%20table,second%20highest%20salary%20in%20SQL.
//    $sqlTop = "SELECT MAX(votes) FROM candidates";
//    $sqlSec = "SELECT MAX(votes) FROM candidates WHERE votes < (SELECT MAX(votes) FROM candidates)";
    $sqlTop = "SELECT * FROM candidates ORDER BY votes DESC";


    $top = $con->query($sqlTop);
//    $sec = $con->query($sqlSec);

    $resultTop = $top->fetch_assoc();
//    $resultSec = $sec->fetch_assoc();
//    $result = $top . $sec;

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Results: Top 2</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>

    <body>
        <div class="container">
            <div class="register"><a href="logout.php">Logout</a></div>
            <h1>Top 2 Most Voted</h1>

            <form name="results" action="results.php" method="post">
                <div class="row">
                    <div class="inline_block">
                        <?php
                        $query = "SELECT * FROM candidates WHERE votes >= 0 ORDER BY votes DESC LIMIT 2;";
                        $result = $con->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_array()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['votes']?></td>
                                </tr>
                                <br>
                            <?php	}
                        }else{
                            echo "<h2>No record found!</h2>";
                        } ?>


                    </div>
                </div>

                <div class="row">
                    <input class="btn" type="submit" name="complete" value="Return">
                </div>
            </form>
        </div>
    </body>
</html>
