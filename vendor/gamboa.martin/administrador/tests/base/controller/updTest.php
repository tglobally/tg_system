<?php
namespace tests\base\controller;

use base\controller\upd;
use gamboamartin\administrador\models\adm_mes;
use gamboamartin\controllers\controlador_adm_mes;
use gamboamartin\errores\errores;
use gamboamartin\test\test;
use stdClass;


class updTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
        $this->paths_conf = new stdClass();
        $this->paths_conf->generales = '/var/www/html/administrador/config/generales.php';
        $this->paths_conf->database = '/var/www/html/administrador/config/database.php';
        $this->paths_conf->views = '/var/www/html/administrador/config/views.php';
    }

    /**
     */
    public function test_asigna_datos_modifica(): void
    {
        errores::$error = false;
        $_SESSION['usuario_id'] = 2;
        $upd = new upd();

        $del = (new adm_mes($this->link))->elimina_todo();
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error', data: $del);
            print_r($error);
            exit;
        }

        $adm_mes_ins = array();
        $adm_mes_ins['id'] = 1;
        $adm_mes_ins['codigo'] = 1;
        $adm_mes_ins['descripcion'] = 1;
        $alta = (new adm_mes($this->link))->alta_registro($adm_mes_ins);
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error', data: $alta);
            print_r($error);
            exit;
        }

        $controler = new controlador_adm_mes(link: $this->link, paths_conf: $this->paths_conf);
        $controler->seccion = 'a';
        $controler->registro_id = 1;
        $resultado = $upd->asigna_datos_modifica($controler);


        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals(1, $resultado['adm_mes_id']);
        errores::$error = false;
    }




}