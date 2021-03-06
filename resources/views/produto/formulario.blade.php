@extends('layout.principal')

@section('conteudo')

<h1>{{ isset($p) ? 'Alterar Produto ' . $p->nome : 'Novo Produto' }}</h1>

@if(count($errors))
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
	
<form method="post" action="{{ isset($p) ? action('ProdutoController@altera') : action('ProdutoController@adiciona') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
	@if(isset($p))
		<input type="hidden" name="id" value="{{ $p->id }}">
	@endif
	
	<div class="form-group">
		<label for="nome">Nome</label>
		<input type="text" name="nome" class="form-control" value="{{ isset($p) ? $p->nome : old('nome') }}">
	</div>
	<div class="form-group">
		<label for="descricao">Descrição</label>
		<input type="text" name="descricao" class="form-control" value="{{ isset($p) ? $p->descricao : old('descricao') }}">
	</div>
	<div class="form-group">
		<label for="valor">Valor</label>
		<div class="input-group">
			<div class="input-group-addon">R$</div>
			<input type="text" name="valor" class="form-control" value="{{ isset($p) ? $p->valor : old('valor') }}">
		</div>
	</div>
	<div class="form-group">
		<label for="quantidade">Quantidade</label>
		<input type="number" name="quantidade" class="form-control" value="{{ isset($p) ? $p->quantidade : old('quantidade') }}">
	</div>
	
	<hr>
	<button type="submit" class="btn btn-primary">
		<span class="glyphicon glyphicon-floppy-disk"></span> {{ isset($p) ? 'Alterar' : 'Adicionar' }}
	</button>
	<button id="btn-cancelar" type="button" class="btn btn-danger">
		<span class="glyphicon glyphicon-remove"></span> Cancelar
	</button>
</form>

<!-- Scripts da página -->
<script type="text/javascript">
	$(document).ready(function () {
		// Evento para retornar a tela inicial
		$('#btn-cancelar').click(function () {
			window.location = "{{ action('ProdutoController@lista') }}";
		});
	});
</script>
@stop