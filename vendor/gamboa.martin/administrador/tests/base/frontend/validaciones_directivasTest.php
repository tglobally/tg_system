<?php
namespace tests\base\frontend;

use base\frontend\validaciones_directivas;
use gamboamartin\errores\errores;
use gamboamartin\test\test;


class validaciones_directivasTest extends test {
    public errores $errores;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
    }




    public function test_valida_data_btn(){
        errores::$error = false;
        $val = new validaciones_directivas();
        //$inicializacion = new liberator($inicializacion);

        $cols = '-1';
        $label = '-1';
        $name = '-1';
        $value = '-1';
        $resultado = $val->valida_data_btn($cols, $label, $name, $value);
        $this->assertIsBool($resultado);


        errores::$error = false;

        $cols = '1';
        $label = '-1';
        $name = '-1';
        $value = '-1';
        $resultado = $val->valida_data_btn($cols, $label, $name, $value);
        $this->assertIsBool($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);
        errores::$error = false;
    }

    public function test_valida_datos_accion(){
        errores::$error = false;
        $val = new validaciones_directivas();
        //$inicializacion = new liberator($inicializacion);
        $seccion = '';
        $accion = '';
        $resultado = $val->valida_datos_accion(accion:$accion,seccion:  $seccion);

        $this->assertTrue(errores::$error);


        errores::$error = false;
        $seccion = 'adm_seccion';
        $accion = '';
        $resultado = $val->valida_datos_accion($accion, $seccion);

        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error la accion esta vacia', $resultado['mensaje']);

        errores::$error = false;
        $seccion = 'adm_seccion';
        $accion = 'a';
        $resultado = $val->valida_datos_accion($accion, $seccion);
        $this->assertIsBool($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;
    }

    public function test_valida_elemento_base_input(){
        errores::$error = false;
        $val = new validaciones_directivas();
        //$inicializacion = new liberator($inicializacion);
        $tabla = '';
        $cols = '0';
        $resultado = $val->valida_elementos_base_input($cols, $tabla);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error tabla vacia', $resultado['mensaje']);

        errores::$error = false;

        $tabla = 'a';
        $cols = '0';
        $resultado = $val->valida_elementos_base_input($cols, $tabla);
        $this->assertIsBool($resultado);


        errores::$error = false;

        $tabla = 'a';
        $cols = '10';
        $resultado = $val->valida_elementos_base_input($cols, $tabla);
        $this->assertIsBool($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);

        errores::$error = false;

    }

    public function test_valida_elemento_lista_template(){
        errores::$error = false;
        $val = new validaciones_directivas();

        $registro = array();
        $resultado = $val->valida_elemento_lista_template($registro);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error al validar registro', $resultado['mensaje']);

        errores::$error = false;
        $registro = array();
        $registro['adm_elemento_lista_descripcion'] = 'a';
        $registro['adm_elemento_lista_tipo'] = 'a';
        $resultado = $val->valida_elemento_lista_template($registro);
        $this->assertIsBool($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);
        errores::$error = false;
    }


    public function test_valida_footer_row(): void
    {
        errores::$error = false;
        $val = new validaciones_directivas();
        //$inicializacion = new liberator($inicializacion);
        $registro = array();
        $seccion = '';
        $resultado = $val->valida_footer_row($registro, $seccion);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error registro viene vacio', $resultado['mensaje']);

        errores::$error = false;
        $registro = array();
        $seccion = '';
        $registro[] = '';
        $resultado = $val->valida_footer_row($registro, $seccion);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error seccion viene vacia', $resultado['mensaje']);

        errores::$error = false;
        $registro = array();
        $seccion = 'a';
        $registro[] = '';
        $resultado = $val->valida_footer_row($registro, $seccion);
        //print_r($resultado);exit;
        $this->assertIsBool($resultado);
        $this->assertNotTrue(errores::$error);


        errores::$error = false;
        //$inicializacion = new liberator($inicializacion);
        $registro = array();
        $seccion = 'prueba';
        $registro[] = '';
        $resultado = $val->valida_footer_row($registro, $seccion);
        $this->assertIsBool($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);


    }

    public function test_valida_link(){
        errores::$error = false;
        $val = new validaciones_directivas();
        //$inicializacion = new liberator($inicializacion);

        $accion = array();
        $resultado = $val->valida_link($accion);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error accion no puede venir vacia', $resultado['mensaje']);

        errores::$error = false;

        $accion = array();
        $accion[] = '';
        $resultado = $val->valida_link($accion);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('$accion[adm_seccion_descripcion] debe existir', $resultado['mensaje']);

        errores::$error = false;

        $accion = array();
        $accion['adm_seccion_descripcion'] = 'a';
        $resultado = $val->valida_link($accion);
        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('$accion[adm_accion_descripcion] debe existir', $resultado['mensaje']);

        errores::$error = false;

        $accion = array();
        $accion['adm_seccion_descripcion'] = 'a';
        $accion['adm_accion_descripcion'] = 'a';
        $resultado = $val->valida_link($accion);
        $this->assertIsBool($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);
        errores::$error = false;
    }

    public function test_valida_metodos(){
        errores::$error = false;
        $val = new validaciones_directivas();
        //$inicializacion = new liberator($inicializacion);
        $tabla = '';
        $accion = '';
        $resultado = $val->valida_metodos(accion:  $accion, tabla: $tabla);

        $this->assertIsArray( $resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error tabla vacia', $resultado['mensaje']);

        errores::$error = false;
        $tabla = 'a';
        $accion = '';
        $resultado = $val->valida_metodos(accion:  $accion, tabla: $tabla);
        $this->assertIsArray( $resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error la accion es invalida', $resultado['mensaje']);

        errores::$error = false;
        $tabla = 'adm_minuto';
        $accion = '';
        $resultado = $val->valida_metodos(accion:  $accion, tabla: $tabla);

        $this->assertIsArray( $resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error la accion es invalida', $resultado['mensaje']);

        errores::$error = false;
        $tabla = 'adm_minuto';
        $accion = 'alta';
        $resultado = $val->valida_metodos(accion:  $accion, tabla: $tabla);
        $this->assertIsBool( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);


    }




}