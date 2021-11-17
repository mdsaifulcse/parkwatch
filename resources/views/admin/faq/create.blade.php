@extends('admin.template')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown m-r--5">   
                    <li>
                        <a href="{{ url('admin/faqs') }}" class="btn btn-sm btn-primary waves-effect">
                            <i class="material-icons">list</i>
                            <span>List</span>
                        </a> 
                    </li>  
                </ul>
            </div> 


            <div class="body">
                {!! Form::open(['route' => 'faqs.store', 'method'=>'POST', 'class' => 'form-validation frmValidation', 'files' => true]) !!}

                    <label for="name">Title *</label>
                    <div class="form-group">
                        <div class="form-line  {{ $errors->has('question') ? 'error focused' : '' }}">
                            <input name="question" type="text" id="question" class="form-control" required placeholder="Enter Title Here" value="{{ old('question') }}">
                        </div>
                        @if ($errors->has('question'))
                            <label class="error">{{ $errors->first('question') }}</label>
                        @endif
                    </div>


                <label for="address">{{ Lang::label('Description') }}</label>
                <div class="form-group">
                    <div class="form-line  {{ $errors->has('answer') ? 'error focused' : '' }}">
                        <textarea name="answer" type="text" id="answer" required  class="form-control" placeholder="Description">{{old('answer')}}</textarea>
                    </div>
                    @if ($errors->has('answer'))
                        <label class="error">{{ $errors->first('answer') }}</label>
                    @endif
                </div>


                    <div class="row">
                        <div class="col-sm-4">
                            <label for="status">Type : </label>
                            <div class="form-group">
                                <div class="form-line  {{ $errors->has('country_id') ? 'error focused' : '' }}">
                                    {{ Form::select('type', $type,  old('type'), ['class'=>'form-control', 'required'=>true,'id'=>'countryId', 'placeholder'=>Lang::label('Select Option')]) }}
                                </div>

                                @if ($errors->has('type'))
                                    <label class="error">{{ $errors->first('type') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label for="status">{{ Lang::label('Status') }} : </label>
                            <div class="switch {{ $errors->has('status') ? 'error focused' : '' }}">
                                <label>
                                    OFF<input name="status" type="checkbox" checked="" value="{{\App\Models\Country::PUBLISHED}}">
                                    <span class="lever"></span>ON
                                </label>
                                @if ($errors->has('status'))
                                    <label class="error">{{ $errors->first('status') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="reset" class="btn btn-danger waves-effect">{{ Lang::label('Reset') }}</button>
                            <button type="submit" class="btn btn-success waves-effect">{{ Lang::label('Save') }}</button>
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
