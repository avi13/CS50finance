<?php

    // configuration
    require("../includes/config.php"); 
    
    $rows = query("SELECT symbol, shares FROM stocks_owned WHERE id=?", $_SESSION["id"]);
    $cash = query("SELECT cash FROM users WHERE id=?", $_SESSION["id"]);

    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
            ];
        }
    }
    // render portfolio
    render("portfolio.php", ["cash"=>$cash, "positions"=>$positions, "title" => "Portfolio"]);

?>
