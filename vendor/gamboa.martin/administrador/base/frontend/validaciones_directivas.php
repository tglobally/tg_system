<?php
namespace base\frontend;


use config\generales;
use gamboamartin\errores\errores;
use gamboamartin\validacion\validacion;


class validaciones_directivas extends validacion{




    /**
     * Valida los elementos de un boton
     * @param string $label Etiqueta a mostrar
     * @param string $name Nombre del boton
     * @param string $value Valor de boton
     * @return bool|array
     * @version 1.309.41
     */
    public function valida_data_btn( string $label, string $name, string $value): bool|array
    {

        if($name===''){
            return $this->error->error(mensaje:'Error $name no puede venir vacio',data: $label);
        }
        if($value===''){
            return $this->error->error(mensaje:'Error $value no puede venir vacio',data: $name);
        }
        return true;
    }

    /**
     * P ORDER P INT
     * @param array $data_boton
     * @return bool|array
     */
    public function valida_data_btn_template(array $data_boton): bool|array
    {


        $valida = $this->btn_base(data_boton: $data_boton);
        if(errores::$error){
            return $this->error->error('Error al validar data_boton',$valida);
        }
        $valida = $this->btn_second(data_boton: $data_boton);
        if(errores::$error){
            return $this->error->error('Error al validar data_boton',$valida);
        }

        if($data_boton['id'] === ''){
            return $this->error->error('Error id no puede venir vacio',$data_boton['id']);
        }
        if(!is_numeric($data_boton['id'])){
            return $this->error->error('Error $data_boton[id] debe ser numero',$data_boton);
        }
        return true;
    }

    /**
     * P ORDER P INT PROBADO ERROREV
     * @param string $seccion
     * @param string $accion
     * @return bool|array
     */
    public function valida_datos_accion( string $accion, string $seccion): bool|array
    {

        if ($accion === '') {
            return $this->error->error(mensaje:'Error la accion esta vacia', data:$accion);
        }
        return true;
    }

    /**
     * Funcion que valida la existencia de campos de un elemento para lista
     * @version 1.28.14
     * @param array $registro Registro de tipo elemento lista
     * @return array|bool
     */
    public function valida_elemento_lista_template(array $registro): array|bool
    {
        $keys = array('adm_elemento_lista_descripcion','adm_elemento_lista_tipo');
        $valida = $this->valida_existencia_keys(keys:  $keys, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje: "Error al validar registro", data: $valida);
        }
        return $valida;
    }

    /**
     *
     * Valida la entrada de datos para generacion de inputs
     *
     * @param string $tabla Tabla - estructura modelo sistema
     * @param int $cols Columnas para asignacion de html entre 1 y 12
     *
     * @return array|bool con resultado
     * @example
     *      $campo = 'x';
     *      $cols = 4;
     *      $valida = $this->valida_elementos_base_input($campo,$cols);
     * if(isset($valida['error'])){
     * return $this->errores->error('Error al validar',$valida);
     * }
     *
     * @version 1.310.41
     */
    public function valida_elementos_base_input(int $cols, string $tabla):array|bool{
        if($tabla === ''){
            return $this->error->error(mensaje: "Error tabla vacia", data: $tabla);
        }


        return true;
    }

    /**
     * P INT P ORDER
     * @param bool $aplica_etiqueta
     * @param string $etiqueta
     * @return bool|array
     */
    private function valida_etiqueta(bool $aplica_etiqueta, string $etiqueta): bool|array
    {
        if($aplica_etiqueta) {
            $etiqueta_valida = $this->letra_numero_espacio(txt: $etiqueta);
            if (!$etiqueta_valida) {
                return $this->error->error("Error al etiqueta invalida", $etiqueta);
            }
        }
        return true;
    }

    /**
     * Valida datos para las acciones de un row
     * @version 1.39.14
     * @param array $registro Registro de lista
     * @param string $seccion Seccion en ejecucion
     * @return bool|array
     */
    final public function valida_footer_row(array $registro, string $seccion): bool|array
    {
        if(count($registro)===0){
            return $this->error->error(mensaje: 'Error registro viene vacio',data: $registro);
        }
        if($seccion === ''){
            return $this->error->error(mensaje: 'Error seccion viene vacia',data: $registro);
        }
        $valida = $this->valida_name_clase(tabla: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar seccion',data: $valida);
        }
        return true;
    }

    /**
     * ERRORREV
     * @param string $accion
     * @param string $id
     * @param string $seccion
     * @param string $session_id
     * @return bool|array
     */
    public function valida_href(string $accion, string $id, string $seccion, string $session_id): bool|array
    {
        $seccion = trim($seccion);
        if($seccion === ''){
            return $this->error->error(mensaje: 'Error la seccion no puede venir vacia',data:  $seccion,
                params: get_defined_vars());
        }
        $accion = trim($accion);
        if($accion === ''){
            return $this->error->error(mensaje:'Error la $accion no puede venir vacia', data:$accion,
                params: get_defined_vars());
        }
        $session_id = trim($session_id);
        if($session_id === ''){
            return $this->error->error(mensaje:'Error la $session_id no puede venir vacia',data: $session_id);
        }
        $id = trim($id);
        if($id === ''){
            return $this->error->error(mensaje:'Error la $id no puede venir vacia',data: $id,
                params: get_defined_vars());
        }
        return true;
    }

    /**
     * P INT
     * @param bool $aplica_etiqueta
     * @param string $etiqueta
     * @param string $campo
     * @param string $tipo
     * @return bool|array
     */
    public function valida_input_text(bool $aplica_etiqueta, string $etiqueta, string $campo, string $tipo): bool|array
    {
        $valida = $this->valida_etiqueta(aplica_etiqueta: $aplica_etiqueta, etiqueta: $etiqueta);
        if(errores::$error){
            return $this->error->error('Error al validar etiqueta', $valida);
        }

        if($campo === ''){
            return $this->error->error('Error $campo no puede venir vacio', $campo);
        }
        if($tipo === ''){
            return $this->error->error('Error $tipo no puede venir vacio', $tipo);
        }
        return true;
    }

    /**
     * P ORDER P INT PROBADO ERROREV
     * @param array $accion
     * @return bool|array
     */
    public function valida_link(array $accion): bool|array
    {
        if(count($accion)===0){
            return $this->error->error(mensaje: 'Error accion no puede venir vacia',data: $accion);
        }
        if(!isset($accion['adm_seccion_descripcion'])){
            return $this->error->error(mensaje:'$accion[adm_seccion_descripcion] debe existir',data:$accion);
        }
        if(!isset($accion['adm_accion_descripcion'])){
            return $this->error->error(mensaje:'$accion[adm_accion_descripcion] debe existir',data:$accion);
        }
        return true;
    }

    /**
     *
     * Valida que exista la clase y la accion
     *
     * @param string $tabla tabla modelo a validar
     * @param string $accion accion a validar
     *
     * @return array|bool informacion de validacion
     * @example
     *      $valida_metodo = $directiva->valida_metodos($this->seccion,'alta');
     *
     * @uses  templates
     * @version 1.230.38
     * @verfuncion 1.1.0
     * @author mgamboa
     * @fecha 2022-08-01 11:42
     */
    public function valida_metodos(string $accion, string $tabla):array|bool{
        $tabla = trim($tabla);
        $accion = trim($accion);

        $namespace = '';
        if((new generales())->sistema === 'administrador'){
            $namespace = 'gamboamartin\\';
        }

        $tabla = str_replace('models\\','',$tabla);
        $class = $namespace.'controllers\\controlador_'.$tabla;
        if($tabla === ''){
            return  $this->error->error(mensaje: "Error tabla vacia",data: $tabla);
        }

        if(!method_exists($class,$accion)){
            return  $this->error->error(mensaje:"Error la accion es invalida",data:array('controlador_'.$tabla,$accion));
        }

        return true;
    }



    public function valida_vars_get(string $key, string $value): bool|array
    {
        if(is_numeric($key)){
            return $this->error->error('Error el key de la variable no puede ser un numero',$key);
        }
        $value = trim($value);
        if($value === ''){
            return $this->error->error('Error el valor de la variable no puede venir vacio',$value);
        }
        $key = trim($key);
        if($key === ''){
            return $this->error->error('Error el $key de la variable no puede venir vacio',$key);
        }
        return true;
    }
}
