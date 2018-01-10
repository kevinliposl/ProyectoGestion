<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ProyectoGesti&oacute;n</title>
        <script src="public/js/jquery.min.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="?"><div>Home</div></a></li> 
                    <li><a href="#"><div>Usuarios</div></a>
                        <ul>
                            <li><a href="#"><div>Estudiante</div></a>
                                <ul>
                                    <li><a href="?controller=Student&action=insert"><div>Registrar</div></a></li>  
                                    <li><a href="?controller=Student&action=select"><div>Ver</div></a></li>
                                    <li><a href="?controller=Student&action=update"><div>Actualizar</div></a></li>
                                    <li><a href="?controller=Student&action=delete"><div>Eliminar</div></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>