@extends('layouts.app')

@section('content')
            <div class="panel panel-default">
                <div class="panel-heading">Menus
                    <a href="menus/create" class="btn btn-primary pull-right" style="margin-top: -7px;"> Add New Menu <span class="glyphicon glyphicon-plus" style="font-weight: bold;"></span> </a>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>status</th>
                                <th>image</th>
                                <th>Created By</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $menu->title }}</td>
                                    <td>{{ $menu->type }}</td>
                                    <td>{{ $menu->description }}</td>
                                    <td>{{ $menu->status }}</td>
                                    <td><img class="img-responsive menuThumb" src="{{ $menu->image }}"></td>
                                    <td>{{ $menu->user->name }}</td>
                                    <td>
                                        {!! Form::open(['method'=>'DELETE', 'route'=>['menus.destroy', $menu->id ]]) !!}
                                        {!! Form::submit('x', ['class'=>'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        <a href="menus/{{$menu->id}}/edit"> <span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginatios col-lg-12 text-center">
                        {!! $menus->render() !!}
                    </div>
                </div>
            </div>
@endsection
