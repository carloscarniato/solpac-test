$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*  When product click add product button */
    $('#create-new-product').click(function () {
        $('#btn-save').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#productCrudModal').html("Adicionar produto");
        $('#product-modal').modal('show');
        $('#btn-save').html('Adicionar');
    });

   /* When click edit product */
    $('body').on('click', '#edit-product', function () {
      var product_id = $(this).data('id');
      $.get('/produtos/' + product_id + '/edit' , function (data) {
         $('#productCrudModal').html("Editar produto");
          $('#btn-save').val("edit-product");
          $('#product-modal').modal('show');
          $('#product_id').val(data.id);
          $('#name').val(data.name);
          $('#category').val(data.category);
      })
   });
   //delete product login
    $('body').on('click', '.delete-product', function () {
        var product_id = $(this).data("id");
        confirm("Você tem certeza que deseja excluir?");

        $.ajax({
            type: "DELETE",
            url: '/produtos/'+product_id,
            success: function (data) {
                $("#product_id_" + product_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
  });

 if ($("#productForm").length > 0) {
      $("#productForm").validate({

     submitHandler: function(form) {

      var actionType = $('#btn-save').val();
      $('#btn-save').html('Enviando..');

      $.ajax({
          data: $('#productForm').serialize(),
          url: "",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              console.log(data);
              var product = '<tr id="product_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.category + '</td>';
              product += '<td><a href="javascript:void(0)" id="edit-product" data-id="' + data.id + '" class="btn btn-info">Editar</a></td>';
              product += '<td><a href="javascript:void(0)" id="delete-product" data-id="' + data.id + '" class="btn btn-danger delete-product">Excluir</a></td></tr>';


              if (actionType == "create-product") {
                  $('#product-crud').prepend(product);
              } else {
                  $("#product_id_" + data.id).replaceWith(product);
              }

              $('#productForm').trigger("reset");
              $('#product-modal').modal('hide');
              $('#btn-save').html('Salvar');

          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Salvar');
          }
      });
    }
  })
}
