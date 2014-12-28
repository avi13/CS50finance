<div>
    <table>
    <?php

        foreach ($positions as $position)
        {
            print("<tr>");
            print("<td>{$position["symbol"]}</td>");
            print("<td>{$position["name"]}</td>");
            print("<td>{$position["shares"]}</td>");
            print("<td>{$position["price"]}</td>");
            print("</tr>");
        }/*
        print("<tr>");
        print("<td>Available cash = {$cash}</td>");
        print("</tr>");*/
    ?>
    </table>
    <p>
        <?php
            print("Available Cash:{$cash[0]["cash"]}");
        ?>
    </p>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
