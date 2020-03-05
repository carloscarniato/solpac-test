@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="card">
                <div class="card-header"><h4 style="float:left">Produtos</h4><a href="javascript:void(0)" class="float-right btn btn-success mb-2" id="create-new-product">Adicionar Produto</a>
</div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="laravel_crud">
                        <caption>Lista de produtos</caption>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Categoria</th>
                                <th scope="col" colspan="2">Ações</td>
                            </tr>
                        </thead>
                        <tbody id="product-crud">
                            @foreach($products as $product)
                            <tr id="product_id_{{ $product->id }}">
                                <td>{{ $product->id  }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category }}</td>
                                <td><a href="javascript:void(0)" id="edit-product" data-id="{{ $product->id }}" class="btn btn-info">Editar</a></td>
                                <td>
                                <a href="javascript:void(0)" id="delete-product" data-id="{{ $product->id }}" class="btn btn-danger delete-product">Excluir</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="product-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="productCrudModal"></h4>
        </div>
        <div class="modal-body">
            <form id="productForm" name="productForm" class="form-horizontal">
               <input type="hidden" name="product_id" id="product_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insira o nome do produto" value="" maxlength="50" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">Categoria</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="category" name="category" placeholder="Insira o nome do produto" >
                            <option value="0" selected disabled>Selecione uma categoria</option>
                            @foreach($categories as $category)
                                <option value='{{$category->id}} - {{ $category->name }}'>{{$category->id}} - {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Salvar</button>
                    </button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>
@endsection
