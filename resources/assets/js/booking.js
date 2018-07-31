$(document).ready( function () {
    function totalprice() {
        var price = $('#total').val();
        function compute() {
            var numberPassengers = $('#capacity').val();
            var discount = $('#package').val();
            var total = numberPassengers * price * discount / 100;
            total = total.toFixed(2);
            $('#total').val(total);
        }
        $('#capacity, #package').change(compute);
    }
    totalprice();
});
