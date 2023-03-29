<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produse</title>

</head>
<body>
    <?php
        require_once('includes/dbh-inc.php');
        require_once('objects/produs.php');
        require_once('objects/produse_imagine.php');
        require_once('objects/cart_items.php');
    ?>

    <?php
        $produs = new Produs($db);
        $produs_imagine = new produsImagine($db);
        $cart_item = new cartItem($db);

        //action for custom messages
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        //for pagination purposes
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $records_per_page = 6;
        $from_record_num = ($records_per_page * $page) - $records_per_page; //calculate the query limit clause
    
        $page_title = "Produse";

        require_once ('header.php');

        //read all products in the database
        $stmt = $produs ->read($from_record_num,$records_per_page);

        //count number of retrieved products
        $num = $stmt->rowCount();

        //if products retrieved were more than  0
        if($num>0)
        {
            $page_url = "produse.php";
            $total_rows = $produs ->count();

            //show products
            include_once "read_products_template.php";
        }

        //tell the user if there's no products in the databse
        else{
            echo "<div class='col-md-12'>
            <div class='alert alert-danger'>No products found.</div>
            </div>";
        }
        

    ?>


















    <script src="JavaScript/header-footer.js"></script>

</body>
</html>