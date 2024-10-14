<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Enseignant</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons (if needed) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- pdf & excel -->
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="{{ asset('frontend/dashboard/js/list.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/lists.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/html/admin.css') }}">

</head>
<style>
    /* Style select */
    select.classic {
        margin: 0;
        padding: .1rem .2em;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    select.classic,
    select.classic:focus {
        background-image:
            linear-gradient(45deg, transparent 50%, #293D7A 50%),
            linear-gradient(135deg, #293D7A 50%, transparent 50%),
            linear-gradient(to right, #fff, #fff);
        background-position:
            calc(100% - 10px) calc(.6em + 2px),
            calc(100% - 5px) calc(.6em + 2px),
            100% 0;
        background-size:
            5px 5px,
            5px 5px,
            2.5em 2.5em;
        background-repeat: no-repeat;
    }
</style>

<body>
    <!-- header -->
    @include('admin.include.menu')

    <!-- accueil -->
    <div class="container">
        <div class="printableArea">
            <h2 class="text-start">Liste des filières</h2>
            <div class="d-flex justify-content-between align-items-center flex-wrap action-buttons mb-3 no-print">
                <div class="d-flex search-container">
                    <i class="fa fa-search"></i>
                    <input id="searchInput" type="text" id="search" class="form-control search-bar"
                        placeholder="Rechercher...">
                </div>

                <div class="d-flex justify-content-end flex-wrap action-buttons">
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
                                    onclick="exportTableToExcel('#filiereTable')">Excel</a></li>
                            <li><a class="dropdown-item" id="pdf" href="#"
                                    onclick="exportTableToPDF('#filiereTable')">PDF</a></li>

                        </ul>
                    </div>
                    <button class="btn btn-custom btn-ajouter" data-bs-toggle="modal" data-bs-target="#filiere"><i
                            class="fa fa-plus"></i> Ajouter une filiere</button>

                    <div class="dropdown" id="filterMenu">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-filter"></i> Filtrer par
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Nom-Filière</a>
                                <ul class="dropdown-menu">
                                    @foreach ($filieres as $filiere)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Nom-Filière', '{{ $filiere->nomfiliere }}')">
                                                {{ $filiere->nomniveau }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Niveau</a>
                                <ul class="dropdown-menu">
                                    @foreach ($filieres as $filiere)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Niveau', '{{ $filiere->nomniveau }}')">
                                                {{ $filiere->code }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>




            </div>
            <!-- Table for listing teachers -->
            <div id="noResults">Aucun résultat trouvé</div>
            {{-- <div class="table-responsive">
                <table id="filiereTable" class="table">
                    <thead class="table-aaa">
                        <tr class="aa">
                            <th>Identifiant</th>
                            <th>Code(Abreviation)</th>
                            <th>Nom de la Filière</th>
                            <th>Niveau</th>
                            <th>Nombre de classes</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>&nbsp;&nbsp;
                    <tbody id="filiereTable">
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($filieres as $filiere)
                            <tr>
                                <td data-label="Identifiant">{{ $num++ }}</td>
                                <td data-label="Code(Abreviation)">{{ $filiere->code }}</td>
                                <td data-label="Nom de la Filière">{{ $filiere->nomfiliere }}</td>
                                <td data-label="Niveau">{{ $filiere->nomniveau }}</td>
                                <td data-label="Nombre de classes" class="text-center">{{ $filiere->nbclasse }}</td>
                                <td data-label="Action" class="action-icons no-print">
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editFiliere{{ $filiere->id }}"
                                        data-id="{{ $filiere->id }}" data-code="{{ $filiere->code }}"
                                        data-nomfiliere="{{ $filiere->nomfiliere }}">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deletefiliere{{ $filiere->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal de Modification -->
                            <div class="modal " id="editFiliere{{ $filiere->id }}" tabindex="-1"
                                aria-labelledby="editFiliereLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">
                                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="fa-solid fa-xmark"></i> </button>
                                        <h1 class="text-center">Modifier</h1>
                                        <form action="{{ route('filiere.update', $filiere->id) }}" method="POST"
                                            class="needs-validation" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <!-- Fields for editing teacher details -->
                                                    <div class="col-sm-6">
                                                        <input type="text" name="code" class="form-control"
                                                            id="editFirstName" placeholder="Code(Abreviation)"
                                                            value="{{ $filiere->code }}" required>
                                                        <div class="invalid-feedback">
                                                            Valid first name is required.
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="text" name="nomfiliere" class="form-control"
                                                            id="editLastName" placeholder="Nom de la filière"
                                                            value="{{ $filiere->nomfiliere }}" required>
                                                        <div class="invalid-feedback">
                                                            Valid last name is required.
                                                        </div>
                                                    </div>


                                                    <!-- Fields for editing teacher details -->
                                                    <div class="col-sm-12">
                                                        <select name="niveau_id" class="form-control" id="niveau_id">
                                                            @foreach ($niveaux as $niveau)
                                                                <option value="{{ $niveau->id }}"
                                                                    @if ($niveau->id == $filiere->niveau_id) selected @endif>
                                                                    {{ $niveau->nomniveau }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Valid first name is required.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="submit" class="btn btn-success">Sauvegarder</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Annuler</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal de Suppression -->
                            <div class="modal " id="deletefiliere{{ $filiere->id }}" tabindex="-1"
                                aria-labelledby="deletefiliereLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('frontend/dashboard/images/images.png') }}"
                                                width="50" height="50" alt=""><br><br>
                                            <p id="sure">Êtes-vous sûr?</p>
                                            <p>supprimer cette filière ?</p>
                                        </div>
                                        <div class="d-flex justify-content-around">
                                            <form action="{{ route('filiere.destroy', $filiere->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                            <button type="button" style="border-radius:0%" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </tbody>
                </table>
            </div> --}}

            <div class="table-responsive">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <table id="filiereTable" class="table">
                    <thead class="table-aaa">
                        <tr class="aa">
                            <th>Identifiant</th>
                            <th>Nom de la Filière</th>
                            <th>Description</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>&nbsp;&nbsp;
                    <tbody id="filiereTable">
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($filieres as $filiere)
                            <tr>
                                <td data-label="Identifiant">{{ $num++ }}</td>
                                <td data-label="Nom de la Filière">{{ $filiere->nomfiliere }}</td>
                                <td data-label="description">{{ $filiere->description }}</td>
                                <td data-label="Action" class="action-icons no-print">
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editFiliere{{ $filiere->id }}"
                                        data-id="{{ $filiere->id }}" data-description="{{ $filiere->description }}"
                                        data-nomfiliere="{{ $filiere->nomfiliere }}">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deletefiliere{{ $filiere->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal de Modification -->
                            <div class="modal " id="editFiliere{{ $filiere->id }}" tabindex="-1"
                                aria-labelledby="editFiliereLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">
                                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="fa-solid fa-xmark"></i> </button>
                                        <h1 class="text-center">Modifier</h1>
                                        <form action="{{ route('filiere.update', $filiere->id) }}" method="POST"
                                            class="needs-validation" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <!-- Fields for editing teacher details -->
                                                    <div class="col-sm-6">
                                                        <input type="text" name="nomfiliere" class="form-control"
                                                            id="editFirstName" placeholder="Nom de la filière"
                                                            value="{{ $filiere->nomfiliere }}" required>
                                                        <div class="invalid-feedback">
                                                            Valid first name is required.
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="text" name="description" class="form-control"
                                                            id="editLastName" placeholder="Description"
                                                            value="{{ $filiere->description }}" required>
                                                        <div class="invalid-feedback">
                                                            Valid last name is required.
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="submit" class="btn btn-success">Sauvegarder</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Annuler</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal de Suppression -->
                            <div class="modal " id="deletefiliere{{ $filiere->id }}" tabindex="-1"
                                aria-labelledby="deletefiliereLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('frontend/dashboard/images/images.png') }}"
                                                width="50" height="50" alt=""><br><br>
                                            <p id="sure">Êtes-vous sûr?</p>
                                            <p>supprimer cette filière ?</p>
                                        </div>
                                        <div class="d-flex justify-content-around">
                                            <form action="{{ route('filiere.destroy', $filiere->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                            <button type="button" style="border-radius:0%" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <div class="pagination-container  no-print">
                <div class="pagination-info">
                    Affiche
                    <select id="rowsPerPageSelect" data-table-id="#filiereTable">
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
                    <button class="btn prev">‹</button>
                    <button class="btn active">1</button>
                    <button class="btn next">›</button>
                    <span id="nbr">sur 2</span>
                </div>
            </div><br>
        </div>
    </div>
    <!--  -->
    <!--  -->
    <!-- Modal -->
    <div class="modal fade" id="filiere" tabindex="-1" aria-labelledby="editFiliereLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->

                <!-- Modal Body -->
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <h1 class="text-center">Ajouter</h1>
                <div class="modal-body">
                    <form action="{{ route('filiere.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-3">
                            <!-- Fields for adding teacher details -->

                            <div class="col-sm-6">
                                <input type="text" name="nomfiliere" class="form-control" id="editLastName"
                                    placeholder="Nom de la filière" value="" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" name="description" class="form-control" id="editLastName"
                                    placeholder="Descrition" value="" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Sauvegarder</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--  -->


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

                <form action="{{route('superadmin.importfiliere')}}" method="post" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="fileInput" class="form-label">Choisissez un fichier à importer</label>
                            <input type="file" class="form-control" id="fileInput" name="import_file" required>
                            <div class="invalid-feedback">
                                Veuillez sélectionner un fichier.
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Importer</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        </div>

                </form>

            </div>
        </div>
    </div>
    <!--  -->


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
            tableId = rowsPerPageSelect.getAttribute('data-table-id');

            setTableConfig({
                'Nom-Filière': 2,
                'Niveau': 3
            });

            setTableId('#filiereTable');
            searchTable('#filiereTable tbody', 'searchInput', 'noResults');
            paginateTable('#filiereTable');
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


    <script>
        $(document).ready(function() {


            $('#niveau_id').select2({
                placeholder: "Selectionnez le niveau",
                width: '100%',
                minimumResultsForSearch: Infinity

            });
        });
    </script>
</body>

</html>
