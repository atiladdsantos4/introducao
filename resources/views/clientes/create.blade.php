@extends('layouts.template')
@section('title', 'Inserir Cliente')
@section('content')
<div class="container mt-4">
    <form method="POST"  action="{{route('clientes.insert')}}" enctype="multipart/form-data">
        @csrf
        {{-- @method('put') --}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="" name="nome" value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Cpf</label>
                    <input type="text" class="form-control" id="" name="cpf" value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nascimento</label>
                    <input id="nascimento" type="date" class="form-control" id="" name="nascimento">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" id="" name="email" value="">
                </div>
            </div>
        </div>
        <div class="form-group">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" name="image">
                </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
              <img src="imagem.jpg" alt="Minha Figura">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
