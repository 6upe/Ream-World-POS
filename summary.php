<?php
    include 'db_connection.php'
?>

<head>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="bootstrap/jquery.min.js"></script>
</head>

<body class="bg-light" style="overflow: hidden;">

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

    
</body>

</html>