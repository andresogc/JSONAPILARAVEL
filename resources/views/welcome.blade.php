
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        
            <div class="m-4">
                <h2 class="text-white-50">Lista de usuarios</h2>
                <div class="row " >
                @foreach($usersArray as $user )
                    <div class="col-sm-3 m-4">
                        <div class="card bg-info" style="width: 14rem;">
                            <div class="card-body">
                                <h5 class="card-title ">{{$user['name']}}</h5>
                                <p class="card-text text-white">{{$user['email']}}</p>
                                <a href="{{route('listaTodos', $user['id'])}}" class="btn btn-warning">Ver ToDos</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
