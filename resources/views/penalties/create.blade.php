@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8"><h1>Create Penalty</h1></div>
                <div class="col-4 text-right">
                    <a href="{{ action('PenaltyController@index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ action('PenaltyController@store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="penalty_type_id" class="control-label">Penalty Type:</label>
                    <div>
                        <select class="form-control @error('penalty_type_id') is-invalid @enderror" name="penalty_type_id" id="penalty_type_id" required>
                            @if(old('penalty_type_id'))
                                @php
                                $penaltyType = \App\PenaltyType::find(old('penalty_type_id'))
                                @endphp
                                <option value="{{ $penaltyType->id }}">{{ $penaltyType->name }}</option>
                            @endif
                        </select>
                        @error('penalty_type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Penalty Name:</label>
                    <div>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Penalty Name..." required autocomplete="off" value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="control-label">Description:</label>
                    <div>
                        <textarea placeholder="Penalty Description..." class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(() => {

        $('#penalty_type_id').select2({
            placeholder:'Select a Penalty Type',
            ajax: {
                url: "{{ action('PenaltyTypeController@index') }}",
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