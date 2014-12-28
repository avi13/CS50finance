
    <ul class="nav nav-pills">
        <li><a href="quote.php">Quote</a></li>
        <li><a href="buy.php">Buy</a></li>
        <li><a href="sell.php">Sell</a></li>
        <li><a href="history.php">History</a></li>
        <li><a href="addcash.php">Add Cash</a></li>
        <li><a href="logout.php"><strong>Log Out</strong></a></li>
    </ul>

<div>
    <table class="table table-striped" style="text-align: left;">
    <?php

        foreach ($positions as $position)
        {
            print("<tr>");
            print("<td>{$position["symbol"]}</td>");
            print("<td>{$position["name"]}</td>");
            print("<td>{$position["shares"]}</td>");
            $value = number_format($position["price"], 4, '.', '');
            print("<td>{$value}</td>");
            print("</tr>");
        }
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
