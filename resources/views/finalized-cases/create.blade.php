@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Create Case</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('EnquiryCaseController@index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                @endif
                <form action="{{ action('EnquiryCaseController@store') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="enq_no" class="control-label">Enquiry Number:</label>
                                <div>
                                    <input class="form-control @error('enq_no') is-invalid @enderror" value="{{ old('enq_no') }}" type="text" name="enq_no" id="enq_no" placeholder="Enquiry Number..." required autofocus autocomplete="off">
                                    @error('enq_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Employee Name:</label>
                                <div>
                                    <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" type="text" name="name" id="name" placeholder="Employee Name..." required autocomplete="off">
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
                                <label for="designation_id" class="control-label">Designation:</label>
                                <div>
                                    <select class="form-control charges" name="designation_id" id="designation_id" required>
                                        @if(old('designation_id'))
                                            @php
                                                $designation = \App\Designation::find(old('designation_id'))
                                            @endphp
                                            <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                        @endif
                                    </select>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".modal-designation">Add Designation</button>
                                    @error('designation_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="office_id" class="control-label">Office:</label>
                                <div>
                                    <select class="form-control charges" name="office_id" id="office_id" required>
                                        @if(old('office_id'))
                                            @php
                                                $office = \App\Office::find(old('office_id'))
                                            @endphp
                                            <option value="{{ $office->id }}">{{ $office->name }}</option>
                                        @endif
                                    </select>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".modal-office">Add Office</button>
                                    @error('office_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cnic" class="control-label">CNIC:</label>
                                <div>
                                    <input class="form-control @error('cnic') is-invalid @enderror" value="{{ old('cnic') }}" type="text" name="cnic" id="cnic" placeholder="CNIC..." required autocomplete="off">
                                    @error('cnic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="issue_date" class="control-label">Issue Date:</label>
                                <div>
                                    <input class="form-control" type="text" data-toggle="datepicker" name="issue_date" id="issue_date" required autocomplete="off" placeholder="Issue Date..." value="{{ old('issue_date') }}">
                                    @error('issue_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="competent_authority_id" class="control-label">Competent Authority:</label>
                                <div>
                                    <select class="form-control" name="competent_authority_id" id="competent_authority_id" required>
                                        @if(old('competent_authority_id'))
                                            @php
                                                $ca = \App\ComptentAuthority::find(old('competent_authority_id'))
                                            @endphp
                                            <option value="{{ $ca->id }}">{{ $ca->name }}</option>
                                        @endif
                                    </select>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".modal-competent-authority">Add Competent Authority</button>
                                    @error('competent_authority_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="charges_id" class="control-label">Charges:</label>
                                <div>
                                    <select class="form-control charges" name="charges_id" id="charges_id" required>
                                        @if(old('charges_id'))
                                            @php
                                                $charge = \App\Charge::find(old('charges_id'))
                                            @endphp
                                            <option value="{{ $charge->id }}">{{ $charge->name }}</option>
                                        @endif
                                    </select>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".modal-charges">Add Charges</button>
                                    @error('charges_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group"><button type="submit" class="btn btn-primary">Create Case</button></div>
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
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add-office">Create Office</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-designation" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add-designation">Create Designation</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-charges" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Charges</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="charges_form" class="form-horizontal modal-form">
                        @csrf
                        <div class="form-horizontal">
                            <label for="name" class="control-label">Charges in brief: </label>
                            <div>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Designation Name..." autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Charges in Detail:</label>
                            <div>
                                <textarea placeholder="Description..." class="form-control @error('description') is-invalid @enderror" name="description" id="description"></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add-charges">Create Charges</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-competent-authority" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Competent Authority</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="competent_authority_form" class="form-horizontal modal-form">
                        @csrf
                        <div class="form-horizontal">
                            <label for="name" class="control-label">Name: </label>
                            <div>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name..." autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="designation_id_1" class="control-label">Designation:</label>
                            <div>
                                <select class="form-control" name="designation_id" id="designation_id_1" required></select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add-comp-authority">Create Competent Authority</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(() => {
        new Inputmask("99999-9999999-9").mask(document.getElementById("cnic"));
        new Inputmask('99').mask(document.getElementById('bps'));
        new Inputmask('9{1,8}').mask(document.getElementById('code'));

        $('.modal').on('show.bs.modal', event => {
            $("#designation_form")[0].reset();
            $("#office_form")[0].reset();
            $("#charges_form")[0].reset();
            $("#competent_authority_form")[0].reset();
        });

        $('[data-toggle="datepicker"]').datepicker({
            autoHide: true,
            format: 'yyyy-mm-dd',
            endDate: new Date()
        });

        $('#charges_id').select2({
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

        $('#designation_id_1').select2({
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

        $('#competent_authority_id').select2({
            placeholder:'Select Competent Authority',
            ajax: {
                url: "{{ action('ComptentAuthorityController@index') }}",
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

        $(document.body).on("click", ".btn-add-comp-authority",(evt) => {
            $("#competent_authority_form .invalid-feedback").remove();
            $.ajax({
                url: '{{ action('ComptentAuthorityController@store') }}',
                method: 'post',
                data: $("#competent_authority_form").serialize(),
                cache: false,
                success: (req, res) => {
                    if(res == 'success') {
                        $('.modal-competent-authority').modal('hide');
                        Swal.fire(
                            'Created!',
                            'Competent Authority has been created.',
                            'success'
                        )
                    }
                },
                error: (req, res) => {
                    var errors = req.responseJSON.errors;
                    $.each(errors, (index, value) => {
                        $(`#competent_authority_form [name="${index}"]`).parent().append(
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

        $(document.body).on("click", ".btn-add-charges",(evt) => {
            $("#charges_form .invalid-feedback").remove();
            $.ajax({
                url: '{{ action('ChargeController@store') }}',
                method: 'post',
                data: $("#charges_form").serialize(),
                cache: false,
                success: (req, res) => {
                    if(res == 'success') {
                        $('.modal-charges').modal('hide');
                        Swal.fire(
                            'Created!',
                            'Charges has been created.',
                            'success'
                        )
                    }
                },
                error: (req, res) => {
                    var errors = req.responseJSON.errors;
                    $.each(errors, (index, value) => {
                        $(`#charges_form [name="${index}"]`).parent().append(
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