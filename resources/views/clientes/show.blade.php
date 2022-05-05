@extends('layouts.template')
@section('title', 'Clientes')
@section('content')
<?php
   $nasc = $clientes->nascimento;
   $nasc_format = explode("-",$nasc);
   if( isset($clientes->arquivo) ){
      //$avatar = $clientes->arquivo->base64;
     $avatar = '<img class="avatar" src="'.$clientes->arquivo->base64.'">';
   } else {
      $avatar = null;
   }
?>

        <div class="jumbotron">
        <h1 class="display-4"><?php echo $clientes->nome; ?> </h1>
        <p class="lead">cpf: <?php echo substr($clientes->cpf,0,3).'.'.substr($clientes->cpf,3,3).'.'.substr($clientes->cpf,6,3).'-'.substr($clientes->cpf,9,2); ?></p>
        <p class="lead">Nascimento: <?php echo $nasc_format[2].'/'.$nasc_format[1].'/'.$nasc_format[0]; ?></p>
        <p class="lead">E-mail: <?php echo $clientes->email; ?></p>
        <p class="lead">Avatar: <?php echo $avatar; ?></p>
        <hr class="my-4">
        {{-- <a class="btn btn-primary btn-lg" href="{{route('clientes')}}" role="button">Lista de Clientes</a> --}}
        </div>
@endsection
@section('button_group')
    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
       <a href="{{route('clientes')}}" class="btn btn-primary active" aria-current="page">Lista de Clientes</a>
       <a href="{{route('clientes.edit',$clientes->id)}}" class="btn btn-warning">Editar</a>
       <a href="{{route('clientes.inserir')}}" class="btn btn-success">Novo Cliente</a>
    </div>

    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div>
          An example alert with an icon
        </div>
      </div>
@endsection

@section('css_scripts')
    <style>
        /* .avatar {
          width: 20%;
          height: auto;
        } */
    .avatar {
        vertical-align: middle;
        width: 20%;
        height: 20%;
        border-radius: 50%;
      }
    </style>
@endsection
