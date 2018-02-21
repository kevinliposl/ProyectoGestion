<?php
require_once '../util/RandomPassGenerator.php';
require_once '../util/SSession.php';
RandomPassGenerator::getInstance();
?>
<!DOCTYPE html>
<html dir="ltr" lang="es">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>ProyectoGesti&oacute;n</title>
        <script src="../public/js/jquery.min.js" type="text/javascript"></script>
        <script src="../public/js/global.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="../index.php"><div>Home</div></a></li> 
                    <?php if (!isset(SSession::getInstance()->user)) { ?>
                        <li><a href="RegisterView.php"><div>Registro</div></a></li>
                        <li><a href="LoginView.php"><div>Iniciar sesion</div></a></li>
                    <?php }if (isset(SSession::getInstance()->user)) { ?>
                        <li><a href="#"><div>Usuarios</div></a>
                            <ul>
                                <li><a href="StudentView.php"><div>Gesti&oacute;n de Estudiantes</div></a></li>
                                <li><a href="ProfessorView.php"><div>Gesti&oacute;n de Profesores</div></a></li>
                                <li><a href="AdministrativeView.php"><div>Gesti&oacute;n de Administrativos</div></a></li>
                                <li><a href="profileView.php"><div>Perfil</div></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><div>Universidades</div></a>
                            <ul>
                                <li><a href="CareerView.php"><div>Gesti&oacute;n de Carreras</div></a></li>
                                <li><a href="UniversityView.php"><div>Gesti&oacute;n de Universidades</div></a></li>
                                <li><a href="AdministrationInstallationView.php"><div>Gesti&oacute;n de Sedes y Recintos</div></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><div>Actividades</div></a>
                            <ul>
                                <li><a href="AdministrativeEventView.php"><div>Gesti&oacute;n de Eventos</div></a></li>
                                <li><a href="EventView.php"><div>Ver Eventos</div></a></li>
                                <li><a href="AdministrativePostView.php"><div>Gesti&oacute;n de Publicaciones</div></a></li>
                                <li><a href="PostView.php"><div>Ver Publicaciones</div></a></li>
                                <li><a href="AdministrativeCommentView.php"><div>Gesti&oacute;n de Comentarios</div></a></li>

                            </ul>
                        </li>
                        <li><a href="OrganChartView.php"><div>Organigrama</div></a></li> 
                        <li><a href="SearchView.php"><div>Busqueda</div></a></li>
                        <li><a href="../business/LoginBusiness.php?signout=''"><div>Cerrar Sesi&oacute;n</div></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </header>