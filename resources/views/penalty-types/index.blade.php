@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Penalty Types</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('PenaltyTypeController@create') }}" class="btn btn-primary">Create Penalty</a>
                    </div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Sr</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Total Issued</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($penaltyTypes as $penaltyType)
                    <tr>
                        <td>{{ ($penaltyTypes->currentpage() - 1) * $penaltyTypes ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $penaltyType->name }}</td>
                        <td>{{ $penaltyType->description }}</td>
                        <td>{{ $penaltyType->action_takens_count }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a href="{{ action('PenaltyTypeController@edit', $penaltyType) }}" class="dropdown-item">Edit</a>
                                    <a href="#" class="btn-delete dropdown-item" data-penalty-type-id="{{ $penaltyType->id }}">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{ $penaltyTypes->links() }}</div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {

            $(".btn-delete").click((evt) => {
                let id = $(evt.currentTarget).data("penalty-type-id");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    preConfirm: () => {
                        return fetch(`/penalty-types/${id}`, {
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
                        )
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