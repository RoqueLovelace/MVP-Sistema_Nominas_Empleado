<?php
session_start();
include 'timezone.php';

if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $empleadoID = $_SESSION["employee_id"];
  $correo = $_SESSION["usu_correo"];
  $Nombre = $_SESSION["firstname"];
  $gender = $_SESSION["gender"];
  
} else {
  $correo = "Correo no disponible";
  $Nombre = "Nombre no disponible";
}

$currentTime = get_current_time(); // Call the function
?>
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Empleado | Fundación Emprende Hoy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">

        <!-- plugin css -->
        <link href="../../assets/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">

        <!-- preloader css -->
        <link rel="stylesheet" href="../../assets/css/preloader.min.css" type="text/css">

        
        <!-- Bootstrap Css -->
        <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="../../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div class="layout-wrapper" id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="../../assets/picture/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="../../assets/picture/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Nómina</span>
                                </span>
                            </a>

                            <a href="" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../../assets/picture/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="../../assets/picture/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Nómina</span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="search" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="grid" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <div class="p-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/github.png" alt="Github">
                                                <span>GitHub</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/bitbucket.png" alt="bitbucket">
                                                <span>Bitbucket</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/dribbble.png" alt="dribbble">
                                                <span>Dribbble</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/dropbox.png" alt="dropbox">
                                                <span>Dropbox</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/mail_chimp.png" alt="mail_chimp">
                                                <span>Mail Chimp</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../../assets/picture/slack.png" alt="slack">
                                                <span>Slack</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="../../assets/picture/avatar-1.jpg" alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium"><?php echo $Nombre ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="../profile/index.php"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Mi perfil</a>
                                <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Restablecer contraseña</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../../index.php"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i>Cerrar Sesión</a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar="" class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Menu</li>

                            <li>
                                <a href="../home/">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="">
                                    <i data-feather="cpu"></i>
                                    <span data-key="t-icons">Historiales de Empleado</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="../historiales/horas_trabajadas/" data-key="t-boxicons">Horas Trabajadas</a></li>
                                    <li><a href="#" data-key="t-material-design">Horas Extras</a></li>
                                    <li><a href="../historiales/tiempo_de_descanso/" data-key="t-material-design">Tiempo de descanso</a></li>
                                    <li><a href="../historiales/horas_por_cumplir/" data-key="t-dripicons">Horas por Cumplir</a></li>
                                    <li><a href="#" data-key="t-font-awesome">Deducciones</a></li>
                                    <li><a href="../historiales/historial_anual/" data-key="t-boxicons">Historal Anual</a></li>
                                </ul>
                            </li>
                        </ul>

                        <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                            <div class="card-body">
                                <img src="../../assets/picture/giftbox.png" alt="">
                                <div class="mt-4">
                                    <h5 class="alertcard-title font-size-16">Actualizar mi plan</h5>
                                    <p class="font-size-13">Actualice su plan desde una prueba gratuita para seleccionar "Plan de negocios".</p>
                                    <a href="#" class="btn btn-primary mt-2">Actualizar ahora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                    
                        <!-- start page title -->
                        <div class="row ">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Perfil de usuario</h4>

                                    

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-9 col-lg-8">
                                <div class="card">
                                <div class="card-body text-center">
                                     <!-- inicio card body -->
                                            <div class="row justify-content-center">
                                                <div class="col-sm-12">
                                                    <div class="d-flex flex-column align-items-center mt-3 mt-sm-0">
                                                        <div class="avatar-xl mb-3">
                                                            <img src="../../assets/picture/avatar-2.jpg" alt="" class="img-fluid rounded-circle d-block">
                                                        </div>
                                                        <div>
                                                            <h5 class="font-size-16 mb-1"><?php echo $Nombre ?></h5>
                                                            <p class="text-muted font-size-13">Cargo: Full Stack Developer</p>
                                                            <div class="d-flex flex-column align-items-center gap-2 text-muted font-size-13">
                                                                <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>ID Empleado: <?php echo $empleadoID ?></div>
                                                                <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Correo: <?php echo $correo ?></div>
                                                                <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Género: <?php echo $gender ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <!-- end card body -->
                                </div>
                        
                        <div class="row">

<style>


 .select-wrapper {
        display: flex;
        justify-content: left;
        margin-bottom: 10px;
    }

    /* Estilos para el select */
    .select-wrapper select {
        width: 120px; /* Ancho del botón más pequeño */
        padding: 8px;
        font-size: 14px;
        border: 2px solid #000; /* Borde negro */
        border-radius: 5px;
        background-color: transparent; /* Fondo transparente */
        color: #000; /* Texto negro */
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .select-wrapper select:focus {
        border-color: #1abc9c;
        outline: none;
    }

    /* Estilos para el botón de asistencia */
    .btn-assistance {
        display: inline-block;
        width: 120px;
        padding: 10px;
        font-size: 16px;
        text-align: center;
        color: #fff; /* Texto blanco */
        background-color: #1abc9c; /* Fondo verde */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

.btn-assistance:hover {
        background-color: #16a085;
        transform: scale(1.05);
    }

     /* Estilos para el botón de descarga */
     .btn-assistance1 {
        display: inline-block;
        width: 120px;
        padding: 10px;
        font-size: 16px;
        text-align: center;
        color: #fff; /* Texto blanco */
        background-color: #1abc9c; /* Fondo verde */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

            /* Estilo para los botones deshabilitados */
        .btn-assistance1:disabled {
            background-color: grey; /* Fondo gris */
            pointer-events: none; /* Anula el hover */
        }
        


        .btn-assistance1:hover {
                background-color: #16a085;
                transform: scale(1.05);
            }

      .btn-assistance2 {
        display: inline-block;
        width: 120px;
        padding: 10px;
        font-size: 16px;
        text-align: center;
        color: #fff; /* Texto blanco */
        background-color: #1abc9c; /* Fondo verde */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

            /* Estilo para los botones deshabilitados */
        .btn-assistance2:disabled {
            background-color: grey; /* Fondo gris */
            pointer-events: none; /* Anula el hover */
        }
        


        .btn-assistance2:hover {
                background-color: #16a085;
                transform: scale(1.05);
            }

    /* Estilos adicionales para centrar todo el contenido */
    .card.text-center .card-header, 
    .card.text-center .card-body, 
    .card.text-center .clock {
        text-align: center;
        justify-content: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card-title {
        flex-grow: 0;
        margin: 0 auto;
    }

    .clock {
        font-size: 18px;
        color: #333;
    }
    .custom-buttons {
            display: flex;
            justify-content: center;
            gap: 10px; /* Separación entre botones */
            flex-wrap: wrap; /* Permite que los botones se envuelvan en líneas */
        }

        .custom-buttons .btn {
            position: relative;
            width: 50px; /* Ancho del botón */
            height: 150px; /* Alto del botón */
            background-color: #3498db; /* Color de fondo */
            border: none;
            color: white;
            font-size: 25px;
            cursor: pointer;
            overflow: hidden;
            text-align: center;
            line-height: 58px; /* Alineación vertical del texto */
            clip-path: polygon(50% 100%, 100% 75%, 100% 25%, 50% 0%, 0% 25%, 0% 75%);
            transition: all 0.3s ease;
        }

        .custom-buttons .btn:hover {
            transform: scale(1.1);
        }

        .custom-buttons .btn-primary {
            background-color: #1abc9c; /* Color de fondo para el botón Iniciar */
        }

        .custom-buttons .btn-warning {
            background-color: #FFA726; /* Color de fondo para el botón Pausar */
        }

        .custom-buttons .btn-secondary {
            background-color: #FF8BA7; /* Color de fondo para el botón almuerzo */
        }


        .custom-buttons .btn-info {
            background-color: #A474A4; /* Color de fondo para el botón Continuar */
        }

        .custom-buttons .btn-danger {
            background-color: #e74c3c; /* Color de fondo para el botón Finalizar */
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .custom-buttons .btn {
                width: 80px; /* Ancho del botón en pantallas pequeñas */
                height: 70px; /* Alto del botón en pantallas pequeñas */
                line-height: 46px; /* Alineación vertical del texto en pantallas pequeñas */
                font-size: 14px; /* Tamaño de fuente más pequeño */
            }
        }

        @media (max-width: 480px) {
            .custom-buttons .btn {
                width: 60px; /* Ancho del botón en pantallas muy pequeñas */
                height: 50px; /* Alto del botón en pantallas muy pequeñas */
                line-height: 34px; /* Alineación vertical del texto en pantallas muy pequeñas */
                font-size: 12px; /* Tamaño de fuente más pequeño */
            }
        }

       
</style>



  

                        <!-- CARTA 1 -->
                    <div class="col-xl-4">
                        <div class="card text-left">
                            <div class="card-header align-items-center d-flex justify-content-center">
                                <h3 class="card-title mb-0">Registrar asistencia</h3>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <h6>Hora local:</h6>
                                <div class="clock" id="reloj">Loading...</div>
                                <br>
                                <hr>
                                <h6 style="color: red; ">Meta a cumplir</h6>
                                <div class="clock" style="color: red; ">8:00:00 Horas</div>
                                <br>
                                <hr>

                                <h6>Marca tu asistencia</h6>

                                <div class="select-wrapper">
                                    <select id="tipoAccion">
                                        <option value="Entrada">Entrada</option>
                                        <option value="Salida">Salida</option>
                                    </select>
                                </div>
                               
                                <button class="btn-assistance" onclick="logAsistencia()" id="btn_asistenciaLog" >Asistencia</button>
                                
                            
                            <hr>

                            <h6>Justificacion asistencia</h6>

                            <div class="form-group">
                                <textarea class="form-control" id="justificacion_txt" rows="3" placeholder="Escribe tu justificación aquí" disabled require></textarea>
                            </div>
                            <br>

                            <button class="btn-assistance2" id="btn_justificacion" disabled onclick="enviarJustificacion()">Enviar</button>

                          </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>

                            <!-- end col -->


                            <!-- CARTA 2 -->
                            <div class="col-xl-4">
                            <div class="card text-left">
                            <div class="card text-center">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Indicadores a cumplir de Hoy</h4>
                                        <div class="flex-shrink-0">
                                            </div>
                                        
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                    <h6>Horas a trabajar</h6>
                                    <div class="clock" id="temporizador_trabajo">6:40:00 </div>
                                    <br>
                                    <hr>
                                    <h6>Receso maximo </h6>
                                    <div class="clock" id="temporizador_receso">20:00</div>
                                    <br>
                                    <hr>
                                    <h6>Tiempo almuerzo </h6>
                                    <div class="clock" id="temporizador_almuerzo">60:00</div>
                                    <br>
                                    <hr>
                                    <h6>Pausas diarias</h6>
                                    <div class="clock" id="pausas">0</div>
                                    <br>
                                    <hr>
                                    <h6 style="color: red; text-align: center;">Total Horas</h6>
                                    <div class="clock" style="color: red; text-align: center;">8:00:00 Horas</div>
                                    
                                    
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            
                            </div>

                            <!-- CARTA 3 -->
                            <div class="col-xl-4">
                            <div class="card text-left">
                            <div class="card text-center">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Reporte del dia</h4>
                                        <div class="flex-shrink-0">
                                        
                                        </div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                <h6>Asistencia:</h6>
                                <div class="log" id="asistenciaLog"></div>
                                <br>
                                <hr>
                                <h6>Horario laboral:</h6>
                                <div class="log" id="timerLog"></div>
                                <br>
                                <hr>
                                <h6>Tiempo de receso:</h6>
                                <div class="log" id="recesoLog"></div>
                                <br>
                                <hr>
                                <h6>Tiempo de almuerzo:</h6>
                                <div class="log" id="almuerzoLog"></div>
                                <br>
                                <hr>
                                <h6>Pausas diarias:</h6>
                                <div class="log" id="pausasLog"></div>
                                <hr>
                               
                              
                                <h6 style="text-align: center;" >Generar reporte de Hoy </h6>
                                 <br>
                                <div style="display: flex; justify-content: center; align-items: center; height: 50px;">
                                
                                <form method="post" action="generarPDF.php">
                                <input type="hidden" name="descargarPDF" value="1">
                                <button class="btn-assistance1" id="btn_descargar" disabled>Generar</button>
                            </form>


                                </div>
                            </div>



                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            
                            </div>
                           
                        </div><!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>


                 <!-- NUEVOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->



                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-9 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <!-- Botones con funciones -->
                                    <div class="btn-group custom-buttons">
                                    <input type="submit" class="btn btn-primary" id="tiempoInicio" value="Iniciar" disabled>
                                    <input type="submit" class="btn btn-secondary" id="tiempoAlmuerzo" value="Almuerzo" disabled >
                                    <input type="submit" class="btn btn-warning" id="tiempoPausas" value="Pausar" disabled >
                                    <input type="submit" class="btn btn-info" id="tiempoResumen" value="Continuar" disabled>
                                    <input type="submit" class="btn btn-danger" id="tiempoFinalizacion" value="Finalizar" disabled>
                        
                                 </div>

                                </div>
                                <!-- end card body -->
                            </div>
                        </div>
                    </div><!-- end row -->
                </div><!-- end container -->

                </div>
                <!-- container-fluid -->
                </div>



                                <!-- End Page-content -->


                <!-- Logica reloj -->
                    
                <script src="js/script.js"></script>






            </body>








                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Minia.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar="" class="h-100">
                <div class="rightbar-title d-flex align-items-center bg-dark p-3">

                    <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="m-0">

                <div class="p-4">
                    <h6 class="mb-3">Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout" id="layout-vertical" value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout" id="layout-horizontal" value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-light" value="light">
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-dark" value="dark">
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width" id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width" id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position" id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position" id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-ltr" value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-rtl" value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>

                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/metisMenu.min.js"></script>
        <script src="../../assets/js/simplebar.min.js"></script>
        <script src="../../assets/js/waves.min.js"></script>
        <script src="../../assets/js/feather.min.js"></script>
        <!-- pace js -->
        <script src="../../assets/js/pace.min.js"></script>

        <!-- apexcharts -->
        <script src="../../assets/js/apexcharts.min.js"></script>

        <!-- Plugins js-->
        <script src="../../assets/js/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="../../assets/js/jquery-jvectormap-world-mill-en.js"></script>
        <!-- dashboard init -->
        <script src="../../assets/js/dashboard.init.js"></script>

        <script src="../../assets/js/app.js"></script>

    </body>

</html>