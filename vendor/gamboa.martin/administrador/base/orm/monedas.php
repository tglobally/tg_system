<?php
namespace base\orm;
use gamboamartin\errores\errores;

class monedas{

    private errores $error;
    public function __construct(){
        $this->error = new errores();
    }

    /**
     * Elimina los caracteres para convertir el valor en un double
     * @param string|int|float|null $value Valor moneda
     * @return string|int|float|null
     * @version 1.275.40
     * @verfuncion 1.1.0
     * @author mgamboa
     * @fecha 2022-08-08 12:44
     *
     */
    private function limpia_moneda_value(string|int|float|null $value): string|int|float|null
    {
        if($value === null){
            return null;
        }
        $value = trim($value);
        return str_replace(array('$', ','), '', $value);

    }

    /**
     * Limpia los campos de tipo moneda previo a la insersion
     * @param string $tipo_dato Tipo dato a limpiar
     * @param array $tipos_moneda Tipos moneda campos
     * @param int|string|float|null $value Valor a limpiar
     * @return float|array|int|string|null
     * @version 1.337.41
     */
    private function limpia_monedas_values(string $tipo_dato, array $tipos_moneda,
                                           int|string|float|null $value): float|array|int|string|null
    {
        $tipo_dato = trim($tipo_dato);
        if($tipo_dato === ''){
            return $this->error->error(mensaje: 'Error tipo dato vacio', data: $tipo_dato);
        }
        if(in_array($tipo_dato, $tipos_moneda, true)) {
            $value = $this->limpia_moneda_value(value: $value);
            if (errores::$error) {
                return $this->error->error(mensaje: 'Error al limpiar value', data: $value);
            }
        }
        return $value;
    }

    /**
     * Ajusta valores de tipo moneda para upd
     * @param string $campo Campo a reasignar valor
     * @param modelo $modelo Modelo en ejecucion para validacion
     * @param array $tipos_moneda Campos tipos moneda declarados en modelo
     * @param string|int|float|null $value
     * @return float|array|int|string|null
     * @version 1.358.41

     */
    private function reasigna_value_moneda(string $campo, modelo $modelo, array $tipos_moneda,
                                           string|int|float|null $value): float|array|int|string|null
    {
        $value_ = $value;
        if($campo === ''){
            return $this->error->error('Error campo no puede venir vacio', $campo);
        }
        if(!isset($modelo->tipo_campos[$campo])){
            return $value_;
        }
        $tipo_dato = $modelo->tipo_campos[$campo];
        $value_ = $this->limpia_monedas_values(tipo_dato: $tipo_dato,tipos_moneda:  $tipos_moneda,value:  $value_);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar value',data:  $value_);
        }
        return $value_;
    }

    /**
     * Asigna valores moneda
     * @param string $campo Campo a reasignar valor
     * @param modelo $modelo Modelo en ejecucion para validacion
     * @param string|float|int|null $value Valor a ajustar
     * @return float|array|int|string|null
     * @version 1.404.45
     *
     */
    public function value_moneda(
        string $campo, modelo_base $modelo, string|float|int|null $value): float|array|int|string|null
    {
        $value_= $value;
        $tipos_moneda = array('double','double_con_cero');
        if(array_key_exists($campo, $modelo->tipo_campos)){
            $value_ = $this->reasigna_value_moneda(
                campo: $campo, modelo: $modelo,tipos_moneda:  $tipos_moneda,value:  $value_);
            if (errores::$error) {
                return $this->error->error(mensaje: 'Error al limpiar value', data: $value_);
            }
        }
        return $value_;
    }

}
