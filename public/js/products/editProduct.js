$(document).ready(function () {
    let id = null;

    let editDescriptionEditor;

    ClassicEditor.create(document.querySelector("#editProductForm #description"))
        .then((editor) => {
            editDescriptionEditor = editor;
        })
        .catch((error) => {
            console.error(error);
        });

    // Get the data ang put on the modal
    $("body").on("click", "#editProductModalBtn", function () {
        id = $(this).attr("data-id");

        $.ajax({
            url: `/products/${id}/edit`,
            type: "GET",
            success: function (response) {

                let html = '';
                response.photos.forEach(photo => {
                    html += `<img src="${photo.url}" width="100" height="100" class="img-fluid mr-2" id="image-preview">`;
                });

                $('#editProductForm .img-preview').html(html);


                $("#editProductForm #name").val(response.name);
                $("#editProductForm #price").val(response.price);
                $("#editProductForm #qty").val(response.qty);

			          /* A way to select the category that the product is currently in. */
								$("#editProductForm #category").selectpicker('val', `${response.category}`);

                editDescriptionEditor.setData(response.description);

            },
            error: function (error) {
                let msg = error.responseJSON.msg;
                if (error.status === 400 || error.status === 422) {

                    $('#loader').hide();
                    $('#submit').attr('disabled', false);
                    $('#cancel').attr('disabled', false);

                    Swal.fire(
                        'Oops!',
                        msg,
                        'error'
                    )
                } else {
                    Swal.fire(
                        'Oops!',
                        'Something went wrong, please try again.',
                        'error'
                    )
                }
            },
        });
    });

    $('#editProductForm #loader').hide();

    let validateForm = {
        errorElement: "div",
        rules: {
            name: "required",
            price: {
                required: true,
                number: true
            },
            qty: {
                required: true,
                number: true
            },
            "image[]": {
                required: false,
                extension: "jpg|jpeg|png",
            },
            category: {
                required: true
            },
            description: {
                required: true,
                minlength: 50
            }
        },
        messages: {
            name: {
                required: "Name is required",
            },
            price: {
                required: "Price is required",
            },
            qty: {
                required: "Quantity is required",
            },
            category: {
                required: "Category is required"
            },
            description: {
                required: "Description is required"
            },
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        errorPlacement: function (error, element) {
            // Change the location of error labels
            if (element.attr("name") == "description") {
                error.insertAfter("#editProductForm #description_validate");
            } else if (element.attr("name") == "image[]") {
                error.insertAfter("#editProductForm #image-err");
            } else {
                error.insertAfter(element);
            }
        },
        ignore: [],
        submitHandler: function () {
            $('#editProductForm #submit').attr('disabled', true);
            $('#editProductForm #cancel').attr('disabled', true);
            $('#editProductForm #loader').show();

            // AJAX with Image Uploading
            let myForm = document.getElementById("editProductForm");
            let formData = new FormData(myForm); //use formData for forms with files
            formData.append("_method", "PUT");

            $.ajax({
                type: "POST",
                url: `/products/${id}`,
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.msg == 'success') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: 'Product has been updated.',
                            didClose: () => window.location.reload()
                        })

                        $('#editProductForm #loader').hide();
                        $('#editProductForm #submit').attr('disabled', false);
                        $('#editProductForm #cancel').attr('disabled', false);

                        $("#editProductForm").trigger("reset"); // Clear the form
                        $("#editProductModal").modal("hide"); // Hide the modal
                        // $("#dataTable").DataTable().reload();
                    }
                },
                error: function (error) {
                    $('#editProductForm #loader').hide();
                    $('#editProductForm #submit').attr('disabled', false);
                    $('#editProductForm #cancel').attr('disabled', false);

                    Swal.fire(
                        'Oops!',
                        'Something went wrong, please try again.',
                        'error'
                    )
                }

            });
        }
    };

    $('#editProductForm').validate(validateForm);

});
