<?php
namespace tests\base\frontend;

use base\frontend\params_inputs;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use stdClass;


class params_inputsTest extends test {
    public errores $errores;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
    }




    public function test_disabled_html()
    {
        errores::$error = false;
        $params = new params_inputs();
        //$params = new liberator($params);
        $disabled = false;

        $resultado = $params->disabled_html($disabled);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('',$resultado);

        errores::$error = false;

        $disabled = true;

        $resultado = $params->disabled_html($disabled);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('disabled',$resultado);

        errores::$error = false;
    }


    public function test_required_html(): void
    {
        errores::$error = false;
        $params = new params_inputs();
        //$params = new liberator($params);

        $resultado = $params->required_html(required: false);
        $this->assertIsString( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('', $resultado);

        errores::$error = false;

        $resultado = $params->required_html(required: true);
        $this->assertIsString( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('required', $resultado);
        errores::$error = false;

    }

    
}