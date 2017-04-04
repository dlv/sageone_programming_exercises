<html>
  <head>
    <title><?php echo $title ?></title>
  </head>
     
   <body>
      <form action="http://sageone.com.br/upload" method="post" enctype="multipart/form-data">
          Selecione o arquivo:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Enviar" name="send">
      </form>

      <?php echo $body ?>
   </body>
</html>
