<?php defined('SYSPATH') or die('No direct script access.');

class Model_Products extends Model
{
  public function validation()
  {
    if (!isset($_FILES['fileToUpload']))
        return "Parametro de upload incorreto.";
    
    $validation = Validation::factory($_FILES)
      ->rules('fileToUpload', array(
        array('Upload::not_empty'),
        array('Upload::valid'),
        array('Upload::type', array(':value', array('txt','csv'))),
        array('Upload::size', array(':value', '2M'))
    ));

    return $validation->check();
  }

  public function parse()
  {
    $file = $_FILES['fileToUpload'];

    if($file['type'] == 'text/csv')
    {
      $data = $this->parse_csv($file,';');

      foreach ($data as $value)
      {

        $item = html_entity_decode(utf8_decode('Identificação'));
        $find = $this->get_id($value[$item]);

        if (empty($find))
          $this->insert($value);
      }
    }
    else if($file['type'] == 'text/plain')
    {
      $data = $this->parse_txt($file);
    }
  }

  private function parse_csv($file, $delimiter)
  {
    if(!file_exists($file['tmp_name']) || !is_readable($file['tmp_name']))
      return 'Arquivo não localizado';

    $header = NULL;
    $data = array();

    if (($handle = fopen($file['tmp_name'], 'r')) !== FALSE)
    {
      while(($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
      {
        if(!$header)
          $header = $row;
        else
          $data[] = array_combine($header,$row);
      }

      fclose($handle);
    }

    return $data;
  }

  private function parse_txt($file)
  {
    $txt_file = file_get_contents($file['tmp_name']);
    $rows = explode("\n", $txt_file);
    $begin = FALSE;
    $products = array();

    array_shift($rows);
    
    foreach($rows as $row => $data)
    {
      if (0 === strpos($data, 'I')) {
        if($begin)
          array_push($products, $itens);

        $row_data = explode('|', $data);
        $begin = TRUE;
        $itens = array();
      }

      // $row_data = explode('|', $data);
      if($begin)
      {
        $row_data = explode('|', $data);

        //var_dump($row_data);
        foreach($row_data as $item)
        {
          array_push($itens, $item);
        } 
      }
    }

    foreach($products as $product)
    {
      $find = $this->get_id($product[1]);
      if (empty($find))
      {
        $value = $this->convertTxtToArray($product);
        $result = $this->insert($value);
      }
    }
  }

  private function array_valid($data)
  {
    $object = Validation::factory($data);
    $object->rule('Categoria', 'not_empty')
          ->rule('Unidade', 'not_empty')
          ->rule(html_entity_decode(utf8_decode('Descrição')), 'not_empty')
          ->rule(html_entity_decode(utf8_decode('Identificação')),  'not_empty')
          ->rule('Custo', 'not_empty');
  }

  public function get_id($id)
  {
    $query = DB::query(Database::SELECT, 'SELECT * FROM products WHERE id = :cod'); 
    $query->parameters(array(':cod' => $id));
    $result = $query->execute();
    
    return $result->as_array();
  }


  private function insert($data)
  {
    if(!is_array($data))
      return 'Dados inválidos!';

    $insert = DB::insert('products',
          array('id', 'description', 'unity','categorie',
          'cost','sale_price_1','sale_price_2','sale_price_3',
          'observation','provider','stock','barcode','min_stock',
          'max_stock','stock_purchase','sales_unit_factor','NCM','mark','weight','size',
          'inactive','type','composition','feedstock','business_mateiral',
          'for_sale','coin','ipi','gender'))
      ->values(array(
          $data[html_entity_decode(utf8_decode('Identificação'))],
          $data[html_entity_decode(utf8_decode('Descrição'))],
          $data['Unidade'],
          $data['Categoria'],
          number_format(str_replace(",",".",$data['Custo']),2),
          number_format(str_replace(",",".",$data[html_entity_decode(utf8_decode('Preço de Venda 1'))]),2),
          number_format(str_replace(",",".",$data[html_entity_decode(utf8_decode('Preço de Venda 2'))]),2),
          number_format(str_replace(",",".",$data[html_entity_decode(utf8_decode('Preço de Venda 3'))]),2),
          $data[html_entity_decode(utf8_decode('Observações'))],
          $data['Fornecedor'],
          $data['Estoque'],
          $data[html_entity_decode(utf8_decode('Cód. Barra'))],
          $data[html_entity_decode(utf8_decode('Estoque Mínimo'))],
          $data[html_entity_decode(utf8_decode('Estoque Máximo'))],
          $data['Estoque Compra'],
          array_key_exists('Fator unid. de venda',$data)?number_format(str_replace(",",".",$data['Fator unid. de venda']),2) : 0,
          $data['NCM'],
          $data['Marca'],
          $data['Peso'],
          $data['Tamanho'],
          $data['Inativo'],
          $data['Tipo'],
          $data[html_entity_decode(utf8_decode('Composição'))],
          $data[html_entity_decode(utf8_decode('Matéria Prima'))],
          $data['Material Expediente'],
          $data['Para Venda'],
          $data['Moeda'],
          array_key_exists('ipi',$data)? $data['ipi']:0,
          array_key_exists('gender',$data)? $data['gender']:""
        ))->execute();
  }

  public function update($data)
  {
    if(!is_array($data))
      return 'Dados inválidos!';

    $query = DB::update('products')
      ->set(array('description' => $data['description'],
        'unity' => $data['unity'],
        'categorie' => $data['categorie'],
        'cost' => number_format(str_replace(",",".",$data['cost']),2), // $data['cost'],
        'sale_price_1' => number_format(str_replace(",",".",$data['sale_price_1']),2), // $data['sale_price_1'],
        'sale_price_2' => number_format(str_replace(",",".",$data['sale_price_2']),2),//$data['sale_price_2'],
        'sale_price_3' => number_format(str_replace(",",".",$data['sale_price_3']),2),// $data['sale_price_3'],
        'observation'  => $data['observation'],
        'provider' => $data['provider'],
        'stock' => $data['stock'],
        'barcode' => $data['barcode'],
        'min_stock' => $data['min_stock'],
        'max_stock' => $data['max_stock'],
        'stock_purchase' => $data['stock_purchase'],
        'sales_unit_factor' => $data['sales_unit_factor'],
        'NCM' => $data['NCM'],
        'mark' => $data['mark'],
        'weight' => $data['weight'],
        'size' => $data['size'],
        'inactive' => $data['inactive'],
        'type' => $data['type'],
        'composition' => $data['composition'],
        'feedstock' => $data['feedstock'],
        'business_mateiral' => $data['business_material'],
        'for_sale' => $data['for_sale'],
        'coin' => $data['coin'],
        'ipi' => $data['ipi'],
        'gender' => $data['gender']
      ))
      ->where('id', '=', $data['id']);

    // echo Debug::vars((string) $query);
    // exit;

    return $query->execute();
  }

  public function delete($cod)
  {
    $result = DB::delete('products')
      ->where('id', '=', $cod)
      ->execute();

    return $result;
  }

  public function get_all()
  {
    $results = DB::select()->from('products')->execute();

    return $results->as_array();
  }

  private function convertTxtToArray($txt)
  {
      $data = array();
      $data[html_entity_decode(utf8_decode('Identificação'))] = $txt[1];
      $data[html_entity_decode(utf8_decode('Descrição'))] = $txt[2];
      $data['Unidade'] = (empty($txt[10])) ? $txt[7] : $txt[10];
      $data['Categoria'] = "";
      $data['Custo'] = (empty($txt[8])) ? 0 : $txt[8];
      $data[html_entity_decode(utf8_decode('Preço de Venda 1'))] = 0;
      $data[html_entity_decode(utf8_decode('Preço de Venda 2'))] = 0;
      $data[html_entity_decode(utf8_decode('Preço de Venda 3'))] = 0;
      $data[html_entity_decode(utf8_decode('Observações'))] = "";
      $data['Fornecedor'] = "";
      $data['Estoque'] = $txt[12];
      $data[html_entity_decode(utf8_decode('Cód. Barra'))] = (empty($txt[9])) ? $txt[3] : $txt[9];
      $data[html_entity_decode(utf8_decode('Estoque Mínimo'))] = 0;
      $data[html_entity_decode(utf8_decode('Estoque Máximo'))] = 0;
      $data['Estoque Compra'] = 0;
      $data['Fator unid. de venda'] = 0;
      $data['NCM'] = $txt[4];
      $data['Marca'] = "";
      $data['Peso'] = "";
      $data['Tamanho'] = "";
      $data['Inativo'] = "";
      $data['Tipo'] = "";
      $data[html_entity_decode(utf8_decode('Composição'))] = "";
      $data[html_entity_decode(utf8_decode('Matéria Prima'))] = "";
      $data['Material Expediente'] = "";
      $data['Para Venda'] = (empty($txt[11])) ? $txt[8] : $txt[11];
      $data['Moeda'] = "";
      $data['ipi'] = $txt[6];
      $data['gender'] = $txt[7];

      return $data;
  }
}
