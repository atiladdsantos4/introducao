<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\arquivo;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = cliente::orderby('id', 'desc')->paginate();
        return view('clientes.index', ['clientes' => $clientes]);
    }

    public function create(){
        return view('clientes.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Request
     */
    public function insert(Request $request)
    {
        //dd($request->nome);
        //dd('entrei_aqui');
        //dados da imagem

        // // Retorna mime type do arquivo (Exemplo image/png)
        // $file = $request->image;
        // $mime = $request->image->getMimeType();

        // // Retorna o nome original do arquivo
        // $original_name =  $request->image->getClientOriginalName();

        // // Extensão do arquivo
        // $original_ext = $request->image->getClientOriginalExtension();
        // $extensao =  $request->image->extension();
        // $path = $request->image->getPathName();
        // $conteudo = base64_encode(file_get_contents($path));
        // //$exibir = base64_decode($conteudo);
        // echo '<img src="data:image/jpeg;base64,'.trim($conteudo).'" id="teste">';

        // // Tamanho do arquivo
        // $tamanho = $request->image->getSize();
        //dd('entrei_aqui');
        //----------//
        $cliente = new cliente();

        if( $request->image != null ){

            $arq = new arquivo();
            $arq->mime = $request->image->getMimeType();
            $arq->tamanho = $request->image->getSize();
            $arq->extensao = $request->image->extension();
            $path = $request->image->getPathName();
            $conteudo = base64_encode(file_get_contents($path));
            $arq->base64 = 'data:image/jpeg;base64,'.$conteudo;
            $arq->save();
            $cliente->id_arquivo = $arq->id_arquivo;
        }

        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->nascimento = $request->nascimento;
        $cliente->email = $request->email;
        $cliente->save();
        return redirect()->route('clientes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(cliente $cliente)
    {
        //dd('entrei aqui');
        $cliente->delete();
        return redirect()->route('clientes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $cliente = cliente::find($request->id);
        return view('clientes.show',[ "clientes" => $cliente ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //dd($cliente);
        $cliente = cliente::find($cliente->id);
        return view('clientes.edit',[ "cliente" => $cliente ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    //public function editar()
    public function editar($id,Request $request)
    {
        //dd($id);
        $cliente = cliente::find($id);
        //$cliente->id = $request->id;
        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->nascimento = $request->nascimento;
        $cliente->email = $request->email;
        //if( $request->image != null && $cliente->id_arquivo ){
        if( $request->image != null && $cliente->id_arquivo == null ){
            $arq = new arquivo();
            $arq->mime = $request->image->getMimeType();
            $arq->tamanho = $request->image->getSize();
            $arq->extensao = $request->image->extension();
            $path = $request->image->getPathName();
            $conteudo = base64_encode(file_get_contents($path));
            $arq->base64 = 'data:image/'.$arq->extensao.';base64,'.$conteudo;
            $arq->save();
            $cliente->id_arquivo = $arq->id_arquivo;
        }

        if( $request->image != null && $cliente->id_arquivo != null ){
            $arq = arquivo::find($cliente->id_arquivo);
            $arq->mime = $request->image->getMimeType();
            $arq->tamanho = $request->image->getSize();
            $arq->extensao = $request->image->extension();
            $path = $request->image->getPathName();
            $conteudo = base64_encode(file_get_contents($path));
            $arq->base64 = 'data:image/'.$arq->extensao.';base64,'.$conteudo;
            $arq->save();
        }

        $cliente->save();
        $clientes = cliente::orderby('id', 'desc')->paginate();
        return view('clientes.index', ['clientes' => $clientes]);
        /*
            "id" => 2
            "nome" => "Juarez Santos"
            "cpf" => "14265487910"
            "nascimento" => "1967-09-14"
            "email" => "juarezsantos@gmail.com"
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }

    //--> Ajax Functions <--//
    public function loadimg(Request $request){
       $token = $request->_token;
       $id_avatar = $request->id_avatar;
       $nome_avatar = $request->nome_avatar;
       $cliente = cliente::find($request->id_avatar);
       $output = array(
          'token' => $token,
          'id' => $id_avatar,
          'nome' => $cliente->nome,
          'img' => $cliente->arquivo->base64,
       );
       return json_encode($output);
    }
}
