$(document).ready(function () {

    let descriptionEditor;

    ClassicEditor.create(document.querySelector("#addCategoryForm #description"))
        .then((editor) => {
            descriptionEditor = editor;
        })
        .catch((error) => {
            console.error(error);
        });


    $('#addCategoryForm #loader').hide();

    let validateForm = {
        errorElement: "div",
        rules: {
            name: "required",
            "image[]": {
                required: true,
                extension: "jpg|jpeg|png",
            },
            description: {
                required: true,
                minlength: 50
            }
        },
        messages: {
            name: {
                required: "Un nom est requis",
            },

            "image[]": {
                required: "Veuillez envoyer au moins 1 image"
            },
            description: {
                required: "Une description est requise"
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
                error.insertAfter("#addCategoryForm #description_validate");
            } else if (element.attr("name") == "image[]") {
                error.insertAfter("#addCategoryForm #image-err");
            } else {
                error.insertAfter(element);
            }
        },
				ignore: ":hidden, [contenteditable='true']:not(ck)",

        submitHandler: function () {
            $('#addCategoryForm #submit').attr('disabled', true);
            $('#addCategoryForm #cancel').attr('disabled', true);
            $('#addCategoryForm #loader').show();

            // AJAX with Image Uploading
            let myForm = document.getElementById("addCategoryForm");
            let formData = new FormData(myForm); //use formData for forms with files

            $.ajax({
                type: "POST",
                url: '/categories',
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.msg == 'success') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Créé!',
                            text: 'Une catégorie a été créé.',
                            didClose: () => window.location.reload()
                        })

                        descriptionEditor.setData(''); // Clear wysiwyg form

                        $('#addCategoryForm #loader').hide();
                        $('#addCategoryForm #submit').attr('disabled', false);
                        $('#addCategoryForm #cancel').attr('disabled', false);

                        $("#addCategoryForm").trigger("reset"); // Clear the form
                        $("#createCategoryModal").modal("hide"); // Hide the modal
                        // $("#dataTable").DataTable().reload();
                    }
                },
                error: function (error) {
                    let msg = error.responseJSON.msg;
                    if (error.status === 400 || error.status === 422) {

                        $('#addCategoryForm #loader').hide();
                        $('#addCategoryForm #submit').attr('disabled', false);
                        $('#addCategoryForm #cancel').attr('disabled', false);

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
                }

            });
        }
    };

    $('#addCategoryForm').validate(validateForm);


});
