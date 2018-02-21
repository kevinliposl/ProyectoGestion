<?php
require_once 'util/RandomPassGenerator.php';
require_once 'util/SSession.php';

RandomPassGenerator::getInstance();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ProyectoGesti&oacute;n</title>
        <script src="public/js/jquery.min.js" type="text/javascript"></script>
        <script src="public/js/global.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php"><div>Home</div></a></li>
                    <?php if (!isset(SSession::getInstance()->user)) { ?>
                        <li><a href="view/RegisterView.php"><div>Registro</div></a></li>
                        <li><a href="view/LoginView.php"><div>Iniciar sesion</div></a></li>
                    <?php }if (isset(SSession::getInstance()->user)) {
                        if(SSession::getInstance()->user['type'] == "adm"){?>
                        <li><a href="#"><div>Usuario</div></a>
                            <ul>
                                <li><a href="view/StudentView.php"><div>Gesti&oacute;n de Estudiantes</div></a></li>
                                <li><a href="view/ProfessorView.php"><div>Gesti&oacute;n de Profesores</div></a></li>
                                <li><a href="view/AdministrativeView.php"><div>Gesti&oacute;n de Administrativos</div></a></li>
                                <li><a href="view/profileView.php"><div>Perfil</div></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><div>Universidades</div></a>
                            <ul>
                                <li><a href="view/CareerView.php"><div>Gesti&oacute;n de Carreras</div></a></li>
                                <li><a href="view/UniversityView.php"><div>Gesti&oacute;n de Universidades</div></a></li>
                                <li><a href="view/AdministrationInstallationView.php"><div>Gesti&oacute;n de Sedes y Recintos</div></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><div>Actividades</div></a>
                            <ul>
                                <li><a href="view/AdministrativeEventView.php"><div>Gesti&oacute;n de Eventos</div></a></li>
                                <li><a href="view/EventView.php"><div>Ver Eventos</div></a></li>
                                <li><a href="view/AdministrativePostView.php"><div>Gesti&oacute;n de Publicaciones</div></a></li>
                                <li><a href="view/PostView.php"><div>Ver Publicaciones</div></a></li>
                            </ul>
                        </li>
                            <li><a href="view/AdministrativeCommentView.php"><div>Gesti&oacute;n de Comentarios</div></a></li> 
                        
                        <li><a href="view/OrganChartView.php"><div>Organigrama</div></a></li> 
                        <li><a href="view/SearchView.php"><div>Busqueda</div></a></li>
                        <?php }else{?>
                            <li><a href="#"><div>Usuario</div></a>
                            <ul>
                                <li><a href="view/profileView.php"><div>Perfil</div></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><div>Actividades</div></a>
                            <ul>
                                <li><a href="view/AdministrativeEventView.php"><div>Gesti&oacute;n de Eventos</div></a></li>
                                <li><a href="view/EventView.php"><div>Ver Eventos</div></a></li>
                                <li><a href="view/AdministrativePostView.php"><div>Gesti&oacute;n de Publicaciones</div></a></li>
                                <li><a href="view/PostView.php"><div>Ver Publicaciones</div></a></li>
                            </ul>
                        </li>
                        <li><a href="view/OrganChartView.php"><div>Organigrama</div></a></li> 
                        <li><a href="view/SearchView.php"><div>Busqueda</div></a></li>
                        <?php }?>
                        
                        <li><a href="business/LoginBusiness.php?signout='i'"><div>Cerrar Sesi&oacute;n</div></a></li>
                    
                    <?php } ?>
                </ul>
            </nav>
        </header>

        <h1>INDEX</h1>

    </body>
</html>
