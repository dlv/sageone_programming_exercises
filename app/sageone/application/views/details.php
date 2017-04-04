<html>
   <head>
     <title><?php echo $title ?></title>
     <style>
        body { position:relative; margin:1em 2em; font:12px monaco,monospace; }
        input[type=text] {
          width: 100%;
          padding: 12px 20px; 
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
        }
        input[type=submit], button {
          width: 100%;
          background-color: #4CAF50;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        }
        div {
          width: 98%;
          height: 70%;
          border-radius: 5px;
          background-color: #f2f2f2;
          padding: 20px;
          overflow-x: hidden;
        }
     </style> 
   </head>
 
    <body>
      <form action="http://sageone.com.br/update" method="post">
        <div>
           Código: <input type="text" name="id" id="id" value=<?php echo $data[0]['id'] ?> readonly />
           <br />
           Descrição: <input type="text" name="description" id="description" value=<?php echo $data[0]['description'] ?>  />
           <br />
           Categoria: <input type="text" name="categorie" id="categorie" value=<?php echo $data[0]['categorie'] ?>  />
           <br />
           Unidade: <input type="text" name="unity" id="unity" value=<?php echo $data[0]['unity'] ?>  />
           <br />
           Custo: <input type="text" name="cost" id="cost" value=<?php echo number_format($data[0]['cost'],2) ?> />
           <br />
           Preço de Veda 1: <input type="text" name="sale_price_1" id="sale_price_1" value=<?php echo number_format($data[0]['sale_price_1'],2) ?>  />
           <br />
           Preço de Veda 2: <input type="text" name="sale_price_2" id="sale_price_2" value=<?php echo number_format($data[0]['sale_price_2'],2) ?>  />
           <br />
           Preço de Veda 3: <input type="text" name="sale_price_3" id="sale_price_3" value=<?php echo number_format($data[0]['sale_price_3'],2) ?>  />
           <br />
           Obeservações: <input type="text" name="observation" id="observation" value=<?php echo $data[0]['observation'] ?>  />
           <br />
           Fornecedor: <input type="text" name="provider" id="provider" value=<?php echo $data[0]['provider'] ?>  />
           <br />
           Estoque: <input type="text" name="stock" id="stock" value=<?php echo $data[0]['stock'] ?>  />
           <br />
           Cód Barras: <input type="text" name="barcode" id="barcode" value=<?php echo $data[0]['barcode'] ?>  />
           <br />
           Estoque Mínimo: <input type="text" name="min_stock" id="min_stock" value=<?php echo $data[0]['min_stock'] ?>  />
           <br />
           Estoque Máximo: <input type="text" name="max_stock" id="max_stock" value=<?php echo $data[0]['max_stock'] ?>  />
           <br />
           Estoque Compra: <input type="text" name="stock_purchase" id="stock_purchase" value=<?php echo $data[0]['stock_purchase'] ?>  />
           <br />
           Fator unid. de Venda: <input type="text" name="stock_purchase" id="stock_purchase" value=<?php echo $data[0]['sales_unit_factor'] ?>  />            <br />
           NCM: <input type="text" name="NCM" id="NCM" value=<?php echo $data[0]['NCM'] ?>  />
           <br />
           Marca: <input type="text" name="mark" id="mark" value=<?php echo $data[0]['mark'] ?>  />
           <br />
           Peso: <input type="text" name="weight" id="weight" value=<?php echo $data[0]['weight'] ?>  />
           <br />
           Tamanho: <input type="text" name="size" id="size" value=<?php echo $data[0]['size'] ?>  />
           <br />
           Inativo: <input type="text" name="inactive" id="inactive" value=<?php echo $data[0]['inactive'] ?>  /> 
           <br />
           Tipo: <input type="text" name="type" id="type" value=<?php echo $data[0]['type'] ?>  />
           <br />
           Composição: <input type="text" name="composition" id="composition" value=<?php echo $data[0]['composition'] ?>  />
           <br />
           Máteria Prima: <input type="text" name="feedstock" id="feedstock" value=<?php echo $data[0]['feedstock'] ?> />
           <br />
            Meterial Expediente: <input type="text" name="business_material" id="business_material" value=<?php echo $data[0]['business_mateiral'] ?>  />
           <br />
           Para Venda: <input type="text" name="for_sale" id="for_sale" value=<?php echo $data[0]['for_sale'] ?> />
           <br />
           Moeda: <input type="text" name="coin" id="coin" value=<?php echo $data[0]['coin'] ?> />
           <br />
           IPI: <input type="text" name="stock_purchase" id="stock_purchase" value=<?php echo $data[0]['ipi'] ?>  />
           <br />
           Gender: <input type="text" name="stock_purchase" id="stock_purchase" value=<?php echo $data[0]['gender'] ?>  />
           <br />
       </div>
       <input type="submit" value="Atualizar"/>
    </form>
    <button type="button" onclick="window.location.href='http://sageone.com.br'">Voltar</button>
  </body>
 </html>

