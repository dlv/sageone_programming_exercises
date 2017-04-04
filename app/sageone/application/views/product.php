<!DOCTYPE html>
<html>
  <head>
    <style>
      table {
       font-family: arial, sans-serif;
       border-collapse: collapse;
       width: 100%;
      }

      td, th {
       border: 1px solid #dddddd;
       text-align: left;
       padding: 8px;
      }

      tr:nth-child(even) {
       background-color: #dddddd;
      }

      input[type=submit], button {
        width: 20%;
        background-color: #4CAF50;
        color: white;
        padding: 7px 10px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

    </style>
  </head>
  <body>

  <table id="products">
    <tr>
      <th>Código</th>
      <th>Descrição</th>
      <th>Categoria</th>
      <th></th>
    </tr>
    <?php foreach($data as $value) { ?>
    <tr>
      <td><?php echo $value['id'] ?></td>
      <td><?php echo $value['description'] ?></td>
      <td><?php echo $value['categorie'] ?></td>
      <td> 
          <button type="button" onclick="alterar(this)" >Detalhes</button>
          <button type="button" onclick="excluir(this)" >Excluir</button>
      </td>
    </tr>
    <?php } ?>
  </table>
  <script type="text/javascript" >
    function alterar(x) {
     var id = x.parentNode.parentNode.cells[0].innerHTML;
     var url = 'http://sageone.com.br/details/'+id;
     x.addEventListener('click', function(event) {
          window.location.href=url;
     });
    }
 
    function excluir(y) {
     var id = y.parentNode.parentNode.cells[0].innerHTML;
     var url = 'http://sageone.com.br/delete/'+id;
     y.addEventListener('click', function(event) {
        window.location.href=url;
     });
    }
  </script>
 </body>
</html>

