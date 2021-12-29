<?php 

class errorController extends Controller {
  function __construct()
  {
  }
  
  function index() {
    $data =
    [
      'title' => 'Página no encontrada',
      'bg'    => 'dark',
      'padding' => '0px',
    ];
    View::render('404', $data);
  }
}