$(function () {
    // Prevent User to press Enter
    $("form").keypress(function (e) {
        //Enter key
        if (e.which == 13) {
            return false;
        }
    });

    // Get All the Product Qty Input
    const className = document.querySelectorAll(".product_qty");

    Array.from(className).forEach(element => {
        let rowId = element.id.split("_")[2];
        let idOfEachElement = "#" + element.id;

        $("#plus_" + rowId).click(function (e) {
            let _token = $('input[name="_token"]').val();

            let qty = document.querySelector(idOfEachElement).value;

            updateQty(qty, rowId, _token); // make request to Server to Update the Quantity
        });

        // ONCLICK
        $("#minus_" + rowId).click(function (e) {
            let _token = $('input[name="_token"]').val();

            let qty = document.querySelector(idOfEachElement).value;

            updateQty(qty, rowId, _token); // make request to Server to Update the Quantity
        });

        // FOR ON CHANGE
        /*
        $(idOfEachElement).change(function (e) {
            let _token = $('input[name="_token"]').val();

            let qty = document.querySelector(idOfEachElement).value;

            updateQty(qty, rowId, _token); // make request to Server to Update the Quantity
        });*/


    });
});

function updateQty(qty, rowId, _token) {
    // Ajax Post Request
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        url: "/cart",
        method: "POST",
        data: {
            _token: _token,
            quantiy: parseInt(qty),
            rowId: rowId
        },
        success: function (response) {
            $('#total').text(response.total);
            $('#subtotal').text(response.subtotal);
            $('#tax').text(response.tax);
            console.log(response);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}
