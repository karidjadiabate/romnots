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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{ asset('frontend/dashboard/js/list.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/html/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/lists.css') }}">

    <title>Professeur</title>

</head>

<body>
    <!-- header -->
    @include('admin.include.menu')
    <!-- accueil -->
    <div class="container">
        <div class="printableArea">
            <h2 class="text-start">Liste des enseignants</h2>
            <div class="d-flex justify-content-between align-items-center flex-wrap action-buttons mb-3 no-print">
                <div class="d-flex search-container">
                    <i class="fa fa-search"></i>
                    <input id="searchInput" type="text" id="search" class="form-control search-bar"
                        placeholder="Rechercher...">
                </div>

                <div class="d-flex justify-content-end flex-wrap">
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
                                    onclick="exportTableToExcel('#teacherTable')">Excel</a></li>
                            <li><a class="dropdown-item" id="pdf" href="#"
                                    onclick="exportTableToPDF('#teacherTable')">PDF</a></li>

                        </ul>
                    </div>
                    <button class="btn btn-custom btn-ajouter" data-bs-toggle="modal" data-bs-target="#enseignant"><i
                            class="fa fa-plus"></i> Ajouter un enseignant</button>

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
                                    @foreach ($professeurs as $professeur)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Nom-Matière', '{{ $professeur->nommatieres }}')">
                                                {{ $professeur->nommatieres }}
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
                                    @foreach ($professeurs as $professeur)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="applyFilter('Classe', '{{ $professeur->nomclasses }}')">
                                                {{ $professeur->nomclasses }}
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
                <table id="teacherTable" class="table">
                    <thead class="table-aaa">
                        <tr class="aa">
                            <th>Identifiant</th>
                            <th>Nom et Prénoms</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Adresse</th>
                            <th>Matière</th>
                            <th>Classes</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>&nbsp;&nbsp;
                    <tbody id="teacherTable">
                        @php
                            $num = 1;
                        @endphp

                        @foreach ($professeurs as $professeur)
                            <tr>
                                <td data-label="Identifiant">{{ $num++ }}</td>
                                <td data-label="Nom">
                                @if ($professeur->image)
                                    <img src="{{ asset('storage/profile/' . $professeur->image) }}" alt="User" class="rounded-circle profile-image"
                                    style="width: 40px; height: 35x; margin-top:-5px">
                                @else
                                    <img src="{{ Avatar::create($professeur->nom .' '.$professeur->prenom)->toBase64() }}" alt="User" class="rounded-circle profile-image"
                                    style="width: 40px; height: 35x; margin-top:-5px">
                                @endif

                                {{ $professeur->nom .' '.$professeur->prenom }}</td>
                                <td data-label="Email">{{ $professeur->email }}</td>
                                <td data-label="Contact">{{ $professeur->contact }}</td>
                                <td data-label="Adresse">{{ $professeur->adresse }}</td>
                                <td data-label="Matière">{{ $professeur->nommatieres }}</td>
                                <td data-label="Classes">{{ $professeur->nomclasses }}</td>
                                <td data-label="Action" class="action-icons no-print">
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editTeacher{{ $professeur->id }}"
                                        data-id="{{ $professeur->id }}" data-nom="{{ $professeur->nom }}"
                                        data-prenom="{{ $professeur->prenom }}"
                                        data-email="{{ $professeur->email }}"
                                        data-matiere_id="{{ $professeur->matiere_id }}"
                                        data-selected_classes="{{ $professeur->selected_classes }}" data-adresse="{{ $professeur->adresse }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn  btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteTeacher{{ $professeur->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal de Modification -->
                            <div class="modal fade" id="editTeacher{{ $professeur->id }}" tabindex="-1"
                                aria-labelledby="editTeacherLabel{{ $professeur->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <h1 class="text-center">Modifier</h1>
                                        <form action="{{ route('user.update', $professeur->id) }}" method="POST" enctype="multipart/form-data"
                                            class="needs-validation" novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <!-- Fields for editing teacher details -->
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            id="editNom{{ $professeur->id }}" name="nom"
                                                            placeholder="Nom" value="{{ $professeur->nom }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            id="editPrenom{{ $professeur->id }}" name="prenom"
                                                            placeholder="Prénoms" value="{{ $professeur->prenom }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="email" class="form-control"
                                                            id="editEmail{{ $professeur->id }}" name="email"
                                                            placeholder="Email" value="{{ $professeur->email }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="tel" class="form-control"
                                                            id="editContact{{ $professeur->id }}" name="contact"
                                                            placeholder="Contact" value="{{ $professeur->contact }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    {{--  --}}
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <select name="matiere_id[]" id="matiereselect2"
                                                                class="matiereprof-multiple form-control" multiple>
                                                                @foreach ($matieres as $matiere)
                                                                    <option value="{{ $matiere->id }}"
                                                                        @if (in_array((string) $matiere->id, explode(',', $professeur->matiere_id))) selected @endif>
                                                                        {{ $matiere->nommatiere }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <select class="select2-multiple form-control"
                                                                name="classe_id[]" style="width: 100%"
                                                                id="classeselect2" multiple>
                                                                <option value="">Selectionnez une classe</option>
                                                                @foreach ($classes as $classe)
                                                                    <option value="{{ $classe->id }}"
                                                                        @if (in_array($classe->id, json_decode($professeur->selected_classes))) selected @endif>
                                                                        {{ $classe->nomclasse }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            id="adresse{{ $professeur->id }}" name="adresse"
                                                            placeholder="Adresse"
                                                            value="{{ $professeur->adresse }}" required>
                                                        <div class="invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <input type="file" class="form-control"
                                                            id="file{{ $professeur->id }}" name="file"
                                                            value="{{ $professeur->image }}" required>
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
                            <div class="modal fade" id="deleteTeacher{{ $professeur->id }}" tabindex="-1"
                                aria-labelledby="deleteTeacherLabel{{ $professeur->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('frontend/dashboard/images/images.png') }}"
                                                width="50" height="50" alt=""><br><br>
                                            <p id="sure">Êtes-vous sûr?</p>
                                            <p>Supprimer cet enseignant ?</p>
                                        </div>
                                        <div class="d-flex justify-content-around">
                                            <form action="{{ route('user.destroy', $professeur->id) }}"
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
                    <select id="rowsPerPageSelect" data-table-id="#teacherTable">
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
    <div class="modal fade" id="enseignant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->

                <!-- Modal Body -->
                <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i> <!-- Font Awesome close icon -->
                </button>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" id="quickForm" method="POST" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row g-3">
                            <!-- Fields for adding teacher details -->
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
                                    placeholder="Email" value="" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" value="" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="2">Professeur</option>
                                </select>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="adresse" name="adresse"
                                        placeholder="Adresse" value="" required>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="matiere_id[]" id="matiereselect3"
                                        class="matiereprof-multiple form-control" multiple>
                                        @foreach ($matieres as $matiere)
                                            <option value="{{ $matiere->id }}">{{ $matiere->nommatiere }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="select2-multiple form-control" name="classe_id[]"
                                        style="width: 100%" id="classeselect3" multiple>
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id }}">{{ $classe->nomclasse }}</option>
                                        @endforeach
                                        <div class="invalid-feedback">
                                        </div>
                                    </select>

                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">Sauvegarder</button>
                                <button type="button" class="btn btn-danger"
                                    data-bs-dismiss="modal">Annuler</button>
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
                'Nom-Matière': 5,
                'Classe': 6
            });
            setTableId('#teacherTable');
            searchTable('#teacherTable tbody', 'searchInput', 'noResults');
            paginateTable('#teacherTable');
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#classeselect2').select2({
                placeholder: "Classes",
                allowClear: true,
            });

            $('#matiereselect2').select2({
                placeholder: "Matière",
                allowClear: true,
            });
            $('#classeselect3').select2({
                placeholder: "Classes",
                allowClear: true,
            });

            $('#matiereselect3').select2({
                placeholder: "Matière",
                allowClear: true,
            });


        });
    </script>

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

                    password: {
                        required: true,
                    },

                    classeselect3: {
                        required: true,
                    },

                    matiere_id: {
                        required: true,
                    },


                    email: {
                        required: true,
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

                    classeselect3: {
                        required: "Veuillez selectionner la ou les classes",
                    },

                    matiere_id: {
                        required: "Veuillez selectionner la ou les matieres",
                    },

                    password: {
                        required: "Veuillez entrer le mot de passe.",
                    },

                    email: {
                        required: "Veuillez entrer une adresse e-mail.",
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
