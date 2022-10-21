<div id="cart-panel">
    <span id="exit-cart">&times;</span>
    <section id="cart-section" class="h-100">
      <?php if(isset($_SESSION['logged'])){
        $adres = "summary_before_payment.php";
      }else{
        $adres= "login_page.php?payment";
      }
      
      
      ?>
<form id="cartform" method="POST" action="/projekt/<?php echo $adres?>">
      <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-10">

            <div class="d-flex justify-content-between align-items-center mb-4">
              <h3 class="fw-normal mb-0 text-black">Twój koszyk</h3>

            </div>
            <div class="item_empty">

            </div>
            <div class="item">
            
            </div>
            

         
            


            



            <div class="card cart-buttons">
              <div class="d-grid gap-2 p-4 butn-grid">
                
                <button type="button" target="exampleModal" class="pay btn btn-warning btn-lg">Kup (<span class="total_price">0</span>zł)</button>
                
                <button type="submit" hidden></button>
               
              </div>
            </div>

          </div>
        </div>
      </div>
      </form>
    </section>
  </div>
 