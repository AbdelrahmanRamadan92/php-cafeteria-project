
function handleXMLOrder(str, selector, query) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(query);
      if (selector.length == 0) { }
      
      else if(query.includes("changecartbyuser")){
          console.log("SD");
          if((this.responseText)){
                document.getElementById('myDIV').style.display="block";
                document.getElementById('myDIV').innerHTML   = (this.responseText);
              
          }
      }
      else if (query.includes("removeFromCart"))
        document.querySelector('div[p-id="' + str + '"]').remove();
      
        else if(query.includes("addtoadmincartxx")){
          document.getElementById('myDIV').innerHTML = (this.responseText);
        }
      else {
        console.log(this.responseText.value);
        if ((this.responseText).includes("here"))
     //   document.querySelector('#myDIV div[p-id="2"]  input.input-number')
          document.querySelector('#myDIV div[p-id="' + str + '"]  input.input-number').innerHTML = (this.responseText)

        else
          document.querySelector(selector).innerHTML += (this.responseText);
      }
    }


  }

  //xmlhttp.open("GET", "requests.php?" + query, true);
 // xmlhttp.send();
 
  xmlhttp.open("POST", "requests", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(query);
}

//////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////
/*
function incrementValue() {

  var value = event.target.parentElement.previousElementSibling.children[0].value;
  if (isNaN(value) || value < 1) {
    value = 1;
  }

  value++;
  event.target.parentElement.previousElementSibling.children[0].value = value;
  product_id = event.target.getAttribute("data-product-id");
  //productpagetotal();
  productpagemaxtotal();
  handleXMLOrder(value, '', 'increasQuantity=' + value + '&p_id=' + product_id);
}
*/

function decrementValue() {

  var value = event.target.parentElement.nextElementSibling.children[0].value;
  if (isNaN(value) || value < 1) {
    value = 1;
  }

  value--;
  event.target.parentElement.nextElementSibling.children[0].value = value;
  product_id = event.target.getAttribute("data-product-id");
  handleXMLOrder(value, '', 'increasadminQuantity=' + value + '&p_id=' + product_id);


let price =  event.target.parentNode.nextElementSibling.children[0].innerText;
    event.target.parentNode.nextElementSibling.children[0].innerText += parseInt(price);
  //productpagetotal();
  productpagemaxtotal();
}

function productpagetotal() {
  var totalPrice = parseInt(document.querySelector('#product-total-price').dataset.price);
  let quantity = document.querySelectorAll('input[name="quantity"]');
  var sum = totalPrice * quantity;
  sum = Math.round(sum * 100) / 100;
  totalPrice.innerHTML = '$' + sum; 
}

function productpagemaxtotal() {
  var totalPrice = document.querySelector('.product-maxtotal-price');

  let quantity = document.querySelectorAll('input[name="quantity"]');
  let price = document.querySelectorAll('#product-total-price');
  let sum = 0;
  for (let i = 0; i < price.length; i++) {
    sum += parseInt(price[i].innerText) * parseInt(quantity[i].value);
  }
  console.log("f");
  totalPrice.innerHTML = '$' + sum;
}

/////////////////////////////////// create Order /////////////////////////

function newxxxcreateorder(id){
    if(document.querySelector('.xempty-data')){
    if(document.querySelector('.xempty-data').style.display=="block" || document.querySelector('.xempty-data').style.display=='')
        document.querySelector('.xempty-data').style.display="none";
    }
    if(document.querySelector('#myDIV').style.display=="none")
    document.querySelector('#myDIV').style.display="block";
      productpagemaxtotal();


    handleXMLOrder(id, '.products-continerx', 'addtoadmincartxxx=' + id);
}

////////////////////////////////////////////////////////////
/*
function adminorder(id){
   guest_id = document.getElementById("myselect").value;
   handleXMLOrder(id, '', 'addtoadmincartxx=' + id + '&user_id='+guest_id);  
    
}*/
   


    function deleteItemadmin(id) {

      handleXMLOrder(id, '', 'removeFromadminCart=' + id);
      event.target.parentElement.parentElement.remove();
      productpagemaxtotal();
    }




function deleteItemById(id) {
 let user_id = document.getElementById("myselect").value;

  handleXMLOrder(id, '', 'removeFromCartByAdminx=' + id+"&user_id="+user_id);
  event.target.parentElement.parentElement.remove()
  productpagemaxtotal();
}



function handleXMLOrder3(str, selector, query) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(query);
      if (selector.length == 0) { }
      
      else if(query.includes("changecartbyuser")){
          console.log("SD");
          if((this.responseText)){
              if((this.responseText).includes('xxxxxempty')){
                  document.querySelector('.xempty-data').style.display="block";
                                               document.getElementById('myDIV').style.display="none";

                  
              }
             
             else 
             {if(document.getElementById('myDIV').style.display=="block")
                             document.getElementById('myDIV').style.display="none";

                document.getElementById('myDIV').style.display="block";
                  document.querySelector('.xempty-data').style.display="none";
                document.querySelector('#myDIV .products-continerx').innerHTML   = (this.responseText);
             }
          }
      }
      else if (query.includes("removeFromCart"))
        document.querySelector('.div[p-id="' + str + '"]').remove();
      
        else if(query.includes("addtoadmincartxx")){
          document.getElementById('myDIV').innerHTML = (this.responseText);
        }
      else {
        console.log(this.responseText.value);
        if ((this.responseText).includes("here"))
     //   document.querySelector('#myDIV div[p-id="2"]  input.input-number')
          document.querySelector('#myDIV div[p-id="' + str + '"]  input.input-number').innerHTML = (this.responseText)

        else
          document.querySelector(selector).innerHTML += (this.responseText);
      }
    }


  }

  //xmlhttp.open("GET", "requests.php?" + query, true);
 // xmlhttp.send();
 
  xmlhttp.open("POST", "requests", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(query);
}

function changecartuser(){
    let user_id =document.querySelector('select#myselect').value;
      handleXMLOrder3(user_id, 'myDIV', 'changecartbyuser=' + user_id);
}


function createAdminOrder(){
     let user_id =document.querySelector('select#myselect').value;
     let room = document.querySelector('span.rooom').innerText;
        handleXML(1, '#createOrder', "createOrderbyid="+user_id+"&userroom="+room, 1);
    
     if(document.querySelector('#myDIV')){
        if(document.querySelector('#myDIV').style.display=="block" || document.querySelector('#myDIV').style.display=='') 
            document.querySelector('#myDIV').style.display="none";
     }
}
   
