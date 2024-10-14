<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons (if needed) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="{{ asset('frontend/dashboard/js/list.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/html/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/lists.css') }}">
    <title>Sujets</title>
</head>
<style>
    .modal-content {
        max-width: 70%;
        margin: auto;
        padding: 20px;
        background-color: aqua;
    }

    .modal-dialog {
        max-height: 90vh;

        display: flex;
        align-items: center;
    }


    .modal-content {
        width: 100%;
        margin: 0;
        padding: 0;
        max-width: 100%;
        margin-top: 30px;
        margin-left: 10%;
        background-color: white;
    }

    /* Style de l'en-tête de la modal */

    .modal-title {
        font-size: 24px;
        font-weight: bold;
        color: #3F2CA3;
        margin-top: 2%;

    }

    /* Bouton de fermeture personnalisé */
    /* .custom-close-btn {
        background-color: transparent;
        border: none;
        font-size: 30px;
        color: #3F2CA3;
        cursor: pointer;
        display: flex;
        align-items: center;
    } */

    /* Corps de la modal */
    /* .modal-body {
        padding: 20px;
    } */

    .add-printer-scanner {
        margin-bottom: 20px;
    }

    .add-button {
        background-color: #F1F1FF;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        color: #3F2CA3;
        border-radius: 0%;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    h3 {
        color: #3F2CA3;
        font-size: 18px;
    }

    .fa-plus {
        margin-right: 8px;
        font-size: 18px;
    }

    /* Style de la liste des appareils */
    .devices-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .devices-list li {
        display: flex;
        align-items: center;
        padding: 8px 0;
        color: #3F2CA3;
    }

    .device-icon,
    .add-button i {
        background-color: #3F2CA3;
        color: white;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 10px;
        border-radius: 5px;
    }



    .device-icon svg {
        width: 24px;
        height: 24px;
        fill: white;
    }
</style>

<body>
    <!-- header -->
    @include('admin.include.menu')
    <!-- accueil -->
    <div class="container principal">
        <div class="printableArea ">
            <h2 class="text-start text-title">Liste des sujets</h2>
            <div
                class="d-flex justify-content-between align-items-center flex-wrap action-buttons  px-4  mb-3 no-print">
                <div class="d-flex search-container">
                    <i class="fa fa-search"></i>
                    <input id="searchInput" type="text" id="search" class="form-control search-bar"
                        placeholder="Rechercher...">
                </div>

                <div class="d-flex justify-content-end flex-wrap ">
                    <button class="btn btn-custom btn-imprimer" id="printBtn" onclick="printDiv()"><i
                            class="fa fa-print"></i> Imprimer</button>
                    <button class="btn btn-custom btn-importer" data-bs-toggle="modal" data-bs-target="#importModal"><i
                            class="fa fa-upload"></i> Importer</button>

                    <!-- Dropdown for Export options -->
                    <div class="btn-group">
                        <button class="btn btn-custom btn-exporter dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-download"></i> Exporter
                        </button>
                        <ul class="dropdown-menu" id="menu">
                            <!-- Assurez-vous que ces liens ont bien l'attribut href="#" et que onclick est correct -->
                            <li><a class="dropdown-item" id="excel" href="#"
                                    onclick="exportTableToExcel('#inscriptionTable')">Excel</a></li>
                            <li><a class="dropdown-item" id="pdf" href="#"
                                    onclick="exportTableToPDF('#inscriptionTable')">PDF</a></li>

                        </ul>
                    </div>

                    @if (auth()->user()->role_id == 2)
                        <a href="{{ route('sujetprofesseur.create') }}" class="btn btn-custom btn-ajouter"
                            onclick="window.location.href='{{ asset('frontend/dashboard/html/sujt.html') }}'"><i
                                class="fa fa-plus"></i> Creer un sujet</a>
                    @elseif(auth()->user()->role_id == 5)
                        <a href="{{ route('sujetadmin.create') }}" class="btn btn-custom btn-ajouter"
                            onclick="window.location.href='{{ asset('frontend/dashboard/html/sujt.html') }}'"><i
                                class="fa fa-plus"></i> Creer un sujet</a>
                    @endif

                    <div class="dropdown" id="filterMenu">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-filter"></i> Filtrer par
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Matière</a>
                                <ul class="dropdown-menu">
                                    {{-- @foreach ($etudiants as $etudiant)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Genre', '{{ $etudiant->genre }}')">
                                                {{ $etudiant->genre }}
                                            </a>
                                        </li>
                                    @endforeach --}}
                                </ul>
                            </li>
                            {{--  --}}
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Filière</a>
                                <ul class="dropdown-menu">
                                    {{-- @foreach ($etudiants as $etudiant)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Classe', '{{ $etudiant->nomclasse }}')">
                                                {{ $etudiant->nomclasse }}
                                            </a>
                                        </li>
                                    @endforeach --}}
                                </ul>
                            </li>

                            {{--  --}}
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Classes</a>
                                <ul class="dropdown-menu">
                                    {{-- @foreach ($etudiants as $etudiant)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Classe', '{{ $etudiant->nomclasse }}')">
                                                {{ $etudiant->nomclasse }}
                                            </a>
                                        </li>
                                    @endforeach --}}
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>




            </div>
            <!-- Table for listing teachers -->
            <div id="noResults">Aucun résultat trouvé</div>
            <div class="table-responsive">
                <table id="inscriptionTable" class="table">
                    <thead class="table-aaa">
                        <tr class="aa">
                            {{-- <th>Identifiant</th> --}}
                            <th>Code</th>
                            @if (auth()->user()->role_id == 5)
                                <th>Professeur</th>
                            @endif
                            <th>Matière</th>
                            <th>Filière</th>
                            <th>Classes</th>
                            <th>Date de création</th>
                            <th>Statut</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    &nbsp;&nbsp;
                    <tbody>
                        @foreach ($listesujets as $listesujet)
                            <tr>
                                {{-- <td data-label="Identifiant">{{ $listesujet->id }}</td> --}}
                                <td data-label="Code">{{ $listesujet->code }}</td>
                                @if (auth()->user()->role_id == 5)
                                    <td data-label="User">{{ $listesujet->nom . ' ' . $listesujet->prenom }}</td>
                                @endif
                                <td data-label="Matière">{{ $listesujet->nommatiere }}</td>
                                <td data-label="Filière">{{ $listesujet->nomfiliere }}</td>
                                <td data-label="Classes">{{ $listesujet->nomclasse }}</td>
                                <td data-label="Date de création">{{ $listesujet->created_date }}</td>
                                <td data-label="Statut" id="corrigé">
                                    <span
                                        class="stats
                                    @if ($listesujet->status === 'non-corrige') non-corrige
                                    @elseif($listesujet->status === 'corrige') corrige @endif">
                                        @if ($listesujet->status === 'non-corrige')
                                            Non Corrigé
                                        @elseif($listesujet->status === 'corrige')
                                            Corrigé
                                        @endif
                                    </span>


                                </td>
                                <td data-label="Action" class="action-icons no-print">
                                    <button data-bs-toggle="modal" data-bs-target="#editTeacher">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button data-bs-toggle="modal" data-bs-target="#impri">
                                        <i style="color: #4A41C5;" class="fa-solid fa-print"></i>
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#impri">
                                        <i style="color:#38B293" class="fa-solid fa-calculator"></i>
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#editTeacher">
                                        <i class="fa-solid fa-list"></i>
                                    </button>
                                    <button data-bs-toggle="modal" data-bs-target="#deleteTeacher">
                                        <i class="fa-solid fa-box-archive"></i>
                                    </button>
                                </td>
                                {{--  pour appliquer les fonction geler --}}
                                {{-- <td data-label="Action" class="action-icons no-print">
                                    <button data-bs-toggle="modal" data-bs-target="#editTeacher"
                                        @if ($listesujet->status === 'corrige') disabled @endif>
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button data-bs-toggle="modal" data-bs-target="#impri"
                                        @if ($listesujet->status === 'corrige') disabled @endif>
                                        <i style="color: #4A41C5;" class="fa-solid fa-print"></i>
                                    </button>

                                    <button data-bs-toggle="modal" data-bs-target="#impri"
                                        @if ($listesujet->status === 'corrige') disabled @endif>
                                        <i style="color:#38B293" class="fa-solid fa-calculator"></i>
                                    </button>

                                    <button data-bs-toggle="modal" data-bs-target="#editTeacher"
                                        @if ($listesujet->status === 'non-corrige') disabled @endif>
                                        <i class="fa-solid fa-list"></i>
                                    </button>

                                    <button data-bs-toggle="modal" data-bs-target="#deleteTeacher"
                                        @if ($listesujet->status === 'non-corrige') disabled @endif>
                                        <i class="fa-solid fa-box-archive"></i>
                                    </button>
                                </td> --}}

                            </tr>
                            {{-- <button data-bs-toggle="modal" data-bs-target="#imprisd">
                                <i class="fas fa-calculator fa-stack-2x" style="color: #4A41C5"></i>
                            </button> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>


            <div class="pagination-container  no-print">
                <div class="pagination-info">
                    Affiche
                    <select class="classic" id="rowsPerPageSelect" data-table-id="#inscriptionTable">
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    de
                </div>
                <div class="pagination-buttons">
                    <button class="btn prev"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="btn active">1</button>
                    <button class="btn next"><i class="fa-solid fa-chevron-right"></i></button>
                    <span id="nbr">sur 2</span>
                </div>
            </div><br>
        </div>
    </div>
    <!--  -->
    {{--  --}} {{-- modal scan --}}

    <div class="modal fade " id="impri" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Connecter un scanner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="add-printer-scanner">
                        <button class="add-button">
                            <i class="fas fa-plus"></i> Ajouter une imprimante ou un scanner
                        </button>
                    </div>
                    <h3>Imprimante et scanners disponible</h3>
                    <ul class="devices-list">
                        <li>
                            <div class="device-icon">
                                <!-- SVG de l'imprimante -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 35.529 31.976">
                                    <g id="printer2" transform="translate(-2 -3)"
                                        style="mix-blend-mode: normal;isolation: isolate">
                                        <path id="Tracé_379" data-name="Tracé 379"
                                            d="M2,11.329A5.329,5.329,0,0,1,7.329,6h3.553a1.777,1.777,0,0,1,.794.188l3.178,1.589H32.2a5.329,5.329,0,0,1,5.329,5.329v8.882A5.329,5.329,0,0,1,32.2,27.317H28.647V23.765H32.2a1.776,1.776,0,0,0,1.776-1.776V13.106A1.776,1.776,0,0,0,32.2,11.329H14.435a1.776,1.776,0,0,1-.794-.188L10.463,9.553H7.329a1.776,1.776,0,0,0-1.776,1.776V21.988a1.776,1.776,0,0,0,1.776,1.776h3.553v3.553H7.329A5.329,5.329,0,0,1,2,21.988Z"
                                            transform="translate(0 2.329)" fill="#fff" fill-rule="evenodd" />
                                        <path id="Tracé_380" data-name="Tracé 380"
                                            d="M8.553,6.553A3.553,3.553,0,0,1,12.106,3H22.765a3.553,3.553,0,0,1,3.553,3.553v3.553H22.765V6.553H12.106V9.9L9.347,8.517a1.777,1.777,0,0,0-.794-.188ZM26.317,26.094v5.329a3.553,3.553,0,0,1-3.553,3.553H12.106a3.553,3.553,0,0,1-3.553-3.553V22.541a1.776,1.776,0,0,1,0-3.553H26.317a1.776,1.776,0,1,1,0,3.553Zm-3.553-3.553H12.106v8.882H22.765ZM8.553,15.435a1.776,1.776,0,1,1-1.776-1.776A1.776,1.776,0,0,1,8.553,15.435Z"
                                            transform="translate(2.329)" fill="#fff" fill-rule="evenodd" />
                                    </g>
                                </svg>
                            </div>
                            SCANNER HP Scanjet Pro 2600 F1
                        </li>
                        <li>
                            <div class="device-icon">
                                <!-- Répéter l'icône SVG de l'imprimante -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 35.529 31.976">
                                    <g id="printer2" transform="translate(-2 -3)"
                                        style="mix-blend-mode: normal;isolation: isolate">
                                        <path id="Tracé_379" data-name="Tracé 379"
                                            d="M2,11.329A5.329,5.329,0,0,1,7.329,6h3.553a1.777,1.777,0,0,1,.794.188l3.178,1.589H32.2a5.329,5.329,0,0,1,5.329,5.329v8.882A5.329,5.329,0,0,1,32.2,27.317H28.647V23.765H32.2a1.776,1.776,0,0,0,1.776-1.776V13.106A1.776,1.776,0,0,0,32.2,11.329H14.435a1.776,1.776,0,0,1-.794-.188L10.463,9.553H7.329a1.776,1.776,0,0,0-1.776,1.776V21.988a1.776,1.776,0,0,0,1.776,1.776h3.553v3.553H7.329A5.329,5.329,0,0,1,2,21.988Z"
                                            transform="translate(0 2.329)" fill="#fff" fill-rule="evenodd" />
                                        <path id="Tracé_380" data-name="Tracé 380"
                                            d="M8.553,6.553A3.553,3.553,0,0,1,12.106,3H22.765a3.553,3.553,0,0,1,3.553,3.553v3.553H22.765V6.553H12.106V9.9L9.347,8.517a1.777,1.777,0,0,0-.794-.188ZM26.317,26.094v5.329a3.553,3.553,0,0,1-3.553,3.553H12.106a3.553,3.553,0,0,1-3.553-3.553V22.541a1.776,1.776,0,0,1,0-3.553H26.317a1.776,1.776,0,1,1,0,3.553Zm-3.553-3.553H12.106v8.882H22.765ZM8.553,15.435a1.776,1.776,0,1,1-1.776-1.776A1.776,1.776,0,0,1,8.553,15.435Z"
                                            transform="translate(2.329)" fill="#fff" fill-rule="evenodd" />
                                    </g>
                                </svg>
                            </div>
                            Canon G3010 séries
                        </li>
                        <li>
                            <div class="device-icon">
                                <!-- Répéter l'icône SVG de l'imprimante -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 35.529 31.976">
                                    <g id="printer2" transform="translate(-2 -3)"
                                        style="mix-blend-mode: normal;isolation: isolate">
                                        <path id="Tracé_379" data-name="Tracé 379"
                                            d="M2,11.329A5.329,5.329,0,0,1,7.329,6h3.553a1.777,1.777,0,0,1,.794.188l3.178,1.589H32.2a5.329,5.329,0,0,1,5.329,5.329v8.882A5.329,5.329,0,0,1,32.2,27.317H28.647V23.765H32.2a1.776,1.776,0,0,0,1.776-1.776V13.106A1.776,1.776,0,0,0,32.2,11.329H14.435a1.776,1.776,0,0,1-.794-.188L10.463,9.553H7.329a1.776,1.776,0,0,0-1.776,1.776V21.988a1.776,1.776,0,0,0,1.776,1.776h3.553v3.553H7.329A5.329,5.329,0,0,1,2,21.988Z"
                                            transform="translate(0 2.329)" fill="#fff" fill-rule="evenodd" />
                                        <path id="Tracé_380" data-name="Tracé 380"
                                            d="M8.553,6.553A3.553,3.553,0,0,1,12.106,3H22.765a3.553,3.553,0,0,1,3.553,3.553v3.553H22.765V6.553H12.106V9.9L9.347,8.517a1.777,1.777,0,0,0-.794-.188ZM26.317,26.094v5.329a3.553,3.553,0,0,1-3.553,3.553H12.106a3.553,3.553,0,0,1-3.553-3.553V22.541a1.776,1.776,0,0,1,0-3.553H26.317a1.776,1.776,0,1,1,0,3.553Zm-3.553-3.553H12.106v8.882H22.765ZM8.553,15.435a1.776,1.776,0,1,1-1.776-1.776A1.776,1.776,0,0,1,8.553,15.435Z"
                                            transform="translate(2.329)" fill="#fff" fill-rule="evenodd" />
                                    </g>
                                </svg>
                            </div>
                            Canon Colortrac SmartLF SCi 36
                        </li>
                        <li>
                            <div class="device-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 35.529 31.976">
                                    <g id="printer2" transform="translate(-2 -3)"
                                        style="mix-blend-mode: normal;isolation: isolate">
                                        <path id="Tracé_379" data-name="Tracé 379"
                                            d="M2,11.329A5.329,5.329,0,0,1,7.329,6h3.553a1.777,1.777,0,0,1,.794.188l3.178,1.589H32.2a5.329,5.329,0,0,1,5.329,5.329v8.882A5.329,5.329,0,0,1,32.2,27.317H28.647V23.765H32.2a1.776,1.776,0,0,0,1.776-1.776V13.106A1.776,1.776,0,0,0,32.2,11.329H14.435a1.776,1.776,0,0,1-.794-.188L10.463,9.553H7.329a1.776,1.776,0,0,0-1.776,1.776V21.988a1.776,1.776,0,0,0,1.776,1.776h3.553v3.553H7.329A5.329,5.329,0,0,1,2,21.988Z"
                                            transform="translate(0 2.329)" fill="#fff" fill-rule="evenodd" />
                                        <path id="Tracé_380" data-name="Tracé 380"
                                            d="M8.553,6.553A3.553,3.553,0,0,1,12.106,3H22.765a3.553,3.553,0,0,1,3.553,3.553v3.553H22.765V6.553H12.106V9.9L9.347,8.517a1.777,1.777,0,0,0-.794-.188ZM26.317,26.094v5.329a3.553,3.553,0,0,1-3.553,3.553H12.106a3.553,3.553,0,0,1-3.553-3.553V22.541a1.776,1.776,0,0,1,0-3.553H26.317a1.776,1.776,0,1,1,0,3.553Zm-3.553-3.553H12.106v8.882H22.765ZM8.553,15.435a1.776,1.776,0,1,1-1.776-1.776A1.776,1.776,0,0,1,8.553,15.435Z"
                                            transform="translate(2.329)" fill="#fff" fill-rule="evenodd" />
                                    </g>
                                </svg>
                            </div>
                            Fax
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{--  --}}
    <!-- importer -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <!-- Modal Body -->
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i> <!-- Font Awesome close icon -->
                </button>
                <h1 class="modal-title fs-5 text-center" id="importModalLabel">Importer un fichier</h1>

                <form action="/path/to/your/upload/handler" method="post" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="fileInput" class="form-label">Choisissez un fichier à importer</label>
                            <input type="file" class="form-control" id="fileInput" name="importedFile" required>
                            <div class="invalid-feedback">
                                Veuillez sélectionner un fichier.
                            </div>
                        </div>
                </form>

                <!-- Modal Footer -->
                <div class="modal-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Importer</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
    <!--  -->




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Définir la configuration pour ce fichier
            setTableConfig({
                'Matière': 5, // Index de la colonne "Matière"
                'Classe': 6 // Index de la colonne "Classe"
            });

            // Définir l'ID du tableau pour les fonctions de recherche et de pagination
            setTableId('#inscriptionTable');
            // Appel des fonctions de recherche et de pagination
            searchTable('#inscriptionTable tbody', 'searchInput', 'noResults');
            paginateTable('#inscriptionTable');
        });
    </script>


    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>



</body>

</html>
