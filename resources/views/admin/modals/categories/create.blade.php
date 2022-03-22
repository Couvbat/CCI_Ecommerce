<!-- Create Category Modal-->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une catégorie</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm" role="form" data-bs-toggle="validator" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="eg. Camera, Bag"
                            value="" />
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="title">Image</label>
                        </div>
                        <div class="file-upload">
                            <input class="file-upload__input" type="file" name="image[]" id="image" multiple
                                accept="image/png, image/jpeg, image/gif">
                            <button class="file-upload__button" type="button">Choisir fichier(s)</button>
                            <span class="file-upload__label"></span>
                        </div>
                        <div id="image-err" class="error"></div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control form-control-textarea" name="description" id="description"
                            placeholder="Détaillez le produit que vous vendez" rows="4"></textarea>
                        <small id="description_validate" class="text-muted font-sm error"></small>
                    </div>

                    <div class="mt-2">
                        <hr>
                    </div>
                    <div class="form-footer d-flex justify-content-end">
                        <button id="cancel" class="btn btn-danger" type="button" data-bs-dismiss="modal">
                            Annuler
                        </button>
                        <button class="ml-2 btn btn-primary" id="submit">
                            <img id="loader" src="{{ asset('img/loading.gif') }}" width="25" height="25"
                                class="img-fluid" alt="loader">
                            {{ __('Ajouter') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
