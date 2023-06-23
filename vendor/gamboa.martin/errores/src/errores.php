<?php
/**
 * Retorna errores, si en alguna parte del software se detecta algun error la estatica errores::error se vuelve true
 * @version 1.0.0
 */
namespace gamboamartin\errores;


use config\generales;

final class errores{
    public static bool $error = false;
    public string $mensaje = '';
    public string $class ='';
    public int $line = -1 ;
    public string $file = '';
    public string $function = '';
    public mixed $data = '';
    public array $params = array();
    public string $fix = '';


    public array $upload_errores = array();

    public function __construct(){
        $this->upload_errores = array(
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        );

    }

    /**
     * Si existe algun error se debe llamar esta funcion la cual debera funcionar de manera recursiva
     * para mostrar todos lo errores desde el origen hasta la ejecucion final
     * @link  https://drive.google.com/file/d/1WTYgD_U3f43n7EyO6551GlS5TiA1qGdg/view?usp=sharing
     * @param string $mensaje Mensaje a mostrar
     * @param mixed $data Complemento y/o detalle de error
     * @param array $params Parametros de funcion definitiva
     * @param string $seccion_header elemento para regresar a seccion especifica en el controlador
     * @param string $accion_header elemento para regresar a accion especifica en el controlador
     * @param int $registro_id id de un modelo de la base de datos
     * @param string $fix Mensaje de posible solucion al error
     * @param bool $aplica_bitacora Si aplica entonces guarda en un archivo de texto el error
     * @return array
     * @version 1.1.0

     */
    final public function error(string $mensaje, mixed $data, array $params = array(), string $seccion_header = '',
                          string $accion_header = '', int $registro_id = -1, string $fix = '',
                          bool $aplica_bitacora = false):array{

        $mensaje = trim($mensaje);
        if($mensaje === ''){
            $fix = 'Debes mandar llamar la funcion con un mensaje valido en forma de texto ej ';
            $fix .= ' $error = new errores()';
            $fix .= '$error->error(mensaje: "Mensaje de error descriptivo",data: "datos con el error");';
            return $this->error("Error el mensaje esta vacio", $mensaje, get_defined_vars(),
                $seccion_header ,  $accion_header,$registro_id,$fix);
        }
        $debug = debug_backtrace(2);

        if(!isset($debug[0]['line'])){
            $debug[0]['line'] = -1;
        }
        if(!isset($debug[0]['line'])){
            $debug[0]['file'] = '';
        }
        if(!isset($debug[1]['class'])){
            $debug[1]['class'] = '';
        }
        if(!isset($debug[1]['function'])){
            $debug[1]['function'] = '';
        }


        $data_error['error'] = 1;
        $data_error['mensaje'] = '<b><span style="color:red">' . $mensaje . '</span></b>';
        $data_error['mensaje_limpio'] = $mensaje;
        $data_error['file'] = '<b>' . $debug[0]['file'] . '</b>';
        $data_error['line'] = '<b>' . $debug[0]['line'] . '</b>';
        $data_error['class'] = '<b>' . $debug[1]['class'] . '</b>';
        $data_error['function'] = '<b>' . $debug[1]['function'] . '</b>';
        $data_error['data'] = $data;
        $data_error['params'] = $params;
        $data_error['fix'] = $fix;

        $_SESSION['error_resultado'][] = $data_error;

        $seccion_header = trim($seccion_header);
        $accion_header = trim($accion_header);
        if($seccion_header!=='' && $accion_header !=='') {
            $_SESSION['seccion_header'] = $seccion_header;
            $_SESSION['accion_header'] = $accion_header;
            $_SESSION['registro_id_header'] = $registro_id;
        }

        self::$error = true;
        $this->mensaje = $mensaje;
        $this->class = $debug[1]['class'];
        $this->line = $debug[0]['line'];
        $this->file = $debug[0]['file'];
        $this->function = $debug[1]['function'];
        $this->fix = $fix;
        $this->params = $params;
        if($data === null){
            $data = '';
        }

        $this->data = $data;
        if($aplica_bitacora){

            $ruta_archivos = (new generales())->path_base.'archivos/';
            if(!file_exists($ruta_archivos)){
                mkdir($ruta_archivos);
            }
            $ruta_archivos = $ruta_archivos.'errores/';
            if(!file_exists($ruta_archivos)){
                mkdir($ruta_archivos);
            }
            $name_file = 'error_file_'.$this->file.'_line_'.$this->line.'_function_'.$this->function.'_class_'.$this->class
                .date('Y-m-d H:m:s') .'_'.time().'.log';

            $name_file = str_replace('/', '_', $name_file);
            $name_file = str_replace('\\', '_', $name_file);

            $ruta_bit_error =$ruta_archivos.$name_file;

            file_put_contents($ruta_bit_error, serialize($data_error));

        }

        return $data_error;
    }

}
