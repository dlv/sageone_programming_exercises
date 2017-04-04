<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Products extends Controller {

	public function action_index()
  {
    $m_products = new Model_Products();
    $view = View::factory('home');  
    $view->title = "SageOne";
    $view->data = $m_products->get_all();
    $view_product = View::factory('product');
    $view_product->data = $m_products->get_all();
    $view->body = $view_product;

    $this->response->body($view);
	}

  public function action_update()
  {
    $m_products = new Model_Products();
    $result = $m_products->update($_POST);

    if($this->is_valid($result))
      $this->view_result('Registro atualizado com sucesso.');
  }

  public function action_upload()
  {
    $error_message = NULL;
    $m_products = new Model_Products();
    
    if ($this->request->method() == Request::POST)
    {
      $error_message = $m_products->validation();

      if ($this->is_valid($error_message))
      {
         if(!$error_message)
          $this->view_error('Falha ao validar o arquivo');
         
         $error_message = $m_products->parse();

         if($this->is_valid($error_message))
         {
          $this->view_result("Arquivo importado com sucesso.");
         }
      }
    }
    else
    {
      $this->view_error("Parametro incorreto.");
    }
  }

  public function action_details()
  {
    $id = $this->request->param('id','0'); 
    /* if ($id <= 0)
    {
      $view_error = View::factory('error/error');
      $view_error->title = "SageOne - ERRO";
      $view_error->message_erro = "Parametro Inválido";          
      $response = Response::factory()
                  ->status(505)
                  ->body($view_error->render());
      $this->response = $response;                                           
    }
    else
    {*/
      $m_product = new Model_Products();
      $view = View::factory('details');
      
      $data = $m_product->get_id($id);

      $view->title = "SageOne";
      $view->data = $data;
      $this->response->body($view);
   // }
  }

  public function action_delete()
  {
    
    $id = $this->request->param('id','0');
    $m_product = new Model_Products();

    $result = $m_product->delete($id);
    $this->view_result("Produto excluido com Sucesso.");
  }

  private function is_valid($value)
  {
    if(is_string($value))
      $this->view_error($value);

    return TRUE;
  }

  private function view_result($message)
  {
    $view = View::factory('result');
    $view->title = "SageOne - Resultado";
    $view->message = $message;
    $response = Response::factory()
      ->status(200)
      ->body($view->render());
    $this->response = $response;
  }

  private function view_error($message)
  {
    $view_error = View::factory('error/error');
    $view_error->title = "SageOne - ERRO";
    $view_error->message_erro = $message;          
    $response = Response::factory()
                   ->status(505)
                   ->body($view_error->render());
    $this->response = $response;
  }
}
