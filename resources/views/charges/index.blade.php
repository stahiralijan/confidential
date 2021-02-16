@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Charges</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('ChargeController@create') }}" class="btn btn-primary">Create Charge</a>
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
                    <th>Charge Name</th>
                    <th>Charge Description</th>
                    <th>Enquiries</th>
                </tr>
                </thead>
                <tbody>
                @foreach($charges as $charge)
                    <tr>
                        <td>{{ ($charges->currentpage() - 1) * $charges ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $charge->name }}</td>
                        <td>{{ $charge->description }}</td>
                        <td>{{ $charge->enquiry_cases_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{ $charges->links() }}</div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {

            $(".btn-delete").click((evt) => {
                let id = $(evt.currentTarget).data("charge-id");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    preConfirm: () => {
                        return fetch(`/charges/${id}`, {
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