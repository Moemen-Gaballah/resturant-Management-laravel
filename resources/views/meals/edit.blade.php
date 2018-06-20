@extends('layouts.app')
@section('content')

                 <div class="panel panel-default">
                    <div class="panel-heading">Edit meal: {{ $meal->title }}</div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            {!! Form::model($meal, array('method' => 'PATCH', 'action' => ['MealsController@update', $meal->id],'files' => true)) !!}
                            <div class="form-group col-lg-3">
                                {!! Form::text('title', null, array('required', 'class' => 'form-control', 'placeholder' => 'New meal Title')) !!}
                            </div>

                            <div class="form-group col-lg-3">
                                {!! Form::select('status', ['1'=>'Active','0'=>'Inactive'], null, array('required', 'class' => 'form-control', 'placeholder' => 'meal Status')) !!}
                            </div>

                            <div class="form-group col-lg-3">
                                {!! Form::number('price', null, array('required', 'step' => 'any', 'class' => 'form-control', 'placeholder' => 'meal Price')) !!}
                            </div>

                            <div class="form-group col-lg-3">
                                {!! Form::file('image', array('class' => 'form-control', 'placeholder' => 'Upload photo')) !!}
                            </div>

                            <div class="form-group col-lg-12">
                                {!! Form::textarea('description', null, array('required', 'class' => 'form-control', 'placeholder' => 'meal Description')) !!}
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-lg-12">
                                @foreach($menus as $menu)
                                    @if(count($menu->items) > 0)
                                        <h4>{{ $menu->title }}</h4>
                                        <div class="form-group col-lg-6 menuItems">
                                            <ul>
                                                @foreach($menu->items as $item)
                                                    <li> <input
                                                                @if (in_array($item->id, $mealItemsIDs))
                                                                        checked
                                                                @endif
                                                                type="checkbox"
                                                                name="items[]"
                                                                value="{{ $item->id }}">
                                                                @if (in_array($item->id, $mealItemsIDs))
                                                                    <div class="alert alert-danger">
                                                                        {{$item->title}}
                                                                    </div>
                                                                @else
                                                                    {{$item->title}}
                                                                @endif
                                                        {{ $item->title }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-lg-2">
                                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                            </div>

                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset($meal->image) }}" alt="{{ $meal->title }}" class="img-rounded img-responsive editMenuImg">
                        </div>
                    </div>
                 </div>
@endsection