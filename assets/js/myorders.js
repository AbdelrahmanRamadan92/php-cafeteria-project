$(function () {
  $('input[name="birthday"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'), 10)
  }, function (start, end, label) {
    var years = moment().diff(start, 'years');

  });
});

function show_order() {
  orders.classList.toggle("d-none");
}