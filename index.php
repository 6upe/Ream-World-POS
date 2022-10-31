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
    <script src="bootstrap/jquery.min.js"></script>


    
    <title>Ream World POS</title>

    <style>
        .product-card:hover {
            color: white;
            background-color: #174074;
        }

        /* #saleItem{
            font-family: 'Courier New', Courier, monospace; 
            cursor: pointer;
        } */
    </style>
</head>

<body class="bg-light" style="overflow: hidden;">

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
                <button type="button" class="btn btn-primary btn-lg mx-3" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">System</button>
            </div>
        </div>
    </nav>



    <div class="row">
        <div class="col-lg-7">
            <div class="my-3" align="center">
                <input type="text" style="width: 50%; border-radius: 50px;" class="form-control" id="searchValue"
                    placeholder="Search Product here..." onkeyup="filter()" >
            </div>
            <div class="products">
                <hr>
                <div class="row my-3" style="overflow:scroll; height:450px;" id="cards">

                    <?php
                    for($i = 0; $i < count($productArray); $i++){
                        if($productArray[$i]['productQty'] > 0){
                ?>
                    <div class="product-card card mx-4 my-3"
                        style="width: 13rem; cursor: pointer; box-shadow: 2px 2px 2px 1px rgba(0.1, 0.1, 0.1, 0.1); height: 150px;"
                        align="center" onclick="getProduct(<?php echo $productArray[$i]['productId']?>);">
                        <div class="card-body">
                            <h6 class="card-title" id="productName<?php echo $productArray[$i]['productId']?>">
                                <?php echo $productArray[$i]['productName']?>
                            </h6>
                            K<span class="card-subtitle mb-2 fs-6"
                                id="productUnitPrice<?php echo $productArray[$i]['productId']?>">
                                <?php echo $productArray[$i]['productUnitPrice']?>
                            </span>
                            <hr>
                            Qty Stock:<span class="card-subtitle mb-2"
                                id="productQty<?php echo $productArray[$i]['productId']?>"
                                style="font-size: 15px; font-family: 'Courier New', Courier, monospace;">
                                <?php echo $productArray[$i]['productQty']?>
                            </span>
                        </div>
                    </div>

                    <?php
                        }
                    }
                ?>
                    <script>
                        
                        
                        function filter(){
                            var input, filter, cards, cardContainer, h6, title, i;
                            input = document.getElementById("searchValue");
                            filter = input.value.toUpperCase();
                            cardContainer = document.getElementById("cards");
                            cards = cardContainer.getElementsByClassName("card");
                            for (i = 0; i < cards.length; i++) {
                                title = cards[i].querySelector(".card-body h6.card-title");
                                if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                                    cards[i].style.display = "";
                                } else {
                                    cards[i].style.display = "none";
                                }
                            }
                            

                        }


                        var saleItem = document.getElementById('saleItem');
                        var rowList = document.getElementById('rowList');
                        var saleItemRow1 = '';
                        // var qty = 1;
                        var grandTotal = 0;

                        function getProduct(index) {

                            var name = document.getElementById('productName' + index).innerText;
                            var unitPrice = document.getElementById('productUnitPrice' + index).innerText;
                            var item = document.getElementById('item' + index);
                            var productQuantity = document.getElementById('productQty' + index).innerText;

                            var newProductQuantity = parseInt(productQuantity) - 1;
                            // alert(name + " " + newProductQuantity);
                            productQuantity.innerText += newProductQuantity;


                            var saleItem = document.getElementById('saleItem');
                            var rowList = document.getElementById('rowList');

                            var saleItemRow = '<tr style="font-family: Courier, monospace; cursor: pointer; border-top: 0.5px solid silver;" id="item' + index + '" onclick="clearMe(' + index + ');">' +
                                '<td>' + ' ' + name + '</td>' +
                                '<td id="itemQty' + index + '" > ' + 1 + '</td>' +
                                '<td>' + ' ' + unitPrice + '</td>' +
                                '<td id="itemTotal' + index + '">' + ' ' + (unitPrice * 1) + '</td>' +
                                '</tr>' + ' ';
                            
                            
                            
                            if (((saleItem.innerHTML).toString()).includes(name)) {
                                // alert('table row exists');
                                
                                var itemQty = document.getElementById('itemQty' + index).innerText;
                                var itemNewQty = itemQty;
                                var parsedQty = (parseInt(itemNewQty) + 1);
                                item.remove();
                                saleItem.innerHTML += '<tr style="font-family: Courier, monospace; cursor: pointer; border-top: 0.5px solid silver;" id="item' + index + '" onclick="clearMe(' + index + ');">' +
                                    '<td>' + ' ' + name + '</td>' +
                                    '<td id="itemQty' + index + '" >' + ' ' + parsedQty + '</td>' +
                                    '<td>' + ' ' + unitPrice + '</td>' +
                                    '<td id="itemTotal' + index + '">' + ' ' + (unitPrice * parsedQty) + '</td>' +
                                    '</tr>' + ' ';
                                    saleItemRow1 += ((saleItem.innerHTML).toString());
                                    // alert(saleItemRow1);

                                grandTotal += (unitPrice * 1);
                            } else {
                                // alert('table row does not exists');
                                saleItem.innerHTML += saleItemRow;
                                saleItemRow1 += ((saleItem.innerHTML).toString());
                                // alert(saleItemRow1);

                                grandTotal += (unitPrice * 1);
                            }

                            var grandTotalElement = document.getElementById('grandTotal').textContent = ('K ' + grandTotal).toString();
                        }

                        function clearMe(indexItem) {
                            var item = document.getElementById('item' + indexItem);
                            var saleItem = document.getElementById('saleItem');
                            

                            var name = document.getElementById('productName' + indexItem).innerText;
                            var unitPrice = document.getElementById('productUnitPrice' + indexItem).innerText;
                            
                            
                            var itemQty = document.getElementById('itemQty' + indexItem).innerText;
                            var itemNewQty = itemQty;
                            var parsedQty = (parseInt(itemNewQty) - 1);

                            if (parseInt(itemNewQty) == 1) {
                               
                                item.remove();
                                grandTotal -= unitPrice;
                                
                            } else {
                                
                                item.remove();

                                saleItem.innerHTML += '<tr style="font-family: Courier, monospace; cursor: pointer; border-top: 0.5px solid silver;" id="item' + indexItem + '" onclick="clearMe(' + indexItem + ');">' +
                                    '<td>' + ' ' + name + '</td>' +
                                    '<td id="itemQty' + indexItem + '" >' + ' ' + parsedQty + '</td>' +
                                    '<td>' + ' ' + unitPrice + '</td>' +
                                    '<td id="itemTotal' + indexItem + '">' + ' ' + (unitPrice * parsedQty) + '</td>' +
                                    '</tr>' + ' ';

                                grandTotal -= (unitPrice * 1);

                            }

                            var grandTotalElement = document.getElementById('grandTotal').textContent = ('K ' + grandTotal).toString();
                        }

                        function display(){
                            var tableRows = document.getElementById('saleItem').innerHTML;
                            var saleTotal = document.getElementById('grandTotal').innerHTML;
                            // alert();
                            document.getElementById('rowList').innerHTML = tableRows;
                            document.getElementById('salesTotal').innerHTML = saleTotal;
                        }
                    </script>

                </div>
            </div>
        </div>

        <div class=" row col-lg-5 d-flex justify-content-center my-4" style="overflow:scroll; height:500px;"
            style="border-left: 1px solid rgb(222, 222, 222); height: 90%;">

            <div class="card border-outline-secondary mb-3" style="width: 85%;">
                <div class="card-header bg-transparent border-secondary" align="center">
                    <img src="ream world logo.png" width="100px" alt="logo"> <br>
                    <b>Ream World General Dealers</b> <br>
                    <span class="lead" style="font-size: 10px;">Specialized in computer repairs, computer software
                        maintenance, printer and copy machine repairs, stationary, computer services & internet
                        services.</span>
                </div>
                <div class="card-body" style="overflow-y: scroll; height: 200px;">
                    <table class="table table-hover text-center">
                        <thead>
                            <td class="fw-bold">Description</td>
                            <td class="fw-bold">Qty</td>
                            <td class="fw-bold">Unit Price</td>
                            <td class="fw-bold">Total</td>
                        </thead>
                   
                        <tbody id="saleItem">

                        </tbody>
                        

                        <!-- <tr>
                            <td>Cello tape</td>
                            <td>2</td>
                            <td>13.00</td>
                            <td>26.00</td>
                        </tr> -->

                    </table>
                </div>
                <div class="card-footer bg-transparent border-secondary sticky-top" align="center">
                    <button class="btn btn-primary my-3 btn-lg" style="float: left;" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                        aria-controls="offcanvasRight"  onclick="display();">Record Sales</button>
                        <button class="fs-1 fw-bold my-3 "
                        style="float: right; border: none; color: #174074; background: white;"
                        id="grandTotal">K0.00</button>

                </div>
            </div>

        </div>
    </div>



    <!-- off canvas record sales -->

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">RECORD SALES</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body my-5">
      
            <form action="index.php" method="post">
                <textarea class="form-control" style="display: none;" aria-label="With textarea" name="sales"  id="rowList"></textarea>
                <textarea class="form-control" style="display: none;" aria-label="With textarea" name="total"  id="salesTotal"></textarea>
 <br>
                <label for="date" class="form-label text-success text-muted my-2">Enter Record date</label>
                <input type="date" class="form-control  my-2" name="date" required>
                <label for="note" class="form-label text-success text-muted  my-2">Notes about this record (*optional)</label>
                <input type="text" class="form-control  my-2" name="notes"> <br>
                <input type="submit" class="btn btn-outline-warning  my-3" name="saveRecord" value="Save Record">

            </form>

            
        </div>
    </div>



    <!-- System Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel" style="color:#174074;">System Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed  fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne" style="color:#174074;">
                                    BACK UP RECORDS TO DATABASE
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body" align="center">
                                    <div class="progress mx-2 my-4">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                            role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 75%"></div>
                                    </div>
                                    <div class="button-group my-4">
                                        <button class="btn btn-success" style="width: 60%; border-radius: 50px;">Back Up
                                            Now!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed fw-bold " type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo" style="color:#174074;">
                                    UPDATE SYSTEM
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body" align="center">
                                    <div class="mb-3 mx-5">
                                        <label for="formFile" class="form-label">Upload SQLite Record Database</label>
                                        <input class="form-control" type="file" id="formFile">
                                    </div>
                                    <div class="progress mx-2 my-4">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                            role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 75%"></div>
                                    </div>
                                    <div class="button-group my-4">
                                        <button class="btn btn-success" style="width: 60%; border-radius: 50px;">Update
                                            System Now!</button>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed  fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                    aria-expanded="false" aria-controls="flush-collapseThree" style="color:#174074;">
                                    OTHER SYSTEM FEATURES
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body" align="center">
                                    <div class="card border-outline-secondary mb-3" style="width: 85%;">
                                        <div class="card-header bg-transparent border-secondary" align="center">
                                            <img src="piko.png" width="100px" alt="logo"> <br>
                                            <b>Piko Tech Solutions</b> <br>

                                        </div>
                                        <div class="card-body">
                                            <small>Piko Tech Solutions is an Information Technology company on the
                                                Copperbelt, Zambia intended to cater corporate and domestic clients, we
                                                intend to offer computer services and trainings to our clients, as well
                                                as other services in our line of Business such as web development,
                                                Graphics Designing, Photography/Videography, Network
                                                Design/Implementation, Mobile app and Desktop Software development.
                                            </small>

                                        </div>
                                        <div class="card-footer bg-transparent border-secondary" align="center">
                                            <button class="btn btn-primary my-3">Contact Us Now!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer my-3">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="windowClose()">Log Out</button>
                </div>
                <script language="javascript" type="text/javascript">
                    function windowClose() {
                    window.open('','_parent','');
                    window.close();
                    }
                </script>
            </div>
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
    </script>

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

</body>

</html>