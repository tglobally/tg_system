<?php
namespace tests\orm;

use gamboamartin\administrador\models\adm_accion_grupo;
use gamboamartin\errores\errores;
use gamboamartin\test\test;


class adm_accion_grupoTest extends test {
    public errores $errores;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
    }

    public function test_grupos_por_accion(): void
    {

        errores::$error = false;
        $modelo = new adm_accion_grupo($this->link);
        //$modelo = new liberator($modelo);


        $adm_accion_id= 1;
        $resultado = $modelo->grupos_por_accion($adm_accion_id);
        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;

        $adm_accion_id= 4;
        $resultado = $modelo->grupos_por_accion($adm_accion_id);
        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertNotEmpty($resultado);

        errores::$error = false;
    }

    public function test_obten_accion_permitida(): void
    {

        errores::$error = false;
        $modelo = new adm_accion_grupo($this->link);
        //$modelo = new liberator($modelo);

        unset($_SESSION['grupo_id']);
        $seccion_menu_id= -1;
        $resultado = $modelo->obten_accion_permitida($seccion_menu_id);

        $this->assertIsArray($resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error al validar session', $resultado['mensaje']);

        errores::$error = false;

        $_SESSION['grupo_id'] = 2;

        $seccion_menu_id= -1;
        $resultado = $modelo->obten_accion_permitida($seccion_menu_id);
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);


        errores::$error = false;

    }


}

