@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Designations</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('DesignationController@create') }}" class="btn btn-primary">Create Designation</a>
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
                    <th>Name</th>
                    <th>BPS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($designations as $designation)
                    <tr>
                        <td>{{ ($designations->currentpage() - 1) * $designations ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $designation->name }}</td>
                        <td>{{ $designation->bps }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{ $designations->links() }}</div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(() => {

        $(".btn-delete").click((evt)=>{
            let id = $(evt.currentTarget).data("designation-id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                preConfirm: () => {
                    return fetch(`/designations/${id}`, {
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
            }).then(result => {
                console.log(result);
                if (result.value.success) {
                    Swal.fire(
                        'Deleted!',
                        'Designation has been deleted.',
                        'success'
                    );
                    $(evt.currentTarget).parent().parent().parent().parent().fadeOut('slow',()=>{$(evt.currentTarget).parent().parent().parent().parent().remove()});
                } else {
                    Swal.fire(
                        'Can not be Deleted!',
                        result.value.reason,
                        'error'
                    )
                }
            })
        });

    })
</script>
@endpush