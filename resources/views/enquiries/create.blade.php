@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Initiate Enquiry</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('EnquiryController@index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                @endif
                <form action="{{ action('EnquiryController@store') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="enq_number" class="control-label">Enquiry Number:</label>
                                <div>
                                    <input class="form-control @error('name') is-invalid @enderror" value="{{ old('enq_number') }}" type="text" name="enq_number" id="enq_number" placeholder="Enquiry Number..." required autofocus autocomplete="off">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status_id" class="control-label">Enquiry Status:</label>
                                <div>
                                    <select class="form-control" name="status_id" id="status_id" required>
                                        @if(old('status_id'))
                                            @php
                                                $status = \App\Status::find(old('status_id'))
                                            @endphp
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="opening_date" class="control-label">Case Opening Date:</label>
                                <div>
                                    <input class="form-control" type="text" data-toggle="datepicker" name="opening_date"
                                           id="opening_date" required autocomplete="off"
                                           value="{{ old('opening_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="closing_date" class="control-label">Case Closing Date:</label>
                                <div>
                                    <input class="form-control" type="text" data-toggle="datepicker" name="closing_date" id="closing_date" disabled autocomplete="off" value="{{ old('closing_date') }}">
                                </div>
                                <label for="case_closed">Is Enquiry Closed? </label>&nbsp;<input id="case_closed" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No">
                            </div>
                        </div>
                    </div>

                    <h3>Details</h3>
                    <div class="employees-container">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="employee_id_1" class="control-label">Accused:</label>
                                    <div>
                                        <select class="form-control employee" name="employee_id[1]" id="employee_id_1"
                                                required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="charges_1" class="control-label">Charges:</label>
                                    <div>
                                        <select class="form-control charges" name="charges[1][]" id="charges_1" required multiple></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="accusation_1" class="control-label">Accusations:</label>
                            <div>
                                <textarea name="accusation[1]" id="accusation_1" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group-sm">
                        <button type="button" class="btn btn-secondary btn-add-accused"> Add Accused</button>
                        <button type="button" class="btn btn-success btn-create-employee" data-toggle="modal" data-target=".modal-employee"> Create Employee</button>
                        <button class="btn btn-success" data-toggle="modal" data-target=".modal-designation" type="button">Create Designation</button>
                        <button class="btn btn-success" data-toggle="modal" data-target=".modal-office" type="button">Create Office</button>
                    </div>

                    <h3>Enquiry Committee</h3>
                    <div class="committee-container">
                        <div class="form-group">
                            <label for="committee_member_1" class="control-label">Committee Member:</label>
                            <div>
                                <select class="form-control committee-member" name="committee_member_id[]" id="committee_member_1" required></select>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group-sm">
                        <button type="button" class="btn btn-secondary btn-add-committee-member"> Add Committee Member</button>
                        <button type="button" class="btn btn-success btn-create-employee" data-toggle="modal" data-target=".modal-employee"> Create Employee</button>
                        <button class="btn btn-success" data-toggle="modal" data-target=".modal-designation" type="button">Create Designation</button>
                        <button class="btn btn-success" data-toggle="modal" data-target=".modal-office" type="button">Create Office</button>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Initiate Enquiry</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade modal-employee" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="employee_form" class="form-horizontal modal-form needs-validation">
                        @csrf
                        <div class="form-group">
                            <label for="fullname" class="control-label">Employee Name:</label>
                            <div>
                                <input class="form-control @error('fullname') is-invalid @enderror" type="text" name="fullname" id="fullname" placeholder="Employee Name..." required autofocus autocomplete="off" value="{{ old('fullname') }}">
                                @error('fullname')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cnic" class="control-label">CNIC:</label>
                            <div>
                                <input class="form-control @error('cnic') is-invalid @enderror" type="text" name="cnic" id="cnic" placeholder="CNIC..." required maxlength="13" minlength="13" autocomplete="off" value="{{ old('cnic') }}">
                                @error('cnic')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="code" class="control-label">Employee Code:</label>
                            <div>
                                <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" id="code" placeholder="Employee Name..." required  autocomplete="off" value="{{ old('code') }}">
                                @error('code')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile_number" class="control-label">Mobile Number:</label>
                            <div>
                                <input class="form-control @error('mobile_number') is-invalid @enderror" type="text" name="mobile_number" id="mobile_number" placeholder="Mobile Number..." required minlength="10" maxlength="13" autocomplete="off" value="{{ old('mobile_number') }}">
                                @error('mobile_number')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="office_id" class="control-label">Office:</label>
                            <div>
                                <select class="form-control @error('office_id') is-invalid @enderror" name="office_id" id="office_id" required></select>
                                @error('office_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="designation_id" class="control-label">Designation:</label>
                            <div>
                                <select class="form-control @error('designation_id') is-invalid @enderror" name="designation_id" id="designation_id" required></select>
                                @error('designation_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add-employee">Create Employee</button>
                </div>
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

        $(".btn-add-employee").click((evt) => {
            evt.preventDefault();
            $.ajax({
                url: '{{ action('EmployeeController@store') }}',
                method: 'post',
                data: $("#employee_form").serialize(),
                cache: false,
                success: (req, res) => {
                    if(res == 'success') {
                        $('.modal-employee').modal('hide');
                        Swal.fire(
                            'Created!',
                            'Employee has been created.',
                            'success'
                        )
                    }
                },
                error: (req, res) => {
                    var errors = req.responseJSON.errors;
                    $.each(errors, (index, value) => {
                        $(`#employee_form [name="${index}"]`).parent().append(
                            $.map(value, (i, v) => {
                                return `<span class="invalid-feedback" style="display:block">${i}</span>`;
                            })
                        )
                    })
                }
            });
        });

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

        $('.modal').on('show.bs.modal', event => {
            $("#employee_form")[0].reset();
            $("#designation_form")[0].reset();
            $("#office_form")[0].reset();
            empForm.resetForm();
        });

        let accused = 1;
        let committee = 1;

        $('#case_closed').change(function() {
            if(!$('#case_closed').prop('checked')) {
                $('#closing_date').prop({'disabled': true}).val('');
            } else {
                $('#closing_date').prop({'disabled': false});
            }
        });

        $('[data-toggle="datepicker"]').datepicker({
            autoHide: true,
            format: 'yyyy-mm-dd',
            endDate: new Date()
        });

        $('#status_id').select2({
            placeholder:'Select a status',
            ajax: {
                url: "{{ action('StatusController@index') }}",
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

        function init_employee_select() {
            $('.employee').select2({
                placeholder: 'Select an Employee',
                ajax: {
                    url: "{{ action('EmployeeController@index') }}",
                    cache: false,
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(item => {
                                return {id: item.id, text: `Name: ${item.fullname} | CNIC: ${item.cnic}`}
                            })
                        };
                    }
                }
            });
        }

        init_employee_select();

        function init_committee_select() {
            $('.committee-member').select2({
                placeholder: 'Select an Enquiry Committee Member',
                ajax: {
                    url: "{{ action('EmployeeController@index') }}",
                    cache: false,
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(item => {
                                return {id: item.id, text: `Name: ${item.fullname} | CNIC: ${item.cnic}`}
                            })
                        };
                    }
                }
            });
        }

        init_committee_select();

        function init_charges(){
            $('.charges').select2({
                placeholder:'Select charges',
                ajax: {
                    url: "{{ action('ChargeController@index') }}",
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
        }

        init_charges();

        $(".btn-add-accused").click(()=>{
            accused++;
            let employee = `<div>
                    <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="employee_id_${accused}" class="control-label">Accused:</label>
                                    <div><select class="form-control employee" name="employee_id[${accused}]" id="employee_id_${accused}"
                                                required></select></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="charges_${accused}" class="control-label">Charges:</label>
                                    <div><select class="form-control charges" name="charges[${accused}][]" id="charges_${accused}" required multiple></select></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="accusation_1" class="control-label">Accusations:</label>
                            <div><textarea name="accusation[${accused}]" id="accusation_${accused}" class="form-control"></textarea></div>
                        </div>
                </div>`;
            $(".employees-container").append(employee);
            init_employee_select();
            init_charges();
        });

        $(".btn-add-committee-member").click(()=>{
            committee++;
            let employee = `<div class="form-group">
                    <label for="committee_member_${committee}" class="control-label">Member: <button title="Remove" type="button" class="btn btn-danger btn-sm btn-remove">&times;</button></label>
                    <div><select class="form-control committee-member" name="committee_member_id[]" id="committee_member_${committee}" required></select></div></div>`;
            $(".committee-container").append(employee);
            init_committee_select();
        });

        $(document).on('click',".btn-remove", (evt)=>{
            let elem = $(evt.currentTarget).parent().parent().parent();
            elem.fadeOut('slow',()=>{elem.remove()})
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
    });
</script>
@endpush