@extends('layouts.app')

@section('content')
            <div class="panel panel-default">
                <div class="panel-heading">items
                    <a href="/items/create" class="btn btn-primary pull-right" style="margin-top: -7px;"> Add New item <span class="glyphicon glyphicon-plus" style="font-weight: bold;"></span> </a>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>status</th>
                                <th>image</th>
                                <th>Created By</th>
                                <th>Menu</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td><img class="img-responsive itemThumb" src="{{ $item->image }}"></td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->menu->title }}</td>
                                    <td>
                                        {!! Form::open(['method'=>'DELETE', 'route'=>['items.destroy', $item->id ]]) !!}
                                        {!! Form::submit('x', ['class'=>'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        <a href="items/{{$item->id}}/edit"> <span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginatios col-lg-12 text-center">
                        {!! $items->render() !!}
                    </div>
                </div>
            </div>
@endsection
