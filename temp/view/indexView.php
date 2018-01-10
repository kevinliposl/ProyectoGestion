<?php
$session = SSession::getInstance();

if (isset($session->permissions)) {
    if ($session->permissions == 'A') {
        include_once 'public/headerAdmin.php'; //Admin
    } elseif ($session->permissions == 'S') {
        include_once 'public/headerStudent.php'; //Student
    } elseif ($session->permissions == 'R') {
        include_once 'public/headerRoot.php'; //Root
    } elseif ($session->permissions == 'T') {
        include_once 'public/headerProfessor.php'; //Professor
    }
} else {
    include_once 'public/header.php';
}
?>
<section id="slider" class="slider-parallax swiper_wrapper dark full-screen">
    <div class="slider-parallax-inner">
        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark" style="background-image: url('public/images/presentation/1.jpg');">
                    <div class="container clearfix">
                        <div class="slider-caption slider-caption-left">
                            <h2 data-caption-animate="fadeInRight" style="text-align: center;">
                                ¡Bienvenido <br>a<br> Fusi&oacute;n!
                            </h2>
                            <p data-caption-animate="fadeInUp" data-caption-delay="200" style="font-size: medium; text-align: center;">
                                <b>"La música da alma al universo, alas a la mente, vuelos a la imaginación, consuelo a la tristeza y vida y alegría a todas las cosas" -Platón-</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" data-scrollto="#content" data-offset="100" class="dark one-page-arrow"><i class="icon-angle-down infinite animated fadeInDown"></i></a>
    </div>
</section>

<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-lg-5">
                    <div class="heading-block topmargin">
                        <h1>L&iacute;der en educaci&oacute;n musical en Turrialba</h1>
                    </div>
                    <p class="lead">
                        Fusi&oacute;n es la academia l&iacute;der en educaci&oacute;n musical
                        en el cant&oacute;n de Turrialba, formando futuros grandes m&uacute;sicos. 
                    </p>
                </div>
                <div class="col-lg-7">

                    <div style="position: relative; margin-bottom: -60px;" class="ohidden" data-height-lg="426" data-height-md="567" data-height-sm="470" data-height-xs="287" data-height-xxs="183">
                        <img src="public/images/landing/piano.png" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="400" alt="Fa">
                    </div>
                </div>
            </div>
        </div>
        <div class="section nobottommargin">
            <div class="container clear-bottommargin clearfix">
                <div class="row topmargin-sm clearfix">
                    <div class="col-md-4 bottommargin">
                        <div class="heading-block nobottomborder" style="margin-bottom: 15px;">
                            <span class="before-heading"></span>
                            <h4>¿Quienes somos?</h4>
                        </div>
                        <p align="justify">
                            Brindamos clases privadas en nuestras instalaciones,
                            también talleres, clínicas y capacitaciones para 
                            público en general y toda agrupación musical que 
                            desee mejorar en sus aptitudes musicales. 
                            <br><br><a href="?controlador=Index&action=aboutus">¡Conozca m&aacute;s sobre nosotros!</a>
                        </p>
                    </div>
                    <div class="col-md-4 bottommargin">
                        <div class="heading-block nobottomborder" style="margin-bottom: 15px;">
                            <span class="before-heading"></span>
                            <h4>Nuestras ofertas academicas</h4>
                        </div>
                        <p align="justify">
                            En Fusi&oacute;n academia de m&uacute;sica, nuestros 
                            estudiantes se forman en diferentes &aacute;reas de la 
                            música como Violin, Canto, Piano, Bater&iacute;a, Guitarra
                            entre muchas otras m&aacute;s.
                            <br><br><a href="?controlador=Index&action=instruments">¡Conozca m&aacute;s sobre los cursos!</a>
                        </p>
                    </div>
                    <div class="col-md-4 bottommargin">
                        <div class="heading-block nobottomborder" style="margin-bottom: 15px;">
                            <span class="before-heading"></span>
                            <h4>Docencia en Fusi&oacute;n   </h4>
                        </div>
                        <p align="justify">
                            Fusi&oacute;n academia de m&uacute;sica se caracteriza
                            por el alto nivel de exigencia en sus profesores.
                            Todo miembro que integra nuestro equipo 
                            docente ha pasado por múltiples etapas de calificación 
                            y habilidades.
                            <br><br><a href="#">¡Conozca m&aacute;s sobre nuestros docentes!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="section footer-stick">
            <h4 class="uppercase center">¿Qu&eacute; dicen nuestros <span>clientes</span>?</h4>
            <div class="fslider testimonial testimonial-full" data-animation="fade" data-arrows="false">
                <div class="flexslider">
                    <div class="slider-wrap">
                        <div id="fb-root"></div>
                        <script>(function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id))
                                    return;
                                js = d.createElement(s);
                                js.id = id;
                                js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11';
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>

                        <div class="fb-comments" data-href="http://fusionacademiacr.com/" data-numposts="5"></div>
                        <div class="clearfix "><br><br><br><br><br></div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($session->permissions)) { ?>
            <div class="modal-on-load" data-target="#myModal1"></div>
        <?php } ?>
        <!-- Modal -->
        <div class="modal1 mfp-hide subscribe-widget" id="myModal1">
            <div class="block dark divcenter" style="background: url('public/images/footer-bg.jpg') no-repeat; background-size: cover; max-width: 500px;" data-height-lg="400">
                <div style="padding: 50px;">
                    <div class="center" style="max-width:500px;">
                        <h3>¡Nuestra p&aacute;gina a&uacute;n se encuentra en construcci&oacute;n!</h3>
                    </div>
                    <div class="heading-block nobottomborder bottommargin-sm" style="max-width:500px;">
                        <span>Si encuentras alg&uacute;n error puedes enviarnos un correo a:</span>
                        <br>
                        <p class="nobottommargin"><small>pabloBarrientos@fusionacademiacr.com</small></p>
                        <p class="nobottommargin"><small>kevinSandoval@fusionacademiacr.com</small></p>
                    </div>
                    <div class="heading-block nobottomborder bottommargin-sm" style="max-width:500px;">
                        <span>O bien, lo puedes hacer desde nuestra secci&oacute;n de 
                            <a href="?controller=Index&action=contact" class="badge">Contacto</a></span>
                    </div>
                </div>
                <div class="section center nomargin" style="padding: 30px;">
                    <a href="#" class="button" onClick="$.magnificPopup.close();return false;">Entendido</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once 'public/footer.php';
