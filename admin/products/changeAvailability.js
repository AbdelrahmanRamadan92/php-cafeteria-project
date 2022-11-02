let availablebtns = document.querySelectorAll('.available');
console.log(availablebtns);
availablebtns.forEach((btn) => btn.addEventListener('click', changeAvailability));


function changeAvailability() {
  const id = this.dataset.id;
  console.log(id);
  fetch(`https://cafeteria-new.000webhostapp.com/admin/products/changeAvailability.php?id=${id}`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      let btn = document.querySelector(`.available[data-id='${id}']`);
      data ? btn.innerHTML = "Available" : btn.innerHTML = "Un Available";
    });
}