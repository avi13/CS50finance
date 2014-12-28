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
            $stockname = strtoupper($_POST["symbol"]);
            $stock = lookup($stockname);
            if (!(preg_match("/^\d+$/", $_POST["quantity"])))
            {
                apologize("Please enter positive integers only");
            }
            else if ($stock === false)
            {
                apologize("Enter valid stock symbol");
            }
            else
            {
                $user = query("SELECT username, cash FROM users WHERE id = ?", $_SESSION["id"]);
                $cash = $user[0]["cash"];
                if ($cash < ($_POST["quantity"] * $stock["price"]))
                {
                    apologize("Ooops! Not enough money");
                }
                else
                {
                    $buysuccess = query("INSERT INTO stocks_owned (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)",$_SESSION["id"], $stockname, $_POST["quantity"]);
                    if ($buysuccess === false)
                    {
                        apologize("Buying failed. Please try again later");
                    }
                    else
                    {
                        query("UPDATE users SET cash=cash-? WHERE id=?",($_POST["quantity"] * $stock["price"]),$_SESSION["id"]);
                    }
                    redirect("index.php");
                    
                }
            }
        }
    }
    else
    {
        // else render form
        render("buy_form.php", ["title" => "Buy"]);
    }

?>
