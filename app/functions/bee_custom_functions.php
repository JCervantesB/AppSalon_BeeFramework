<?php 

/**
 * La primera función de pruebas del curso de creando el framework MVC
 *
 * @return void
 */
function en_custom() {
  return 'ESTOY DENTRO DE CUSTOM_FUNCTIONS.';
}

/**
 * Carga las diferentes divisas soporatadas en el proyecto de pruebas
 *
 * @return void
 */
function get_coins() {
  return 
  [
    'MXN',
    'USD',
    'CAD',
    'EUR',
    'ARS',
    'AUD',
    'JPY'
  ];
}

function debuguear($variable) : string {
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
  $s = htmlspecialchars($html);
  return $s;
}

function esUltimo(string $actual, string $proximo): bool {
  if($actual !== $proximo) {
      return true;
  }
  return false;
}

// Función que revisa que el usuario este autenticado

function isAuth() : void {
  if(!isset($_SESSION['login'])) {
      header('Location: /');
  }
}

function isAdmin() : void {
  if(!isset($_SESSION['admin'])) {
      header('Location: /');
  }
}