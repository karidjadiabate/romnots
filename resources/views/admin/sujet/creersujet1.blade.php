<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/html/sujt.css') }}" />
    <script src="{{ asset('frontend/dashboard/html/script.js') }}" defer></script>

    <title>Registration Form</title>
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
            <i class="fa-solid fa-circle-xmark fermeture" id="close-modal-btn"></i>
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


    @if (auth()->user()->role_id === 2)
        <form action="{{ route('sujetprofesseur.store') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-step form-step-active">
                <div class="wo">
                    <div class="input-group select-group">
                        <label for="position" class="label">Type de sujet</label>
                        <select name="type_sujet_id" id="position" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Choisissez le type de sujet
                            </option>
                            @foreach ($typessujets as $typessujet)
                                <option value="{{ $typessujet->id }}">{{ $typessujet->libtypesujet }}</option>
                            @endforeach
                        </select>
                        <span class="border"></span>
                        <div class="error-message" id="position-error" style="display: none; color: red;">Veuillez
                            sélectionner un type de sujet.</div>
                    </div>
                    <div class="input-group select-group">
                        <label for="position" class="label">Matière</label>
                        <select name="matiere_id" id="positions" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionner la matière
                            </option>
                            @if (auth()->user()->role_id === 3)
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id }}">{{ $matiere->nommatiere }}</option>
                                @endforeach
                            @elseif(auth()->user()->role_id === 2)
                                @foreach ($professeurMatiere as $matiere)
                                    <option value="{{ $matiere->id }}">{{ $matiere->nommatiere }}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="border"></span>
                        <div class="error-message" id="positions-error" style="display: none; color: red;">Veuillez
                            sélectionner une matière.</div>
                    </div>
                    <div class="input-group select-group">
                        <label for="position" class="label">Filière</label>
                        <select name="filiere_id" id="positions1" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionnez la Filière
                            </option>
                            @foreach ($filieres as $filiere)
                                <option value="{{ $filiere->id }}">{{ $filiere->nomfiliere }}</option>
                            @endforeach
                        </select>
                        <span class="border"></span>
                        <div class="error-message" id="positions1-error" style="display: none; color: red;">Veuillez
                            sélectionner une filière.</div>
                    </div>
                    <div class="input-group select-group">
                        <label for="position" class="label">Classe</label>
                        <select name="classe_id" id="positions2" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionnez la classe
                            </option>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->id }}">{{ $classe->nomclasse }}</option>
                            @endforeach
                        </select>
                        <span class="border"></span>
                        <div class="error-message" id="positions2-error" style="display: none; color: red;">Veuillez
                            sélectionner une classe.</div>
                    </div>
                    <div class="input-group time-group">
                        <label for="time" class="label">Durée</label>
                        <input type="text" name="heure" id="time" class="time-effect-1" placeholder="hh:mm"
                            onfocus="this.type='time'" onblur="this.type='time'" required />
                        <span class="border"></span>
                    </div>
                </div>

                <div class="">
                    <a href="#" class="btn btn-next width-24 ml-auto" id="suivants">Suivant</a>
                </div>
            </div>

            <div class="form-step">
                <div class="note-container">
                    <span>Note:</span>
                    <input type="text" name="noteprincipale" class="note-value"
                        placeholder="Entrez le nombre total de points *" />
                    <a class="valid-not">Valider</a>
                    <div class="error-message" id="error-message">Le champ ne peut pas être vide.</div>
                </div>

                <div class="frm" style="display: none">
                    <div class="sa">
                        <div class="btnas-ends">
                            <i class="fa-solid fa-x delete-questionnaires"></i>
                        </div>
                        <div class="input-group">
                            <input type="text" name="sections[0][titre]" id="phone"
                                placeholder="Sous titre 1" required />
                        </div>
                        <div class="input-group input-with-icon">
                            <input type="text" name="sections[0][soustitre]" id="preview"
                                placeholder="Libellé du sous titre" required />
                            <label for="file-input" class="icon-label"><i class="fa-regular fa-image"></i></label>
                            <input type="file" id="file-input" class="file-input" data-preview="image-preview"
                                data-result="preview" name="" style="display: none" />
                            <img id="image-preview" alt="Aperçu de l'image" />

                        </div>
                    </div>

                    <div class="section-container">
                        <div class="sectio-container">
                            <div class="btnas-end">
                                <!-- <i class="fa-solid fa-x delete-section"></i> -->
                            </div>
                            <div class="sa-1">
                                <div class="questionnaire-container">
                                    <div class="input-group">
                                        <div class="questionnaire">
                                            <div class="input-group">
                                                <div class="display-1">
                                                    <div class="textarea">
                                                        <textarea name="sections[0][questions][0][libquestion]" id="previews" required placeholder="Question"></textarea>
                                                    </div>
                                                    <div class="file-inputa">
                                                        <div class="eme">
                                                            <label for="fileinputs"><i
                                                                    class="fa-regular fa-image"></i></label>
                                                            <input type="file" id="fileinputs" class="file-input"
                                                                data-preview="imagepreviews" data-result="previews"
                                                                name="" style="display: none" />
                                                            <img id="imagepreviews" alt="Aperçu de l'image" />

                                                        </div>
                                                        <div>
                                                            <i
                                                                class="fa-solid fa-xmark deletes delete-questionnaire"></i>
                                                        </div>
                                                        <!-- <i class="fa-solid fa-x  delete-section"></i> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <ol class="circle-list">
                                                    <li>
                                                        <input type="text" class="heckbox-reponce" id="checkbox1"
                                                            name="sections[0][questions][0][reponses][0][libreponse]"
                                                            required placeholder="reponse 1" />
                                                        <label for="imagine"><i
                                                                class="fa-regular fa-image"></i></label>
                                                        <input type="file" id="imagine" class="file-input"
                                                            data-preview="imaginations" name=""
                                                            style="display: none" />
                                                        <img id="imaginations" class="img" alt="" />
                                                        <select name="sections[0][questions][0][reponses][0][result]"
                                                            id="mySelect" class="Select">
                                                            <option value="" disabled selected hidden>
                                                                resultat
                                                            </option>
                                                            <option value="bonne_reponse" class="green"
                                                                data-target="1">
                                                                Bonne réponse
                                                            </option>
                                                            <option value="mauvaise_reponse" class="yellow"
                                                                data-target="2">
                                                                Mauvaise réponse
                                                            </option>
                                                            <option value="mauvaise_reponse-" class="red"
                                                                data-target="3">
                                                                Mauvaise réponse(-)
                                                            </option>
                                                        </select>
                                                        <input type="number" id="point" class="point"
                                                            name="sections[0][questions][0][reponses][0][points]"
                                                            required placeholder="not 1" />
                                                        <i class="fa-regular fa-trash-can delete delete-btn"></i>
                                                    </li>
                                                </ol>
                                                <a class="add-response" href="#"><input type="radio" />
                                                    <p>
                                                        Ajouter une autre proposition de réponse ou
                                                        <span>ajouter '' Autre ''</span>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="Ajouter-question"><i
                                        class="fa-solid fa-circle-plus"></i>Ajouter une
                                    question</a>
                            </div>
                        </div>
                    </div>

                    <div class="btns-end">
                        <a href="#" class="Ajouter-section"> <i class="fa-solid fa-circle-plus"></i>Ajouter une
                            section</a>
                    </div>

                    <div class="btns-group">
                        <a href="#" class="btn-prev">Précédent</a>
                        <a href="#" class="btn btn-next width-24">Suivant</a>
                    </div>
                </div>
            </div>
            <div class="form-step">
                <div class="btns-group">
                    <a href="#" class="btn-prev">Précédent</a>
                    <button type="submit" class="btn">Terminé</button>
                </div>
            </div>
        </form>
    @elseif(auth()->user()->role_id === 3)
        <form action="{{ route('sujetadmin.store') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-step form-step-active">
                <div class="wo">
                    <div class="input-group select-group">
                        <label for="position" class="label">Type de sujet</label>
                        <select name="type_sujet_id" id="position" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Choisissez le type de sujet
                            </option>
                            @foreach ($typessujets as $typessujet)
                                <option value="{{ $typessujet->id }}">{{ $typessujet->libtypesujet }}</option>
                            @endforeach
                        </select>
                        <span class="border"></span>
                        <div class="error-message" id="position-error" style="display: none; color: red;">Veuillez
                            sélectionner un type de sujet.</div>
                    </div>
                    <div class="input-group select-group">
                        <label for="position" class="label">Matière</label>
                        <select name="matiere_id" id="positions" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionner la matière
                            </option>
                            @if (auth()->user()->role_id === 3)
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id }}">{{ $matiere->nommatiere }}</option>
                                @endforeach
                            @elseif(auth()->user()->role_id === 2)
                                @foreach ($professeurMatiere as $matiere)
                                    <option value="{{ $matiere->id }}">{{ $matiere->nommatiere }}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="border"></span>
                        <div class="error-message" id="positions-error" style="display: none; color: red;">Veuillez
                            sélectionner une matière.</div>
                    </div>
                    <div class="input-group select-group">
                        <label for="position" class="label">Filière</label>
                        <select name="filiere_id" id="positions1" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionnez la Filière
                            </option>
                            @foreach ($filieres as $filiere)
                                <option value="{{ $filiere->id }}">{{ $filiere->nomfiliere }}</option>
                            @endforeach
                        </select>
                        <span class="border"></span>
                        <div class="error-message" id="positions1-error" style="display: none; color: red;">Veuillez
                            sélectionner une filière.</div>
                    </div>
                    <div class="input-group select-group">
                        <label for="position" class="label">Classe</label>
                        <select name="classe_id" id="positions2" class="select-effect-1" required>
                            <option value="" disabled selected hidden>
                                Sélectionnez la classe
                            </option>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->id }}">{{ $classe->nomclasse }}</option>
                            @endforeach
                        </select>
                        <span class="border"></span>
                        <div class="error-message" id="positions2-error" style="display: none; color: red;">Veuillez
                            sélectionner une classe.</div>
                    </div>
                    <div class="input-group time-group">
                        <label for="time" class="label">Durée</label>
                        <input type="text" name="heure" id="time" class="time-effect-1"
                            placeholder="hh:mm" onfocus="this.type='time'" onblur="this.type='time'" required />
                        <span class="border"></span>
                    </div>
                </div>

                <div class="">
                    <a href="#" class="btn btn-next width-24 ml-auto" id="suivants">Suivant</a>
                </div>
            </div>

            <div class="form-step">
                <div class="note-container">
                    <span>Note:</span>
                    <input type="text" name="noteprincipale" class="note-value"
                        placeholder="Entrez le nombre total de points *" />
                    <a class="valid-not">Valider</a>
                    <div class="error-message" id="error-message">Le champ ne peut pas être vide.</div>
                </div>

                <div class="frm" style="display: none">
                    <div class="sa">
                        <div class="btnas-ends">
                            <i class="fa-solid fa-x delete-questionnaires"></i>
                        </div>
                        <div class="input-group">
                            <input type="text" name="sections[0][titre]" id="phone"
                                placeholder="Sous titre 1" required />
                        </div>
                        <div class="input-group input-with-icon">
                            <input type="text" name="sections[0][soustitre]" id="preview"
                                placeholder="Libellé du sous titre" required />
                            <label for="file-input" class="icon-label"><i class="fa-regular fa-image"></i></label>
                            <input type="file" id="file-input" class="file-input" data-preview="image-preview"
                                data-result="preview" name="" style="display: none" />
                            <img id="image-preview" alt="Aperçu de l'image" />

                        </div>
                    </div>

                    <div class="section-container">
                        <div class="sectio-container">
                            <div class="btnas-end">
                                <!-- <i class="fa-solid fa-x delete-section"></i> -->
                            </div>
                            <div class="sa-1">
                                <div class="questionnaire-container">
                                    <div class="input-group">
                                        <div class="questionnaire">
                                            <div class="input-group">
                                                <div class="display-1">
                                                    <div class="textarea">
                                                        <textarea name="sections[0][questions][0][libquestion]" id="previews" required placeholder="Question"></textarea>
                                                    </div>
                                                    <div class="file-inputa">
                                                        <div class="eme">
                                                            <label for="fileinputs"><i
                                                                    class="fa-regular fa-image"></i></label>
                                                            <input type="file" id="fileinputs" class="file-input"
                                                                data-preview="imagepreviews" data-result="previews"
                                                                name="" style="display: none" />
                                                            <img id="imagepreviews" alt="" />

                                                        </div>
                                                        <div>
                                                            <i
                                                                class="fa-solid fa-xmark deletes delete-questionnaire"></i>
                                                        </div>
                                                        <!-- <i class="fa-solid fa-x  delete-section"></i> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <ol class="circle-list">
                                                    <li>
                                                        <input type="text" class="heckbox-reponce" id="checkbox1"
                                                            name="sections[0][questions][0][reponses][0][libreponse]"
                                                            required placeholder="reponse 1" />
                                                        <label for="imagine"><i
                                                                class="fa-regular fa-image"></i></label>
                                                        <input type="file" id="imagine" class="file-input"
                                                            data-preview="imaginations" name=""
                                                            style="display: none" />
                                                        <img id="imaginations" class="img" alt="" />
                                                        <select name="sections[0][questions][0][reponses][0][result]"
                                                            id="mySelect" class="Select">
                                                            <option value="" disabled selected hidden>
                                                                resultat
                                                            </option>
                                                            <option value="bonne_reponse" class="green"
                                                                data-target="1">
                                                                Bonne réponse
                                                            </option>
                                                            <option value="mauvaise_reponse" class="yellow"
                                                                data-target="2">
                                                                Mauvaise réponse
                                                            </option>
                                                            <option value="mauvaise_reponse-" class="red"
                                                                data-target="3">
                                                                Mauvaise réponse(-)
                                                            </option>
                                                        </select>
                                                        <input type="number" id="point" class="point"
                                                            name="sections[0][questions][0][reponses][0][points]"
                                                            required placeholder="not 1" />
                                                        <i class="fa-regular fa-trash-can delete delete-btn"></i>
                                                    </li>
                                                </ol>
                                                <a class="add-response" href="#"><input type="radio" />
                                                    <p>
                                                        Ajouter une autre proposition de réponse ou
                                                        <span>ajouter '' Autre ''</span>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="Ajouter-question"><i
                                        class="fa-solid fa-circle-plus"></i>Ajouter une
                                    question</a>
                            </div>
                        </div>
                    </div>

                    <div class="btns-end">
                        <a href="#" class="Ajouter-section"> <i class="fa-solid fa-circle-plus"></i>Ajouter une
                            section</a>
                    </div>

                    <div class="btns-group">
                        <a href="#" class="btn-prev">Précédent</a>
                        <a href="#" class="btn btn-next width-24">Suivant</a>
                    </div>
                </div>
            </div>
            <div class="form-step">
                <div class="btns-group">
                    <a href="#" class="btn-prev">Précédent</a>
                    <button type="submit" class="btn">Terminé</button>
                </div>
            </div>
        </form>
    @endif
    <script>
        // JavaScript pour ouvrir et fermer le modal
        document.getElementById('close-modal-btn').addEventListener('click', function() {
            document.getElementById('myModal').style.display = 'flex';
        });

        document.getElementById('fermetures').addEventListener('click', function() {
            document.getElementById('myModal').style.display = 'none';
        });
        document.getElementById('btn-red').addEventListener('click', function() {
            document.getElementById('myModal').style.display = 'none';
        });

        // Fermer le modal en cliquant à l'extérieur de la fenêtre
        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('myModal')) {
                document.getElementById('myModal').style.display = 'none';
            }
        });
    </script>
    <script>
        document.querySelector('.valid-not').addEventListener('click', function(event) {
            var input = document.querySelector('.note-value');
            var errorMessage = document.getElementById('error-message');

            if (input.value.trim() === '') {
                event.preventDefault(); // Empêche l'action par défaut (si c'est un lien)
                errorMessage.style.display = 'block'; // Affiche le message d'erreur
                input.focus(); // Focalise sur le champ de texte
            } else {
                errorMessage.style.display = 'none'; // Masque le message d'erreur si le champ n'est pas vide
            }
        });
    </script>

    <script>
        document.body.addEventListener('change', function(event) {
            if (event.target && event.target.classList.contains('file-input')) {
                const file = event.target.files[0];
                const previewId = event.target.getAttribute('data-preview');
                const imagePreview = document.getElementById(previewId);
                const imaginations = event.target.getAttribute('data-result');
                const inpute = document.getElementById(imaginations);

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (imagePreview) {
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = 'block';
                            inpute.style.paddingLeft = '75px'; // Correction ici
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    if (imagePreview) {
                        imagePreview.style.display = 'none';
                    }
                }
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach a single event listener to the container or body
            document.body.addEventListener('click', function(event) {
                // Check if the clicked element is a delete button
                if (event.target && event.target.classList.contains('delete-questionnaires')) {
                    const parentSa = event.target.closest('.sa');
                    if (parentSa) {
                        parentSa.remove();
                        const ajouterQuestionButtone = parentSa.querySelector('.Ajouter-question');
                        if (ajouterQuestionButtone) {
                            ajouterQuestionButtone.remove(); // Supprimer le bouton
                        }
                    }
                }
            });


        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let sectionCounter = 0;
            let questionCounter = 0;
            let responseCounter = 0;
            let imagerevue = 0;
            let imagerevu = 0
            let imageprevu = 0;
            let imageprevus = 0;
            let imagerevue0 = 0;
            let imagerevu0 = 0;
            let imageprevu0 = 0;
            let imageprevus0 = 0;

            function handleSelectChanges(event) {
                const selectElement = event.target;
                const inputElement = selectElement.nextElementSibling;
                const selectedOption = selectElement.options[selectElement.selectedIndex];

                selectElement.classList.remove("yellow", "red", "green");

                if (selectedOption) {
                    if (selectedOption.className) {
                        selectElement.classList.add(selectedOption.className);
                    }

                    if (inputElement) {
                        inputElement.className = "";
                        if (selectedOption.className) {
                            inputElement.classList.add(selectedOption.className);
                        }
                        if (selectedOption.value === "Manager") {
                            inputElement.disabled = true;
                        } else {
                            inputElement.disabled = false;
                        }
                    }
                }
            }

            document.querySelector(".valid-not")?.addEventListener("click", function(event) {
                const input = document.querySelector('.note-value');
                const errorMessage = document.getElementById('error-message');

                if (input.value.trim() === '') {
                    event.preventDefault();
                    errorMessage.style.display = 'block';
                    input.focus();
                } else {
                    errorMessage.style.display = 'none';
                    const noteValue = input.value;

                    const frm = document.querySelector(".frm");
                    if (frm) {
                        frm.style.display = "block";
                        input.disabled = true;
                    }

                    this.classList.remove("valid-not");
                    this.classList.add("edit-button");
                    this.id = 'edit-buttons';
                    this.innerHTML = '<i class="fa-solid fa-pen-to-square" id="square"></i>';

                    document.getElementById('edit-buttons').addEventListener("click", function() {
                        input.disabled = false;
                        input.focus();
                    });
                }
            });

            document.querySelector(".Ajouter-section")?.addEventListener("click", function(event) {
                event.preventDefault();

                const sectionsContainer = document.querySelector(".section-container");
                if (sectionsContainer) {
                    sectionCounter++;
                    const uniqueId = `sectio-container-${sectionCounter}`;

                    const newSections = document.createElement("div");
                    newSections.className = "sa";
                    newSections.innerHTML = `
                <div class="btnas-ends">
                    <i class="fa-solid fa-x delete-questionnaires"></i>
                </div>
                <div class="input-group">
                    <input type="text" name="sections[${sectionCounter}][titre]" id="phone" placeholder="Sous titre ${sectionCounter}" required />
                </div>
                <div class="input-group input-with-icon">
                    <input type="text" name="sections[${sectionCounter}][soustitre]" id="preview" placeholder="Libellé du sous titre" required />
                    <label for="file-input${sectionCounter}" class="icon-label"><i class="fa-regular fa-image"></i></label>
                    <input type="file" class="file-input" id="file-input${sectionCounter}" data-preview="image-preview${sectionCounter}" name="sections[${sectionCounter}][image]" style="display: none" />
                    <img id="image-preview${sectionCounter}" alt="" />
                </div>`;

                    const newSection = document.createElement("div");
                    newSection.className = "sectio-container";
                    newSection.id = uniqueId;
                    newSection.innerHTML = `
                <div class="btnas-end"></div>
                <div class="sa-1">
                    <div class="questionnaire-container" id="section-${sectionCounter}">
                    </div>
                    <a href="#" class="Ajouter-question"><i class="fa-solid fa-circle-plus"></i>Ajouter une question</a>
                </div>`;

                    sectionsContainer.appendChild(newSections);
                    attachAllEvents(newSections);
                    sectionsContainer.appendChild(newSection);
                    attachAllEvents(newSection);
                }
            });
            function attachResponseEvent(sectionElement) {
                const addResponseButton = sectionElement.querySelector(".add-response");
                if (addResponseButton) {
                    addResponseButton.addEventListener("click", function(event) {
                        event.preventDefault();

                        const sectionIndex = sectionElement.closest(".sectio-container").id.split('-')[2];
                        const questionIndex = sectionElement.closest(".questionnaire-container").id.split(
                            '-')[1];

                        const list = sectionElement.querySelector(".circle-list");
                        const responseIndex = list.children.length;

                        const newItem = document.createElement("li");
                        newItem.innerHTML = `
                    <input type="text" class="heckbox-reponce" name="sections[${sectionIndex}][questions][${questionIndex}][reponses][${responseIndex}][libreponse]" placeholder="reponse ${responseIndex + 1}" required />
                    <label for="imagine${responseCounter}"><i class="fa-regular fa-image"></i></label>
                    <input type="file" id="imagine${responseCounter}" class="file-input" data-preview="revange${responseCounter}" name="sections[${sectionIndex}][questions][${questionIndex}][reponses][${responseIndex}][image]" style="display: none" />
                    <img id="revange${responseCounter}" class="img" alt="" />
                    <select name="sections[${sectionIndex}][questions][${questionIndex}][reponses][${responseIndex}][result]" id="responseselect${sectionCounter}${++responseCounter}" class="Select">
                        <option value="" disabled selected hidden>resultat</option>
                        <option value="bonne_reponse" class="green" data-target="">Bonne réponse</option>
                        <option value="mauvaise_reponse" class="yellow" data-target="">Mauvaise réponse</option>
                        <option value="mauvaise_reponse-" class="red" data-target="">Mauvaise réponse(-)</option>
                    </select>
                    <input type="number" class="point" name="sections[${sectionIndex}][questions][${questionIndex}][reponses][${responseIndex}][points]" required placeholder="not ${responseIndex + 1}" />
                    <i class="fa-regular fa-trash-can delete delete-btn"></i>`;

                        list.appendChild(newItem);
                        attachDeleteEvent(newItem);
                        newItem.querySelector('.Select').addEventListener("change", handleSelectChanges);
                    });
                }
            }

            function attachAllEvents(sectionElement) {
                attachResponseEvent(sectionElement);
                attachDeleteEvent(sectionElement);
                attachAddQuestionEvent(sectionElement);
                attachDeleteQuestionnaireEvent(sectionElement);
                attachDeleteSectionEvent(sectionElement);

                sectionElement.querySelectorAll('.Select').forEach(selectElement => {
                    selectElement.addEventListener("change", handleSelectChanges);

                    const initialSelectedOption = selectElement.options[selectElement.selectedIndex];
                    if (initialSelectedOption) {
                        if (initialSelectedOption.className) {
                            selectElement.classList.add(initialSelectedOption.className);
                        }
                        const inputElement = selectElement.nextElementSibling;
                        if (inputElement) {
                            inputElement.className = "";
                            if (initialSelectedOption.className) {
                                inputElement.classList.add(initialSelectedOption.className);
                            }
                            if (initialSelectedOption.value === "Manager") {
                                inputElement.disabled = true;
                            } else {
                                inputElement.disabled = false;
                            }
                        }
                    }
                });
            }



            function attachDeleteEvent(element) {
                const deleteButton = element.querySelector(".delete-btn");
                if (deleteButton) {
                    deleteButton.addEventListener("click", function() {
                        this.closest("li").remove();
                    });
                }
            }

            function attachAddQuestionEvent(sectionElement) {
                const addQuestionButton = sectionElement.querySelector(".Ajouter-question");
                if (addQuestionButton) {
                    addQuestionButton.addEventListener("click", function(event) {
                        event.preventDefault();
                        const sectionIndex = sectionElement.id.split('-')[2];
                        questionCounter++;
                        const questionnaireContainer = sectionElement.querySelector(
                            ".questionnaire-container");
                        if (!questionnaireContainer) return;

                        const spacer = document.createElement("div");
                        spacer.className = "question-separator";

                        const newQuestionnaire = document.createElement("div");
                        newQuestionnaire.className = "input-group";
                        newQuestionnaire.innerHTML = `
                    <div class="questionnaire">
                        <div class="input-group">
                            <div class="display-1">
                                <div class="textarea">
                                    <textarea name="sections[${sectionIndex}][questions][${questionCounter}][libquestion]" id="previews" required placeholder="Question"></textarea>
                                </div>
                                <div class="file-inputa">
                                    <div class="eme">
                                        <label for="fileinputs${imagerevue0++}"><i class="fa-regular fa-image"></i></label>
                                        <input type="file" id="fileinputs${imagerevu0++}" data-preview="imagepreviews${imageprevu0++}" data-result="previews" class="file-input" name="sections[${sectionIndex}][questions][${questionCounter}][image]" style="display: none;">
                                        <img id="imagepreviews${imageprevus0++}" alt="" />
                                    </div>
                                </div>
                                <div>
                                    <i class="fa-solid fa-xmark deletes delete-questionnaire"></i>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <ol class="circle-list">
                                <li>
                                    <input type="text" class="heckbox-reponce" name="sections[${sectionIndex}][questions][${questionCounter}][reponses][0][libreponse]" placeholder="reponse 1" required />
                                    <label for="imagine"><i class="fa-regular fa-image"></i></label>
                                    <input type="file" id="imagine" class="file-input" data-preview="imaginations" name="sections[${sectionIndex}][questions][${questionCounter}][reponses][0][image]" style="display: none" />
                                    <img id="imaginations" class="img" alt="" />
                                    <select name="sections[${sectionIndex}][questions][${questionCounter}][reponses][0][result]" class="Select">
                                        <option value="" disabled selected hidden>resultat</option>
                                        <option value="bonne_reponse" class="green" data-target="1">Bonne réponse</option>
                                        <option value="mauvaise_reponse" class="yellow" data-target="2">Mauvaise réponse</option>
                                        <option value="mauvaise_reponse-" class="red" data-target="3">Mauvaise réponse(-)</option>
                                    </select>
                                    <input type="number" class="point" name="sections[${sectionIndex}][questions][${questionCounter}][reponses][0][points]" required placeholder="not 1" />
                                    <i class="fa-regular fa-trash-can delete delete-btn"></i>
                                </li>
                            </ol>
                            <a class="add-response" href="#"><input type="radio"><p>Ajouter une autre proposition de réponse ou <span>ajouter '' Autre ''</span></p></a>
                        </div>
                    </div>`;

                        questionnaireContainer.appendChild(spacer);
                        questionnaireContainer.appendChild(newQuestionnaire);
                        attachAllEvents(newQuestionnaire);
                    });
                }
            }

            function attachDeleteQuestionnaireEvent(sectionElement) {
                const deleteQuestionnaireButtons = sectionElement.querySelectorAll(".delete-questionnaire");

                deleteQuestionnaireButtons.forEach(function(button) {
                    button.addEventListener("click", function() {
                        const questionnaire = this.closest(".questionnaire");
                        if (questionnaire) {
                            const inputGroup = questionnaire.closest(".input-group");
                            if (inputGroup) {
                                const previousElement = inputGroup.previousElementSibling;
                                if (previousElement && previousElement.classList.contains(
                                        "question-separator")) {
                                    previousElement.remove();
                                }
                                questionnaire.remove();
                                inputGroup.remove();
                            }
                        }
                    });
                });
            }

            function attachDeleteSectionEvent(sectionElement) {
                const deleteSectionButton = sectionElement.querySelector(".delete-section");
                if (deleteSectionButton) {
                    deleteSectionButton.addEventListener("click", function() {
                        this.closest(".sectio-container").remove();
                    });
                }
            }

            function attachDeleteQuestionnaireEvents(sectionElement) {
                const deleteQuestionnaireButtons = sectionElement.querySelectorAll(".delete-questionnaires");
                let firstParentRemoved = false;

                deleteQuestionnaireButtons.forEach(function(button) {
                    button.addEventListener("click", function() {
                        if (!firstParentRemoved) {
                            const parentElement = this.parentElement;
                            if (parentElement) {
                                parentElement.remove();
                                firstParentRemoved = true;
                            }
                        }
                    });
                });
            }

            document.querySelectorAll(".sectio-container").forEach(attachAllEvents);
        });
    </script>
</body>

</html>
