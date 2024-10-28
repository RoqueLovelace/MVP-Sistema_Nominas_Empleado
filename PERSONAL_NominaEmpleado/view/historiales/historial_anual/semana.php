<?php
session_start();
include 'timezone.php';

if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $correo = $_SESSION["usu_correo"];
    $Nombre = $_SESSION["firstname"];
    $Employeid = $_SESSION["employee_id"];
} else {
    $correo = "Correo no disponible";
    $Nombre = "Nombre no disponible";
}

$currentTime = get_current_time(); // Call the function

// Definir la función para realizar las solicitudes a la API
function getApiData($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

$year = isset($_GET['year']) ? $_GET['year'] : 2024;
$month = isset($_GET['month']) ? $_GET['month'] : 1;
$employee_id = 26; //ID de ejemplo

$url_work_hours = "http://127.0.0.1:8000/api/assistence/work-hours/$year/$employee_id";
$url_weekly_hours = "http://127.0.0.1:8000/api/assistence/weekly-hours/$id/$year/$month";

$data_work_hours = getApiData($url_work_hours);
$data_weekly_hours = getApiData($url_weekly_hours);

// Función para convertir tiempo a formato decimal
function timeToDecimal($time) {
    if (is_numeric($time)) {
        return $time;
    } else {
        list($hours, $minutes) = explode(':', $time);
        return $hours + ($minutes / 60);
    }
}

// Función para formatear tiempo decimal a formato 'HH:MM'
function formatDecimalToTime($decimal) {
    $hours = floor($decimal);
    $minutes = round(($decimal - $hours) * 60);
    return sprintf("%02d:%02d", $hours, $minutes);
}

// Sumar las horas para el mes seleccionado
$total_hours_for_month = 0;
if (isset($data_work_hours['work_hours']) && is_array($data_work_hours['work_hours'])) {
    foreach ($data_work_hours['work_hours'] as $work_hour) {
        if (isset($work_hour['mes']) && $work_hour['mes'] == $month) {
            $total_hours_for_month += timeToDecimal($work_hour['total_horas']);
        }
    }
}

$total_hours_formatted = formatDecimalToTime($total_hours_for_month);

$months = [
    1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
    5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
    9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
];

$month_name = $months[$month] ?? 'Mes no disponible';
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
    <link href="../../../assets/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">

    <!-- preloader css -->
    <link rel="stylesheet" href="../../../assets/css/preloader.min.css" type="text/css">

    <!-- Bootstrap Css -->
    <link href="../../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="../../../assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="../../../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">
</head>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="../../home/" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="../../../assets/picture/logo-sm.svg" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="../../../assets/picture/logo-sm.svg" alt="" height="24"> <span
                                    class="logo-txt">Nómina</span>
                            </span>
                        </a>

                        <a href="../../home/" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="../../../assets/picture/logo-sm.svg" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="../../../assets/picture/logo-sm.svg" alt="" height="24"> <span
                                    class="logo-txt">Nómina</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="search" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Search Result">

                                        <button class="btn btn-primary" type="submit"><i
                                                class="mdi mdi-magnify"></i></button>
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
                        <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i data-feather="grid" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <div class="p-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../../../assets/picture/github.png" alt="Github">
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../../../assets/picture/bitbucket.png" alt="bitbucket">
                                            <span>Bitbucket</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../../../assets/picture/dribbble.png" alt="dribbble">
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../../../assets/picture/dropbox.png" alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../../../assets/picture/mail_chimp.png" alt="mail_chimp">
                                            <span>Mail Chimp</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../../../assets/picture/slack.png" alt="slack">
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-soft-light border-start border-end"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="../../../assets/picture/avatar-1.jpg"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">
                                <?php echo $Nombre ?>
                            </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="../../profile/index.php"><i
                                    class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Mi perfil</a>
                            <a class="dropdown-item" href="auth-lock-screen.html"><i
                                    class="mdi mdi-lock font-size-16 align-middle me-1"></i> Restablecer contraseña</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../../../index.php"><i
                                    class="mdi mdi-logout font-size-16 align-middle me-1"></i>Cerrar Sesión</a>
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
                            <a href="../../home/">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="">
                                <i data-feather="user"></i>
                                <span data-key="t-icons">Usuarios</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="../usuario/" data-key="t-boxicons">Usuarios y Contratos</a></li>
                            </ul>
                        </li>
                        <li>
                        <li>
                            <a href="javascript: void(0);" class="">
                                <i data-feather="cpu"></i>
                                <span data-key="t-icons">Historiales de Empleado</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="../horas_trabajadas/" data-key="t-boxicons">Horas Trabajadas</a></li>
                                <li><a href="../horas_extras/" data-key="t-material-design">Horas Extras</a></li>
                                <li><a href="../tiempo_de_descanso/" data-key="t-dripicons">Tiempo de Descanso</a></li>
                                <li><a href="../horas_por_cumplir/" data-key="t-dripicons">Horas por Cumplir</a></li>
                                <li><a href="../deducciones/" data-key="t-font-awesome">Deducciones</a></li>
                                <li><a href="../historial_anual/" data-key="t-boxicons">Historal Anual</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                        <div class="card-body">
                            <img src="../../../assets/picture/giftbox.png" alt="">
                            <div class="mt-4">
                                <h5 class="alertcard-title font-size-16">Actualizar mi plan</h5>
                                <p class="font-size-13">Actualice su plan desde una prueba gratuita para seleccionar
                                    "Plan de negocios".</p>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Historial de Horas Totales</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Historiales</a></li>
                                        <li class="breadcrumb-item active">Horas Semanales</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- container-fluid -->
                    <div class="row">
                        <div class="col-12">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-12">
                                    <!--Tarjeta-->
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-md-10">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xl me-3">
                                                                <img src="../../../assets/picture/avatar-2.jpg" alt=""
                                                                    class="img-fluid rounded-circle d-block">
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div>
                                                                <h5 class="font-size-16 mb-1">
                                                                    <?php echo $Nombre ?>
                                                                </h5>
                                                                <p class="text-muted font-size-13">Cargo: Full Stack
                                                                    Developer</p>

                                                                <div
                                                                    class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                                    <div>
                                                                        <i
                                                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>
                                                                        ID Empleado:
                                                                        <?php echo $Employeid ?>
                                                                    </div>
                                                                    <div>
                                                                        <i
                                                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>
                                                                        <?php echo $correo ?>
                                                                    </div>
                                                                </div>
                                                                <!-- Mostrar el total de horas del mes seleccionado -->
                                                                <div class="mt-3">
                                                                    <h5>Total de horas de
                                                                        <?php echo "$month_name: $total_hours_formatted"; ?>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- card-body -->
                                            </div> <!-- card -->
                                        </div> <!-- col-md-10 -->
                                    </div> <!-- row -->
                                </div> <!-- col-md-12 -->
                            </div> <!-- row -->
                        </div> <!-- col-12 -->
                    </div>
                    <!--Contenido semana-->
                    <style>
                        thead {
                            background-color: #FAFAFA;
                        }

                        tbody tr:nth-child(odd) {
                            background-color: white;
                        }

                        tbody tr:nth-child(even) {
                            background-color: #FAFAFA;
                        }
                    </style>
                    <div class="container mt-4">
                        <div class="card shadow-lg" style="border-radius: 20px;">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <?php if ($data_weekly_hours && isset($data_weekly_hours['semanas']) && is_array($data_weekly_hours['semanas'])): ?>
                                    <table class="table table-bordered text-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>Semana</th>
                                                <th>Lunes</th>
                                                <th>Martes</th>
                                                <th>Miércoles</th>
                                                <th>Jueves</th>
                                                <th>Viernes</th>
                                                <th>Sábado</th>
                                                <th>Domingo</th>
                                                <th>Total Semana</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_weekly_hours['semanas'] as $weekly_hour): 
                                                        $week = $weekly_hour['semana_del_mes'];
                                                        $url_daily_details = "http://127.0.0.1:8000/api/assistence/daily-details/$id/$year/$month/$week";
                                                        $data_daily_details = getApiData($url_daily_details);

                                                        $work_by_day = [
                                                            'Lunes' => '-',
                                                            'Martes' => '-',
                                                            'Miércoles' => '-',
                                                            'Jueves' => '-',
                                                            'Viernes' => '-',
                                                            'Sábado' => '-',
                                                            'Domingo' => '-'
                                                        ];
                                                        $total_hours_decimal = 0;

                                                        if (isset($data_daily_details['details']) && is_array($data_daily_details['details'])) {
                                                            foreach ($data_daily_details['details'] as $detalle) {
                                                                $date = $detalle['date'];
                                                                $day_of_week = date('N', strtotime($date));
                                                                $day_of_week_map = [
                                                                    1 => 'Lunes',
                                                                    2 => 'Martes',
                                                                    3 => 'Miércoles',
                                                                    4 => 'Jueves',
                                                                    5 => 'Viernes',
                                                                    6 => 'Sábado',
                                                                    7 => 'Domingo'
                                                                ];
                                                                $day_name = $day_of_week_map[$day_of_week] ?? null;

                                                                if ($day_name) {
                                                                    $work_by_day[$day_name] = $detalle['work_completed'];
                                                                    $total_hours_decimal += timeToDecimal($detalle['work_completed']);
                                                                }
                                                            }
                                                        }
                                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo "Semana " . $week; ?>
                                                </td>
                                                <?php foreach ($day_of_week_map as $day_number => $day_name): ?>
                                                <td>
                                                    <?php if ($work_by_day[$day_name] !== '-'): ?>
                                                    <a href="info.php?date=<?php echo urlencode(date('Y-m-d', strtotime("
                                                        $year-$month-01 +".(($week - 1) * 7 + $day_number - 1)."
                                                        days"))); ?>" class="text-dark text-decoration-none">
                                                        <?php echo $work_by_day[$day_name]; ?>
                                                    </a>
                                                    <?php else: ?>
                                                    <?php echo '-'; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <?php endforeach; ?>
                                                <td class="fw-bold">
                                                    <?php echo formatDecimalToTime($total_hours_decimal); ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php else: ?>
                                    <p>No hay datos disponibles.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- end mi contenido -->
    </div>
    <!-- End Page-content -->
    </div>
    </div>
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
                    <input class="form-check-input" type="radio" name="layout" id="layout-horizontal"
                        value="horizontal">
                    <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-light"
                        value="light">
                    <label class="form-check-label" for="layout-mode-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-dark" value="dark">
                    <label class="form-check-label" for="layout-mode-dark">Dark</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-width" id="layout-width-fuild"
                        value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                    <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-width" id="layout-width-boxed"
                        value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                    <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-position" id="layout-position-fixed"
                        value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                    <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-position" id="layout-position-scrollable"
                        value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                    <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-light"
                        value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                    <label class="form-check-label" for="topbar-color-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-dark" value="dark"
                        onchange="document.body.setAttribute('data-topbar', 'dark')">
                    <label class="form-check-label" for="topbar-color-dark">Dark</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-default"
                        value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                    <label class="form-check-label" for="sidebar-size-default">Default</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-compact"
                        value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                    <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-small"
                        value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                    <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-light"
                        value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                    <label class="form-check-label" for="sidebar-color-light">Light</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-dark"
                        value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                    <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-brand"
                        value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                    <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-ltr"
                        value="ltr">
                    <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-rtl"
                        value="rtl">
                    <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                </div>

            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="../../../assets/js/jquery.min.js"></script>
    <script src="../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/metisMenu.min.js"></script>
    <script src="../../../assets/js/simplebar.min.js"></script>
    <script src="../../../assets/js/waves.min.js"></script>
    <script src="../../../assets/js/feather.min.js"></script>
    <!-- pace js -->
    <script src="../../../assets/js/pace.min.js"></script>

    <!-- apexcharts -->
    <script src="../../../assets/js/apexcharts.min.js"></script>

    <!-- Plugins js-->
    <script src="../../../assets/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../../../assets/js/jquery-jvectormap-world-mill-en.js"></script>
    <!-- dashboard init -->
    <script src="../../../assets/js/dashboard.init.js"></script>

    <script src="../../../assets/js/app.js"></script>

    <?php include '../../../assets/scripts.php'; ?>

</body>

</html>