@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')

    <section id="order">
        <x-user-profile :city="$city"
												:street_nb="$street_nb"
                        :street="$street"
												:additional_info="$additional_info"/>
    </section>

@endsection

@section('extra-js')
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Delete Account
            $('#deleteAccountBtn').click(function () {
                Swal.fire({
                    title: 'Etes-vous sûr ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer mon compte'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: '{!! route('user.destroy', auth()->user()->id) !!}',
                            data: {
                                '_method': 'DELETE'
                            },
                            success: function () {
                                return window.location.href = '/';
                            },
                            error: function () {
                                return window.location.href = '/';
                            }
                        })
                    }
                })
            });
        });
    </script>


@endsection
