<?php
  //require_once("connection_db.php");
class Mantenimiento{
    
    public static function guardar_Articulos($codigo, $descripcion, $precio){
        include("Conexion.php");
        $query = "INSERT INTO  articulos (codigo, descripcion, precio)
                                VALUES (?, ?, ?)";
        try{    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($codigo, $descripcion, $precio));
          $count = $comando->rowCount();
        
          if($count > 0){
              return 1;
          }else{
              return 0;
          }
        } catch (PDOException $e) {
            return -1;
        }                        
    }
    
    
    
    
    public static function eliminar_Articulos($codigo){
      include("Conexion.php");
      $query = "delete from articulos where codigo=?";
      try{
          $link=conexion();
          $comando=$link->prepare($query);
          $comando->execute(array($codigo));
          //return $comando;
          $count = $comando->rowCount(); 
          if($count>0){
              return 1;
          }else{
              return 0;   
          }
          
      }catch (PDOException $e){
          return -1;
      }
  }
  
  
  
  public static function actualizar_Articulos($codigo, $descripcion, $precio){
        include("Conexion.php");
        $query = "UPDATE articulos" .
            " SET descripcion=?, precio=? " .
            "WHERE codigo=?";

        try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($descripcion, $precio, $codigo));
          //return $comando;
          $count = $comando->rowCount(); 
          if($count>0){
              return 1;
          }else{
              return 0;   
          }

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    
    
    
    
    public static function getArticulosCodigo($codigo) {
        include("Conexion.php");
        $query = "SELECT codigo,descripcion,precio from articulos where codigo = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($codigo));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
  }
  
  
  public static function getArticulosDescripcion($desc) {
        include("Conexion.php");
        $query = "SELECT codigo,descripcion,precio from articulos where descripcion = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($desc));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
  }
  
  
  
   public static function getAllArticulos() {
        include("Conexion.php");
        
        $query = "SELECT codigo,descripcion,precio FROM articulos";

        try {
            $link=conexion();    
            $comando = $link->prepare($query);
            // Ejecutar sentencia preparada
            $comando->execute();
            
            $rows_array = array();
            while($result = $comando->fetch(PDO::FETCH_ASSOC))
                {
                    //$temp = array();
                    //$temp['codigo'] = $result['codigo'];
                    //$temp['descripcion'] = $result['descripcion'];
                    //$temp['precio'] = $result['precio'];
                                            
                     $array [] = array('codigo' => $result['codigo'], 'descripcion' => $result['descripcion'], 'precio' => $result['precio']);
                    
                    /*
                    $rows_array['codigo'] = $result['codigo'];
                    $rows_array['descripcion'] = $result['descripcion'];
                    $rows_array['precio'] = $result['precio'];
                    */
                }
                
                array_map("utf8_encode", $array);
  	            header('Content-type: application/json; charset=utf-8');
  	            return print_r(json_encode($array), JSON_UNESCAPED_UNICODE);
  	            
  	            
  	            //json_encode($datos, JSON_UNESCAPED_UNICODE);
                //return (var_dump($array));
                //return print_r($array);
        } catch (PDOException $e) {
            return false;
        }
        
    }
  
  
  
      //by Prof. Gamez.
}
?>