let deletbtns = document.querySelectorAll('.delete');
//le.log(deletbtns);
deletbtns.forEach((btn) => btn.addEventListener('click', delete_product));
function delete_product() {
 const id = this.dataset.id;
const data = {"id" :id};
fetch('https://cafeteria-new.000webhostapp.com/deleteproduct', {
  method: 'POST', 
    body: JSON.stringify(data),
  headers: {
  'Content-type': 'application/json; charset=UTF-8',
  },
  })
  .then((response) => response.json())
  .then((data) => {
    console.log(data);
      if (data) 
      {
        let btn = document.querySelector(`.delete[data-id='${id}']`);
        btn.parentElement.parentElement.remove();
      }
    }).catch((error) => {
    console.error('Error:', error);
  });
}
// function handleXMLOrder(str, selector, query) {
//   if (str == "") {
//     document.getElementById("txtHint").innerHTML = "";
//     return;
//   }

//   var xmlhttp = new XMLHttpRequest();

//   xmlhttp.onreadystatechange = function () {
//     if (this.readyState == 4 && this.status == 200) {
//       console.log(query);
//       if (selector.length == 0) { }
//       else if (query.includes("removeFromadminCart"))
//         document.querySelector('div[p-id="' + str + '"]').remove();
      
     
//     }


//   }

  //xmlhttp.open("GET", "requests.php?" + query, true);
 // xmlhttp.send();
 
//   xmlhttp.open("POST", "delete", true);
//   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xmlhttp.send(query);
// }


// function deleteItemadmin(id) {
//     //alert(id);

//       handleXMLOrder(id, '', 'removeFromadminCart=' + id);
//       event.target.parentElement.parentElement.remove();
     
//     }


// // main.js

// // POST request using fetch()
// fetch("https://cafeteria-new.000webhostapp.com/deleteproduct", {
	
// 	// Adding method type
// 	method: "POST",
	
// 	// Adding body or contents to send
// 	body: JSON.stringify({
// 		id: id,
// 	}),
	
// 	// Adding headers to the request
// 	headers: {
// 		"Content-type": "application/json; charset=UTF-8"
// 	}
// })

// // Converting to JSON
// .then(response => response.json())

// // Displaying results to console
// .then(json => console.log(json));
// }
