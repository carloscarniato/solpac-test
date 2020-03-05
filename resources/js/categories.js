$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*  When category click add category button */
    $('#create-new-category').click(function () {
        $('#btn-save').val("create-category");
        $('#category_id').val('');
        $('#categoryForm').trigger("reset");
        $('#categoryCrudModal').html("Adicionar categoria");
        $('#category-modal').modal('show');
        $('#btn-save').html('Adicionar');
    });

   /* When click edit category */
    $('body').on('click', '#edit-category', function () {
      var category_id = $(this).data('id');
      $.get('/categorias/' + category_id + '/edit' , function (data) {
         $('#categoryCrudModal').html("Editar categoria");
          $('#btn-save').val("edit-category");
          $('#category-modal').modal('show');
          $('#category_id').val(data.id);
          $('#name').val(data.name);
      })
   });
   //delete category login
    $('body').on('click', '.delete-category', function () {
        var category_id = $(this).data("id");
        confirm("Você tem certeza que deseja excluir?");

        $.ajax({
            type: "DELETE",
            url: '/categorias/'+category_id,
            success: function (data) {
                $("#category_id_" + category_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
  });

 if ($("#categoryForm").length > 0) {
      $("#categoryForm").validate({

     submitHandler: function(form) {

      var actionType = $('#btn-save').val();
      $('#btn-save').html('Enviando..');

      $.ajax({
          data: $('#categoryForm').serialize(),
          url: "",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              var category = '<tr id="category_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td>';
              category += '<td><a href="javascript:void(0)" id="edit-category" data-id="' + data.id + '" class="btn btn-info">Editar</a></td>';
              category += '<td><a href="javascript:void(0)" id="delete-category" data-id="' + data.id + '" class="btn btn-danger delete-category">Excluir</a></td></tr>';


              if (actionType == "create-category") {
                  $('#category-crud').prepend(category);
              } else {
                  $("#category_id_" + data.id).replaceWith(category);
              }

              $('#categoryForm').trigger("reset");
              $('#category-modal').modal('hide');
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
