@extends('layouts.template')
@section('title', 'Clientes')
@section('content')
<?php
@session_start();
if(@$_SESSION['id_usuario'] == null){
  echo "<script language='javascript'> window.location='./' </script>";
}
if(!isset($id)){
  $id = "";

}

?>
<div class="container">

<a href="{{route('clientes.inserir')}}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir Cliente</a>

<!-- DataTales Example -->
<div class="card shadow mb-4">

<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>CPF</th>
          <th>Nascimento</th>
          <th>email</th>
        </tr>
      </thead>

      <tbody>
      @foreach($clientes as $cliente)
         <tr>
            <td>{{$cliente->nome}}</td>
            <td>{{$cliente->cpf}}</td>
            <td>{{$cliente->nascimento}}</td>
            <td>{{$cliente->email}}</td>
            <td>
            <a title="Detalhes do Cliente" href="{{route('clientes.descricao', $cliente->id)}}"><i class="fas fa-eye text-primary mr-1"></i></a>
            <a href="{{route('clientes.edit', $cliente)}}"><i class="fas fa-edit text-info mr-1"></i></a>
            <a href="#"><i id="{{$cliente->id}}" class="fas fa-trash text-danger mr-1"></i></a>
            <a href="#"><i id="{{$cliente->id}}" class="fas fa-user text-success mr-1"></i></a>
            {{-- <a href="{{route('produtos.modal', $cliente)}}"><i class="fas fa-trash text-danger mr-1"></i></a> --}}
            </td>
        </tr>
        @endforeach
      </tbody>
  </table>
</div>
</div>
</div>


    <!-- {{$clientes->links()}} -->


</div>

<script type="text/javascript">
  $(document).ready(function () {
    $('#dataTable').dataTable({
      "ordering": false
    })

  });
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletar Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         Deseja Realmente Excluir este Registro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form id="form_deleta" method="POST" action="{{route('clientes.delete', $id)}}">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Avatar Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Avatar Cliente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-center">
                <input type="text" id="valor">
                <img class="avatar" src="">
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
</div>

<?php
if(@$id != ""){
  echo "<script>$('#exampleModal').modal('show');</script>";
}
?>

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
@section('footer_scripts')
    <script type="text/javascript">
        $('.fa-trash').click(function(){
            let valor = $(this).prop("id");
            let url = window.location.origin;
            $("#identificador").remove();
            $('#form_deleta').append(('<input type="hidden" id="identificador" name="id" value="'+valor+'">'));
            $("#form_deleta").attr('action', url+'/clientes/'+valor);
            $('#exampleModal').modal('show');
        });

        $('.fa-user').click(function(){
            let dadosForm = [];
            dadosForm.push(
               {'name': '_token','value': $( "input[name^='_token']" ).val()},
               {'name': 'id_avatar', 'value': $(this).prop("id")},
            )
            $.post('{{route('cli.imagem')}}', dadosForm, function(resultado) {
            }, 'json')
                .done(function(resultado) {
                    $("#staticBackdrop").modal('show');
                    $("#valor").val(resultado.id+'-'+resultado.nome);
                    $(".avatar").attr("src",resultado.img);
                    //alert(resultado.id);
                    // if(resultado.valid){
                    //     var retorno = resultado.html;
                    //     //$("#id_datas").html(resultado.html);
                    // } else {
                    //     $('.modal-error').modal('show');
                    //     $('.modal-error').modal('show');
                    // }
                })
                .always(function(resultado) {
                null;
            });
        });

    </script>
@endsection


