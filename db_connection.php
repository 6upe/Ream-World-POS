<?php
    $con = new PDO("sqlite:reamworld_records.db");
    if($con){
        //echo 'Database Connected';
        
    }else{
        echo 'Database NOT Connected';
    }
    // $result = $con->query('select * from products');

?>

<?php
                        $name = $unitPrice = $qty = '';
                        $productArray = [];

                        if(isset($_POST['addProductBtn'])){
                            $name = $_POST['product-name'];
                            $unitPrice = $_POST['product-unit-price'];
                            $qty = $_POST['product-quantity'];

                            $InsertQuery = "insert into products (productName, productUnitPrice, productQty) values('$name','$unitPrice','$qty')";
                        
                        $con->query($InsertQuery);
                        echo $name.' Was added to Database!';

                        }
                        
                        $showQuery = $con->prepare("select * from products");
                        $showQuery->execute();
                        
                        $productArray = $showQuery->fetchAll(PDO::FETCH_ASSOC);
                        
                        $stockTotal = 0;
                        for($i = 0; $i < count($productArray); $i++){
                            $stockTotal += ($productArray[$i]['productQty'] * $productArray[$i]['productUnitPrice']);
                        }
                        // echo '<pre>';
                        // print_r($productArray);
                        // echo '</pre>';

                        // for($i = 0; $i < 6; $i++){
                        //     echo $productArray[$i]['productName'];
                        for($i = 0; $i < count($productArray); $i++){
                            $newProductId = $productArray[$i]['productId'];
                                if($productArray[$i]['productQty'] == 0){
                                    $updateSaleQuery = $con->prepare("DELETE FROM products  WHERE productId = '$newProductId'");
                                    $updateSaleQuery->execute();
                                }
                            }
?>

<?php
    if(isset($_POST['editProductBtn'])){
        $editName = $_POST['edit-name'];
        $editUnitPrice = $_POST['edit-unit-price'];
        $editQty = $_POST['edit-qty'];

        $updateQuery = "UPDATE products SET productUnitPrice = '$editUnitPrice', productQty = '$editQty' WHERE productName = '$editName'";

                        
        if($con->query($updateQuery)){
            echo $editName.' Was updated to Database!';
            header('Location: inventory.php');
        }else{
            header('Location: inventory.php');
            echo $editName.' Was Not Found';
            
        }

       
    }

    if(isset($_POST['deleteProductBtn'])){
        $deleteName = $_POST['delete-name'];

        $updateQuery = "DELETE FROM products WHERE productName = '$deleteName'";

                        
        if($con->query($updateQuery)){
            echo $deleteName.' Deleted from the Database!';
            header('Location: inventory.php');
        }else{
            header('Location: inventory.php');
            echo $deleteName.' Was Not Found';
            
        }

       
    }
?>



<?php
    $date = $sales = $notes = $total = '';
    if(isset($_POST['saveRecord'])){
        $date = $_POST['date'];
        $sales = $_POST['sales'];
        $notes = $_POST['notes'];
        $total = $_POST['total'];

        $con->query("INSERT INTO sales_records VALUES('$date','$sales','$total','$notes')");

        

        // $productName = $productArray[$i]['productName'];
        //echo strip_tags($sales) . '<br>';
        
        //iterate through the $productArray
         $salesString = strip_tags($sales);
        for($i = 0; $i < count($productArray); $i++){  
            $newQuantity = '';
            $newNewQuantity = 0;
            $newProductId = (int)$productArray[$i]['productId'];     
            $position = strpos($salesString , $productArray[$i]['productName'], 0);
            if($position !== false){
                if($salesString[$position + strlen($productArray[$i]['productName']) + 2] == ' '){
                        $newQuantity = $salesString[$position + strlen($productArray[$i]['productName']) + 1];
                }else if($salesString[$position + strlen($productArray[$i]['productName']) + 3] == ' '){
                    $newQuantity = $salesString[$position + strlen($productArray[$i]['productName']) + 1] . $salesString[$position + strlen($productArray[$i]['productName']) + 2];
                }else{
                    $newQuantity = $salesString[$position + strlen($productArray[$i]['productName']) + 1] . $salesString[$position + strlen($productArray[$i]['productName']) + 2] . $salesString[$position + strlen($productArray[$i]['productName']) + 3];
                }

                $newNewQuantity = (int)$productArray[$i]['productQty'] - (int)$newQuantity;

                // if($salesString[$position + strlen($productArray[$i]['productName']) + 4] == ' ')
                //echo $productArray[$i]['productName'] . ' Has ' . $newQuantity . '<br>';
                if($productArray[$i]['productId'] == 0){
                    $updateSaleQuery = $con->prepare("DELETE FROM products  WHERE productId = '$newProductId'");
                    $updateSaleQuery->execute();
                }else{
                    $updateSaleQuery = $con->prepare("UPDATE products SET productQty = '$newNewQuantity' WHERE productId = '$newProductId'");
                    $updateSaleQuery->execute();
                }
                
                header('Location: index.php');
            }
        }
        //if $productName is in Sales
        //get Number after the $productName
        //subtract from #qty and update database
        
        echo $notes.' Was added to Database!';
        //echo $sales;
        // echo '<pre>';
        // print_r($_POST['sales']);
        // echo '</pre>';
}
?>



<?php
                $salesQuery = $con->prepare("select * from sales_records");
                $salesQuery->execute();
                $salesArray = $salesQuery->fetchAll(PDO::FETCH_ASSOC);
                // echo '<pre>';
                // print_r($salesArray);
                // echo '</pre>';
                
 ?>
