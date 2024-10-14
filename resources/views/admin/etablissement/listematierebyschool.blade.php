<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matières</title>
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

    <title>matiere</title>

</head>


<body>
    <!-- header -->
    @include('admin.include.menu')

    <!-- accueil -->
    <div class="container">
        <div class="printableArea">
            <h2 class="text-start">Liste des matières</h2>
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
                                    onclick="exportTableToExcel('#matiereTable')">Excel</a></li>
                            <li><a class="dropdown-item" id="pdf" href="#"
                                    onclick="exportTableToPDF('#matiereTable')">PDF</a></li>

                        </ul>
                    </div>
                    <button class="btn btn-custom btn-ajouter" data-bs-toggle="modal" data-bs-target="#matiere"><i
                            class="fa fa-plus"></i> Ajouter une Matière</button>

                    <div class="dropdown" id="filterMenu">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-filter"></i> Filtrer par
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Nom-Matière</a>
                                <ul class="dropdown-menu">
                                    @foreach ($lesmatieres as $matiere)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Nom-Matière', '{{ $matiere->nommatiere }}')">
                                                {{ $matiere->nommatiere }}
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
            <div class="table-responsive">
                <table id="matiereTable" class="table">
                    <thead class="table-aaa">
                        <tr class="aa">
                            <th>Code</th>
                            <th>Nom de la Matière</th>
                            <th>Coefficient</th>
                            <th>Crédits ECTS</th>
                            <th>Volume horaire</th>
                            <th class="no-print" style="text-align: center">Action</th>
                        </tr>
                    </thead>&nbsp;&nbsp;
                    <tbody id="matiereTable">

                        @foreach ($nosmatieres as $matiere)
                            <tr>
                                <td data-label="Identifiant">{{ $matiere->code }}</td>
                                <td data-label="Nom">{{ $matiere->matiere->nommatiere }}</td>
                                <td data-label="coefficient">{{ $matiere->coefficient }}</td>
                                <td data-label="credit">{{ $matiere->credit }}</td>
                                <td data-label="volume">{{ $matiere->volumehoraire }} h</td>
                                <td data-label="Action" style="text-align: center" class="action-icons no-print">
                                    <!-- Bouton de Modification -->
                                    <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editMatiere{{ $matiere->id }}" data-code="{{ $matiere->code }}" data-id="{{ $matiere->id }}"
                                        data-nommatiere="{{ $matiere->matiere->nommatiere }}" data-coefficient="{{ $matiere->coefficient }}"
                                        data-credit="{{ $matiere->credit }}" data-volumehoraire="{{ $matiere->volumehoraire }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Bouton de Suppression -->
                                    <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deletematiere{{ $matiere->matiere->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal de Modification -->
                            <div class="modal fade" id="editMatiere{{ $matiere->id }}" tabindex="-1"
                                aria-labelledby="editMatiereLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="fa-solid fa-xmark"></i> </button>
                                        <h1 class="text-center">Modifier</h1>
                                        <form action="{{ route('updateadmin.matiere', $matiere->id) }}" method="POST" class="needs-validation" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <!-- Sélection des matières -->
                                                    <div class="col-sm-6">
                                                        <select class="select2-multiple form-control" name="matiere_id" style="width: 100%" id="matiereeditselect2" disabled>
                                                            @foreach ($nosmatieres as $matiereOption)
                                                                <option value="{{ $matiereOption->id }}"
                                                                    {{ $matiereOption->id == $matiere->matiere_id ? 'selected' : '' }}>
                                                                    {{ $matiereOption->matiere->nommatiere }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <input type="number" name="coefficient" class="form-control" id="editLastName"
                                                            placeholder="Coefficient" value="{{$matiere->coefficient}}" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="number" name="credit" class="form-control" id="editLastName"
                                                            placeholder="Crédits ECTS / autre système de crédit" value="{{$matiere->credit}}" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="number" name="volumehoraire" class="form-control" id="editLastName"
                                                            placeholder="Volume horaire" value="{{$matiere->volumehoraire}}" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="d-flex justify-content-around">
                                                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <!-- Modal de Suppression -->
                            <div class="modal fade" id="deletematiere{{ $matiere->id }}" tabindex="-1"
                                aria-labelledby="deleteMatiereLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('frontend/dashboard/images/images.png') }}"
                                                width="50" height="50" alt=""><br><br>
                                                <p id="sure">Êtes-vous sûr?</p>
                                                <p>supprimer la matière <strong>{{$matiere->matiere->nommatiere}}</strong> ?</p>
                                        </div>
                                        <div class="d-flex justify-content-around">
                                            <form action="{{ route('destroyadmin.matiere', $matiere->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                            <button type="button" style="border-radius: 0%"
                                                class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
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
                    <select id="rowsPerPageSelect" data-table-id="#matiereTable">
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
    <div class="modal " id="matiere" tabindex="-1" aria-labelledby="addMatiereLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i></button>
                <h1 class="text-center">Ajouter</h1>
                <form action="{{ route('storeadmin.matiere') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="select2-multiple form-control"
                                        name="matiere_id[]" style="width: 100%" id="matiereselect2"
                                        multiple>
                                        <option value="">Selectionnez une matière</option>
                                        @foreach ($lesmatieres as $matiere)
                                            <option value="{{ $matiere->id }}">
                                                {{ $matiere->nommatiere }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="number" name="coefficient" class="form-control" id="editLastName"
                                    placeholder="Coefficient" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="number" name="credit" class="form-control" id="editLastName"
                                    placeholder="Crédits ECTS / autre système de crédit" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="number" name="volumehoraire" class="form-control" id="editLastName"
                                    placeholder="Volume horaire" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success">Sauvegarder</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
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
                    <i class="fa-solid fa-xmark"></i></button>

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
                'Nom-Matière': 1,

            });

            // Définir l'ID du tableau pour les fonctions de recherche et de pagination
            setTableId('#matiereTable');
            // Appel des fonctions de recherche et de pagination
            searchTable('#matiereTable tbody', 'searchInput', 'noResults');
            paginateTable('#matiereTable');
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

        $('#matiereselect2').select2({
            placeholder: "Matière",
            allowClear: true,
        });

    });
</script>

</body>

</html>
