<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/messageError.css') }}">

    <title>Liste_des_Etablissements</title>

</head>


<body>
    <!-- header -->
    @include('admin.include.menu')

    <!-- accueil -->
    <div class="container">
        <div class="printableArea">
            <h2 class="text-start">Liste des Etablissements</h2>
            <div class="d-flex justify-content-between align-items-center flex-wrap action-buttons mb-3 no-print">
                <div class="d-flex search-container">
                    <i class="fa fa-search"></i>
                    <input id="searchInput" type="text" id="search" class="form-control search-bar"
                        placeholder="Rechercher...">
                </div>

                <div class="d-flex justify-content-end flex-wrap action-buttons">
                    <button class="btn btn-custom btn-imprimer" id="printBtn" onclick="printDiv()"><i
                            class="fa fa-print"></i> Imprimer</button>


                    <!-- Dropdown for Export options -->
                    <div class="btn-group">
                        <button class="btn btn-custom btn-exporter dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-download"></i> Exporter
                        </button>
                        <ul class="dropdown-menu" id="menu">
                            <!-- Assurez-vous que ces liens ont bien l'attribut href="#" et que onclick est correct -->
                            <li><a class="dropdown-item" id="excel" href="#"
                                    onclick="exportTableToExcel('#etablissementTable')">Excel</a></li>
                            <li><a class="dropdown-item" id="pdf" href="#"
                                    onclick="exportTableToPDF('#etablissementTable')">PDF</a></li>

                        </ul>
                    </div>
                    <button class="btn btn-custom btn-ajouter" data-bs-toggle="modal"
                        data-bs-target="#etablissementModal"><i class="fa fa-plus"></i> Ajouter un
                        Etablissement</button>
                </div>





            </div>
            <!-- Table for listing teachers -->
            <div id="noResults">Aucun résultat trouvé</div>
            <div class="table-responsive">
                <table id="etablissementTable" class="table">
                    <thead class="table-aaa">
                        <tr class="aa">
                            <th>Identifiant</th>
                            <th>Nom Etablissement</th>
                            <th>Nom Responsable</th>
                            <th>Prenom Responsable</th>
                            <th>Contact</th>
                            <th>logo</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>&nbsp;&nbsp;
                    <tbody id="etablissementTable">
                        @foreach ($etablissements as $etablissement)
                            <tr>
                                <td data-label="Identifiant">{{ $etablissement->id }}</td>
                                <td data-label="Nom Etablissement">{{ $etablissement->nometablissement }}</td>
                                <td data-label="Nom Responsable">{{ $etablissement->nomresponsable }}</td>
                                <td data-label="Prenom Responsable">{{ $etablissement->prenomresponsable }}</td>
                                <td data-label="Contact">{{ $etablissement->contact }}</td>
                                <td data-label="logo"><img src="{{ asset('storage/logo/' . $etablissement->logo) }}"
                                        width="50" height="50" class="img-circle elevation-2" alt="">
                                </td>
                                <td data-label="Action" class="action-icons no-print">
                                    {{-- <button data-bs-toggle="modal" data-bs-target="#editTeacher"> <i
                                        class="fas fa-edit"></i></button>
                                <button data-bs-toggle="modal" data-bs-target="#deleteTeacher"><i
                                        class="fas fa-trash-alt"></i></button> --}}
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editEtablissementModal{{ $etablissement->id }}"
                                        data-id="{{ $etablissement->id }}"
                                        data-nometablissement="{{ $etablissement->nometablissement }}"
                                        data-nomresponsable="{{ $etablissement->nomresponsable }}"
                                        data-prenomresponsable="{{ $etablissement->prenomresponsable }}"
                                        data-contact="{{ $etablissement->contact }}"
                                        data-adresse="{{ $etablissement->adresse }}"
                                        data-logo="{{ asset('storage/logo/' . $etablissement->logo) }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteEtablissementModal{{ $etablissement->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>


                            <!-- Modal for editing establishment -->
                            <div class="modal fade" id="editEtablissementModal{{ $etablissement->id }}" tabindex="-1"
                                aria-labelledby="editEtablissementModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <h1 class="text-center">Modifier</h1>
                                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="fa-solid fa-xmark"></i> <!-- Font Awesome close icon -->
                                        </button>
                                        <form id="editEtablissementForm{{ $etablissement->id }}"
                                            action="{{ route('etablissement.update', $etablissement->id) }}"
                                            method="POST" class="needs-validation" enctype="multipart/form-data"
                                            novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            name="nometablissement" placeholder="Nom Etablissement"
                                                            value="{{ $etablissement->nometablissement }}" required>
                                                        <div class="invalid-feedback">
                                                            Le nom de l'établissement est requis.
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            name="nomresponsable" placeholder="Nom Responsable"
                                                            value="{{ $etablissement->nomresponsable }}" required>
                                                        <div class="invalid-feedback">
                                                            Le nom du responsable est requis.
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            name="prenomresponsable" placeholder="Prénom Responsable"
                                                            value="{{ $etablissement->prenomresponsable }}" required>
                                                        <div class="invalid-feedback">
                                                            Le prénom du responsable est requis.
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="tel" class="form-control" name="contact"
                                                            placeholder="Contact"
                                                            value="{{ $etablissement->contact }}" required>
                                                        <div class="invalid-feedback">
                                                            Le contact est requis.
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="adresse"
                                                            placeholder="Adresse Etablissement"
                                                            value="{{ $etablissement->adresse }}" required>
                                                        <div class="invalid-feedback">
                                                            L'adresse est requise.
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="file" class="form-control" name="file"
                                                            placeholder="Logo">
                                                        <div class="invalid-feedback">
                                                            Choisissez un logo valide.
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


                            <!-- Modal for deleting establishment -->
                            <div class="modal" id="deleteEtablissementModal{{ $etablissement->id }}" tabindex="-1"
                                aria-labelledby="deleteEtablissementModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('frontend/dashboard/images/images.png') }}"
                                                width="150" height="150" alt=""><br><br>
                                            <p id="sure">Êtes-vous sûr?</p>
                                            <p>Supprimer l'établissement?</p>
                                        </div>
                                        <div class="d-flex justify-content-around">
                                            <form action="{{ route('etablissement.destroy', $etablissement->id) }}"
                                                method="POST">
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
                    <select id="rowsPerPageSelect" data-table-id="#etablissementTable">
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
    <div class="modal fade" id="etablissementModal" tabindex="-1" aria-labelledby="etablissementModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <h1 class="text-center">Ajouter</h1>
                <form action="{{ route('etablissement.store') }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nometablissement"
                                    placeholder="Nom Etablissement" required>
                                <div class="invalid-feedback">
                                    Le nom de l'établissement est requis.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nomresponsable"
                                    placeholder="Nom Responsable" required>
                                <div class="invalid-feedback">
                                    Le nom du responsable est requis.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="prenomresponsable"
                                    placeholder="Prénom Responsable" required>
                                <div class="invalid-feedback">
                                    Le prénom du responsable est requis.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="tel" class="form-control" name="contact" placeholder="Contact"
                                    required>
                                <div class="invalid-feedback">
                                    Le contact est requis.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="adresse"
                                    placeholder="Adresse Etablissement" required>
                                <div class="invalid-feedback">
                                    L'adresse est requise.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" name="file" placeholder="Logo"
                                    required>
                                <div class="invalid-feedback">
                                    Choisissez un logo valide.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Sauvegarder</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
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
            setTableId('#etablissementTable');
            // Appel des fonctions de recherche et de pagination
            searchTable('#etablissementTable tbody', 'searchInput', 'noResults');
            paginateTable('#etablissementTable');
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
