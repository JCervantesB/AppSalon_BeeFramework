<?php 

require 'funciones.php';
require 'database.php';

// Conectarnos a la base de datos
use Model\ActiveRecordModel;

ActiveRecordModel::setDB($db);