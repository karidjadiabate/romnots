<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3c4b920158.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js'></script>
    <link rel="stylesheet" href="{{asset('frontend/dashboard/css/dash.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/dashboard/html/admin.css')}}">
    <title>admin</title>
</head>
<style>

</style>

<body>
    <!-- header -->


@include('admin.include.menu')


    <!-- accueil -->
    <!-- titre -->
    <div class="container text-center mt-4">
    @if(auth()->user()->role_id==2 || auth()->user()->role_id==3)

        <h1>Bienvenue <i>{{auth()->user()->etablissement->nometablissement}}</i></h1>
        @endif
    </div>
    <!-- banniere -->
    <div class="banner">
        <div class="banner-title">Banniere d'information</div>
    </div>
    <!-- la suite -->
    <div class="container text-center mt-4">
        <!-- les  cartes-->

        @if (auth()->user()->role_id === 3)
        <div class="row text-start">
            <div class="col-md-3 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <svg class="icon small-icon" xmlns="http://www.w3.org/2000/svg" width="43.75" height="35"
                            viewBox="0 0 43.75 35">
                            <path id="users-solid"
                                d="M9.844,0A5.469,5.469,0,1,1,4.375,5.469,5.469,5.469,0,0,1,9.844,0ZM35,0a5.469,5.469,0,1,1-5.469,5.469A5.469,5.469,0,0,1,35,0ZM0,20.419a7.3,7.3,0,0,1,7.294-7.294h2.919a7.333,7.333,0,0,1,3.049.663,8.6,8.6,0,0,0-.13,1.524,8.753,8.753,0,0,0,2.96,6.562H1.456A1.462,1.462,0,0,1,0,20.419Zm27.706,1.456h-.048a8.729,8.729,0,0,0,2.96-6.562,9.362,9.362,0,0,0-.13-1.524,7.227,7.227,0,0,1,3.049-.663h2.919a7.3,7.3,0,0,1,7.294,7.294,1.457,1.457,0,0,1-1.456,1.456ZM15.313,15.313a6.562,6.562,0,1,1,6.562,6.562A6.562,6.562,0,0,1,15.313,15.313ZM8.75,33.175a9.114,9.114,0,0,1,9.112-9.112h8.025A9.114,9.114,0,0,1,35,33.175,1.825,1.825,0,0,1,33.175,35h-22.6A1.825,1.825,0,0,1,8.75,33.175Z"
                                fill="#fff" />
                        </svg>
                        <h5 class="card-title">Effectif des Etudiants</h5>
                        <p class="card-text">{{$nbetudiant}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <svg class="icon small-icon" xmlns="http://www.w3.org/2000/svg" width="30.448" height="34.798"
                            viewBox="0 0 30.448 34.798">
                            <path id="user-tie-solid"
                                d="M6.525,8.7a8.7,8.7,0,1,0,8.7-8.7A8.7,8.7,0,0,0,6.525,8.7Zm6.423,13.607,1.264,2.107-2.263,8.421L9.5,22.85a1.006,1.006,0,0,0-1.217-.768A10.961,10.961,0,0,0,0,32.711,2.087,2.087,0,0,0,2.087,34.8H28.362a2.087,2.087,0,0,0,2.087-2.087,10.961,10.961,0,0,0-8.285-10.63,1.016,1.016,0,0,0-1.217.768L18.5,32.834l-2.263-8.421L17.5,22.306a1.086,1.086,0,0,0-.931-1.645H13.885a1.087,1.087,0,0,0-.931,1.645Z"
                                fill="#fff" />
                        </svg>
                        <h5 class="card-title">Effectif des Enseignants</h5>
                        <p class="card-text">{{$nbprofesseur}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <svg class="icon small-icon" xmlns="http://www.w3.org/2000/svg" width="31.318" height="34.798"
                            viewBox="0 0 31.318 34.798">
                            <path id="Tracé_381" data-name="Tracé 381"
                                d="M34.318,5.48H9.96a3.48,3.48,0,0,0,0,6.96H34.318V35.058a1.74,1.74,0,0,1-1.74,1.74H9.96A6.96,6.96,0,0,1,3,29.838V8.96A6.96,6.96,0,0,1,9.96,2H32.578a1.74,1.74,0,0,1,1.74,1.74Zm-1.74,5.22H9.96a1.74,1.74,0,0,1,0-3.48H32.578Z"
                                transform="translate(-3 -2)" fill="#fff" />
                        </svg>
                        <h5 class="card-title">Nombre total de filieres</h5>
                        <p class="card-text">{{$nbfiliere}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <svg class="icon small-icon" xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                            viewBox="0 0 35 35">
                            <path id="Soustraction_4" data-name="Soustraction 4"
                                d="M27.223,35H7.777A7.786,7.786,0,0,1,0,27.223V7.777A7.786,7.786,0,0,1,7.777,0H27.223A7.786,7.786,0,0,1,35,7.777V27.223A7.786,7.786,0,0,1,27.223,35Zm-3.89-13.608a1.944,1.944,0,1,0,1.944,1.944A1.946,1.946,0,0,0,23.333,21.392Zm-11.665,0a1.944,1.944,0,1,0,1.944,1.944A1.946,1.946,0,0,0,11.667,21.392Zm11.665-5.833A1.944,1.944,0,1,0,25.277,17.5,1.946,1.946,0,0,0,23.333,15.559Zm-11.665,0A1.944,1.944,0,1,0,13.611,17.5,1.946,1.946,0,0,0,11.667,15.559ZM23.333,9.725a1.945,1.945,0,1,0,1.944,1.946A1.947,1.947,0,0,0,23.333,9.725Zm-11.665,0a1.945,1.945,0,1,0,1.944,1.946A1.947,1.947,0,0,0,11.667,9.725Z"
                                fill="#fff" />
                        </svg>

                        <h5 class="card-title">Nombre total de sujets générés</h5>
                        <p class="card-text">250</p>
                    </div>
                </div>
            </div>
        </div>
        @elseif (auth()->user()->role_id === 4)


        <div class="row text-start">
            <div class="col-md-3 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <svg class="icon small-icon" xmlns="http://www.w3.org/2000/svg" width="43.75" height="35"
                            viewBox="0 0 43.75 35">
                            <path id="users-solid"
                                d="M9.844,0A5.469,5.469,0,1,1,4.375,5.469,5.469,5.469,0,0,1,9.844,0ZM35,0a5.469,5.469,0,1,1-5.469,5.469A5.469,5.469,0,0,1,35,0ZM0,20.419a7.3,7.3,0,0,1,7.294-7.294h2.919a7.333,7.333,0,0,1,3.049.663,8.6,8.6,0,0,0-.13,1.524,8.753,8.753,0,0,0,2.96,6.562H1.456A1.462,1.462,0,0,1,0,20.419Zm27.706,1.456h-.048a8.729,8.729,0,0,0,2.96-6.562,9.362,9.362,0,0,0-.13-1.524,7.227,7.227,0,0,1,3.049-.663h2.919a7.3,7.3,0,0,1,7.294,7.294,1.457,1.457,0,0,1-1.456,1.456ZM15.313,15.313a6.562,6.562,0,1,1,6.562,6.562A6.562,6.562,0,0,1,15.313,15.313ZM8.75,33.175a9.114,9.114,0,0,1,9.112-9.112h8.025A9.114,9.114,0,0,1,35,33.175,1.825,1.825,0,0,1,33.175,35h-22.6A1.825,1.825,0,0,1,8.75,33.175Z"
                                fill="#fff" />
                        </svg>
                        <h5 class="card-title">Nombre d'etablissements acceptés</h5>
                        <p class="card-text">{{$nbetablissementaccepte}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <svg class="icon small-icon" xmlns="http://www.w3.org/2000/svg" width="30.448" height="34.798"
                            viewBox="0 0 30.448 34.798">
                            <path id="user-tie-solid"
                                d="M6.525,8.7a8.7,8.7,0,1,0,8.7-8.7A8.7,8.7,0,0,0,6.525,8.7Zm6.423,13.607,1.264,2.107-2.263,8.421L9.5,22.85a1.006,1.006,0,0,0-1.217-.768A10.961,10.961,0,0,0,0,32.711,2.087,2.087,0,0,0,2.087,34.8H28.362a2.087,2.087,0,0,0,2.087-2.087,10.961,10.961,0,0,0-8.285-10.63,1.016,1.016,0,0,0-1.217.768L18.5,32.834l-2.263-8.421L17.5,22.306a1.086,1.086,0,0,0-.931-1.645H13.885a1.087,1.087,0,0,0-.931,1.645Z"
                                fill="#fff" />
                        </svg>
                        <h5 class="card-title">Nombre d'etablissements refusés</h5>
                        <p class="card-text">{{$nbetablissementrefuse}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <svg class="icon small-icon" xmlns="http://www.w3.org/2000/svg" width="31.318" height="34.798"
                            viewBox="0 0 31.318 34.798">
                            <path id="Tracé_381" data-name="Tracé 381"
                                d="M34.318,5.48H9.96a3.48,3.48,0,0,0,0,6.96H34.318V35.058a1.74,1.74,0,0,1-1.74,1.74H9.96A6.96,6.96,0,0,1,3,29.838V8.96A6.96,6.96,0,0,1,9.96,2H32.578a1.74,1.74,0,0,1,1.74,1.74Zm-1.74,5.22H9.96a1.74,1.74,0,0,1,0-3.48H32.578Z"
                                transform="translate(-3 -2)" fill="#fff" />
                        </svg>
                        <h5 class="card-title">Nombre d'administrateurs</h5>
                        <p class="card-text">{{$nbadmin}}</p>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <svg class="icon small-icon" xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                            viewBox="0 0 35 35">
                            <path id="Soustraction_4" data-name="Soustraction 4"
                                d="M27.223,35H7.777A7.786,7.786,0,0,1,0,27.223V7.777A7.786,7.786,0,0,1,7.777,0H27.223A7.786,7.786,0,0,1,35,7.777V27.223A7.786,7.786,0,0,1,27.223,35Zm-3.89-13.608a1.944,1.944,0,1,0,1.944,1.944A1.946,1.946,0,0,0,23.333,21.392Zm-11.665,0a1.944,1.944,0,1,0,1.944,1.944A1.946,1.946,0,0,0,11.667,21.392Zm11.665-5.833A1.944,1.944,0,1,0,25.277,17.5,1.946,1.946,0,0,0,23.333,15.559Zm-11.665,0A1.944,1.944,0,1,0,13.611,17.5,1.946,1.946,0,0,0,11.667,15.559ZM23.333,9.725a1.945,1.945,0,1,0,1.944,1.946A1.947,1.947,0,0,0,23.333,9.725Zm-11.665,0a1.945,1.945,0,1,0,1.944,1.946A1.947,1.947,0,0,0,11.667,9.725Z"
                                fill="#fff" />
                        </svg>

                        <h5 class="card-title">Nombre total de sujets générés</h5>
                        <p class="card-text">250</p>
                    </div>
                </div>
            </div> --}}
        </div>
        @endif

        <!--  -->

        @if (auth()->user()->role_id === 3)
        <div class="container mt-5 ">
            <div class="row ">
                <!-- Première section -->
                <div class="col-md-6 mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-4 perfo">
                        <h4 class="mb-0 text-start">Performance de la classe</h4>
                        <div class="d-flex">
                            <select class="form-select w-auto me-2 custom-select">
                                <option selected>Filière...</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                            </select>
                            <select class="form-select w-auto custom-select">
                                <option selected>Classe...</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-placeholder mb-4">
                        <canvas id="myChart"></canvas>
                    </div>
                    <!-- Ajoutez la section des Sujets récents ici -->
                    <div class="col-12 tablest">
                        <h4 class="card-sujets text-start">Sujets récents</h4>
                        <table class="tables text-start  ">
                            <tbody>
                                <tr>
                                    <td>Économie</td>
                                    <td>04-07-2024</td>
                                    <td>Devoir</td>
                                    <td>Marketing</td>
                                    <td>MA1A-RHCOMA1-CF2A</td>
                                    <td><span class="badge bg-success">Corrigé</span></td>
                                </tr>
                                <tr>
                                    <td>Économie</td>
                                    <td>04-07-2024</td>
                                    <td>Devoir</td>
                                    <td>Rhcom</td>
                                    <td>MA1A-RGLIC</td>
                                    <td><span class="badge bg-warning">Non corrigé</span></td>
                                </tr>
                                <tr>
                                    <td>Comptabilité</td>
                                    <td>04-07-2024</td>
                                    <td>Examen</td>
                                    <td>Finance</td>
                                    <td>MA1A-RH-CF2COMA1A</td>
                                    <td><span class="badge bg-warning">Non corrigé</span></td>
                                </tr>
                                <tr>
                                    <td>Mathématiques</td>
                                    <td>04-07-2024</td>
                                    <td>Devoir</td>
                                    <td>Génie civil</td>
                                    <td>MA1A-RGLIC</td>
                                    <td><span class="badge bg-success">Corrigé</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- calendrier -->
                <div class="col-md-6">
                    <div class="d-flex flex-column mb-4 perfo">
                        <h4 class="mb-3 text-start">Performance des enseignants</h4>
                        <div class="event-list mb-4">
                            <div class="event-card">
                                <p><i class="fa-regular fa-clock"></i>08h - 12h</p>
                                <p>16-07-2024</p>
                                <p>Économie MA2A</p>
                            </div>
                            <div class="event-card">
                                <p><i class="fa-regular fa-clock"></i>08h - 12h</p>
                                <p>24-07-2024</p>
                                <p>Comptabilité CFIC</p>
                            </div>
                        </div>
                        <div id="calendar" class="mb-4">
                            <div class="calendar-header">
                                <button id="prevMonth">&lt;</button>
                                <div class="month-year"></div>
                                <button id="nextMonth">&gt;</button>
                            </div>
                            <div class="calendar-grid">
                                <div class="day-name">Lu</div>
                                <div class="day-name">Ma</div>
                                <div class="day-name">Me</div>
                                <div class="day-name">Je</div>
                                <div class="day-name">Ve</div>
                                <div class="day-name">Sa</div>
                                <div class="day-name">Di</div>
                                <!-- Days will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endif





    </div>
    </div>


    <script src="{{asset('frontend/dashboard/html/graph.js')}}"></script>
    <script src="{{asset('frontend/dashboard/js/calendrier.js')}}"></script>
    <script src="{{asset('frontend/dahboard/js/calen.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
