<?php
namespace tests\orm;

use gamboamartin\administrador\models\adm_elemento_lista;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;


class adm_elemento_listaTest extends test {
    public errores $errores;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
    }

    public function test_elementos_lista(){

        errores::$error = false;
        $el = new adm_elemento_lista($this->link);
        $el = new liberator($el);

        $vista = '';
        $tabla = '';
        $resultado = $el->elementos_lista($tabla, $vista);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error al validar', $resultado['mensaje']);

        errores::$error = false;

        $vista = '';
        $tabla = 'adm_seccion';
        $resultado = $el->elementos_lista($tabla, $vista);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error $vista no puede venir vacia', $resultado['mensaje']);

        errores::$error = false;

        $vista = 'lista';
        $tabla = 'adm_seccion';
        $resultado = $el->elementos_lista($tabla, $vista);
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }


    public function test_filtro_el(){

        errores::$error = false;
        $el = new adm_elemento_lista($this->link);
        //$inicializacion = new liberator($inicializacion);
        $campo = '';
        $seccion = '';
        $tabla_externa = '';
        $resultado = $el->filtro_el($campo, $seccion, $tabla_externa);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error al validar datos', $resultado['mensaje']);

        errores::$error = false;
        $campo = '';
        $seccion = '';
        $tabla_externa = 'a';
        $resultado = $el->filtro_el($campo, $seccion, $tabla_externa);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error al validar datos', $resultado['mensaje']);

        errores::$error = false;
        $campo = 'b';
        $seccion = '';
        $tabla_externa = 'a';
        $resultado = $el->filtro_el($campo, $seccion, $tabla_externa);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error al validar datos', $resultado['mensaje']);

        errores::$error = false;
        $campo = 'b';
        $seccion = 'c';
        $tabla_externa = 'a';
        $resultado = $el->filtro_el($campo, $seccion, $tabla_externa);
        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);


        errores::$error = false;

    }

    public function test_genera_estructura_bd(){

        errores::$error = false;
        $el = new adm_elemento_lista($this->link);
        $el = new liberator($el);

        $vista = 'alta';
        $tabla = 'adm_seccion';
        $campos_obligatorios = array();
        $estructura_bd = array();
        $mod = new adm_elemento_lista($this->link);
        $resultado = $el->genera_estructura_bd($estructura_bd, $mod, $vista);

        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_genera_estructura_tabla(){

        errores::$error = false;
        $el = new adm_elemento_lista($this->link);
        $el = new liberator($el);

        $vista = 'alta';
        $tabla = 'adm_seccion';
        $campos_obligatorios = array();
        $estructura_bd = array();
        $resultado = $el->genera_estructura_tabla($campos_obligatorios, $estructura_bd, $tabla, $vista);
        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;
    }

    public function test_obten_campos_el(){

        errores::$error = false;
        $el = new adm_elemento_lista($this->link);
        //$el = new liberator($el);

        $vista = 'alta';
        $tabla = 'adm_seccion';
        $campos_obligatorios = array();
        $estructura_bd = array();
        $mod = new adm_elemento_lista($this->link);
        $resultado = $el->obten_campos_el($estructura_bd, $mod, $vista);
        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);
        errores::$error = false;

    }


}

