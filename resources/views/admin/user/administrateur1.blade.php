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
    <title>admin</title>

</head>


<body>
    <!-- header -->
    @include('admin.include.menu')
    <!-- accueil -->
    <div class="container">
        <div class="printableArea">
            <h2 class="text-start">Liste des Administrateurs</h2>
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
                                    onclick="exportTableToExcel('#adminTable')">Excel</a></li>
                            <li><a class="dropdown-item" id="pdf" href="#"
                                    onclick="exportTableToPDF('#adminTable')">PDF</a></li>

                        </ul>
                    </div>
                    <button class="btn btn-custom btn-ajouter" data-bs-toggle="modal" data-bs-target="#admin"><i
                            class="fa fa-plus"></i> Ajouter un administrateur</button>
                </div>




            </div>
            <!-- Table for listing teachers -->
            <div id="noResults">Aucun résultat trouvé</div>
            <div class="table-responsive">
                <table id="adminTable" class="table">
                    <thead class="table-aaa">
                        <tr class="aa">
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Prénom </th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Etablissement</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>&nbsp;&nbsp;
                    <tbody>
                        <!-- Example rows, replace with dynamic data -->
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($administrateurs as $administrateur)
                            <tr>
                                <td data-label="Identifiant">{{ $num++ }}</td>
                                <td data-label="Nom">{{ $administrateur->nom }}</td>
                                <td data-label="Prénoms">{{ $administrateur->prenom }}</td>
                                <td data-label="Contact">{{ $administrateur->contact }}</td>
                                <td data-label="Email">{{ $administrateur->email }}</td>
                                <td data-label="Etablissement">{{ $administrateur->nometablissement }}</td>
                                <td data-label="Action" class="action-icons no-print">
                                    <button class="btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editAdmin{{ $administrateur->id }}"
                                        data-id="{{ $administrateur->id }}" data-nom="{{ $administrateur->nom }}"
                                        data-prenom="{{ $administrateur->prenom }}"
                                        data-email="{{ $administrateur->email }}"
                                        data-etablissement_id="{{ $administrateur->etablissement_id }}">
                                        <i class="fas fa-pen"></i>

                                    </button>
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteAdmin{{ $administrateur->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal de Modification -->
                            <div class="modal fade" id="editAdmin{{ $administrateur->id }}" tabindex="-1"
                                aria-labelledby="editAdminLabel{{ $administrateur->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="fa-solid fa-xmark"></i></button>

                                        <h1 class="text-center">Modifier</h1>
                                        <form action="{{ route('user.update', $administrateur->id) }}" method="POST"
                                            class="needs-validation" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <!-- Fields for editing teacher details -->
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            id="editNom{{ $administrateur->id }}" name="nom"
                                                            placeholder="Nom" value="{{ $administrateur->nom }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Nom est requis.
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            id="editPrenom{{ $administrateur->id }}" name="prenom"
                                                            placeholder="Prénoms"
                                                            value="{{ $administrateur->prenom }}" required>
                                                        <div class="invalid-feedback">
                                                            Prénom est requis.
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="email" class="form-control"
                                                            id="editEmail{{ $administrateur->id }}" name="email"
                                                            placeholder="Email" value="{{ $administrateur->email }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Email est requis.
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="tel" class="form-control"
                                                            id="editContact{{ $administrateur->id }}" name="contact"
                                                            placeholder="Contact"
                                                            value="{{ $administrateur->contact }}" required>
                                                        <div class="invalid-feedback">
                                                            Contact est requis.
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <select class="select2-multiple form-control w-100"
                                                            name="etablissement_id" id="select2Multiple">
                                                            @foreach ($etablissements as $etablissement)
                                                                <option value="{{ $etablissement->id }}"
                                                                    @if ($etablissement->id == $administrateur->etablissement_id) selected @endif>
                                                                    {{ $etablissement->nometablissement }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Contact est requis.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-around">
                                                <button type="submit" class="btn btn-success">Sauvegarder</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Annuler</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal de Suppression -->
                            <div class="modal fade" id="deleteAdmin{{ $administrateur->id }}" tabindex="-1"
                                aria-labelledby="deleteAdminLabel{{ $administrateur->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('frontend/dashboard/images/images.png') }}"
                                                width="50" height="50" alt=""><br><br>
                                            <p id="sure">Êtes-vous sûr?</p>
                                            <p>Supprimer cet enseignant ?</p>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <form action="{{ route('user.destroy', $administrateur->id) }}"
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
                    <select id="rowsPerPageSelect" data-table-id="#inscriptionTable">
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
    <!-- Modal ajout -->
    <div class="modal fade" id="admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i></button>
                <h1 class="text-center">Ajouter un admin</h1>
                <form action="{{ route('user.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="firstName" name="nom"
                                    placeholder="Nom" value="" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="lastName" name="prenom"
                                    placeholder="Prenoms" value="" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="tel" class="form-control" id="contact" name="contact"
                                    placeholder="Contact" value="" required>
                                <div class="invalid-feedback">
                                    Valid contact is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" value="" required>
                                <div class="invalid-feedback">
                                    Valid email is required.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <select name="role_id" id="role_id" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->nomrole }}</option>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">
                                    Valid class is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <select name="etablissement_id" id="etablissement_id" class="form-control" required>
                                    <option value="">Selectionnez un établissement</option>
                                    @foreach ($etablissements as $etablissement)
                                        <option value="{{ $etablissement->id }}">
                                            {{ $etablissement->nometablissement }}</option>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">
                                    Valid class is required.
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" value="" required>
                                <div class="invalid-feedback">
                                    Valid subject is required.
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {


            // Définir l'ID du tableau pour les fonctions de recherche et de pagination
            setTableId('#inscriptionTable');
            // Appel des fonctions de recherche et de pagination
            searchTable('#adminTable tbody', 'searchInput', 'noResults');
            paginateTable('#adminTable');
        });
    </script>


    </script>

    <!-- Bootstrap JS -->
    <script src="../js/list.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
