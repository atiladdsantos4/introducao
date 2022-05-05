@extends('layouts.template')
@section('title', 'Editar Cliente')
@section('content')
<div class="container mt-4">
    <form method="POST" action="{{route('clientes.editar', $cliente)}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="" name="nome" value="{{$cliente->nome}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Cpf</label>
                    <input type="text" class="form-control" id="" name="cpf" value="{{$cliente->cpf}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nascimento</label>
                    <input id="nascimento" type="date" class="form-control" id="" name="nascimento" value="{{$cliente->nascimento}}">
                    {{-- <input type="text" class="form-control" id="" name="nascimento" value="{{$cliente->nascimento}}"> --}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Selecione o seu Avatar</label>
                        <input class="form-control" type="file" name="image">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Email</label>
            <textarea class="form-control" id="" name="email" rows="3">{{$cliente->email}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
