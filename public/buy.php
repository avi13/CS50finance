<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        if(empty($_POST["symbol"]))
        {
            apologize("Please enter stock symbol");
        }
        else
        {
            $stock = lookup($_POST["symbol"]);
            if ($stock === false)
            {
                apologize("Enter valid stock symbol");
            }
            else
            {
                render("quote_result.php", ["title" => "Quote", "symbol" => $stock["symbol"], "name" => $stock["name"], "price" => $stock["price"]]);

            }
        }
    }
    else
    {
        // else render form
        render("buy_form.php", ["title" => "Buy"]);
    }

?>
