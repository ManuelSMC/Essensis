<?php
    @session_start();

    $GLOBALS['ruta_raiz'] = "http://localhost/Essensis";
    $GLOBALS['inicio'] = $GLOBALS['ruta_raiz'].'../cliente/index.php';
    $GLOBALS['ruta_raiz_sin_sesion'] = $GLOBALS['ruta_raiz'].'/admin/login_get.php';
    $GLOBALS['suscriptor_dashboard'] = $GLOBALS['ruta_raiz']."/admin/dashboard_suscriptor.php";
    $GLOBALS['worker_dashboard'] = $GLOBALS['ruta_raiz']."/admin/dashboard_worker.php";
    $GLOBALS['login'] = $GLOBALS['ruta_raiz']."/admin/login_get.php";
    $GLOBALS['client_list'] = $GLOBALS['ruta_raiz'].'/admin/client_list.php';

    function connectDatabase(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "essensis";

        return mysqli_connect($servername, $username, $password, $database, 3306);
    }

    function addUser($nombre, $apellido, $direccion, $usuario, $password, $estatus) {
        $conn = connectDatabase();
        $password = md5($password);
        $consulta = "SELECT usuario FROM usuario WHERE usuario = '$usuario'";
        $query = mysqli_query($conn, $consulta);
        if(mysqli_num_rows($query) >= 1){
            $_SESSION['correo_existente'] = true;
            header("Location: register_get.php");
        }else{
            $add_sql_usuario = "INSERT INTO usuario (usuario, password, tipo, estatus) VALUES ('$usuario', '$password', 2, '$estatus')";
            mysqli_query($conn, $add_sql_usuario);

            $id_usuario = mysqli_insert_id($conn);
            
            $add_sql_cliente = "INSERT INTO cliente (nombre, apellido, direccion, id_usuario) VALUES ('$nombre', '$apellido', '$direccion', '$id_usuario')";
            mysqli_query($conn, $add_sql_cliente);
        
            closeConnMysql($conn);
        
            $_SESSION['usuario_agregado'] = true;
            header("Location: login_get.php");
        }
    }

    function getCliente($id_cliente) {
        $conn = connectDatabase();
        $consulta = "SELECT * FROM cliente WHERE id_cliente = " . $id_cliente;
        return mysqli_query($conn, $consulta);
        closeConnMysql($conn);
    }

    function addUser2($nombre, $apellido, $direccion, $usuario, $password, $estatus){

        $conn = connectDatabase();
        $password = md5($password);
        $consulta = "SELECT usuario FROM usuario 
        INNER JOIN cliente ON (usuario.id_usuario = cliente.id_usuario)
        WHERE usuario = '$usuario'";
        $query = mysqli_query($conn, $consulta);
        if(mysqli_num_rows($query) >= 1){
            $_SESSION['correo_existente'] = true;
            header("Location: add_client.php");
        }else{
            $add_sql = "INSERT INTO usuario (usuario, password, tipo, estatus) VALUES ('$usuario', '$password', 2, '$estatus')";
            mysqli_query($conn, $add_sql);

            $id_usuario = mysqli_insert_id($conn);

            $add_sql2 = "INSERT INTO cliente (nombre, apellido, direccion, id_usuario) VALUES ('$nombre', '$apellido', '$direccion', '$id_usuario')";
            mysqli_query($conn, $add_sql2);
            
            closeConnMysql($conn);
    
            $_SESSION['usuario_agregado2'] = true;
            header("Location: client_list.php");
        }        
    }

    function loginUser($usuario, $password){
        
        $conn = connectDatabase();
        $query = "SELECT * FROM usuario WHERE usuario = '$usuario'";
        $result = $conn->query($query);
        $password = md5($password);
        if (mysqli_num_rows($result) > 0) {
            
            $row = $result->fetch_assoc();
    
            if (($password == $row['password'])) {

                $_SESSION['id_usuario'] = $row['id_usuario'];
                
                if($row['estatus'] == 0){
                    $_SESSION['deshabilitado'] = true;
                    header("Location: login_get.php");
                exit;
                }elseif ($row['tipo'] == 1) {
                    if($row['estatus'] == 0){
                        $_SESSION['deshabilitado'];
                        header("Location:" . $GLOBALS['login']);
                    }else{
                        $query_perfil = "SELECT * FROM usuario 
                        INNER JOIN administrador ON(usuario.id_usuario = administrador.id_usuario)
                        WHERE usuario = '$usuario'";
                        $result_perfil = $conn->query($query_perfil);
                        $row_perfil = $result_perfil->fetch_assoc();
                        $_SESSION['administrador'] = $row_perfil['nombre'];
                        $_SESSION['inicioadmin'] = true;
                        $_SESSION["id_administrador"] = $row_perfil['id_administrador'];
                        header("Location:" . $GLOBALS['worker_dashboard']);
                    }
                } elseif ($row['tipo'] == 2) {
                    if($row['estatus'] == 0){
                        $_SESSION['deshabilitado'];
                        header("Location:" . $GLOBALS['login']);
                    }else{
                        $query_perfil = "SELECT * FROM usuario 
                        INNER JOIN cliente ON(usuario.id_usuario = cliente.id_usuario)
                        WHERE usuario = '$usuario'";
                        $result_perfil = $conn->query($query_perfil);
                        $row_perfil = $result_perfil->fetch_assoc();
                        $_SESSION['cliente'] = $row_perfil['nombre'];
                        $_SESSION['iniciocliente'] = true;
                        $_SESSION["id_cliente"] = $row_perfil['id_cliente'];
                        header("Location:" . $GLOBALS['inicio']);
                    }
                }
            }else {
                $_SESSION['no_inicio'] = true;
                header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
            }
        }else {
            $_SESSION['no_inicio'] = true;
            header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
        } 
    
        closeConnMysql($conn);
    }

    function updateClient($id_cliente, $nombre, $apellido, $direccion, $email, $password, $estatus){
        $conn = connectDatabase();
        $password = md5($password);
        if($password == ""){
            
            $update_sql = "UPDATE usuario
            SET usuario = '$email', estatus = '$estatus'
            WHERE id_usuario IN (SELECT id_usuario FROM cliente WHERE id_cliente = '$id_cliente')";
            mysqli_query($conn, $update_sql);
                        
            $update_sql2 = "UPDATE cliente
            SET nombre = '$nombre', apellido = '$apellido', direccion = '$direccion'
            WHERE id_cliente = '$id_cliente'";
            mysqli_query($conn, $update_sql2);

        }
        elseif($password != ""){
            
            $update_sql = "UPDATE usuario
            SET usuario = '$email', estatus = '$estatus', password = '$password'
            WHERE id_usuario IN (SELECT id_usuario FROM cliente WHERE id_cliente = '$id_cliente')";
            mysqli_query($conn, $update_sql);
                        
            $update_sql2 = "UPDATE cliente
            SET nombre = '$nombre', apellido = '$apellido', direccion = '$direccion'
            WHERE id_cliente = '$id_cliente'";
            mysqli_query($conn, $update_sql2);
        }
        
        closeConnMysql($conn);
    }

    function habilitar_cli($estatus, $id_cliente){

        $conn = connectDatabase();
            $update_sql = "UPDATE usuario
            INNER JOIN cliente ON (usuario.id_usuario = cliente.id_usuario)
            SET estatus = '$estatus'
            WHERE id_cliente = '$id_cliente'";
    
        mysqli_query($conn, $update_sql);

        closeConnMysql($conn);
    }

    function perfilAdmin($id_admin){
        $conn = connectDatabase();
        $perfil_sql = "SELECT * FROM usuario 
        INNER JOIN administrador ON (usuario.id_usuario = administrador.id_usuario)
        WHERE id_administrador = '$id_admin'";
        $perfil = mysqli_query($conn, $perfil_sql);
        return $perfil;
        closeConnMysql($conn);
    }

    function perfilCliente($id_cliente){
        $conn = connectDatabase();
        $perfil_sql = "SELECT * FROM usuario 
        INNER JOIN cliente ON (usuario.id_usuario = cliente.id_usuario)
        WHERE id_cliente = $id_cliente";
        $perfil = mysqli_query($conn, $perfil_sql);
        return $perfil;
        closeConnMysql($conn);
    }


    function user_inhab($email, $pass){
        $conn = connectDatabase();
        $query = "SELECT estatus FROM usuario
        INNER JOIN cliente ON (usuario.id_usuario = cliente.id_usuario)
        WHERE usuario = '$email' AND password='$pass'";
        $status = mysqli_query($conn,$query);
        return $status;
        closeConnMysql($conn);
    }

    function admin_inhab($email, $pass){
        $conn = connectDatabase();
        $query = "SELECT estatus FROM usuario 
        INNER JOIN administador ON (usuario.id_usuario = administador.id_usuario)
        WHERE usuario = '$email' AND password='$pass'";
        $status = mysqli_query($conn,$query);
        return $status;
        closeConnMysql($conn);
    }


    function tableWorker(){ 
        $conn = connectDatabase();
        $table_data = "SELECT * FROM usuario 
        INNER JOIN administrador ON (usuario.id_usuario = administrador.id_usuario)";
        return mysqli_query($conn, $table_data);
        closeConnMysql($conn);
    }
    
    function tableInv(){
        $conn = connectDatabase();
        $table_data = "SELECT * FROM inventario";
        return mysqli_query($conn, $table_data);
        closeConnMysql($conn);
    }
    
    function showWorker(){
        $id_administrador = $_GET['administrador'];
        $conn = connectDatabase();
        $table_data = "SELECT * FROM usuario 
        INNER JOIN administrador ON (usuario.id_usuario = administrador.id_usuario)
        WHERE id_administrador = '$id_administrador'";
        return mysqli_query($conn, $table_data);
        closeConnMysql($conn);
    }

    function addWorker($nombre, $apellido, $email, $password, $estatus){

        $conn = connectDatabase();
        $password = md5($password);
        $consulta = "SELECT usuario FROM usuario 
        INNER JOIN administrador ON (usuario.id_usuario = administrador.id_usuario)
        WHERE usuario = '$email'";
        $query = mysqli_query($conn, $consulta);
        if(mysqli_num_rows($query) >= 1){
            $_SESSION['correo_existente'] = true;
            header("Location: add_worker.php");
        }else{

        $add_sql = "INSERT INTO usuario (usuario, password, tipo, estatus) values ('$email', '$password', 1, '$estatus')";
        mysqli_query($conn, $add_sql);
        $id_usuario = $conn->insert_id;

        $query_admin = "INSERT INTO administrador (nombre, apellido, id_usuario) VALUES ('$nombre', '$apellido', '$id_usuario')";
        $result_admin = $conn->query($query_admin);
        
        closeConnMysql($conn);

        $_SESSION['empleado_agregado'] = true;
        header("Location: workers_list.php");
        }          
    }

    function updateWorker($id_administrador, $nombre, $apellido, $email, $password, $estatus){
        $conn = connectDatabase();
        $password = md5($password);
        if($password == ""){
            
            $update_sql = "UPDATE usuario
            SET usuario = '$email', estatus = '$estatus'
            WHERE id_usuario IN (SELECT id_usuario FROM administrador WHERE id_administrador = '$id_administrador')";
            mysqli_query($conn, $update_sql);
                        
            $update_sql2 = "UPDATE administrador
            SET nombre = '$nombre', apellido = '$apellido'
            WHERE id_administrador = '$id_administrador'";
            mysqli_query($conn, $update_sql2);

        }
        elseif($password != ""){
            
            $update_sql = "UPDATE usuario
            SET usuario = '$email', estatus = '$estatus', password = '$password'
            WHERE id_usuario IN (SELECT id_usuario FROM administrador WHERE id_administrador = '$id_administrador')";
            mysqli_query($conn, $update_sql);
                        
            $update_sql2 = "UPDATE administrador
            SET nombre = '$nombre', apellido = '$apellido'
            WHERE id_administrador = '$id_administrador'";
            mysqli_query($conn, $update_sql2);
        }
        
        closeConnMysql($conn);
    }

    function deleteWorker($id_administrador){
        $conn = connectDatabase();
        $delete_sql = "DELETE FROM administrador WHERE id_administrador = '$id_administrador'";
        mysqli_query($conn, $delete_sql);
        closeConnMysql($conn);
    }

    function closeConnMysql($conn){
        mysqli_close($conn);
    }

    function inhabilitar_admin($estatus, $id_administrador){

        $conn = connectDatabase();
            $update_sql = "UPDATE usuario
            INNER JOIN administrador ON (usuario.id_usuario = administrador.id_usuario)
            SET estatus = '$estatus'
            WHERE id_administrador = '$id_administrador'";
    
        mysqli_query($conn, $update_sql);

        closeConnMysql($conn);
    }

    function inhabilitar_cli($estatus, $id_cliente){

        $conn = connectDatabase();
            $update_sql = "UPDATE usuario
            INNER JOIN cliente ON (usuario.id_usuario = cliente.id_usuario)
            SET estatus = '$estatus'
            WHERE id_cliente = '$id_cliente'";
    
        mysqli_query($conn, $update_sql);

        closeConnMysql($conn);
    }
    


    function habilitar_admin($estatus, $id_administrador){

        $conn = connectDatabase();
            $update_sql = "UPDATE usuario
            INNER JOIN administrador ON (usuario.id_usuario = administrador.id_usuario)
            SET estatus = '$estatus'
            WHERE id_administrador = '$id_administrador'";
    
        mysqli_query($conn, $update_sql);

        closeConnMysql($conn);
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    function tableWorker2(){
        
        $conn = connectDatabase();
        $table_data2 = "SELECT * FROM usuario
        INNER JOIN cliente ON (usuario.id_usuario = cliente.id_usuario)";
        return mysqli_query($conn, $table_data2);
        closeConnMysql($conn);
        $_SESSION['usuario_agregado2'] = true;
            header("Location:" . $GLOBALS['client_list']);
    }

    function showWorker2(){
        $conn = connectDatabase();
        $table_data2 = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'";
        return mysqli_query($conn, $table_data2);
        closeConnMysql($conn);
    }

    function updateWorker2($id_cliente, $nombre, $apellido, $direccion, $password, $usuario, $estatus){

        $conn = connectDatabase();
        if($password == ""){
            $update_sql = "UPDATE cliente
            SET nombre = '$nombre', apellido = '$apellido', usuario = '$usuario', direccion = '$direccion', estatus = '$estatus'
            WHERE id_cliente = '$id_cliente'";
        }        
        elseif($password != ""){
            $update_sql = "UPDATE cliente
            SET nombre = '$nombre', apellido = '$apellido', usuario = '$usuario', direccion = '$direccion', estatus = '$estatus'
            WHERE id_cliente = '$id_cliente'";
        }

        mysqli_query($conn, $update_sql);
        closeConnMysql($conn);
    }
    
    function deleteWorker2($id_cliente){
        $conn = connectDatabase();
        $delete_sql = "DELETE FROM cliente WHERE id_cliente = '$id_cliente'";
        mysqli_query($conn, $delete_sql);
        closeConnMysql($conn);
    }

    function closeConnMysql2($conn){
        mysqli_close($conn);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////

    function addSuc($nombre, $estado, $municipio, $direccion, $telefono, $estatus,$imagen){

        $conn = connectDatabase();
        
        $filename = $_FILES["imagen"]["name"];
        $filename = str_replace(" ", "_", $filename);

        $tempname = $_FILES["imagen"]["tmp_name"];
        $path = "/6_blog/Images/Sucursales/".$filename;
        $folder = str_replace("\\", "/", dirname(getcwd())."/Images/Sucursales/");

        $path_file = $folder.$filename;

        move_uploaded_file($tempname, $path_file);

        $add_sql = "INSERT INTO sucursales (nombre, estado, municipio, direccion, telefono, estatus,imagen) values ('$nombre', '$estado', '$municipio', '$direccion', '$telefono', '$estatus','$path')";

        mysqli_query($conn, $add_sql);
        
        closeConnMysql($conn);

        $_SESSION['sucursal_agregado'] = true;
            header("Location: sucursal_list.php");
    }
    function tableSuc(){
        
        $conn = connectDatabase();
        $table_data = "SELECT * FROM sucursales";
        return mysqli_query($conn, $table_data);
        closeConnMysql($conn);
    }

    function tableAdmin(){
        $conn = connectDatabase();
        $table_data = "SELECT * FROM administradores";
        return mysqli_query($conn, $table_data);
        closeConnMysql($conn);
    }
    
    function showAdmin(){
        $id_admin = $_GET['id_admin'];
        $conn = connectDatabase();
        $table_data = "SELECT * FROM administrador WHERE id_administrador = '$id_admin'";
        return mysqli_query($conn, $table_data);
        closeConnMysql($conn);
    }

    function showSuc(){
        $id_sucursal = $_GET['sucursal'];
        $conn = connectDatabase();
        $table_data = "SELECT * FROM sucursales WHERE id_sucursal = '$id_sucursal'";
        return mysqli_query($conn, $table_data);
        closeConnMysql($conn);
    }

    function inhabilitar_suc($estatus, $id_sucursal){

        $conn = connectDatabase();
            $update_sql = "UPDATE sucursales
            SET estatus = '$estatus'
            WHERE id_sucursal = '$id_sucursal'";
    
        mysqli_query($conn, $update_sql);

        closeConnMysql($conn);
    }

    function habilitar_suc($estatus, $id_sucursal){

        $conn = connectDatabase();
            $update_sql = "UPDATE sucursales
            SET estatus = '$estatus'
            WHERE id_sucursal = '$id_sucursal'";
    
        mysqli_query($conn, $update_sql);

        closeConnMysql($conn);
    }

    function updateSucVacio($id_sucursal, $nombre, $estado, $municipio, $direccion, $telefono, $estatus)
{
    $conn = connectDatabase();

    $filename = $_FILES["imagen"]["name"];
    $filename = str_replace(" ", "_", $filename);

    $tempname = $_FILES["imagen"]["tmp_name"];
    $path = "/6_blog/Images/Sucursales/" . $filename;
    $folder = str_replace("\\", "/", dirname(getcwd()) . "/Images/Sucursales/");

    $path_file = $folder . $filename;

    move_uploaded_file($tempname, $path_file);
    $update_sql = "UPDATE sucursales
                    SET nombre = '$nombre', estado = '$estado', municipio = '$municipio', direccion = '$direccion',  telefono = '$telefono', estatus = '$estatus'
                    WHERE id_sucursal = '$id_sucursal'";

    mysqli_query($conn, $update_sql);

    closeConnMysql($conn);
}

function updateSucNoVacio($id_sucursal, $nombre, $estado, $municipio, $direccion, $telefono, $estatus, $imagen)
{
    $conn = connectDatabase();

    $filename = $_FILES["imagen"]["name"];
    $filename = str_replace(" ", "_", $filename);

    $tempname = $_FILES["imagen"]["tmp_name"];
    $path = "/6_blog/Images/Sucursales/" . $filename;
    $folder = str_replace("\\", "/", dirname(getcwd()) . "/Images/Sucursales/");

    $path_file = $folder . $filename;

    move_uploaded_file($tempname, $path_file);
    $update_sql = "UPDATE sucursales
                    SET nombre = '$nombre', estado = '$estado', municipio = '$municipio', direccion = '$direccion',  telefono = '$telefono', estatus = '$estatus',imagen = '$path'
                    WHERE id_sucursal = '$id_sucursal'";

    mysqli_query($conn, $update_sql);

    closeConnMysql($conn);
}

    function selectSucursales(){
        $conn = connectDatabase();
        $select_sql = "SELECT * FROM sucursales";
        $select = mysqli_query($conn, $select_sql);
        return $select;
        closeConnMysql($conn);
    }

    function selectProductos(){
        $conn = connectDatabase();
        $select_sql = "SELECT * FROM productos";
        $select = mysqli_query($conn, $select_sql);
        return $select;
        closeConnMysql($conn);
    }




/* ////////////////////////////// INICIO PRODUCTOS ////////////////////////////////////// */

    function tableProd(){
        
        $conn = connectDatabase();

        $table_data = "SELECT * FROM productos";
        return mysqli_query($conn, $table_data);
        closeConnMysql($conn);
    }

    function addProd($marca, $modelo, $descripcion, $color, $precio, $imagen){
        $conn = connectDatabase();
        
        $filename = $_FILES["imagen"]["name"];
        $filename = str_replace(" ", "_", $filename);

        $tempname = $_FILES["imagen"]["tmp_name"];
        $path = "/6_blog/Images/Productos/".$filename;
        $folder = str_replace("\\", "/", dirname(getcwd())."/Images/Productos/");

        $path_file = $folder.$filename;

        move_uploaded_file($tempname, $path_file);

        $add_sql = "INSERT INTO productos (marca, modelo, descripcion, color, precio, imagen) values ('$marca', '$modelo', '$descripcion', '$color', '$precio', '$path')";

        mysqli_query($conn, $add_sql);
        
        closeConnMysql($conn);

        $_SESSION['producto_agregado'] = true;
            header("Location: productos_list.php");
    }

    function inhabilitar_prod($estatus, $id_producto){

        $conn = connectDatabase();
            $update_sql = "UPDATE productos
            SET estatus = '$estatus'
            WHERE id = '$id_producto'";
    
        mysqli_query($conn, $update_sql);

        closeConnMysql($conn);
    }

    function habilitar_prod($estatus, $id_producto){

        $conn = connectDatabase();
            $update_sql = "UPDATE productos
            SET estatus = '$estatus'
            WHERE id = '$id_producto'";
    
        mysqli_query($conn, $update_sql);

        closeConnMysql($conn);
    }

    function showProd(){

        $id_producto = $_GET['producto'];

        $conn = connectDatabase();
        
        $table_data = "SELECT * FROM productos WHERE id = '$id_producto'";
        
        return mysqli_query($conn, $table_data);

        closeConnMysql($conn);

        
    }

    function updateProdVacio($id_producto, $marca, $modelo, $descripcion, $color, $precio)
{
    $conn = connectDatabase();

    $filename = $_FILES["imagen"]["name"];
    $filename = str_replace(" ", "_", $filename);

    $tempname = $_FILES["imagen"]["tmp_name"];
    $path = "/6_blog/Images/Productos/" . $filename;
    $folder = str_replace("\\", "/", dirname(getcwd()) . "/Images/Productos/");

    $path_file = $folder . $filename;

    move_uploaded_file($tempname, $path_file);
        $update_sql = "UPDATE productos
                       SET marca = '$marca', modelo = '$modelo', descripcion = '$descripcion', color = '$color', precio = '$precio'
                       WHERE id = '$id_producto'";

    mysqli_query($conn, $update_sql);

    closeConnMysql($conn);
}

function updateProdNoVacio($id_producto, $marca, $modelo, $descripcion, $color, $precio, $imagen)
{
    $conn = connectDatabase();

    $filename = $_FILES["imagen"]["name"];
    $filename = str_replace(" ", "_", $filename);

    $tempname = $_FILES["imagen"]["tmp_name"];
    $path = "/6_blog/Images/Productos/" . $filename;
    $folder = str_replace("\\", "/", dirname(getcwd()) . "/Images/Productos/");

    $path_file = $folder . $filename;

    move_uploaded_file($tempname, $path_file);
    $update_sql = "UPDATE productos
                    SET marca = '$marca', modelo = '$modelo', descripcion = '$descripcion', color = '$color', precio = '$precio', imagen = '$path'
                    WHERE id = '$id_producto'";

    mysqli_query($conn, $update_sql);

    closeConnMysql($conn);
}

/* ////////////////////////////// FIN PRODUCTOS ////////////////////////////////////// */


/* ////////////////////////////// INICIO INVENTARIOS ////////////////////////////////////// */

function selectInventario(){
    $conn = connectDatabase();
    $select_sql = "SELECT * FROM inventario";
    $select = mysqli_query($conn, $select_sql);
    return $select;
    closeConnMysql($conn);
}

function editInventario($id_inventario, $stock){

    $conn = connectDatabase();

    $edit_sql = "UPDATE inventario
        SET disponibles = '$stock'
        WHERE id_inventario = '$id_inventario'";
    mysqli_query($conn, $edit_sql);
    closeConnMysql($conn);
}

function listInventario($id_producto, $id_sucursal, $stock){
    $conn = connectDatabase();
    $inventario_repetido = "SELECT inventario.* FROM inventario 
    INNER JOIN productos ON inventario.id_producto = productos.id
    INNER JOIN sucursales ON inventario.id_sucursal = sucursales.id_sucursal 
    WHERE sucursales.id_sucursal = '$id_sucursal' AND productos.id = '$id_producto'";
    $repetido = mysqli_query($conn, $inventario_repetido);
    
    if(mysqli_num_rows($repetido) > 0){
        $row_repetido = mysqli_fetch_array($repetido);
        $id_inventario_repetido = $row_repetido['id_inventario'];
        $stock_original = $row_repetido["disponibles"];
        $nuevo_stock = $stock_original + $stock;
        $edit_sql = "UPDATE inventario
        SET disponibles = '$nuevo_stock'
        WHERE id_inventario = '$id_inventario_repetido'";
    }else{
        $edit_sql = "INSERT INTO inventario VALUES (0, $stock, $id_producto, $id_sucursal)";
    }
    mysqli_query($conn, $edit_sql);
    closeConnMysql($conn);
}

    function inhabilitar_inv($disponibles, $id_inventario){

        $conn = connectDatabase();
            $update_sql = "UPDATE inventario
            SET disponibles = '$disponibles'
            WHERE id_inventario = '$id_inventario'";
    
        mysqli_query($conn, $update_sql);

        closeConnMysql($conn);
    }

    function addInventario($id_producto, $id_sucursal, $stock){
        $conn = connectDatabase();
        $inventario_repetido = "SELECT inventario.* FROM inventario 
        INNER JOIN productos ON inventario.id_producto = productos.id
        INNER JOIN sucursales ON inventario.id_sucursal = sucursales.id_sucursal 
        WHERE sucursales.id_sucursal = '$id_sucursal' AND productos.id = '$id_producto'";
        $repetido = mysqli_query($conn, $inventario_repetido);
        
        if(mysqli_num_rows($repetido) > 0){
            $row_repetido = mysqli_fetch_array($repetido);
            $id_inventario_repetido = $row_repetido['id_inventario'];
            $stock_original = $row_repetido["disponibles"];
            $nuevo_stock = $stock_original + $stock;
            $edit_sql = "UPDATE inventario
            SET disponibles = '$nuevo_stock'
            WHERE id_inventario = '$id_inventario_repetido'";
        }else{
            $edit_sql = "INSERT INTO inventario VALUES (0, $stock, $id_producto, $id_sucursal)";
        }
        mysqli_query($conn, $edit_sql);
        closeConnMysql($conn);
    }

    function obtenerProducto($idProducto) {
        $conn = connectDatabase();
        $query = "SELECT * FROM productos WHERE id = $idProducto";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($result);
    }
    
    function obtenerSucursal($idSucursal) {
        $conn = connectDatabase();
        $query = "SELECT * FROM sucursales WHERE id_sucursal = $idSucursal";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($result);
    }

/* ////////////////////////////// FIN INVENTARIOS ////////////////////////////////////// */

/* ////////////////////////////// INICIA CARRITO ////////////////////////////////////// */
function agregarCarrito($id_prod, $cantidad, $id_suc) {
    $conn = connectDatabase();

    //Consulta el inventario del producto
    $select_sql = "SELECT * 
    FROM inventario
    WHERE id_producto = '$id_prod'
    AND id_sucursal = '$id_suc'";

    $result = mysqli_query($conn, $select_sql);

    if ($result) {
        
        $row = mysqli_fetch_assoc($result);
        $disponibles = $row['disponibles'];

        if ($disponibles < $cantidad) {
            $_SESSION['sinStock'] = true;
            header("Location: detalle_prod.php?id_prod=$id_prod&id_suc=$id_suc");
        }
        else{
            $inventario_id = $row["id_inventario"];

            if (!isset($_SESSION['carrito'])) {
                // Si no está inicializada la sesión del carrito de compras, inicialízala como un array vacío
                $_SESSION['carrito'] = array();
            }
            
            // Actualiza o agrega al carrito en la sesión
            if (isset($_SESSION['carrito'][$inventario_id])) {
                // Si el inventario ya está en el carrito, actualiza la cantidad
                $_SESSION['carrito'][$inventario_id]['cantidad'] += $cantidad;
            } else {
                // Si no está en el carrito, agrégalo
                $_SESSION['carrito'][$inventario_id] = array(
                    'cantidad' => $cantidad
                );
            }
            
            $_SESSION['agregadoAlCarrito'] = true;
            header("Location: catalogo.php");

        }
        
        /* else {
            $nuevoStock = $disponibles - $cantidad;

            $update_sql = "UPDATE inventario
            SET disponibles = '$nuevoStock'
            WHERE id_producto = '$id_prod'
            AND id_sucursal = '$id_suc'";

            mysqli_query($conn, $update_sql);

            $_SESSION['agregadoAlCarrito'] = true;
            header("Location: catalogo.php");
        }*/
    } else {
        // Manejo de error si la consulta falla
        echo "Error en la consulta: " . mysqli_error($conn);
    }

    closeConnMysql($conn);
}

function getInventario($id_inv) {
    $conn = connectDatabase();

    //Consulta el inventario del producto
    $select_sql = "SELECT * 
    FROM inventario
    WHERE id_inventario = " . $id_inv;

    $result = mysqli_query($conn, $select_sql);

    if ($result) {
        return mysqli_fetch_assoc($result);
    }

    closeConnMysql($conn);
}

function getProducto($id_prod) {
    $conn = connectDatabase();

    //Consulta el inventario del producto
    $select_sql = "SELECT * 
    FROM productos
    WHERE id = " . $id_prod;

    $result = mysqli_query($conn, $select_sql);

    if ($result) {
        return mysqli_fetch_assoc($result);
    }

    closeConnMysql($conn);
}

function getSuc($id_suc) {
    $conn = connectDatabase();

    //Consulta el inventario del producto
    $select_sql = "SELECT * 
    FROM sucursales
    WHERE id_sucursal = " . $id_suc;

    $result = mysqli_query($conn, $select_sql);

    if ($result) {
        return mysqli_fetch_assoc($result);
    }

    closeConnMysql($conn);
}

/* ////////////////////////////// FIN CARRITO ////////////////////////////////////// */

function agregarVenta($id_cli, $monto_total, $monto_iva, $fechaActual){
    $conn = connectDatabase();

    $add_sql_venta = "INSERT INTO venta (id_cliente, monto_total, fecha, tasa_iva) 
    VALUES ('$id_cli', '$monto_total', '$fechaActual', '$monto_iva')";


    mysqli_query($conn, $add_sql_venta);
    $id_venta = mysqli_insert_id($conn);
    $_SESSION['ventaHecha'] = true;
    header("Location: catalogo.php");
    closeConnMysql($conn);
    return $id_venta;
}

function agregarDetalleVenta($id_venta, $id_inventario, $cantidad, $precio_unit, $subtotal){
    $conn = connectDatabase();

    $add_sql_detalle_venta = "INSERT INTO detalle_venta (id_venta, id_inventario, cantidad, precio_unitario, subtotal) 
    VALUES ('$id_venta', '$id_inventario', '$cantidad', '$precio_unit', '$subtotal')";

    mysqli_query($conn, $add_sql_detalle_venta);
    closeConnMysql($conn);
}

function tableDet(){
        
    $conn = connectDatabase();
    $table_data = "SELECT venta.fecha,sucursales.nombre,productos.marca ,detalle_venta.precio_unitario,detalle_venta.cantidad,detalle_venta.subtotal from venta 
    inner join detalle_venta on (venta.id=detalle_venta.id_venta) 
    inner join inventario on (detalle_venta.id_inventario=inventario.id_inventario)
    inner join sucursales on (inventario.id_sucursal=sucursales.id_sucursal)
    inner join productos on (inventario.id_producto=productos.id) where venta.fecha='2023-11-29'";
    
    return mysqli_query($conn, $table_data);
    closeConnMysql($conn);
}
function tableFac(){
        
    $conn = connectDatabase();
    $table_data = "SELECT venta.fecha,productos.marca,detalle_venta.precio_unitario,detalle_venta.cantidad,venta.tasa_iva,venta.monto_total FROM detalle_venta inner join venta on (detalle_venta.id_venta=venta.id) inner join productos on (detalle_venta.id_producto=productos.id)";
    return mysqli_query($conn, $table_data);
    closeConnMysql($conn);
}

/* ////////////////////////////// INICIA VENTA Y DETALLE DE VENTA ////////////////////////////////////// */

function getVentasPorCliente($id_cliente){
    $conn = connectDatabase();
    $table_data = "SELECT * FROM venta WHERE id_cliente = " . $id_cliente;
    return mysqli_query($conn, $table_data);
    closeConnMysql($conn);
}

function getDetalleVenta($id_venta){  
    $conn = connectDatabase();
    $table_data = "SELECT * FROM detalle_venta INNER JOIN venta ON detalle_venta.id_venta = venta.id INNER JOIN cliente ON venta.id_cliente = cliente.id_cliente INNER JOIN inventario ON detalle_venta.id_inventario = inventario.id_inventario INNER JOIN productos ON inventario.id_producto = productos.id WHERE venta.id = ". $id_venta;
    return mysqli_query($conn, $table_data);
    closeConnMysql($conn);
}

/* ////////////////////////////// FIN VENTA Y DETALLE DE VENTA ////////////////////////////////////// */

?>