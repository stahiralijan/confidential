@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10"><h1>Offices</h1></div>
                    <div class="col-2"><a href="{{ action('OfficeController@create') }}" class="btn btn-primary">Create Office</a></div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Sr</th>
                    <th>Office Name</th>
                    <th>Office Code</th>
                    <th>Employees</th>
                </tr>
                </thead>
                <tbody>
                @foreach($offices as $office)
                    <tr>
                        <td>{{ ($offices->currentpage() - 1) * $offices ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $office->name }}</td>
                        <td>{{ $office->code }}</td>
                        <td>{{ $office->employees_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{ $offices->links() }}</div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(() => {

        $(".btn-delete").click((evt)=>{
            let id = $(evt.currentTarget).data("office-id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                preConfirm: () => {
                    return fetch(`/offices/${id}`, {
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
                        'Office has been deleted.',
                        'success'
                    );
                    $(evt.currentTarget).parent().parent().parent().parent().fadeOut('slow',() => {
                        $(evt.currentTarget).parent().parent().parent().parent().remove();
                    });
                } else {
                    Swal.fire({
                            title: 'Can not be Deleted!',
                            text:  result.value.reason,
                            type: 'failure'
                    });
                }
            });
            evt.preventDefault();
        });

    })
</script>
@endpush