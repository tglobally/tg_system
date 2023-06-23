<?php
namespace gamboamartin\administrador\models;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class adm_grupo extends _modelo_parent {
    public function __construct(PDO $link, array $childrens = array(), array $columnas_extra = array()){
        $tabla = 'adm_grupo';
        $columnas = array($tabla=>false);
        $campos_obligatorios = array('descripcion','descripcion_select','codigo','codigo_bis','alias');

        $columnas_extra['adm_grupo_n_permisos'] = /** @lang sql */
            "(SELECT COUNT(*) FROM adm_accion_grupo WHERE adm_accion_grupo.adm_grupo_id = adm_grupo.id)";

        $columnas_extra['adm_grupo_n_usuarios'] = /** @lang sql */
            "(SELECT COUNT(*) FROM adm_usuario WHERE adm_usuario.adm_grupo_id = adm_grupo.id)";

        $childrens['adm_accion_grupo'] = "gamboamartin\\administrador\\models";
        $childrens['adm_usuario'] = "gamboamartin\\administrador\\models";


        parent::__construct(link: $link, tabla: $tabla,campos_obligatorios: $campos_obligatorios, columnas: $columnas,
            columnas_extra: $columnas_extra, childrens: $childrens);
        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Grupo';
    }

    public function elimina_bd(int $id): array|stdClass
    {
        if($id <=0){
            return $this->error->error('Error id debe se mayor a 0', $id);
        }
        $filtro['adm_grupo.id'] = $id;
        $r_adm_accion_grupo = (new adm_accion_grupo(link: $this->link))->elimina_con_filtro_and(filtro: $filtro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al eliminar r_adm_accion_grupo',data:  $r_adm_accion_grupo);
        }

        $r_adm_usuario = (new adm_usuario(link: $this->link))->elimina_con_filtro_and(filtro: $filtro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al eliminar r_adm_usuario',data:  $r_adm_usuario);
        }

        $r_elimina_bd = parent::elimina_bd($id); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error('Error al eliminar adm_grupo', $r_elimina_bd);
        }
        return $r_elimina_bd;
    }

    /**
     * Obtiene los grupos de tipo root
     * @return array
     * @version 2.22.2
     */
    public function grupos_root(): array
    {
        $filtro['adm_grupo.root'] = 'activo';
        $r_grupo = $this->filtro_and(filtro:$filtro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener grupos root',data: $r_grupo);
        }
        return $r_grupo->registros;
    }


}
