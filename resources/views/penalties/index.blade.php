@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Penalties</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('PenaltyController@create') }}" class="btn btn-primary">Create Penalty</a>
                    </div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Sr</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($penalties as $penalty)
                    <tr>
                        <td>{{ ($penalties->currentpage() - 1) * $penalties ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $penalty->penaltyType->name }}</td>
                        <td>{{ $penalty->name }}</td>
                        <td>{{ $penalty->description }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a href="#" class="dropdown-item">View related Enquiry Actions</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ action('PenaltyController@edit', $penalty) }}" class="dropdown-item">Edit</a>
                                    <a href="#" class="btn-delete dropdown-item" data-penalty-id="{{ $penalty->id }}">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{ $penalties->links() }}</div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {

            $(".btn-delete").click((evt) => {
                let id = $(evt.currentTarget).data("penalty-id");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    preConfirm: () => {
                        return fetch(`/penalties/${id}`, {
                            method: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },
                }).then((result) => {
                    console.log(result.value);
                    if (result.value.success) {
                        Swal.fire(
                            'Deleted!',
                            'Penalty has been deleted.',
                            'success'
                        );
                        $(evt.currentTarget).parent().parent().parent().parent().fadeOut('slow',() => {
                            $(evt.currentTarget).parent().parent().parent().parent().remove();
                        });
                    } else {
                        Swal.fire(
                            'Can not be Deleted!',
                            result.value.reason,
                            'failure'
                        )
                    }
                })
            });

        })
    </script>
@endpush