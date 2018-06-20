@extends('layouts.app')
@section('content')

                 <div class="panel panel-default">
                    <div class="panel-heading">Edit item: {{ $item->title }}</div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            {!! Form::model($item, array('method' => 'PATCH', 'action' => ['ItemController@update', $item->id],'files' => true)) !!}
                            <div class="form-group col-lg-4">
                                {!! Form::text('title', null, array('required', 'class' => 'form-control', 'placeholder' => 'New item Title')) !!}
                            </div>

                            <div class="form-group col-lg-4">
                                {!! Form::select('menu_id', $menus, null, array('required', 'class' => 'form-control', 'placeholder' => 'Choose Item Menu')) !!}
                            </div>

                            <div class="form-group col-lg-4">
                                {!! Form::select('status', ['1'=>'Active','0'=>'Inactive'], null, array('required', 'class' => 'form-control', 'placeholder' => 'item Status')) !!}
                            </div>

                            <div class="form-group col-lg-12">
                                {!! Form::textarea('description', null, array('required', 'class' => 'form-control', 'placeholder' => 'item Description')) !!}
                            </div>

                            <div class="form-group col-lg-4">
                                {!! Form::number('price', null, array('required', 'step' => 'any', 'class' => 'form-control', 'placeholder' => 'Item Price')) !!}
                            </div>

                            <div class="form-group col-lg-4">
                                {!! Form::file('image', array('class' => 'form-control', 'placeholder' => 'Upload photo')) !!}
                            </div>

                            <div class="form-group col-lg-2">
                                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                            </div>

                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="img-rounded img-responsive editMenuImg">
                        </div>
                    </div>
                 </div>
@endsection