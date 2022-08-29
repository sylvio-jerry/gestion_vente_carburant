$(document).ready( function() {
    var now = new Date();
    var today = now.getDate()  + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
    alert(today);
    $('#datePicker').val(today);
});​