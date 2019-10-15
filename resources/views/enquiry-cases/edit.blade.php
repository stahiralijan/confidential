@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Finalize Case</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('EnquiryCaseController@index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                @endif
                <div class="form-horizontal">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="enquiry_no" class="control-label">Enquiry Number:</label>
                                <div>
                                    <input class="form-control" value="{{ $enquiryCase->enquiry_no }}" type="text" name="enquiry_no" id="enquiry_no" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Employee Name:</label>
                                <div>
                                    <input class="form-control" value="{{ optional($enquiryCase->employee)->fullname }}" type="text" name="name" id="name" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="designation_id" class="control-label">Designation:</label>
                                <div>
                                    <input type="text" name="designation_id" id="designation_id" class="form-control" value="{{ optional($enquiryCase->designation)->name }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="office_id" class="control-label">Office:</label>
                                <div>
                                    <input type="text" name="office_id" id="office_id" class="form-control" value="{{ optional($enquiryCase->office)->name }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cnic" class="control-label">CNIC:</label>
                                <div>
                                    <input class="form-control" value="{{ optional($enquiryCase->employee)->cnic }}" type="text" name="cnic" id="cnic" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="issue_date" class="control-label">Issue Date:</label>
                                <div>
                                    <input class="form-control" type="text" name="issue_date" id="issue_date" value="{{ $enquiryCase->issue_date->format('Y-m-d') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="competent_authority_id" class="control-label">Competent Authority:</label>
                                <div>
                                    <input class="form-control" type="text" name="competent_authority_id" id="competent_authority_id" value="{{ optional($enquiryCase->competent_authority)->name }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="charges_id" class="control-label">Charges:</label>
                                <div>
                                    <input class="form-control" type="text" name="charges_id" id="charges_id" value="{{ optional($enquiryCase->charges)->name }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <form action="{{ action('EnquiryCaseController@update', $enquiryCase) }}" method="post" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="case_id" value="{{ $enquiryCase->id }}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="punishment_id" class="control-label">Punishment:</label>
                                <div>
                                    <select class="form-control charges" name="punishment_id" id="punishment_id" required>
                                        @if(old('punishment_id'))
                                            @php
                                                $punishment = \App\Punishments::find(old('punishment_id'))
                                            @endphp
                                            <option value="{{ $punishment->id }}">{{ $punishment->name }}</option>
                                        @endif
                                    </select>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".modal-punishment">Add Punishment</button>
                                    @error('punishment_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="imposing_authority_id" class="control-label">Imposing Authority:</label>
                                <div>
                                    <select class="form-control" name="imposing_authority_id" id="imposing_authority_id" required>
                                        @if(old('imposing_authority_id'))
                                            @php
                                                $ca = \App\ComptentAuthority::find(old('imposing_authority_id'))
                                            @endphp
                                            <option value="{{ $ca->id }}">{{ $ca->name }}</option>
                                        @endif
                                    </select>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".modal-imposing-authority">Add Imposing Authority</button>
                                    @error('imposing_authority_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="remarks" class="control-label">Remarks:</label>
                                <div>
                                    <textarea name="remarks" id="remarks" rows="10" class="form-control" >{{ old('remarks') }}</textarea>
                                    @error('remarks')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><button type="submit" class="btn btn-primary">Finalize Case</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade modal-punishment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Punishment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="punishment_form" class="form-horizontal modal-form">
                        @csrf
                        <div class="form-horizontal">
                            <label for="name" class="control-label">Punishment Name: </label>
                            <div>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Punishment Name..." autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="form-horizontal">
                            <label for="punishment_detail" class="control-label">Punishment Detail: </label>
                            <div>
                                <textarea type="text" name="punishment_detail" id="punishment_detail" class="form-control" placeholder="Punishment Detail..." autocomplete="off"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add-punishment">Create Punishment</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-imposing-authority" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Imposing Authority</h5>
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
                    <button type="button" class="btn btn-primary btn-add-comp-authority">Create Imposing Authority</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(() => {

        $('.modal').on('show.bs.modal', event => {
            $("#punishment_form")[0].reset();
            $("#competent_authority_form")[0].reset();
        });

        $('[data-toggle="datepicker"]').datepicker({
            autoHide: true,
            format: 'yyyy-mm-dd',
            endDate: new Date()
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

        $('#punishment_id').select2({
            placeholder:'Select a Punishment',
            ajax: {
                url: "{{ action('PunishmentsController@index') }}",
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

        $('#imposing_authority_id').select2({
            placeholder:'Select Imposing Authority',
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

        $(document.body).on("click", ".btn-add-comp-authority",(evt) => {
            $("#competent_authority_form .invalid-feedback").remove();
            $.ajax({
                url: '{{ action('ComptentAuthorityController@store') }}',
                method: 'post',
                data: $("#competent_authority_form").serialize(),
                cache: false,
                success: (req, res) => {
                    if(res == 'success') {
                        $('.modal-imposing-authority').modal('hide');
                        Swal.fire(
                            'Created!',
                            'Imposing Authority has been created.',
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

        $(document.body).on("click", ".btn-add-punishment",(evt) => {
            $("#punishment_form .invalid-feedback").remove();
            $.ajax({
                url: '{{ action('PunishmentsController@store') }}',
                method: 'post',
                data: $("#punishment_form").serialize(),
                cache: false,
                success: (req, res) => {
                    if(res == 'success') {
                        $('.modal-punishment').modal('hide');
                        Swal.fire(
                            'Created!',
                            'Punishment has been created.',
                            'success'
                        )
                    }
                },
                error: (req, res) => {
                    var errors = req.responseJSON.errors;
                    $.each(errors, (index, value) => {
                        $(`#punishment_form [name="${index}"]`).parent().append(
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