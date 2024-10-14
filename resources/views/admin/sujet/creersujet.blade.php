<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/html/sujt.css') }}" />
    <script src="{{ asset('frontend/dashboard/html/script.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/html/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/lists.css') }}">

    <title>Sujet</title>
</head>

<body>
    <div class="heade">
        <div class="bleu"></div>
        <div class="bleu-1">
            <div class="bleu-2">
                <!-- <i class="fa-solid fa-circle-chevron-left"></i> -->
                <div class="enfant">
                    <h2>Création de sujet</h2>
                    <hr />
                </div>
            </div>
            <i class="fa-solid fa-circle-xmark fermeture" id="close-modal-btnst"></i>
        </div>

        <!-- Progress bar -->
        <div class="eme">
            <div class="progressbar">
                <div class="progress" id="progress"></div>
                <div class="progress-step progress-step-active">Informations</div>
                <div class="progress-step">Questions</div>
                <div class="progress-step">Finalisation</div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <i class="fa-solid fa-circle-xmark" id="fermetures"></i>
            <h2>Quitter la page</h2>
            <p>Voulez-vous vraiment quitté la page ??</p>
            <div id="cool">
                <input type="submit" value="Valider" class="btn-success">
                <input type="reset" value="Annuler" class="btn-red" id="btn-red">
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (auth()->user()->role_id == 2)
        <form action="{{ route('sujetprofesseur.store') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-step form-step-active">
                <div class="wo">
                    <div class="input-group select-group">
                        <label for="type_sujet_id" class="label">Type de sujet</label>
                        <select name="type_sujet_id" id="type_sujet_id" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Choisissez le type de sujet
                            </option>
                            @foreach ($typessujets as $typessujet)
                                <option value="{{ $typessujet->id }}">{{ $typessujet->libtypesujet }}</option>
                            @endforeach
                        </select>
                        <span class="border"></span>
                    </div>

                    <div class="input-group select-group">
                        <label for="matiere_id" class="label">Matière</label>
                        <select name="matiere_id" id="matiere_id" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionner la matière
                            </option>
                            @if (intval(auth()->user()->role_id) === 5)
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id }}">{{ $matiere->nommatiere }}</option>
                                @endforeach
                            @elseif(intval(auth()->user()->role_id) === 2)
                                @foreach ($professeurMatiere as $matiere)
                                    <option value="{{ $matiere->id }}">{{ $matiere->nommatiere }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="input-group select-group">
                        <label for="filiere_id" class="label">Filière</label>
                        <select name="filiere_id" id="filiere_id" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionnez la Filière
                            </option>
                            @foreach ($listefilieres as $filiere)
                                <option value="{{ $filiere->id }}">{{ $filiere->filiere->nomfiliere }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group select-group">
                        <label for="classe_id" class="label">Classe</label>
                        <select name="classe_id" id="classe_id" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionnez la classe
                            </option>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->id }}">{{ $classe->nomclasse }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group time-group">
                        <label for="time" class="label">Durée</label>
                        <input type="text" name="heure" id="time" class="time-effect-1" placeholder="hh:mm"
                            onfocus="this.type='time'" onblur="this.type='time'" required />
                        <span class="border"></span>
                    </div>

                    <div class="input-group time-group">
                        <label for="consigne" class="label">Consigne</label>
                        <input type="text" name="consigne" id="consigne" class="consigne-effect-1"
                            placeholder="Entrez une Consigne" required />
                        <span class="border"></span>
                    </div>
                </div>

                <div class="">
                    <a href="#" class="btn btn-next width-24 ml-auto" id="btn-next">Suivant</a>
                </div>
            </div>
            </div>

            <div class="form-step">
                <div class="note-container">
                    <span style="font-weight: bold">Note:</span>
                    <input type="number" id="note-input" name="noteprincipale" class="note-value"
                        placeholder="Entrez le nombre total de points *" style="border-radius: 0%" />
                    <a class="valid-nots" id="valid-not-valider"
                        style="pointer-events: none; opacity: 0.5;">Valider</a>
                    <div class="error-message" id="error-message">Le champ ne peut pas être vide.</div>
                </div>
                <div class="btns-group" id="masq" style="margin-top: 10%">
                    <a href="#" id="btn-prec" class="btn-prec">Précédent</a>
                    <a href="#" class="btn-prevs" id="valid-not-suivant"
                        style="pointer-events: none; opacity: 0.5;">Suivant</a>
                </div>


                <div class="frm" style="display: none">


                    <div class="section-container">
                        <div class="sectio-container">
                            >
                            <div class="sa-1">

                            </div>
                        </div>
                    </div>

                    <div class="btns-end">
                        <a href="#" class="Ajouter-section"> <i class="fa-solid fa-circle-plus"></i>Ajouter une
                            section</a>
                    </div>

                    <div class="btns-group">
                        <a href="#" id="btn-prev" class="btn-prev">Précédent</a>
                        <a href="#" id="btn-next" class="btn btn-next width-24">Suivant</a>
                    </div>


                </div>
            </div>


            <div class="form-step">
                <div class="btns-group">
                    <a href="#" id="btn-precs" class="btn-prev">Précédent</a>
                    <button type="submit" class="btn">Terminé</button>
                </div>
            </div>
        </form>
    @elseif(auth()->user()->role_id === 5)
        <form action="{{ route('sujetadmin.store') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-step form-step-active">
                <div class="wo">
                    <div class="input-group select-group">
                        <label for="type_sujet_id" class="label">Type de sujet</label>
                        <select name="type_sujet_id" id="type_sujet_id" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Choisissez le type de sujet
                            </option>
                            @foreach ($typessujets as $typessujet)
                                <option value="{{ $typessujet->id }}">{{ $typessujet->libtypesujet }}</option>
                            @endforeach
                        </select>
                        <span class="border"></span>
                    </div>

                    <div class="input-group select-group">
                        <label for="matiere_id" class="label">Matière</label>
                        <select name="matiere_id" id="matiere_id" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionner la matière
                            </option>
                            @if (intval(auth()->user()->role_id) === 5)
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id }}">{{ $matiere->nommatiere }}</option>
                                @endforeach
                            @elseif(intval(auth()->user()->role_id) === 2)
                                @foreach ($professeurMatiere as $matiere)
                                    <option value="{{ $matiere->id }}">{{ $matiere->nommatiere }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="input-group select-group">
                        <label for="filiere_id" class="label">Filière</label>
                        <select name="filiere_id" id="filiere_id" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionnez la Filière
                            </option>
                            @foreach ($listefilieres as $filiere)
                                <option value="{{ $filiere->id }}">{{ $filiere->filiere->nomfiliere }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group select-group">
                        <label for="classe_id" class="label">Classe</label>
                        <select name="classe_id" id="classe_id" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionnez la classe
                            </option>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->id }}">{{ $classe->nomclasse }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group time-group">
                        <label for="time" class="label">Durée</label>
                        <input type="text" name="heure" id="time" class="time-effect-1"
                            placeholder="hh:mm" onfocus="this.type='time'" onblur="this.type='time'" required />
                        <span class="border"></span>
                    </div>

                    <div class="input-group time-group">
                        <label for="consigne" class="label">Consigne</label>
                        <input type="text" name="consigne" id="consigne" class="consigne-effect-1"
                            placeholder="Entrez une Consigne" required />
                        <span class="border"></span>
                    </div>
                </div>

                <div class="">
                    <a href="#" class="btn btn-next width-24 ml-auto" id="btn-next">Suivant</a>
                </div>
            </div>


            <div class="form-step">
                <div class="note-container">
                    <span style="font-weight: bold">Note:</span>
                    <input type="number" id="note-input" name="noteprincipale" class="note-value"
                        placeholder="Entrez le nombre total de points *" style="border-radius: 0%" />
                    <a class="valid-nots" id="valid-not-valider"
                        style="pointer-events: none; opacity: 0.5;">Valider</a>
                    <div class="error-message" id="error-message">Le champ ne peut pas être vide.</div>
                </div>
                <div class="btns-group" id="masq" style="margin-top: 10%">
                    <a href="#" id="btn-prec" class="btn-prev">Précédent</a>
                    <a href="#" class="btn-prevs" id="valid-not-suivant"
                        style="pointer-events: none; opacity: 0.5;">Suivant</a>
                </div>



                <div class="frm" style="display: none">

                    <div class="section-container">
                        <div class="sectio-container">
                            <div class="sa-1">
                            </div>
                        </div>
                    </div>

                    <div class="btns-end">
                        <a href="#" class="Ajouter-section"> <i class="fa-solid fa-circle-plus"></i>Ajouter une
                            section</a>
                    </div>

                    <div class="btns-group">
                        <a href="#" id="btn-prev" class="btn-prev">Précédent</a>
                        <a href="#" id="btn-nexts" class="btn btn-next width-24">Suivant</a>
                    </div>
                </div>

            </div>
            <div class="form-step">
                <div class="btns-group">
                    <a href="#" id="btn-precs" class="btn-prev">Précédent</a>
                    <button type="submit" class="btn">Terminé</button>
                </div>
            </div>
        </form>

    @endif

    <script>
        let isModified = false;

        var inputField = document.querySelector('.note-value');
        var validerBtn = document.getElementById('valid-not-valider');
        var suivantBtn = document.getElementById('valid-not-suivant');

        var frm = document.querySelector('.frm');
        var masqDiv = document.getElementById('masq');
        var noteInput = document.getElementById('note-input');

        inputField.addEventListener('input', function() {
            if (inputField.value.trim() !== '') {
                validerBtn.style.pointerEvents = "auto";
                validerBtn.style.opacity = "1";
            } else {
                validerBtn.style.pointerEvents = "none";
                validerBtn.style.opacity = "0.5";
                validerBtn.style.backgroundColor = "#C5C5C6";
            }
        });

        validerBtn.addEventListener('click', function(event) {
            event.preventDefault();
            if (inputField.value.trim() === '') {
                document.getElementById('error-message').style.display = 'block';
                inputField.focus();
            } else {
                document.getElementById('error-message').style.display = 'none';
                suivantBtn.style.pointerEvents = "auto";
                suivantBtn.style.opacity = "1";
            }
        });

        suivantBtn.addEventListener('click', function(event) {
            event.preventDefault();
            var noteValue = inputField.value;

            if (frm) {
                frm.style.display = "block";

                if (masqDiv) {
                    masqDiv.style.display = "none";
                }

                var frmNoteInput = frm.querySelector('.note-value');
                if (frmNoteInput) {
                    frmNoteInput.value = noteValue;
                }

                var frmValiderButton = document.getElementById('valid-not-valider');
                if (frmValiderButton) {
                    frmValiderButton.classList.add("edit-button");
                    frmValiderButton.id = 'edit-buttons';
                    frmValiderButton.innerHTML =
                        '<i class="fa-solid fa-pen-to-square" id="square" ></i>';

                    frmValiderButton.addEventListener("click", function() {
                        frmNoteInput.disabled = false;
                        frmNoteInput.focus();
                        isModified = true;
                    });
                }
                var noteInput = document.getElementById('note-input');
                noteInput.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            }
        });

        document.querySelector("form").addEventListener("submit", function(event) {

        });




        const counters = {
            section: 0,
            file: 0,
            image: 0,
            response: 0

        };

        function attachFileInputEvents(sectionOrQuestion) {
            const fileInputs = sectionOrQuestion.querySelectorAll('.sa .file-input');

            fileInputs.forEach(function(fileInput) {
                const inputGroup = fileInput.closest('.input-with-icon');

                if (!inputGroup) {
                    console.error('input-with-icon introuvable pour:', fileInput);
                    return;
                }

                const textInput = inputGroup.querySelector('input[type="text"]');
                const previewImage = inputGroup.querySelector('img');

                if (!textInput || !previewImage) {
                    console.error('Input de texte ou image introuvable pour:', fileInput);
                    return;
                }

                const closeButton = document.createElement('span');
                closeButton.innerHTML = '&times;';
                closeButton.style.position = 'absolute';
                closeButton.style.top = '10%';
                closeButton.style.left = '90px';
                closeButton.style.transform = 'translate(-45%,-45%)';
                closeButton.style.backgroundColor = '#4A41C5';
                closeButton.style.color = '#fff';
                closeButton.style.borderRadius = '50%';
                closeButton.style.fontSize = '18px';
                closeButton.style.cursor = 'pointer';
                closeButton.style.width = '20px';
                closeButton.style.height = '20px';
                closeButton.style.display = 'none';
                closeButton.style.textAlign = 'center';
                closeButton.style.lineHeight = '20px';

                inputGroup.style.position = 'relative';
                inputGroup.appendChild(closeButton);

                fileInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            previewImage.src = event.target.result;
                            previewImage.style.display = 'block';
                            closeButton.style.display = 'block';
                            textInput.style.paddingLeft = '110px';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewImage.src = '';
                        previewImage.style.display = 'none';
                        closeButton.style.display = 'none';
                        textInput.style.paddingLeft = '10px';
                    }
                });

                closeButton.addEventListener('click', function() {
                    fileInput.value = '';
                    previewImage.src = '';
                    previewImage.style.display = 'none';
                    closeButton.style.display = 'none';
                    textInput.style.paddingLeft = '10px';
                });
            });
        };


        function attachFileInputWithTextEvents(ParentElement) {
            const fileInputs = ParentElement.querySelectorAll('.file-inputa .file-input'); // Cibler les input file

            fileInputs.forEach(function(fileInput) {
                const inputGroup = fileInput.closest('.display-1'); // Trouver le conteneur parent

                if (!inputGroup) {
                    console.error('input-with-icon introuvable pour:', fileInput);
                    return;
                }

                const textarea = inputGroup.querySelector('textarea'); // Cibler la textarea
                const previewImage = inputGroup.querySelector('img'); // Cibler l'image pour la prévisualisation

                if (!textarea || !previewImage) {
                    console.error('Textarea ou image introuvable pour:', fileInput);
                    return;
                }

                // Créer le bouton "close" pour supprimer l'image
                const closeButton = document.createElement('span');
                closeButton.innerHTML = '&times;';
                closeButton.style.position = 'absolute';
                closeButton.style.top = '10%';
                closeButton.style.left = '90px';
                closeButton.style.transform = 'translate(-45%,-45%)';
                closeButton.style.backgroundColor = '#4A41C5';
                closeButton.style.color = '#fff';
                closeButton.style.borderRadius = '50%';
                closeButton.style.fontSize = '18px';
                closeButton.style.cursor = 'pointer';
                closeButton.style.width = '20px';
                closeButton.style.height = '20px';
                closeButton.style.display = 'none';
                closeButton.style.textAlign = 'center';
                closeButton.style.lineHeight = '20px';

                // Ajouter le bouton "close" au conteneur d'image
                inputGroup.style.position = 'relative';
                inputGroup.appendChild(closeButton);

                // Gérer le changement de fichier et afficher l'image avant le texte
                fileInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            previewImage.src = event.target.result;
                            previewImage.style.display = 'block';
                            closeButton.style.display = 'block';
                            textarea.style.paddingLeft = '110px'; // Ajuster le padding de la textarea
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewImage.src = '';
                        previewImage.style.display = 'none';
                        closeButton.style.display = 'none';
                        textarea.style.paddingLeft = '10px'; // Réinitialiser le padding
                    }
                });

                // Gérer la réinitialisation via le bouton "close"
                closeButton.addEventListener('click', function() {
                    fileInput.value = ''; // Réinitialiser l'input file
                    previewImage.src = ''; // Vider l'image
                    previewImage.style.display = 'none'; // Cacher l'image
                    closeButton.style.display = 'none'; // Cacher le bouton "close"
                    textarea.style.paddingLeft = '10px'; // Réinitialiser le padding
                });
            });
        }




        // Fonction pour ajouter une nouvelle section
        function addSection() {
            counters.section++; // Incrémente le compteur de sections
            counters.file++;
            const sectionsContainer = document.querySelector(".section-container");
            const newSection = document.createElement('div');
            newSection.className = 'section';
            newSection.setAttribute('data-section-index', counters.section - 1);
            newSection.innerHTML = `
    <div class="sa">
        <i class="fa-solid fa-x delete-questionnaires"></i>
        <div class="input-group">
            <input type="text" id="section-title-${counters.section}" name="sections[${counters.section - 1}][titre]" placeholder="Sous titre ${counters.section}" required />
        </div>
        <div class="input-group input-with-icon">
            <input type="text" id="section-soustitre-${counters.section}" name="sections[${counters.section - 1}][soustitre]" placeholder="Libellé de section ${counters.section}" required />
            <label for="file-input-${counters.file}" class="icon-label"><i class="fa-regular fa-image"></i></label>
            <input type="file" class="file-input" id="file-input-${counters.file}" data-preview="image-preview-${counters.file}" name="sections[${counters.section - 1}][image]" style="display: none" />
            <img id="image-preview-${counters.file}" alt="" style="max-width: 100px; display: none;" />
        </div>
    </div>
    <div class="section-container">
        <div class="sectio-container">
            <div class="btnas-end"></div>
            <div class="sa-1">
                <div class="questionnaire-container">
                    <div class="input-group">
                        <div class="questionnaire">
                            <div class="input-group">
                                <div class="display-1">
                                    <div class="textarea">
                                        <textarea id="question-${counters.section}-0" name="sections[${counters.section - 1}][questions][0][libquestion]" required placeholder="Question 1"></textarea>
                                    </div>
                                    <div class="file-inputa">
                                        <div class="eme">
                                            <label for="fileinputs-${counters.file}"><i class="fa-regular fa-image"></i></label>
                                            <input type="file" id="fileinputs-${counters.file}" class="file-input" data-preview="imagepreviews-${counters.file}" name="sections[${counters.section - 1}][questions][0][image]" style="display: none;">
                                            <img id="imagepreviews-${counters.file}" alt="" style="max-width: 100px; display: none;" />
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-xmark deletes delete-questionnaire"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <ol class="circle-list">
                                    <li>
                                        <input type="text" class="heckbox-reponce" id="reponse-${counters.section}-0" name="sections[${counters.section - 1}][questions][0][reponses][0][libreponse]" required placeholder="Réponse 1" />

                                        <select name="sections[${counters.section - 1}][questions][0][reponses][0][result]" id="select-${counters.file}" class="Select">
                                            <option value="" disabled selected hidden> Résultat </option>
                                            <option value="bonne_reponse" class="green" data-target="1">Bonne réponse</option>
                                            <option value="mauvaise_reponse" class="yellow" data-target="2">Mauvaise réponse</option>
                                            <option value="mauvaise_reponse-" class="red" data-target="3">Mauvaise réponse(-)</option>
                                        </select>
                                        <input type="number" id="points-${counters.file}" class="point" name="sections[${counters.section - 1}][questions][0][reponses][0][points]" required placeholder="Note" />
                                        <i class="fa-regular fa-trash-can delete delete-btn"></i>
                                    </li>
                                </ol>
                                <a class="add-response" href="#"><input type="radio" />
                                    <p>Ajouter une autre proposition de réponse ou <span id="ajouts">ajouter '' Autre ''</span></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="Ajouter-question"><i class="fa-solid fa-circle-plus"></i> Ajouter une question</a>
            </div>
        </div>
    </div>`;

            sectionsContainer.appendChild(newSection);

            // Attacher les événements à toutes les réponses par défaut
            const defaultResponses = newSection.querySelectorAll('.circle-list li');
            defaultResponses.forEach((response) => {
                attachSelectChangeEvent(response); // Attache les événements de sélection
            });

            // Attacher les autres événements
            attachFileInputEvents(newSection);
            attachFileInputWithTextEvents(newSection);
            attachAllEvents(newSection);
        }

        // Fonction pour ajouter une nouvelle réponse avec une image unique




        function addQuestion(section) {
            const questionIndex = section.querySelectorAll('.questionnaire').length;
            const uniqueFileInputId = `fileinputs-${counters.file}-${questionIndex}`;
            const uniqueImagePreviewId = `imagepreviews-${counters.file}-${questionIndex}`;

            const newQuestion = document.createElement('div');
            newQuestion.className = 'questionnaire';
            newQuestion.innerHTML = `
    <div class="input-group">
        <div class="display-1">
            <div class="textarea">
                <textarea name="sections[${section.getAttribute('data-section-index')}][questions][${questionIndex}][libquestion]" required placeholder="Question ${questionIndex + 1}"></textarea>
            </div>
            <div class="file-inputa">
                <div class="eme">
                    <label for="${uniqueFileInputId}"><i class="fa-regular fa-image"></i></label>
                    <input type="file" id="${uniqueFileInputId}" class="file-input" data-preview="${uniqueImagePreviewId}" name="sections[${section.getAttribute('data-section-index')}][questions][${questionIndex}][image]" style="display: none;">
                    <img id="${uniqueImagePreviewId}" alt="" style="max-width: 100px; display: none;" />
                </div>
                <div>
                    <i class="fa-solid fa-xmark deletes delete-questionnaire"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group">
        <ol class="circle-list">
            <li>
                <input type="text" class="heckbox-reponce" id="reponse-${questionIndex}-1" name="sections[${section.getAttribute('data-section-index')}][questions][${questionIndex}][reponses][0][libreponse]" required placeholder="Réponse 1" />

                <input type="file" id="imagine-${questionIndex}" class="file-input"  name="" style="display: none" />

                <select name="sections[${section.getAttribute('data-section-index')}][questions][${questionIndex}][reponses][0][result]" id="mySelect-${questionIndex}" class="Select">
                    <option value="" disabled selected hidden> Résultat </option>
                    <option value="bonne_reponse" class="green" data-target="1"> Bonne réponse</option>
                    <option value="mauvaise_reponse" class="yellow" data-target="2">Mauvaise réponse</option>
                    <option value="mauvaise_reponse-" class="red" data-target="3"> Mauvaise réponse(-)</option>
                </select>
                <input type="number" class="point" name="sections[${section.getAttribute('data-section-index')}][questions][${questionIndex}][reponses][0][points]" required placeholder="Note" />
                <i class="fa-regular fa-trash-can delete delete-btn"></i>
            </li>
        </ol>
        <a class="add-response" href="#"><input type="radio" />
            <p>Ajouter une autre proposition de réponse ou <span id="ajouts">ajouter '' Autre ''</span></p>
        </a>
    </div>
    `;

            const spacer = document.createElement('div');
            spacer.className = 'question-separator';
            section.querySelector('.questionnaire-container').appendChild(spacer);

            // Ajouter la nouvelle question au conteneur
            section.querySelector('.questionnaire-container').appendChild(newQuestion);
            attachFileInputWithTextEvents(newQuestion);
            attachSelectChangeEvent(newQuestion);
            attachAllEvents(newQuestion);
            reindexSections();
            counters.file++;
        }


        function addNewResponse(sectionElement) {
            const questionIndex = sectionElement.getAttribute('data-section-index');
            const responseList = sectionElement.querySelector('.circle-list');
            const responseIndex = responseList.children.length;

            // Générez des identifiants uniques pour les inputs d'image


            // Crée une nouvelle réponse
            const newResponse = document.createElement('li');
            newResponse.innerHTML = `
        <input type="text" class="heckbox-reponce" name="sections[${questionIndex}][questions][0][reponses][${responseIndex}][libreponse]" placeholder="Réponse ${responseIndex + 1}" required />
        <select name="sections[${questionIndex}][questions][0][reponses][${responseIndex}][result]" class="Select">
            <option value="" disabled selected hidden> Résultat </option>
            <option value="bonne_reponse" class="green" data-target="1">Bonne réponse</option>
            <option value="mauvaise_reponse" class="yellow" data-target="2">Mauvaise réponse</option>
            <option value="mauvaise_reponse-" class="red" data-target="3">Mauvaise réponse(-)</option>
        </select>
        <input type="number" class="point" name="sections[${questionIndex}][questions][0][reponses][${responseIndex}][points]" placeholder="Note" required />
        <i class="fa-regular fa-trash-can delete delete-btn"></i>
    `;

            // Ajout de la nouvelle réponse à la liste des réponses
            responseList.appendChild(newResponse);
            attachSelectChangeEvent(newResponse); // Gérer les événements pour les réponses
            attachDeleteEvent(newResponse);
            reindexSections();
            counters.file++;
        }


        // Fonction pour gérer les changements de couleur et de notes en fonction de la sélection
        function attachSelectChangeEvent(responseElement) {
            const select = responseElement.querySelector('.Select');
            const noteInput = responseElement.querySelector('.point');

            select.addEventListener('change', function() {
                const selectedOption = select.options[select.selectedIndex];

                // Réinitialiser les styles
                select.classList.remove('green', 'yellow', 'red');
                noteInput.style.border = '1px solid #ccc';
                noteInput.style.color = '';
                noteInput.disabled = false;
                noteInput.value = '';

                if (selectedOption.classList.contains('green')) {
                    select.classList.add('green');
                    noteInput.style.border = '2px solid #38B293';
                    noteInput.style.color = '#38B293';
                } else if (selectedOption.classList.contains('yellow')) {
                    select.classList.add('yellow');
                    noteInput.style.border = '2px solid #FFCC00';
                    noteInput.style.color = '#FFCC00';
                    noteInput.value = 0;
                    noteInput.disabled = true;
                } else if (selectedOption.classList.contains('red')) {
                    select.classList.add('red');
                    noteInput.style.border = '2px solid #FF0000';
                    noteInput.style.color = '#FF0000';

                }
            });


        }

        // Fonction pour gérer les prévisualisations d'images
        function handleImagePreview(input, preview) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }

        // Fonction pour attacher des événements à chaque section/question
        function attachAllEvents(sectionOrQuestion) {
            const deleteBtn = sectionOrQuestion.querySelector('.delete-questionnaires');
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function() {
                    sectionOrQuestion.remove(); // Supprime la section
                    reindexSections(); // Réindexe les sections restantes
                    counters.section = document.querySelectorAll('.section').length; // Mise à jour du compteur
                });
            }


            // Attacher un événement pour le bouton "Ajouter question"
            const addQuestionBtn = sectionOrQuestion.querySelector('.Ajouter-question');
            if (addQuestionBtn) {
                addQuestionBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    addQuestion(sectionOrQuestion); // Ajoute une nouvelle question à la section
                });
            }
            const addResponseBtn = sectionOrQuestion.querySelector('.add-response');
            if (addResponseBtn) {
                addResponseBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    addNewResponse(sectionOrQuestion);
                });
            }

            const deleteQuestionBtn = sectionOrQuestion.querySelector('.delete-questionnaire');
            if (deleteQuestionBtn) {
                deleteQuestionBtn.addEventListener('click', function() {
                    // Trouver le séparateur juste avant la question (si présent)
                    const separator = sectionOrQuestion.previousElementSibling;
                    if (separator && separator.classList.contains('question-separator')) {
                        separator.remove(); // Supprimer le séparateur
                    }

                    sectionOrQuestion.remove();
                    reindexSections(); // Supprimer la question
                });
            }
        }

        function attachDeleteEvent(element) {
            const deleteButton = element.querySelector('.delete-btn');
            if (deleteButton) {
                deleteButton.addEventListener('click', function() {
                    element.remove();
                    reindexSections(); // Supprimer l'élément
                });
            }
        }


        // Événement pour le bouton "Ajouter section"
        document.querySelector(".Ajouter-section")?.addEventListener("click", function(event) {
            event.preventDefault();
            addSection(); // Ajoute une nouvelle section
        });

        // Attacher la section par défaut lors du chargement de la page
        document.addEventListener("DOMContentLoaded", function() {
            addSection(); //
        });

        // Réindexation des sections, questions et réponses
        function reindexSections() {
            const sections = document.querySelectorAll(".section");

            sections.forEach((section, sectionIndex) => {
                // Met à jour l'attribut data-section-index
                section.setAttribute('data-section-index', sectionIndex);

                // Mise à jour du placeholder du titre et du sous-titre
                const titleInput = section.querySelector('input[name^="sections"]');
                if (titleInput) {
                    titleInput.placeholder = `Sous titre ${sectionIndex + 1}`;
                    titleInput.name = `sections[${sectionIndex}][titre]`;
                }

                const subTitleInput = section.querySelector('input[name*="soustitre"]');
                if (subTitleInput) {
                    subTitleInput.placeholder = `Libellé de section ${sectionIndex + 1}`;
                    subTitleInput.name = `sections[${sectionIndex}][soustitre]`;
                }

                // Reindexation des questions dans chaque section
                const questions = section.querySelectorAll('.questionnaire');
                questions.forEach((question, questionIndex) => {
                    const questionTextArea = question.querySelector('textarea[name*="libquestion"]');
                    if (questionTextArea) {
                        questionTextArea.placeholder = `Question ${questionIndex + 1}`;
                        questionTextArea.name =
                            `sections[${sectionIndex}][questions][${questionIndex}][libquestion]`;
                    }

                    // Reindexation des réponses dans chaque question
                    const responses = question.querySelectorAll('li');
                    responses.forEach((response, responseIndex) => {
                        const responseInput = response.querySelector('input[name*="libreponse"]');
                        if (responseInput) {
                            responseInput.placeholder = `Réponse ${responseIndex + 1}`;
                            responseInput.name =
                                `sections[${sectionIndex}][questions][${questionIndex}][reponses][${responseIndex}][libreponse]`;
                        }

                        const resultSelect = response.querySelector('select[name*="result"]');
                        if (resultSelect) {
                            resultSelect.name =
                                `sections[${sectionIndex}][questions][${questionIndex}][reponses][${responseIndex}][result]`;
                        }

                        const pointsInput = response.querySelector('input[name*="points"]');
                        if (pointsInput) {
                            pointsInput.name =
                                `sections[${sectionIndex}][questions][${questionIndex}][reponses][${responseIndex}][points]`;
                        }
                    });
                });
            });
        }
    </script>





    {{--  --}} {{--  --}}



    <script></script>



</body>

</html>
