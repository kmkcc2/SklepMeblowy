let items = []
let total_price = 0;
function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}
var email = ""

window.onload = function(){
      

  email = $("#user_email_loged").val()

  if(email == "unloged") {
    email = "cart";
  }else{
    email = "cart"+email
  }
    try{
      items = JSON.parse(getCookie(email))
    }catch(e){
    }

    
    

    items.forEach(item => {
      addItemToCart(item[0], item[1], item[2], item[3], item[4], item[5])

    });


    var count = $(".item").children().length;
    if (count < 1){
      $(".item_empty").append(
        '<div class="col-sm-12 empty-cart-cls text-center">'+
          '<img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">'+
          '<h3 class="text-white"><strong>Twój koszyk jest pusty!</strong></h3>'
      )
      $(".cart-buttons").css("display","none")
    }else{
      $(".cart-buttons").css("display","block")
      $(".item_empty").children().remove();
    }
    $(".badge").html(count)

    $("#cart").click(function(){
        $("#cart-panel").css("display","block")
        $("#cart-panel").animate({width: "100vw"}, 500, function(){
            $("#cart-section").fadeIn("fast"); 
        })
        $("body").css("overflow-y","hidden")
    })
    $("#exit-cart").click(function(){
        $("#cart-section").fadeOut("fast");
        $("#cart-panel").animate({width: "0"}, 500, function(){
            $("#cart-panel").css("display","none")
        })
        $("body").css("overflow-y","auto")

    })

    


    $("#add_to_cart").click(function(){
        let number_of_items = $("#inputQuantity").val();
        let color = ""
        let material = $("#material-select option:selected").val()
        if($(".btn-check:checked").val() == null){
          color = "czarny"
        }else{
          color = $(".btn-check:checked").val();
        }

        let iddiv = $('#product_id').text()
        let idarr = iddiv.split(" ")
        let id = idarr[1]
        id = id.replace(/\s/g, '');

        let name = $("#name").text();
        let price = $("#price").text();

        
        addItemToCart(id, number_of_items, price, name, color, material)
        item = [id, number_of_items, price, name, color, material]
        let find = false
        for(i = 0; i < items.length;i++){
      
            if(items[i][0] == id && items[i][4] == color && items[i][5] == material){
              items[i][1] = parseInt(items[i][1]) + parseInt(number_of_items);
              find = true;
            }
        }
        if(items.length == 0 || find == false){
          items.push(item)
        }
        
        document.cookie = email+'='+JSON.stringify(items)+'; expires=14; path=/';

        var count = $(".item").children().length;
        $(".badge").html(count)

        location.reload();
    })
    $('body').on('click','.quantity',function(){
      let quan = $(this).val();
      
      
                

    })
    $('body').on('click','.del_btn',function(){
      var id = $(this).attr("attr")
      $(".el"+id).remove()
      var count = $(".item").children().length;
        $(".badge").html(count)

        items = items.slice(0)
        items.splice(id, 1);
                
        document.cookie = email+'='+JSON.stringify(items)+'; expires=14; path=/';

        location.reload();
    })
    $('body').on('click','.pay',function(){
      let isExecuted = confirm("Czy decydujesz się na zakup z obowiązkiem zapłaty?");
      if (isExecuted) {
        $("#cartform").submit();
      }
    })
    $('body').on('click','.prev-arrow',function(){
      let fotonum = $(".visible").attr("foto");
      fotonum = parseInt(fotonum)
      fotonum -= 1;
      if(fotonum < 0 ) fotonum = 0
      $(".visible").addClass("display-none")
      $(".visible").removeClass("visible")

      $(".card-img-top[foto=\""+fotonum+"\"]").removeClass("display-none")
      $(".card-img-top[foto=\""+fotonum+"\"]").addClass("visible")
      }
    )
    $('body').on('click','.next-arrow',function(){
      let fotonum = $(".visible").attr("foto");
      let max = $(".next-arrow").attr("max");
      max = parseInt(max);

      fotonum = parseInt(fotonum)
      fotonum += 1;
      if(fotonum == max) fotonum = max-1

      $(".visible").addClass("display-none")
      $(".visible").removeClass("visible")
      $(".card-img-top[foto=\""+fotonum+"\"]").removeClass("display-none")
      $(".card-img-top[foto=\""+fotonum+"\"]").addClass("visible")
      }
    )
   
    $('body').on('click','.add_new_record_products',function(){
      let count = $("#admin_count").val();
      $(".products_tbody").append("<tr>"+
      "<td></td>"+
      "<td><input type=\"text\" name=\"id_produktu"+count+"\" ></input></td>"+
      "<td><input type=\"text\" name=\"nazwa"+count+"\" ></input></td>"+
      "<td><input type=\"text\" name=\"dostepne_sztuki"+count+"\" ></input></td>"+
      "<td><input type=\"text\" name=\"cena"+count+"\" ></input></td>"+
      "<td><input type=\"text\" name=\"waga"+count+"\" ></input></td>"+
      "<td><input type=\"checkbox\" name=\"dost"+count+"\" checked></input></td>"+
      
  "</tr>")
  $("#admin_count").val(parseInt(count) + 1)

  
    })
    $('body').on('click','.add_new_record_orders',function(){
      $(".products_tbody").append("<tr>"+
      "<td><input disabled type=\"text\" name=\"zamowienie_id\" ></input></td>"+
      "<td><input type=\"text\" name=\"data_zamowienia\" ></input></td>"+
      "<td><input type=\"text\" name=\"id_uzyt\" ></input></td>"+
      "<td><input type=\"text\" name=\"adres\" ></input></td>"+
      "<td><input type=\"text\" name=\"status\" ></input></td>"+
      "<td><input type=\"text\" name=\"dostawa\" ></input></td>"+
  "</tr>")
  
    })
    $('body').on('click','.add_new_record_users',function(){
      $(".products_tbody").append("<tr>"+
      "<td><input disabled type=\"text\" name=\"id_uzyt\" ></input></td>"+
      "<td><input type=\"text\" name=\"nazwa\" ></input></td>"+
      "<td><input type=\"text\" name=\"haslo\" ></input></td>"+
      "<td><input type=\"text\" name=\"email\" ></input></td>"+
      "<td><input type=\"text\" name=\"nr_tel\" ></input></td>"+
      "<td><input type=\"text\" name=\"adres\" ></input></td>"+
      "<td><input type=\"text\" name=\"admin\" ></input></td>"+
  "</tr>")
  
    })

  
 
}
function updateQuant(id,col, mat){
  let value = $('.nbm'+id+col+mat).val()
  let max = $("."+id+"sztuki").val()

  let items = []
  try{
    items = JSON.parse(getCookie(email))
    items.forEach(item => {
      if(item[0] == id && item[4] == col && item[5] == mat){
          if(parseInt(value) <= parseInt(max)){
            item[1] = value
          }else{
            $('.nbm'+id+col+mat).val(max)
          }
       
      }
    });

    document.cookie = email+'='+JSON.stringify(items)+'; expires=14; path=/';
  }catch(e){
    alert(e)
  }

}
function addItemToCart(id, number_of_items, price, name, color, material){
  total_price += parseInt(price.split(" ")[0]) * parseInt(number_of_items)
  $(".total_price").html(parseInt(price.split(" ")[0]) * parseInt(number_of_items) + parseInt($(".total_price").html()))
  if($(".el"+id+color+material).length > 0){
    var number = parseInt($(".nbm"+id+color+material).attr("value"))+parseInt(number_of_items)
    $(".nbm"+id+color+material).attr("value",number)
  }else{
    var count = $(".item").children().length;
    $(".item").append(
      '<div class="card rounded-3 mb-4 el'+id+color+material+'">'+
      '<div class="card-body p-4">'+
  '<div class="row d-flex justify-content-between align-items-center">'+
    '<div class="col-md-3 col-lg-3 col-xl-3">'+
      '<p class="lead fw-normal mb-2">'+name+'</p>'+
      '<p><span class="text-muted ">Kolor: </span><span class="color-span'+id+'">'+color+'</span></p>'+
      '<p><span class="text-muted ">Materiał: </span><span class="material-span'+id+'">'+material+'</span></p>'+
    '</div>'+
    '<div class="col-md-3 col-lg-3 col-xl-2 d-flex">'+
      '<input id="form1" onchange="updateQuant('+id+',\''+color+'\''+',\''+material+'\')" class="nbm'+id+color+material+'" min="0" max="'+$("."+id+"sztuki").val()+'" name="quantity" value="'+number_of_items+'" type="number"'+
        'class="form-control form-control-sm" />'+
    '</div>'+
    '<div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">'+
      '<h5 class="mb-0">'+price+'</h5>'+
    '</div>'+
   '<div class="col-md-1 col-lg-1 col-xl-1 text-end pe-5">'+
      '<a href="#" class="text-danger"><img class="del_btn" attr='+count+' src="/projekt/Assets/trash3-fill.svg"></a>'+
    '</div>'+
  '</div>'+
'</div>'+              
'</div>'
)
  }
    
}
