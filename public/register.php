<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        if(empty($_POST["username"]) || empty($_POST["password"]))
        {
            apologize("Please enter username and password");
        }
        elseif(empty($_POST["confirmation"]))
        {
            apologize("Please retype password");
        }
        elseif($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords do not match!");
        }
        else
        {
            $result = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
            if ($result === false)
            {
                apology("FAILED!!");
            }
            else 
            {
                $rows = query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                $_SESSION["id"] = $id;
                redirect("index.php");
            }
        }
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
