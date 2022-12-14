@extends('layouts.main')

@section('title', 'Raspadinha Cursos - Professor')

@section ('content')  

@if($alteraAux == 0)

  <h2>{{ $professor -> nome }}</h2>
  
  <p>Nome: {{ $professor -> nome }}</p>
  <p>CPF: {{ $professor -> cpf }}</p>
  <p>Endereço: {{ $professor -> endereco }}</p>
  <h4>Informações de Login</h4>
  <p>Usuário: {{ $professor -> usuario }}</p>
  
  <form action="{{ route('altera-dados-botao-P', $professor) }}" method="get">
    <button class="btn-editar">Editar Dados</button>
  </form>
  
  <form action="{{ route('deleta-professor', $professor) }}" method="post">
    {{ csrf_field() }}
    <button class="btn-editar">Excluir professor</button>
  </form>

@endif

@if($alteraAux == 1)

  <h2>{{ $professor -> nome }}</h2>
  
  <form action="{{ route('altera-dados-P', $professor)}}" method="post">
  
    {{ csrf_field() }} 
    
    <label for="nome">Nome Completo: </label>
    <input type="text" name="nome" value="{{ $professor -> nome }}"> <br>
    
    <label for="cpf">CPF: </label>
    <input type="text" name="cpf" value="{{ $professor -> cpf }}"> <br>
    
    <label for="endereco">Endereço: </label>
    <input type="text" name="endereco" value="{{ $professor -> endereco }}"> <br>
    
    <label for="usuario">Usuário: </label>
    <input type="text" name="usuario" value="{{ $professor -> usuario }}"> <br>
    
    <button class="btn">Salvar</button>
  
  </form>

@endif

<h2 class="cursos-prof">Meus Cursos</h2>

@if(count($professor -> cursos) == 0)
  <p>Não está ministrando em nenhum curso.</p>
@endif

@foreach($professor -> cursos as $matriculado)

  <a href="{{ route('pagina-curso', [$matriculado, 'professor', 1]) }}">{{ $matriculado -> nome }}</a><br>

@endforeach

<h2 class="cursos-prof">Cursos Disponíveis</h2>

@php($matriculadoAux = 0)

@foreach($cursos as $curso)

  @php($matriculadoAux = 0)

  @foreach($professor -> cursos as $matriculado)
  
    @if($curso -> id == $matriculado -> id)
    
      @php($matriculadoAux = 1)
    
    @endif
  
  @endforeach
  
  @if($matriculadoAux == 0)
  
  <p>{{ $curso -> nome }}</p>
    <form action="{{ route('matricula-professor', [$professor, $curso]) }}" method="get">
      <button class="btn-editar">Ministrar</button>
    </form>
  
  @endif

@endforeach

@if($matriculadoAux == 1 || count($cursos) == 0)
  
  <p>Nenhum curso disponível.</p>

@endif
  
@endsection