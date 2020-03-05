@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="card">
                <div class="card-header"><h4 style="float:left">Categorias</h4><a href="javascript:void(0)" class="float-right btn btn-success mb-2" id="create-new-category">Adicionar Categoria</a>
</div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="laravel_crud">
                        <caption>Lista de categorias</caption>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col" colspan="2">Ações</td>
                            </tr>
                        </thead>
                        <tbody id="category-crud">
                            @foreach($categories as $category)
                            <tr id="category_id_{{ $category->id }}">
                                <td>{{ $category->id  }}</td>
                                <td>{{ $category->name }}</td>
                                <td><a href="javascript:void(0)" id="edit-category" data-id="{{ $category->id }}" class="btn btn-info">Editar</a></td>
                                <td>
                                <a href="javascript:void(0)" id="delete-category" data-id="{{ $category->id }}" class="btn btn-danger delete-category">Excluir</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="category-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="categoryCrudModal"></h4>
        </div>
        <div class="modal-body">
            <form id="categoryForm" name="categoryForm" class="form-horizontal">
               <input type="hidden" name="category_id" id="category_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insira o nome da categoria" value="" maxlength="50" required="">
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
