<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Shopping Card</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/55fb307a8a.js" crossorigin="anonymous"></script>


  </head>
  <body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark" style="margin-bottom:15px;">
  <!-- Brand -->
  <a class="navbar-brand" href="#"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Mobil shop</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link active" href="#">Produktet</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Kategoria</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="checkout.php">Blej</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i><span id="cart-item" class="badge badge-danger"></span></a>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">

  <div id="message"> </div>
  <div class="row">
            <div class="col-lg-3">
              <h5>Filtro Produktet</h5>
              <hr>
              <h6 class="text-info">Cmimi</h6>
              <input type="hidden" id="hidden_minimum_price " value="0">
              <input type="hidden" id="hidden_maximum_price" value="1000">
              <p id="price_show">0-1500</p>
              <div id="price_range"></div><br>
              <h6 class="text-info">Selekto Prodhuesin</h6>
              <ul class="list-group">
                <?php
                  include 'C:\xampp\htdocs\shopping\config.php';
                  $stmt=$conn->prepare("SELECT DISTINCT brand FROM product ORDER BY brand");
                  $stmt->execute();
                  $result=$stmt->get_result();
                  while($row=$result->fetch_assoc()){
                 ?>
                 <li class="list-group-item">
                   <div class="form-check">
                     <label class="form-check-label">
                       <input type="checkbox" class="form-check-input product_check" value="<?=
                       $row['brand']; ?>" id="brand"><?= $row['brand']; ?>
                     </label>
                   </div>
                 </li>
              <?php } ?>
            </ul><br>
              <h6 class="text-info">Selekto Kapacitetin</h6>
            <ul class="list-group">
              <?php
                $sql = "SELECT DISTINCT storage FROM product ORDER BY storage desc";
                $result = $conn->query($sql);
                while($row=$result->fetch_assoc()){
               ?>
               <li class="list-group-item">
                 <div class="form-check">
                   <label class="form-check-label">
                     <input type="checkbox" class="form-check-input product_check" value="<?=
                     $row['storage']; ?>" id="storage"><?= $row['storage']; ?>
                   </label>
                 </div>
               </li>
            <?php } ?>
            </ul>


            </div>


    <div class="col-lg-9">
        <h5 class="text-center" id="textChange">Produktet</h5>
        <hr>
        <div class="text-center">
          <img src="../img/loader.gif" id="loader" width="200" style="display:none;" >
        </div>
      <div class="row" id="result">
      <?php
        include 'C:\xampp\htdocs\shopping\config.php';
        $stmt=$conn->prepare("SELECT * FROM product");
        $stmt->execute();
        $result=$stmt->get_result();
        while($row=$result->fetch_assoc()):
       ?>
       <div class="col-md-3 mb-2">
         <div class="card-deck">
           <div class="card p-2 border-secondary mb-2">
             <img src="<?= $row['product_image'] ?>" height="300" class="card-img-top">
             <div class="card-body p-1">
               <h5 class="card-title text-center text-info"><?= $row['product_name'] ?> </h5>
               <h5 class="card-text text-center text-danger"><i class="fas fa-euro-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2) ?> </h5>
             </div>
             <div class="card-footer p-1">
               <form action="index.html"class="form-submit">
                 <input type="hidden" class="pid" value="<?= $row['idproduct'] ?> ">
                 <input type="hidden" class="pname" value="<?= $row['product_name'] ?> ">
                 <input type="hidden" class="pprice" value="<?= $row['product_price'] ?> ">
                 <input type="hidden" class="pimage" value="<?= $row['product_image'] ?> ">
                 <input type="hidden" class="pcode" value="<?= $row['product_code'] ?> ">
                 <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Shto ne shporte</button>
               </form>
             </div>
           </div>
         </div>
       </div>
     <?php endwhile; ?>
     </div>
    </div>
    </div>
</div>
    <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $(".addItemBtn").click(function(e){
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {pid:pid, pname:pname, pprice:pprice, pimage:pimage, pcode: pcode},
        success: function(response){
          $("#message").html(response);
          window.scrollTo(0,0);
          load_cart_item_number();
        }
      });
    });

    load_cart_item_number();

    function load_cart_item_number(){
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {cartItem: "cart_item"},
        success: function(response){
          $("#cart-item").html(response);
        }
      });
    }
  });

</script>
<script type="text/javascript">

         $(document).ready(function(){

           $(".product_check").click(function(){
             $("#loader").show();

             var actionn = 'data';
             var brand = get_filter_text('brand');
             var storage = get_filter_text('storage');
             var minimum_price = $('#hidden_minimum_price').val();
             var maximum_price = $('#hidden_maximum_price').val();
             
             $.ajax({
                 url: 'action.php',
                 method: 'POST',
                 data:{actionn:actionn,brand:brand,storage:storage,minimum_price:minimum_price,maximum_price:maximum_price},
                 success:function(response){
                   $("#result").html(response);
                   $("#loader").hide();
                   }
             });

           });

           function get_filter_text(text_id){
             var filterData = [];
             $('#'+text_id+':checked').each(function(){
               filterData.push($(this).val());

             });
               return filterData;
           }

         });
</script><!-- -->
  </body>
</html>
