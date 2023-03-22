<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static  function index(Router $router){
            $propiedades = Propiedad::get(3);
            $inicio = true;

        $router->render('/paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static  function nosotros(Router $router){
        
        $router->render('/paginas/nosotros', []);
    }

    public static  function propiedades(Router $router){
        
        $propiedades = Propiedad::all();

        $router->render('/paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static  function propiedad(Router $router){
        $id = validarORedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);

        if(!$propiedad){
            header("location: /propiedades");
        }

        $router->render('/paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static  function blog(Router $router){
        $router->render('/paginas/blog');
    }

    public static  function entrada(Router $router){
        $router->render('/paginas/entrada');
    }

    public static  function contacto(Router $router){
          $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
           

            $respuesta = $_POST['contacto'];

            //crear una instacia de PHPmailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username =  '16f751e85492d0';
            $mail->Password = 'd09ac7af519009';
            $mail->SMTPSecure = 'tls';
            $mail->Port = '2525';

            //configurar el contenido del email
            $mail->setFrom('Devhenry@gmail.com'); //quien lo envia
            $mail->addAddress('henryelcrack850@gmail.com'); //quien lo recibe
            $mail->Subject = 'Tienes un nuevo mensaje';

            //habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //definir el contenido
            $contenido = "<html>";
            $contenido .= "<p>Tienes un mensaje </p>";
            $contenido .= "<p>Nombre: ". $respuesta['nombre'] ." </p>";

            //mostrar iformacion segun lo que el usuario eligio como metodo de contacto
            if($respuesta['contacto'] == 'telefono'){
                $contenido .= "<p>Eligió  ser contactado vía Teléfono.</p>";
                $contenido .= "<p>Telefono: ". $respuesta['telefono'] ." </p>";
                $contenido .= "<p>Fecha: ". $respuesta['fecha'] ." </p>";
                $contenido .= "<p>Hora: ". $respuesta['hora'] ." </p>";

            }else{
                $contenido .= "<p>Eligió  ser contactado vía E-mail.</p>";
                $contenido .= "<p>Email: ". $respuesta['email'] ." </p>";
            }

            $contenido .= "<p>Mensaje: ". $respuesta['mensaje'] ." </p>";
            $contenido .= "<p>Vende o compra: ". $respuesta['tipo'] ." </p>";
            $contenido .= "<p>Precio o presupuesto: $" . $respuesta['precio']. " </p>";
            $contenido .= "</html>";
            $mail->Body = $contenido;
            $mail->AltBody = 'mensaje alternativo';

            //enviar y comprobar
            if($mail->send()){
                $mensaje = "Mensaje enviado correctamente";
            }else{
                $mensaje = "Mensaje fallido";
            }

        }
        $router->render('/paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}

?>