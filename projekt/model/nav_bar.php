
<?php
  require($_SERVER['DOCUMENT_ROOT']."/projekt/controller/connection.php");
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/projekt/">Sklep meblowy</a>
      <div class="form-outline mx-auto  col-lg-7 col-md-5 col-sm-5">
     <?php
      $query = "select distinct produkty.nazwa as 'nazwa' from zdjecia join produkty on produkty.produkt_id = zdjecia.produkt_id";
      $result = mysqli_query($connection, $query);
      $names = [];
      while($rows = mysqli_fetch_assoc($result)){
        array_push($names, $rows['nazwa']);
      }

     ?>
     <script>
       function search(){
          var names = <?php echo json_encode($names); ?>;
          let term = $("#search-form").val();
          let hints = names.filter(item => item.toLowerCase().indexOf(term) > -1);

          if(hints.length > 0){
            $(".search-items-dropdown").addClass("show")
            $(".search-items-dropdown").empty()
            for(i = 0; i < hints.length; i++){
              $(".search-items-dropdown").append('<li><a class="dropdown-item" href="/projekt/items/item_page.php?name='+hints[i]+'">'+hints[i]+'</a></li>')
            }
          }
       }
       


     </script>
      <input type="search" id="search-form" oninput="search()" class="form-control" placeholder="Wyszukaj produkt" aria-label="Search" />
      <script>  
 
        $("#search-form").focusout(function(){
          setTimeout(function() {$(".search-items-dropdown").removeClass("show")},100)
        })
       </script>
      <ul class="dropdown-menu search-items-dropdown">


      </ul>

      </div>
      <button class="navbar-toggler my-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">

        <ul class="navbar-nav ms-auto px-4">
        
          <li class="nav-item px-2">
            <?php 
              if(isset($_SESSION["logged"])){
                if(isset($_SESSION["admin"]) && $_SESSION["admin"] == "1"){
                  echo "<li class=\"nav-item dropdown\">
                  <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                    ".$_SESSION["logged"]." ADMIN
                  </a>
                  <ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                    <li><a class=\"dropdown-item\" href=\"/projekt/products_admin.php?table=products\">Produkty</a></li>
                    <li><a class=\"dropdown-item\" href=\"/projekt/orders_admin.php?table=orders\">Zamówienia</a></li>
                    <li><a class=\"dropdown-item\" href=\"/projekt/users_admin.php?table=users\">Użytkownicy</a></li>
                    <li><hr class=\"dropdown-divider\"></li>
                    <li><a class=\"dropdown-item\" href=\"/projekt/controller/logout.php\">Wyloguj</a></li>
                  </ul>
              </li>";
                }else{
                  echo "<li class=\"nav-item dropdown\">
                  <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                    ".$_SESSION["logged"]."
                  </a>
                  <ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                    <li><a class=\"dropdown-item\" href=\"/projekt/user_panel.php\">Dane</a></li>
                    <li><a class=\"dropdown-item\" href=\"/projekt/user_orders.php\">Zamówienia</a></li>
                    <li><hr class=\"dropdown-divider\"></li>
                    <li><a class=\"dropdown-item\" href=\"/projekt/controller/logout.php\">Wyloguj</a></li>
                  </ul>
              </li>";
                }
                echo '<input type="hidden" id = "user_email_loged" value = "'.$_SESSION["cookie_email"].'">';
              }else{
                echo '<input type="hidden" id = "user_email_loged" value = "unloged">';

                echo "<div><a class=\"nav-link active hover\" aria-current=\"page\" href=\"/projekt/login_page.php\">Zaloguj</a></div>";
              }
            ?>
            
          </li>
          <li class="nav-item px-2">
            <a class="nav-link active" href="/projekt/katalog.php">Katalog</a>
          </li>
          <li class="nav-item px-2">
            <button type="button" class="btn btn-primary position-relative" id="cart">
              Koszyk
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                0
              </span>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>