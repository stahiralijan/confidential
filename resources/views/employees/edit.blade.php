@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8"><h1>Edit Employee</h1></div>
                <div class="col-4 text-right">
                    <a href="{{ action('EmployeeController@index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <form id="employee_form" action="{{ action('EmployeeController@update', $employee) }}" method="post" class="form-horizontal">
                @csrf
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fullname" class="control-label">Employee Name:</label>
                            <div>
                                <input class="form-control @error('fullname') is-invalid @enderror" type="text" name="fullname" id="fullname" placeholder="Full Name..." required autofocus autocomplete="off" value="{{ old('fullname', $employee->fullname) }}">
                                @error('fullname')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="fathername" class="control-label">Father Name:</label>
                            <div>
                                <input class="form-control @error('fathername') is-invalid @enderror" type="text" name="fathername" id="fathername" placeholder="Father Name..." autocomplete="off" value="{{ old('fathername', $employee->fathername) }}">
                                @error('fathername')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="employee_code" class="control-label">Employee Code:</label>
                            <div>
                                <input class="form-control @error('employee_code') is-invalid @enderror" type="text" name="employee_code" id="employee_code" placeholder="Employee Name..." autocomplete="off" value="{{ old('employee_code', $employee->employee_code) }}">
                                @error('employee_code')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="cnic" class="control-label">CNIC:</label>
                            <div>
                                <input class="form-control @error('cnic') is-invalid @enderror" type="text" name="cnic" id="cnic" placeholder="CNIC..." autocomplete="off" value="{{ old('cnic', $employee->cnic) }}">
                                @error('cnic')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="mobile_number" class="control-label">Mobile Number:</label>
                            <div>
                                <input class="form-control @error('mobile_number') is-invalid @enderror" type="text" name="mobile_number" id="mobile_number" placeholder="Mobile Number..." autocomplete="off" value="{{ old('mobile_number', $employee->mobile_number) }}">
                                @error('mobile_number')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary btn-submit-employee">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(() => {

        new Inputmask("99999-9999999-9").mask(document.getElementById("cnic"));
        new Inputmask("0999-9999999").mask(document.getElementById("mobile_number"));

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

        $(".btn-submit-employee").click(()=>{
            if(empForm.valid()) {
                $("#employee_form")[0].submit();
            }
        });
    });
</script>
@endpush