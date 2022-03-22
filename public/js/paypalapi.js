let amount = document.querySelector("#total").value;

// Send Order To Server
function saveOrderToDatabase(url, data) {
    // Ajax Post Request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: url,
        method: "POST",
        data: {
            paypal: data,
            msg: "payment-success"
        },
        success: function (response) {
            if (!response.success || response.success == undefined) {
                alert("Something went wrong, please try again later");
            } else {
                window.location.href = "/thankyou";
            }
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });

}

const paypalButton = () => {
    paypal
        .Buttons({
            // Setup your paypal button styling
            style: {
                shape: "rect",
                color: "blue",
                layout: "vertical",
                label: "pay"
            },

            createOrder: function (data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    // Configure environment
                    env: "sandbox",

                    // Set up your locale
                    locale: "en_PH",

                    purchase_units: [
                        {
                            amount: {
                                value: amount,
                                currency: "PHP"
                            },
                            shipping: {
                                options: [
                                    {
                                        id: "SHIP_123",
                                        label: "Free Shipping",
                                        type: "SHIPPING",
                                        selected: true,
                                        amount: {
                                            value: "0.00",
                                            currency_code: "PHP"
                                        }
                                    },
                                    {
                                        id: "SHIP_456",
                                        label: "Pick up in Store",
                                        type: "PICKUP",
                                        selected: false,
                                        amount: {
                                            value: "0.00",
                                            currency_code: "PHP"
                                        }
                                    }
                                ]
                            }
                        }
                    ]
                });
            },

            onApprove: function (data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function (details) {
                    // This function shows a transaction success message to your buyer.

                    // Loading
                    document.body.innerHTML = `
                        <div class="spinner">
                            <span class="spinner-text">Please wait, we are processing your order...</span>
                        </div>
                        `;

                    if (details.status == "COMPLETED") {
                        // Do Something to the data that passed from the server side.
                        saveOrderToDatabase('/checkout', details);
                    } else {
                        console.error(
                            "Something went wrong with payment. Please try again later"
                        );
                    }
                });

                //console.log(actions);
            }
        })
        .render("#paypal-button-container");
    //This function displays Smart Payment Buttons on your web page.
};

paypalButton();
