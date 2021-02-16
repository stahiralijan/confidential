@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-9"><h1>Create Competent Authority</h1></div>
                <div class="col-3 text-right">
                    <a href="{{ action('DesignationController@index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <form action="{{ action('ComptentAuthorityController@store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="name" class="control-label">Authority Name:</label>
                    <div>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Authority Name..." required autocomplete="off" value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="designation_id" class="control-label">Designation:</label>
                    <div class="row">
                        <div class="col-9">
                            <select class="form-control @error('designation_id') is-invalid @enderror" name="designation_id" id="designation_id" required>
                                @if(old('designation_id'))
                                    @php
                                        $designation = \App\Designation::find(old('designation_id'))
                                    @endphp
                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                @endif
                            </select>
                            @error('designation_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-3 text-right">
                            <button class="btn btn-success" data-toggle="modal" data-target=".modal-designation" type="button">Add Designation</button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-designation" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="designation_form" class="form-horizontal modal-form">
                    @csrf
                    <div class="form-horizontal">
                        <label for="name" class="control-label">Designation Name: </label>
                        <div>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Designation Name..." autofocus autocomplete="off">
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <label for="bps" class="control-label">BPS: </label>
                        <div>
                            <input type="text" name="bps" id="bps" class="form-control" placeholder="Basic Pay Scal..." autocomplete="off">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-add-designation">Create Designation</button>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script>
        $(document).ready(() => {
            let designationForm = $("#designation_form").validate({
                debug: true,
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    }
                },
                errorClass: "is-invalid",
                validClass: "is-valid",
                errorPlacement: function(error, element) {
                    error.appendTo( element.parent() ).addClass('invalid-feedback')
                },
                errorElement: "span"
            });

            $('.modal').on('show.bs.modal', event => {
                designationForm.resetForm();
                $('.modal-form').each((index,item) => { item.reset() });
            });

            $(document.body).on("click", ".btn-add-designation",(evt) => {
                $("#designation_form .invalid-feedback").remove();
                $.ajax({
                    url: '{{ action('DesignationController@store') }}',
                    method: 'post',
                    data: $("#designation_form").serialize(),
                    cache: false,
                    success: (req, res) => {
                        if(res == 'success') {
                            $('.modal-designation').modal('hide');
                            Swal.fire(
                                'Created!',
                                'Designation has been created.',
                                'success'
                            )
                        }
                    },
                    error: (req, res) => {
                        var errors = req.responseJSON.errors;
                        $.each(errors, (index, value) => {
                            $(`#designation_form [name="${index}"]`).parent().append(
                                $.map(value, (i, v) => {
                                    return `<span class="invalid-feedback" style="display:block">${i}</span>`;
                                })
                            )
                        })
                    }
                });
                evt.preventDefault();
            });

            $('#designation_id').select2({
                placeholder:'Select a Designation',
                ajax: {
                    url: "{{ action('DesignationController@index') }}",
                    cache: false,
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(item => {
                                return {id: item.id, text: item.name}
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush