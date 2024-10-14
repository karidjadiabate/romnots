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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="{{ asset('frontend/dashboard/js/list.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/html/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/lists.css') }}">

    <title>etudiant</title>

</head>


<body>
    <!-- header -->
    @include('admin.include.menu')
    <!-- accueil -->
    <div class="container">
        <div class="printableArea">
            <h2 class="text-start">Liste des Etudiants</h2>
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
                                    onclick="exportTableToExcel('#etudiantTable')">Excel</a></li>
                            <li><a class="dropdown-item" id="pdf" href="#"
                                    onclick="exportTableToPDF('#etudiantTable')">PDF</a></li>

                        </ul>
                    </div>
                    <button class="btn btn-custom btn-ajouter" data-bs-toggle="modal" data-bs-target="#etudiant"><i
                            class="fa fa-plus"></i> Ajouter un etudiant</button>
                    <div class="dropdown" id="filterMenu">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-filter"></i> Filtrer par
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Genre</a>
                                <ul class="dropdown-menu">
                                    @foreach ($etudiants as $etudiant)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Genre', '{{ $etudiant->genre }}')">
                                                {{ $etudiant->genre }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            {{--  --}}
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Classe</a>
                                <ul class="dropdown-menu">
                                    @foreach ($etudiants as $etudiant)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Classe', '{{ $etudiant->nomclasse }}')">
                                                {{ $etudiant->nomclasse }}
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
                <table id="etudiantTable" class="table">
                    <thead class="table-aaa">
                        <tr class="aa">
                            <th>Identifiant</th>
                            <th>Matricule</th>
                            <th>Nom et Prénoms</th>
                            <th>Genre</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Adresse</th>
                            <th>Date de naissance</th>
                            <th>Classe</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>&nbsp;&nbsp;
                    <tbody id="etudiantTable">
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($etudiants as $etudiant)
                            <tr>
                                <td data-label="Identifiant">{{ $num++ }}</td>
                                <td data-label="Matricule">{{ $etudiant->matricule }}</td>
                                <td data-label="Nom">
                                    @if ($etudiant->image)
                                        <img src="{{ asset('storage/profile/' . $etudiant->image) }}" alt="User"
                                            class="rounded-circle profile-image"
                                            style="width: 40px; height: 35x; margin-top:-5px">
                                    @else
                                        <img src="{{ Avatar::create($etudiant->nom . ' ' . $etudiant->prenom)->toBase64() }}"
                                            alt="User" class="rounded-circle profile-image"
                                            style="width: 40px; height: 35x; margin-top:-5px">
                                    @endif

                                    {{ $etudiant->nom . ' ' . $etudiant->prenom }}
                                </td>
                                <td data-label="Genre">{{ $etudiant->genre }}</td>
                                <td data-label="Email">{{ $etudiant->email }}</td>
                                <td data-label="Contact">{{ $etudiant->contact }}</td>
                                <td data-label="Adresse">{{ $etudiant->adresse }}</td>
                                <td data-label="Date-naissance">{{ $etudiant->datenaiss }}</td>
                                <td data-label="Classe">{{ $etudiant->nomclasse }}</td>
                                <td data-label="Action" class="action-icons no-print">
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editEtudiant{{ $etudiant->id }}"
                                        data-file="{{ $etudiant->image }}" data-id="{{ $etudiant->id }}"
                                        data-nom="{{ $etudiant->nom }}" data-prenom="{{ $etudiant->prenom }}"
                                        data-email="{{ $etudiant->email }}"
                                        data-datenaiss="{{ $etudiant->datenaiss }}"
                                        data-adresse="{{ $etudiant->adresse }}">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteEtudiant{{ $etudiant->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal de Modification -->
                            <div class="modal fade" id="editEtudiant{{ $etudiant->id }}" tabindex="-1"
                                aria-labelledby="editAdminLabel{{ $etudiant->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <h1 class="text-center">Modifier</h1>
                                        <form action="{{ route('user.update', $etudiant->id) }}" method="POST"
                                            enctype="multipart/form-data" class="needs-validation" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <!-- Fields for editing teacher details -->
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            id="editNom{{ $etudiant->id }}" name="matricule"
                                                            placeholder="Matricule"
                                                            value="{{ $etudiant->matricule }}" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            id="editNom{{ $etudiant->id }}" name="nom"
                                                            placeholder="Nom" value="{{ $etudiant->nom }}" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            id="editPrenom{{ $etudiant->id }}" name="prenom"
                                                            placeholder="Prénoms" value="{{ $etudiant->prenom }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <select class="select2-multiple form-control" name="classe_id"
                                                            style="width: 100%" id="select2Multiple">
                                                            @foreach ($classes as $classe)
                                                                <option value="{{ $classe->id }}"
                                                                    @if ($classe->id == $etudiant->classe_id) selected @endif>
                                                                    {{ $classe->nomclasse }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="email" class="form-control"
                                                            id="editEmail{{ $etudiant->id }}" name="email"
                                                            placeholder="Email" value="{{ $etudiant->email }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="tel" class="form-control"
                                                            id="editContact{{ $etudiant->id }}" name="contact"
                                                            placeholder="Contact" value="{{ $etudiant->contact }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="date" class="form-control"
                                                            id="editDatenaiss{{ $etudiant->id }}" name="datenaiss"
                                                            placeholder="datenaiss"
                                                            value="{{ $etudiant->datenaiss }}" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <select class="select2-single form-control" name="genre"
                                                            id="genre" style="width: 100%">
                                                            <option value="M"
                                                                @if (old('genre') == 'M') selected @endif>M
                                                            </option>
                                                            <option value="F"
                                                                @if (old('genre') == 'F') selected @endif>F
                                                            </option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            id="adresse{{ $etudiant->id }}" name="adresse"
                                                            placeholder="Adresse" value="{{ $etudiant->adresse }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="file" class="form-control"
                                                            id="adresse{{ $etudiant->id }}" name="file"
                                                            placeholder="datenaiss" value="{{ $etudiant->image }}"
                                                            required>
                                                        <div class="invalid-feedback">
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
                            <div class="modal fade" id="deleteEtudiant{{ $etudiant->id }}" tabindex="-1"
                                aria-labelledby="deleteEtudiantLabel{{ $etudiant->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('frontend/dashboard/images/images.png') }}"
                                                width="50" height="50" alt=""><br><br>
                                            <p id="sure">Êtes-vous sûr?</p>
                                            <p>Supprimer cet etudiant ?</p>
                                        </div>
                                        <div class="d-flex justify-content-around">
                                            <form action="{{ route('user.destroy', $etudiant->id) }}" method="POST">
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
                    <select id="rowsPerPageSelect" data-table-id="#etudiantTable">
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
    <div class="modal fade" id="etudiant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->

                <!-- Modal Body -->
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i> <!-- Font Awesome close icon -->
                </button>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" id="quickForm" method="POST">
                        @csrf
                        <div class="row g-3">
                            <!-- Fields for adding teacher details -->
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="matricule" name="matricule"
                                    placeholder="Matricule" value="" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="firstName" name="nom"
                                    placeholder="Nom" value="" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="lastName" name="prenom"
                                    placeholder="Prenoms" value="" required>
                                <div class="invalid-feedback">
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <input type="tel" class="form-control" id="contact" name="contact"
                                    placeholder="Contact" value="" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email">
                                <div class="invalid-feedback">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="genre" id="genre" class="form-control">
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="datenaiss" name="datenaiss"
                                    placeholder="Date de naissance" max="{{ date('Y-m-d') }}" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option value="1">Etudiant</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="adresse" name="adresse"
                                        placeholder="Adresse" value="" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="classe_id" id="classe_id" class="form-control w-100">
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id }}">{{ $classe->nomclasse }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-sm-6" style="display: none">
                                <input type="password" class="form-control" id="password" name="password"
                                    value="password" placeholder="Password" value="" required>
                                <div class="invalid-feedback">
                                    Valid subject is required.
                                </div>
                            </div> --}}
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
                <div class="modal-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Importer</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                </div>

                <!-- Modal Footer -->

            </div>
        </div>
    </div>
    <!--  -->


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Définir la configuration pour ce fichier
            setTableConfig({
                'Genre': 4,
                'Classe': 8
            });


            setTableId('#etudiantTable');
            searchTable('#etudiantTable tbody', 'searchInput', 'noResults');
            paginateTable('#etudiantTable');
        });
    </script>


    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#role_id').select2({
                placeholder: "",
                allowClear: true,
                width: '100%',
                minimumResultsForSearch: Infinity
            });




        });
    </script>

    <style>
        .invalid-feedback {
            display: block;
            /* Assurez-vous que les messages d'erreur sont visibles */
            color: #dc3545;
            /* Typiquement utilisé pour les messages d'erreur */
        }

        .is-invalid {
            border: 1px solid red;
        }

        .is-valid {
            border: 1px solid green;
        }
    </style>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#quickForm').validate({
                onkeyup: function(element) {
                    $(element).valid();
                },
                onfocusout: function(element) {
                    $(element).valid();
                },
                rules: {
                    nom: {
                        required: true,
                    },

                    prenom: {
                        required: true,
                    },

                    contact: {
                        required: true,
                    },

                    matricule: {
                        required: true,
                    },

                    datenaiss: {
                        required: true,
                    },

                    email: {
                        email: true,
                        remote: {
                            url: "/verify-email",
                            type: "POST",
                            data: {
                                email: function() {
                                    return $("#email").val();
                                }
                            }
                        }
                    }
                },
                messages: {
                    nom: {
                        required: "Veuillez entrer le nom.",
                    },
                    prenom: {
                        required: "Veuillez entrer le prenom.",
                    },

                    contact: {
                        required: "Veuillez entrer le contact.",
                    },

                    datenaiss: {
                        required: "Veuillez entrer la date de naissance.",
                    },

                    matricule: {
                        required: "Veuillez entrer le matricule.",
                    },

                    email: {
                        email: "Veuillez entrer une adresse e-mail valide.",
                        remote: "Cette adresse e-mail existe déjà."
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    // Utiliser la classe invalid-feedback pour placer le message d'erreur
                    var container = element.siblings('.invalid-feedback');
                    if (container.length) {
                        container.append(error);
                    } else {
                        element.after(error);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });
        });
    </script>


</body>

</html>
