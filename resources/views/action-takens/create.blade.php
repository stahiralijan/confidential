@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8"><h1>Create Employee</h1></div>
                <div class="col-4">
                    <a href="{{ action('EmployeeController@index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <form id="employee_form" action="{{ action('EmployeeController@store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="fullname" class="control-label">Employee Name:</label>
                    <div>
                        <input class="form-control @error('fullname') is-invalid @enderror" type="text" name="fullname" id="fullname" placeholder="Employee Name..." required autofocus autocomplete="off" value="{{ old('fullname') }}">
                        @error('fullname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="cnic" class="control-label">CNIC:</label>
                    <div>
                        <input class="form-control @error('cnic') is-invalid @enderror" type="text" name="cnic" id="cnic" placeholder="Employee Name..." required maxlength="13" minlength="13" autocomplete="off" value="{{ old('cnic') }}">
                        @error('cnic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="code" class="control-label">Employee Code:</label>
                    <div>
                        <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" id="code" placeholder="Employee Name..." required  autocomplete="off" value="{{ old('code') }}">
                        @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile_number" class="control-label">Mobile Number:</label>
                    <div>
                        <input class="form-control @error('mobile_number') is-invalid @enderror" type="text" name="mobile_number" id="mobile_number" placeholder="Employee Name..." required minlength="10" maxlength="13" autocomplete="off" value="{{ old('mobile_number') }}">
                        @error('mobile_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="office_id" class="control-label">Office:</label>
                    <div class="row">
                        <div class="col-9">
                            <select class="form-control @error('office_id') is-invalid @enderror" name="office_id" id="office_id" required>
                                @if(old('office_id'))
                                    @php
                                        $office = \App\Office::find(old('office_id'))
                                    @endphp
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                @endif
                            </select>
                            @error('office_id')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="col-3 text-right">
                            <button class="btn btn-success" data-toggle="modal" data-target=".modal-office" type="button">Add Office</button>
                        </div>
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

                <button type="submit" class="btn btn-primary btn-submit-employee">Create</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-office" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Office</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="office_form" class="form-horizontal modal-form needs-validation">
                    @csrf
                    <div class="form-horizontal">
                        <label for="name" class="control-label">Office Name: </label>
                        <div>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Office Name..." autocomplete="off" autofocus required>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <label for="code" class="control-label">Office Code: </label>
                        <div>
                            <input type="text" name="code" id="code" class="form-control" placeholder="Office Code..." autocomplete="off" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-add-office">Create Office</button>
            </div>
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
        let empForm = $("#employee_form").validate({
            debug: true,
            rules: {
                fullname: {
                    required: true,
                    minlength: 3
                },
                cnic:{
                    required: true,
                },
                code:{},
                mobile_number:{
                    required: true,
                },
                bps:{
                    required: true,
                    number: true
                },
                office_id:{},
                designation_id:{}
            },
            errorClass: "is-invalid",
            validClass: "is-valid",
            errorPlacement: function(error, element) {
                error.appendTo( element.parent() ).addClass('invalid-feedback')
            },
            errorElement: "span"
        });

        let officeForm = $("#office_form").validate({
            debug: true,
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                code: {
                    required: true,
                    minlength: 2
                }
            },
            errorClass: "is-invalid",
            validClass: "is-valid",
            errorPlacement: function(error, element) {
                error.appendTo( element.parent() ).addClass('invalid-feedback')
            },
            errorElement: "span"
        });

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


        $(".btn-submit-employee").click(()=>{
            if(empForm.valid()) {
                $("#employee_form")[0].submit();
            }
        });

        $('.modal').on('show.bs.modal', event => {
            officeForm.resetForm();
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

        $(document.body).on("click", ".btn-add-office",(evt) => {
            $("#office_form .invalid-feedback").remove();
            $.ajax({
                url: '{{ action('OfficeController@store') }}',
                method: 'post',
                data: $("#office_form").serialize(),
                cache: false,
                success: (req, res) => {
                    if(res == 'success') {
                        $('.modal-office').modal('hide');
                        Swal.fire(
                            'Created!',
                            'Office has been created.',
                            'success'
                        )
                    }
                },
                error: (req, res) => {
                    var errors = req.responseJSON.errors;
                    $.each(errors, (index, value) => {
                        $(`#office_form [name="${index}"]`).parent().append(
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

        $('#office_id').select2({
            placeholder:'Select an Office',
            ajax: {
                url: "{{ action('OfficeController@index') }}",
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