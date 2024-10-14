<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
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
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/html/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/lists.css') }}">

    <title>classe</title>

</head>


<body>
    <!-- header -->
    @include('admin.include.menu')
    <!-- accueil -->
    <div class="container">
        <div class="printableArea">
            <h2 class="text-start">Liste des Classes</h2>
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
                                    onclick="exportTableToExcel('#classeTable')">Excel</a></li>
                            <li><a class="dropdown-item" id="pdf" href="#"
                                    onclick="exportTableToPDF('#classeTable')">PDF</a></li>

                        </ul>
                    </div>
                    <button class="btn btn-custom btn-ajouter" data-bs-toggle="modal" data-bs-target="#Classes"><i
                            class="fa fa-plus"></i> Ajouter une Classe</button>

                    <div class="dropdown" id="filterMenu">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-filter"></i> Filtrer par
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Nom-classe</a>
                                <ul class="dropdown-menu">
                                    @foreach ($classes as $classe)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Nom-classe', '{{ $classe->nomclasse }}')">
                                                {{ $classe->nomclasse }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            {{--  --}}
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Filière</a>
                                <ul class="dropdown-menu">
                                    @foreach ($classes as $classe)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Filière', '{{ $classe->nomfiliere }}')">
                                                {{ $classe->nomfiliere }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            {{--  --}}
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Niveau</a>
                                <ul class="dropdown-menu">
                                    @foreach ($classes as $classe)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Niveau', '{{ $classe->nomniveau }}')">
                                                {{ $classe->nomniveau }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            {{--  --}}

                        </ul>
                    </div>
                </div>



            </div>
            <!-- Table for listing teachers -->
            <div id="noResults">Aucun résultat trouvé</div>
            <div class="table-responsive">
                <table id="classeTable" class="table">
                    <thead class="table-aaa">
                        <tr class="aa">
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Filière</th>
                            <th>Niveau</th>
                            <th>Effectif de la classe</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>&nbsp;&nbsp;
                    <tbody id="classeTable">
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($classes as $classe)
                            <tr>
                                <td data-label="Code">{{ $classe->code }}</td>
                                <td data-label="Nom">{{ $classe->nomclasse }}</td>
                                <td data-label="Filière">{{ $classe->nomfiliere }}</td>
                                <td data-label="Niveau">{{ $classe->nomniveau }}</td>
                                <td data-label="Effectif de la classe">{{ $classe->nbclasse }}</td>
                                <td data-label="Action" class="action-icons no-print">
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editClasse{{ $classe->id }}"
                                        data-id="{{ $classe->id }}" data-code="{{ $classe->code }}"
                                        data-nomclasse="{{ $classe->nomclasse }}"
                                        data-filiere_id="{{ $classe->filiere_id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteclasse{{ $classe->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>


                            <!-- Modal de Modification -->
                            <div class="modal " id="editClasse{{ $classe->id }}" tabindex="-1"
                                aria-labelledby="editFiliereLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">
                                        <h1 class="text-center">Modifier</h1>
                                        <form action="{{ route('classe.update', $classe->id) }}" method="POST" class="needs-validation" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <!-- Nom de la classe -->
                                                    <div class="col-sm-6">
                                                        <input type="text" name="nomclasse" class="form-control" placeholder="Nom de la classe"
                                                            value="{{ $classe->nomclasse }}" required>
                                                        <div class="invalid-feedback">
                                                            Le nom de la classe est requis.
                                                        </div>
                                                    </div>

                                                    <!-- Sélection de la filière -->
                                                    <div class="col-sm-6">
                                                        <select name="etablissement_filiere_id" class="form-control" disabled required>
                                                            <option value="">Sélectionnez une filière</option>
                                                            @foreach ($listefilieres as $filiere)
                                                                <option value="{{ $filiere->filiere_id }}"
                                                                    {{ $filiere->filiere_id == $classe->etablissement_filiere_id ? 'selected' : '' }}>
                                                                    {{ $filiere->filiere->nomfiliere }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            La filière est requise.
                                                        </div>
                                                    </div>

                                                    <!-- Sélection des niveaux -->
                                                    <div class="col-sm-6">
                                                        <select name="niveau_id" id="niveaux" class="form-control" required>
                                                            @foreach ($listefilieres as $filiere)
                                                                @php
                                                                    $niveaux = $filiere->niveaux(); // Appel à la méthode niveaux pour obtenir les niveaux
                                                                @endphp
                                                                @foreach ($niveaux as $niveau)
                                                                    <option value="{{ $niveau->id }}"
                                                                        {{ $niveau->id == $classe->niveau_id ? 'selected' : '' }}>
                                                                        {{ $niveau->code }}
                                                                    </option>
                                                                @endforeach
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Le niveau est requis.
                                                        </div>
                                                    </div>

                                                    <!-- Effectif de la classe -->
                                                    <div class="col-sm-6">
                                                        <input type="number" name="nbclasse" class="form-control" placeholder="Effectif de la classe"
                                                            value="{{ $classe->nbclasse }}" required>
                                                        <div class="invalid-feedback">
                                                            L'effectif de la classe est requis.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Boutons d'action -->
                                            <div class="d-flex justify-content-around">
                                                <button type="submit" class="btn btn-success">Sauvegarder</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <!-- Modal de Suppression -->
                            <div class="modal " id="deleteclasse{{ $classe->id }}" tabindex="-1"
                                aria-labelledby="deleteclasseLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('frontend/dashboard/images/images.png') }}"
                                                width="150" height="150" alt=""><br><br>
                                            <p id="sure">Êtes-vous sûr?</p>
                                            <p>supprimer cette classe ?</p>
                                        </div>
                                        <div class="d-flex justify-content-around">
                                            <form action="{{ route('classe.destroy', $classe->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary"
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
                    <select id="rowsPerPageSelect" data-table-id="#classeTable">
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
    <div class="modal fade" id="Classes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h1 class="text-center">Ajouter</h1>
                <!-- Modal Body -->
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i> <!-- Font Awesome close icon -->
                </button>
                <div class="modal-body">
                    <form action="{{ route('classe.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-3">
                            <!-- Fields for adding teacher details -->

                            <div class="col-sm-6">
                                <input type="text" name="nomclasse" class="form-control" id="editLastName"
                                    placeholder="Nom de la Classe" value="" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="etablissement_filiere_id" id="etablissement_filiere_id" class="form-control" required>
                                        <option value="">Sélectionnez une filière</option>
                                        @foreach ($listefilieres as $filiere)
                                            <option value="{{ $filiere->filiere_id }}">
                                                {{ $filiere->filiere->nomfiliere }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback">Valid role is required.</div>
                            </div>

                            <div class="col-sm-6">

                            <div class="form-group">
                                <select name="niveau_id" id="niveaux" class="form-control" required>
                                    @foreach ($listefilieres as $filiere)
                                        @php
                                            $niveaux = $filiere->niveaux(); // Appel à la méthode niveaux
                                        @endphp
                                        @foreach ($niveaux as $niveau)
                                            <option value="{{ $niveau->id }}">{{ $niveau->code }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="number" name="nbclasse" class="form-control" id="editLastName"
                                    placeholder="Effectif de la classe" value="" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Sauvegarder</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
                <!-- Modal Footer -->

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
                'Nom-classe': 2,
                'Filière': 3,
                'Niveau': 4
            });

            // Définir l'ID du tableau pour les fonctions de recherche et de pagination
            setTableId('#classeTable');
            // Appel des fonctions de recherche et de pagination
            searchTable('#classeTable tbody', 'searchInput', 'noResults');
            paginateTable('#classeTable');
        });
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
            $('#filiere_id').select2({
                placeholder: "Selectionnez une filière",
                width: '100%',
                minimumResultsForSearch: Infinity

            });
        });
    </script>
</body>

</html>
