$(document).ready(function () {
    let id = null;

    let editDescriptionEditor;

    ClassicEditor.create(document.querySelector("#editCategoryForm #description"))
        .then((editor) => {
            editDescriptionEditor = editor;
        })
        .catch((error) => {
            console.error(error);
        });

    // Get the data ang put on the modal
    $("body").on("click", "#editCategoryModalBtn", function () {
        id = $(this).attr("data-id");

        $.ajax({
            url: `/categories/${id}/edit`,
            type: "GET",
            success: function (response) {

                let html = '';
                response.photos.forEach(photo => {
                    html += `<img src="${photo.url}" width="100" height="100" class="img-fluid mr-2" id="image-preview">`;
                });

                $('#editCategoryForm .img-preview').html(html);


                $("#editCategoryForm #name").val(response.name);
                $("#editCategoryForm #description").val(response.description);

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

    $('#editCategoryForm #loader').hide();

    let validateForm = {
        errorElement: "div",
        rules: {
            name: "required",
            "image[]": {
                required: false,
                extension: "jpg|jpeg|png",
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
                error.insertAfter("#editCategoryForm #description_validate");
            } else if (element.attr("name") == "image[]") {
                error.insertAfter("#editCategoryForm #image-err");
            } else {
                error.insertAfter(element);
            }
        },
        ignore: [],
        submitHandler: function () {
            $('#editCategoryForm #submit').attr('disabled', true);
            $('#editCategoryForm #cancel').attr('disabled', true);
            $('#editCategoryForm #loader').show();

            // AJAX with Image Uploading
            let myForm = document.getElementById("editCategoryForm");
            let formData = new FormData(myForm); //use formData for forms with files
            formData.append("_method", "PUT");

            $.ajax({
                type: "POST",
                url: `/categories/${id}/edit`,
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
                            text: 'Category has been updated.',
                            didClose: () => window.location.reload()
                        })

                        $('#editCategoryForm #loader').hide();
                        $('#editCategoryForm #submit').attr('disabled', false);
                        $('#editCategoryForm #cancel').attr('disabled', false);

                        $("#editCategoryForm").trigger("reset"); // Clear the form
                        $("#editCategoryModal").modal("hide"); // Hide the modal
                        $("#dataTable").DataTable().reload();
                    }
                },
                error: function (error) {
                    $('#editCategoryForm #loader').hide();
                    $('#editCategoryForm #submit').attr('disabled', false);
                    $('#editCategoryForm #cancel').attr('disabled', false);

                    Swal.fire(
                        'Oops!',
                        'Something went wrong, please try again.',
                        'error'
                    )
                }

            });
        }
    };

    $('#editCategoryForm').validate(validateForm);

});
