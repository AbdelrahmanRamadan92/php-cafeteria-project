let from = document.querySelector('input#from');
let to = document.querySelector('input#to');
let users = document.querySelector('select#users');


/***************************** HANDLE XML  *********************************/
function handleXML(str, selector, query) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(selector);
            if (query.includes("deleteId"))
                document.querySelector('tr[order_id="' + str + '"]').remove();


              else if (query.includes("createOrder")){
                document.querySelector('.empty-data').style.display="block";

              }
            else if (query.includes("Delivered")) {
                document.querySelector('tr[order_id="' + str + '"]').parentElement.parentElement.remove();
                document.querySelector('div[order_num="' + str + '"]').remove();
            }

            else if (query.includes("cancelOrder")) {
                document.querySelector(selector).innerHTML = (this.responseText);
                document.querySelector('tr[order_id="' + str + '"] td.status').innerText = 'Canceled';
            }

            else if (query.includes("reOrder")) {
                document.querySelector(selector).innerHTML = (this.responseText);
                document.querySelector('tr[order_id="' + str + '"] td.status').innerText = 'Processing';
            }
            else if (query.includes("page")) {
                document.querySelector(selector).innerHTML = (this.responseText);
            }
            else
                document.querySelector(selector).innerHTML = (this.responseText);
        }
    }

   // xmlhttp.open("POST", "requests.php?" + query, true);
//    xmlhttp.send();

 xmlhttp.open("POST", "requests", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(query);

}

/************************* ADD TO CART ********************************************/

function addToCart(id) {
    handleXML(id, '', 'addToCart=' + id);
}

/***************************** CHECK EXISTENCE *********************************/

function checkExist() {
    if (document.querySelector('.order-items').style.display == "block")
        document.querySelector('.order-items.w-75.m-auto').style.display = "none";

    if (document.querySelector('.table2-content').style.display == "block")
        document.querySelector('.table2-content ').style.display = "none";

}

/***************************** SHOW ORDER *********************************/

function showOrder(str) {
    document.querySelector('.table2-content').style.display = "block";
    handleXML(str, '.table2-content table tbody', 'user_id=' + str);

    if (document.querySelector('.order-items').style.display == "block")
        document.querySelector('.order-items.w-75.m-auto').style.display = "none";
}
/***************************** SHOW ORDER PRODUCTS *********************************/

function showOrderProducts(str) {
    document.querySelector('.order-items').style.display = "block";

    handleXML(str, '.order-items .row', 'id=' + str);
}

/************************* show Order Productss ********************************************/

function showOrderProductss(str) {
    showOrderProducts(str);
    orders.classList.toggle("d-none");
}
/***************************** DELETE ORDER  *********************************/

function deleteOrder(str) {
    handleXML(str, '', 'deleteId=' + str);
    if (document.querySelector('.order-items').style.display == "block")
        document.querySelector('.order-items.w-75.m-auto').style.display = "none";
}
/***************************** FILTER BY DATE  *********************************/

function filterDate(str) {
    checkExist();
    let fromVal = from.value;
    let toVal = to.value;
    let usersVal = users.value;

    handleXML(str, '.table1-orders tbody', "from=" + fromVal + "&to=" + toVal + "&users=" + usersVal);
    document.querySelector('.pagination').style.display = "none";

}

/***************************** FILTER BY DATE  *********************************/

function filterDateUser(str) {
    let fromVal = from.value;
    let toVal = to.value;
    /*  if (document.querySelector('div#orders').style.display == "block")
          document.querySelector('div#orders').style.display = "none";*/
    handleXML(str, '.table.table-bordered tbody', "Userfrom=" + fromVal + "&to=" + toVal);
    document.querySelector('.pagination').style.display = "none";

}
/************************* UPDATE STATUS  ********************************************/
function updateStatusHandle(id) {
    let status = document.querySelector('tr[order_id ="' + id + '" ] select#status').value;
    handleXML(id, 'select#status option', 'status=' + status + '&order_id=' + id);
    showOrdersPage(1);

}

/************************* CANCEL ORDER ********************************************/
function cancelOrder(id) {
    handleXML(id, 'tr[order_id="' + id + '"] td.btns-del', 'cancelOrder=' + id);
}

/************************* Re ORDER ********************************************/
function reOrder(id) {
    handleXML(id, 'tr[order_id="' + id + '"] td.btns-del', 'reOrder=' + id);
}

/************************* SHOW PAGE ********************************************/

function showPage(page) {
    document.querySelector('a.active').classList.remove('active');
    event.target.classList.add('active');
    handleXML(page, '.container .row', 'page=' + page);

}

/************************* showOrdersPage ********************************************/

function showOrdersPage(page) {
    handleXML(page, '.container .row', "pageoo=" + page);
}

/************************* showMyOrdersPage ********************************************/

function showMyOrdersPage(page) {
    handleXML(page, 'table.table-bordered tbody', "myorders=" + page);
}
/************************* showChecksPage ********************************************/

function handleXMLx(str, selector, query) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(selector);
            if (query.includes("deleteId"))
                document.querySelector('tr[order_id="' + str + '"]').remove();
            else
                document.querySelector(selector).innerHTML = (this.responseText);
        }
    }

 xmlhttp.open("POST", "requests", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(query);
  
 //   xmlhttp.open("POST", "requests.php?" + query, true);
   // xmlhttp.send();
}



function showChecksPage(page) {
    handleXMLx(page, '.table1-orders tbody', "checks=" + page);
}

/************************* handle event ********************************************/

let a = document.querySelectorAll('.pagination a');
for (let i = 0; i < a.length; i++) {
    a[i].addEventListener("click", function (event) {
        document.querySelector('.pagination a.active').classList.remove('active');
        event.target.classList.add('active');
    })
}




/********************************** */
function mFunction() {
    let total = document.querySelector('.product-maxtotal-price').innerText;
    handleXML(1, '#createOrder', "createOrder="+total, 1);
    
     if(document.querySelector('#myDIV')){
 if(document.querySelector('#myDIV').style.display=="block" || document.querySelector('#myDIV').style.display=='') 
    document.querySelector('#myDIV').style.display="none";
     }
}