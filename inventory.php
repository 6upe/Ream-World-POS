<?php
    include 'db_connection.php'

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/bootstrap.min.js"></script>

    <title>Ream World POS</title>
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .product-card:hover {
            color: white;
            background-color: #174074;
        }
    </style>
</head>

<body class="bg-light" style="overflow: hidden;" onload="//change_product_to_add();">
    <nav class="navbar bg-light sticky-top">
        <div class="container-fluid  mx-2">
            <a class="navbar-brand" href="index.php">
                <img src="ream world logo.png" alt="" width="75" height="100">
                <span class="fs-3 fw-bold lead" style="color: #174074;">REAM WORLD - POINT OF SALE SYSTEM</span>
            </a>
            <div class="button-group">
                <button class="btn btn-outline-primary btn-lg mx-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Stock Summary</button>

                <button class="btn btn-outline-primary btn-lg mx-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Sales Records</button>

                <a href="inventory.php" class="btn btn-outline-primary btn-lg mx-2">Inventory</a>
                <a class="btn btn-primary btn-lg mx-3" href="index.php" >Dashboard</a>
            </div>
        </div>
    </nav>



    <div class="row">

        <div class="col-lg-8 mx-4 my-5">

            <div>
                <div id="add">
                    <div class="my-4 lead text-muted text-center fw-bold">

                        ADD PRODUCT FROM HERE

                    </div>
                    <form action="inventory.php" class="my-5 d-flex justify-content-center" id="addProductForm" method="post">
                        <div class="form-group" style="width: 500px;">
                            <label for="product-name" class="form-label lead">Product Name</label>
                            <input type="text" name="product-name" class="form-control" required>
                            <label for="product-unit-price" class="form-label lead my-3">Unit Price</label>
                            <input type="text" name="product-unit-price"  class="form-control" required>
                            <label for="product-name" class="form-label lead my-3">Quantity in Stock</label>
                            <input type="number"   name="product-quantity" class="form-control" required>
                            <div align="center">
                                <input type="submit" style="width: 75%; border-radius: 50px;"
                                    class="btn btn-success btn-lg my-3" name="addProductBtn" value="Add Product">
                            </div>

                        </div>

                    </form>

                </div>

                <div id="edit" style="display: none;">

                <div class="my-4 lead text-muted text-center fw-bold">

                    EDIT PRODUCT FROM HERE

                    </div>
                    <form action="inventory.php" class="my-5 d-flex justify-content-center" id="addProductForm" method="post">
                    <div class="form-group" style="width: 500px;">
                        <label for="product-name" class="form-label lead">Product Name <small class="text-warning fw-bold">(case sensitive*)</small></label>
                        <input type="text" name="edit-name" class="form-control" required>
                        <label for="product-unit-price" class="form-label lead my-3">Unit Price</label>
                        <input type="text" name="edit-unit-price"  class="form-control" required>
                        <label for="product-name" class="form-label lead my-3">Quantity in Stock</label>
                        <input type="number"   name="edit-qty" class="form-control" required>
                        <div align="center">
                            <input type="submit" style="width: 75%; border-radius: 50px;"
                                class="btn btn-warning btn-lg my-3" name="editProductBtn" value="Update Product">
                        </div>

                    </div>

                    </form>

                </div>

                <div id="delete" style="display: none;">
                <div class="my-4 lead text-muted text-center fw-bold">

                    DELETE PRODUCT FROM HERE

                    </div>
                    <form action="inventory.php" class="my-5 d-flex justify-content-center" id="addProductForm" method="post">
                    <div class="form-group" style="width: 500px;">
                        <label for="product-name" class="form-label lead">Product Name <small class="text-warning fw-bold">(case sensitive*)</small> </label>
                        <input type="text" name="delete-name" class="form-control" required>
                        
                        <div align="center">
                            <input type="submit" style="width: 75%; border-radius: 50px;"
                                class="btn btn-danger btn-lg my-3" name="deleteProductBtn" value="Delete Product">
                        </div>

                    </div>

                    </form>

                    </form>
                </div>

            </div>

        </div>

        <div class="col-lg-3 my-5">
            <div class="d-grid gap-2 col-8 mx-auto">
                <button onclick="change_product_to_add();" id="add-btn" class="btn btn-outline-primary btn-lg my-5"
                    type="button">Add
                    Product</button>
                <button onclick="change_product_to_edit();" id="edit-btn" class="btn btn-outline-primary btn-lg"
                    type="button">Edit
                    Product</button>
                <button onclick="change_product_to_delete();" id="delete-btn"
                    class="btn btn-outline-primary btn-lg my-5" type="button">Delete Product</button>

            </div>
        </div>
    </div>

    

    <!-- SALES RECORDS -->
    <div style="height: 720px; " class="offcanvas offcanvas-top " tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header text-center mx-5" style="box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);">
            <span class=" text-muted fs-1 fw-bold">SALES RECORDS</span>
            <div style="width: 40%;" align="center">
                <label for="date" class="form-label text-success text-muted ">Filter Records</label>
                <input type="date" class="form-control " name="date" required>
            </div>
                
            <button class="btn btn-outline-secondary btn-lg" style="float: right;" onclick="printPageArea('salesRecords')">Print and Share</button>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" id="salesRecords">

                
                    <table class="table table-hover text-center">
                    <thead>
                        <td class="fw-bold">Date</td>
                        <td class="fw-bold">Items Sold</td>
                        <td class="fw-bold">Grand Total</td>
                        <td class="fw-bold">Comments</td>
                    </thead>
              
                    <tbody id="salesRecords">
                    <?php
                    for($i = 0; $i < count($salesArray); $i++){
                ?>
                <tr>
                    <td><?php echo $salesArray[$i]['date']?></td>
                    <td>
                        <table  class="table table-hover text-center" style="pointer-events:none;">
                        <tbody id="saleItem">
                            <?php echo $salesArray[$i]['daily_sales']?>
                        </tbody>
                        </table>
                        
                    </td>
                    <td><?php echo $salesArray[$i]['total']?></td>
                    <td><?php echo $salesArray[$i]['notes']?></td>
                    </tr>
                    <?php
                    }
                ?>
                    </tbody>

                </table>

        </div> 
    </div>

    <!-- VIEW SUMMARY -->

    <div style="height: 720px; " class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header text-center mx-5" style="box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);">
            <span class=" text-muted fs-1 fw-bold">STOCK SUMMARY</span>
            <span class=" text-warning fs-3 fw-bold" style="float: right; ">STOCK TOTAL : K<?php echo $stockTotal?> </span>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="width: 1300px;" align="center">
        <table class="table table-hover mx-5">
  <thead>
    <tr align="center">
      <th scope="col">Product Name</th>
      <th scope="col">Quantity In Stock </th>
      <th class="col">Unit Price</th>
      <th scope="col">Total Cost In Stock</th>
    </tr>
  </thead>
  <tbody align="center">
                    <?php
                    for($i = 0; $i < count($productArray); $i++){
                ?>
                <tr>
                    <td><?php echo $productArray[$i]['productName']?></td>
                    <td><?php echo $productArray[$i]['productQty']?></td>
                    <td>K <?php echo $productArray[$i]['productUnitPrice']?></td>
                    <td>K <?php echo ($productArray[$i]['productQty'] * $productArray[$i]['productUnitPrice']) ?></td>
                    </tr>
                    
                    <?php
                    }
                ?>
                    </tbody>
</table>
        </div>
    </div>

    <script>
        function printPageArea(areaID){
            var printContent = document.getElementById(areaID);
            var WinPrint = window.open('', '', 'width=1080,height=720');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            // WinPrint.close();       
        }

        const addForm = document.querySelector('#add');
        const editForm = document.querySelector('#edit');
        const deleteForm = document.querySelector('#delete');
        const addBtn = document.querySelector('#add-btn');
        const editBtn = document.querySelector('#edit-btn');
        const deleteBtn = document.querySelector('#delete-btn');

        function change_product_to_add() {
            editForm.setAttribute('style', 'display: none;');
            deleteForm.setAttribute('style', 'display: none;');
            addForm.setAttribute('style', 'display: block;');

            addBtn.classList.add('active');
            editBtn.classList.remove('active');
            deleteBtn.classList.remove('active');
        }
        function change_product_to_edit() {
            editForm.setAttribute('style', 'display: block;');
            deleteForm.setAttribute('style', 'display: none;');
            addForm.setAttribute('style', 'display: none;');

            addBtn.classList.remove('active');
            editBtn.classList.add('active');
            deleteBtn.classList.remove('active');

        }
        function change_product_to_delete() {
            editForm.setAttribute('style', 'display: none;');
            deleteForm.setAttribute('style', 'display: block;');
            addForm.setAttribute('style', 'display: none;');

            addBtn.classList.remove('active');
            editBtn.classList.remove('active');
            deleteBtn.classList.add('active');

        }

    </script>

</body>

</html>