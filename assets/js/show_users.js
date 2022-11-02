let deletbtns=document.querySelectorAll('.delete');
console.log(deletbtns);
deletbtns.forEach((btn) => btn.addEventListener('click',delete_user));


// function delete_user(){
//   const id=this.dataset.id;
// //    console.log(id);
//     fetch(`http://localhost/iti/php-cafatiria/delete_user.php?id=${id}`)
//   .then((response) => response.json())
//   .then((data) => {
//       if (data) {
//         let btn=document.querySelector(`button[data-id='${id}']`);
//         btn.parentElement.parentElement.remove();
//       }
//   });
// }


function delete_user(){
var body = new FormData();


const id = this.dataset.id;
body.append("id", id);
 console.log(body);

fetch('https://cafeteria-new.000webhostapp.com/deleteuser', {
  method: 'POST', 
  mode: "same-origin",
   credentials: "same-origin",
  headers: {
    'Content-Type': 'application/json',
  },
 body: JSON.stringify({
      "id": id
    }),
})
  .then((response) => response.json())
  .then((data) => {
      if (data) {
        let btn = document.querySelector(`.delete[data-id='${id}']`);
        btn.parentElement.parentElement.remove();
      }
      }).catch((error) => {
    console.error('Error:', error);
  });
}