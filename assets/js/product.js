/////////////////////////////delete single Order //////////////////////
/*delete_btns = document.querySelectorAll("#delete-product");
delete_btns.forEach((btn) => btn.addEventListener("click", deleteorder));
function deleteorder() {
  const id = this.dataset.productId;
  fetch(`http://localhost/delete.php?product_id=${id}`)
    .then((res) => res.json())
    .then((data) => {
      if (data) {
        let btn = document.querySelector(`button[data-product-id='${id}']`);

        btn.parentElement.parentElement.remove();
      }

    });
}*/

//////////////////////////////////////////////////////////////////////////////


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
      else if (query.includes("removeFromCart"))
        document.querySelector('div[p-id="' + str + '"]').remove();
      
        else if(query.includes("addtoadmincartxx")){
            if(document.querySelector('.xempty-data')){
        if(document.querySelector('.xempty-data').style.display=="block" || document.querySelector('.xempty-data').style.display=='')
             document.querySelector('.xempty-data').style.display="none";
    }
    if(document.querySelector('#myDIV').style.display=="none")
    document.querySelector('#myDIV').style.display="block";
    
          document.getElementById('myDIV').innerHTML += (this.responseText);
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
  handleXMLOrder(value, '', 'increasQuantity=' + value + '&p_id=' + product_id);


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

///////////////////////////////////////////////////////////////////////////////////////////////


function deleteItem(id) {

  handleXMLOrder(id, '', 'removeFromCart=' + id);
  event.target.parentElement.parentElement.remove()
  productpagemaxtotal();
}


/////////////////////////////////// create Order /////////////////////////

function newxxxcreateorder(id){
    if(document.querySelector('.empty-data')){
    if(document.querySelector('.empty-data').style.display=="block" || document.querySelector('.empty-data').style.display=='')
        document.querySelector('.empty-data').style.display="none";
    }
    if(document.querySelector('#myDIV').style.display=="none")
    document.querySelector('#myDIV').style.display="block";
      productpagemaxtotal();


    handleXMLOrder(id, '.products-continerx', 'addtocartxx=' + id);
}

////////////////////////////////////////////////////////////

function adminorder(id){
   guest_id = document.getElementById("myselect").value;
   handleXMLOrder(id, '', 'addtoadmincartxx=' + id + '&user_id='+guest_id);
   
      productpagemaxtotal();
}


    function deleteItemadmin(id) {

      handleXMLOrder(id, '', 'removeFromadminCart=' + id);
      event.target.parentElement.parentElement.remove()
      productpagemaxtotal();
    }


    /////////////////////////////////////////////////////////


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
      handleXMLOrder(value, '', 'increasadminQuantity=' + value + '&p_id=' + product_id);
    }
    
    
    function decrementValue() {
    
      var value = event.target.parentElement.nextElementSibling.children[0].value;
      if (isNaN(value) || value < 1) {
        value = 1;
      }
    
      value--;
      event.target.parentElement.nextElementSibling.children[0].value = value;
      product_id = event.target.getAttribute("data-product-id");
      handleXMLOrder(value, '', 'increasadminQuantity=' + value + '&p_id=' + product_id);
    
      //productpagetotal();
      productpagemaxtotal();
    }
    
    function productpagetotal() {
      console.log(hello);
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
          console.log(price[i].innerText);
            console.log(quantity[i].value);
        sum += parseInt(price[i].innerText) * parseInt(quantity[i].value);
      }
      
      totalPrice.innerHTML = sum;
    }
    

  

  








