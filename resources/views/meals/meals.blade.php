@extends('layouts.app')

@section('content')
            <div class="panel panel-default">
                <div class="panel-heading">meals
                    <a href="/meals/create" class="btn btn-primary pull-right" style="margin-top: -7px;"> Add New meal <span class="glyphicon glyphicon-plus" style="font-weight: bold;"></span> </a>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>image</th>
                                <th>Created By</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($meals as $meal)
                                <tr>
                                    <td>{{ $meal->id }}</td>
                                    <td>{{ $meal->title }}</td>
                                    <td>{{ $meal->description }}</td>
                                    <td>{{ $meal->price }}</td>
                                    <td>{{ $meal->status }}</td>
                                    <td><img class="img-responsive mealThumb" src="{{ $meal->image }}"></td>
                                    <td>{{ $meal->user->name }}</td>
                                    <td>
                                        {!! Form::open(['method'=>'DELETE', 'route'=>['meals.destroy', $meal->id ]]) !!}
                                        {!! Form::submit('x', ['class'=>'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        <a href="meals/{{$meal->id}}/edit"> <span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginatios col-lg-12 text-center">
                        {!! $meals->render() !!}
                    </div>
                </div>
            </div>
@endsection
