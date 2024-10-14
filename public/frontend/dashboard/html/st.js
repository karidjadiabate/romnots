{/* <script>
// JavaScript pour ouvrir et fermer le modal
document.getElementById('close-modal-btn').addEventListener('click', function () {
    document.getElementById('myModal').style.display = 'flex';
});

document.getElementById('fermetures').addEventListener('click', function () {
    document.getElementById('myModal').style.display = 'none';
});
document.getElementById('btn-red').addEventListener('click', function () {
    document.getElementById('myModal').style.display = 'none';
});

// Fermer le modal en cliquant à l'extérieur de la fenêtre
window.addEventListener('click', function (event) {
    if (event.target === document.getElementById('myModal')) {
        document.getElementById('myModal').style.display = 'none';
    }
});
</script>
<script>
document.querySelector('.valid-not').addEventListener('click', function (event) {
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
document.body.addEventListener('change', function (event) {
    if (event.target && event.target.classList.contains('file-input')) {
        const file = event.target.files[0];
        const previewId = event.target.getAttribute('data-preview');
        const imagePreview = document.getElementById(previewId);
        const imaginations = event.target.getAttribute('data-result');
        const inpute = document.getElementById(imaginations);

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                if (imagePreview) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    inpute.style.paddingLeft = '75px';
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
document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('click', function (event) {
                    if (event.target && event.target.classList.contains('delete-questionnaires')) {
            const parentSa = event.target.closest('.sa');
            if (parentSa) {
                parentSa.remove();
                const ajouterQuestionButtone = parentSa.querySelector('.Ajouter-question');
                if (ajouterQuestionButtone) {
                    ajouterQuestionButtone.remove();
                }
            }
        }
    });


});
</script> */}




// Handle adding a new section
document.querySelector(".Ajouter-section")?.addEventListener("click", function (event) {
    event.preventDefault();

    const sectionsContainer = document.querySelector(".section-container");
    if (sectionsContainer) {
        sectionCounter++;
        sectionCounters++;
        sectionCounters0++;
        sectionCounters00++;
        sectionCounterss0++;
        sectionCounterss1++;
        imagerevue++;
        imagerevu++;
        imageprevu++;
        imageprevus++;
        imagerevue0++;
        imagerevu0++;
        imageprevu0++;
        imageprevus0++;
        imaginons++;
        imaginons0++;
        imaginons1++;
        imaginons2++;
        imaginons4++;
        imaginons5++;
        imaginons6++;
        imaginons7++;
        imaginons8++;
        imaginons9++;
        imaginons10++;
        imaginons11++;
        imaginons12++;
        imaginons13++;
        bryans++;
        bryans1++;
        bryans2++;
        bryans3++;
        bryans4++;
        bryans5++;

        const newSections = document.createElement("div");
        newSections.className = "sa";
        newSections.innerHTML = `
        <div class="btnas-ends">
          <i class="fa-solid fa-x delete-questionnaires"></i>
        </div>
        <div class="input-group">
          <input
            type="text"
            name="phone"
            id="phone"
            placeholder="Sous titre ${sectionCounters} "
            required
          />
        </div>
        <div class="input-group input-with-icon">
          <input
            type="text"
            name="email"
            id="preview${bryans++}"
            placeholder="Libellé du sous titre"
            required
          />
          <label for="file-input${sectionCounterss1}" class="icon-label"
            ><i class="fa-regular fa-image"></i
          ></label>
          <input
            type="file"
            class="file-input"
            id="file-input${sectionCounterss0}"
            data-preview="image-preview${sectionCounters0}"
            data-result="preview${bryans1++}"
            name=""
            style="display: none"
          />
          <img id="image-preview${sectionCounters00}"  alt="Aperçu de l'image" />
        </div>`;
        const newSection = document.createElement("div");
        newSection.className = "sectio-container";
        newSection.innerHTML = `
          <div class="btnas-end">
            <!-- <i class="fa-solid fa-x delete-section"></i>-->
          </div>
          <div class="sa-1">
            <div class="questionnaire-container" id="section-${sectionCounter}">
              <div class="input-group">
              <div class="questionnaire">
                <div class="input-group">
                  <div class="display-1">
                    <div class="textarea">
                      <textarea name="" id="previewz${bryans2++}" required placeholder="Question"></textarea>
                    </div>
                    <div class="file-inputa">
                      <div class="eme">
                        <label for="fileinputs${imagerevue++}"><i class="fa-regular fa-image"></i></label>
                        <input type="file" id="fileinputs${imagerevu++}" data-preview="imagepreviews${imageprevu++}" data-result="previewz${bryans3++}" class="file-input" name="" style="display: none;">
                        <img id="imagepreviews${imageprevus++}" alt="Aperçu de l'image" />
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
                      <input type="text" class="heckbox-reponce" placeholder="reponse 1" required />
                      <label for="imagine${imaginons1++}"
                          ><i class="fa-regular fa-image"></i
                        ></label>
                        <input
                          type="file"
                          id="imagine${imaginons2++}"
                          class="file-input"
                          data-preview="cool${imaginons++}"
                          name=""
                          style="display: none"
                        />
                        <img id="cool${imaginons0++}" class="img" alt="" />
                      <select id="responseselect${sectionCounter}${++responseCounter}" class="Select">
                        <option value="" disabled selected hidden>resultat</option>
                        <option value="Manager" class="yellow" data-target="">Mauvaise réponse</option>
                        <option value="Managers" class="red" data-target="">Mauvaise réponse(-)</option>
                        <option value="Designer" class="green" data-target="">Bonne réponse</option>
                      </select>
                      <input type="number" class="point" required placeholder="not 1" />
                      <i class="fa-regular fa-trash-can delete delete-btn"></i>
                    </li>
                  </ol>
                  <a class="add-response" href="#"><input type="radio"><p>Ajouter une autre proposition de réponse ou <span>ajouter '' Autre ''</span></p></a>
                </div>
              </div>
              </div>
            </div>
            <a href="#" class="Ajouter-question"> <i class="fa-solid fa-circle-plus"></i>Ajouter une question</a>
          </div>`;
        sectionsContainer.appendChild(newSections);
        attachAllEvents(newSections);
        sectionsContainer.appendChild(newSection);
        attachAllEvents(newSection);

    }
});

// Attach events to a newly added section or questionnaire
function attachAllEvents(sectionElement) {
    attachResponseEvent(sectionElement);
    attachDeleteEvent(sectionElement);
    attachAddQuestionEvent(sectionElement);
    attachDeleteQuestionnaireEvent(sectionElement);
    attachDeleteSectionEvent(sectionElement);

    // Re-attach change event for newly added selects
    sectionElement.querySelectorAll('.Select').forEach(selectElement => {
        selectElement.addEventListener("change", handleSelectChanges);

        // Initialize the state of the select on page load
        const initialSelectedOption = selectElement.options[selectElement.selectedIndex];
        if (initialSelectedOption) {
            if (initialSelectedOption.className) {
                selectElement.classList.add(initialSelectedOption.className);
            }
            const inputElement = selectElement.nextElementSibling;
            if (inputElement) {
                inputElement.className = ""; // Reset the input's classes
                if (initialSelectedOption.className) {
                    inputElement.classList.add(initialSelectedOption.className);
                }
                // Manage the disabled state of the input on page load
                if (initialSelectedOption.value === "Manager") {
                    inputElement.disabled = true; // Disable the input if value is "Manager"
                } else {
                    inputElement.disabled = false; // Enable the input otherwise
                }
            }
        }
    });
}

// Handle adding responses
function attachResponseEvent(sectionElement) {
    const addResponseButton = sectionElement.querySelector(".add-response");
    if (addResponseButton) {
        addResponseButton.addEventListener("click", function (event) {
            event.preventDefault();

            const list = sectionElement.querySelector(".circle-list");
            const newItem = document.createElement("li");

            newItem.innerHTML = `
            <input type="text" class="heckbox-reponce" placeholder="reponse ${list.children.length + 1}" required />
             <label for="imagine${imaginons4++}"
                          ><i class="fa-regular fa-image"></i
                        ></label>
                        <input
                          type="file"
                          id="imagine${imaginons5++}"
                          class="file-input"
                          data-preview="revange${imaginons6++}"
                          name=""
                          style="display: none"
                        />
                        <img id="revange${imaginons7++}" class="img" alt="" />
            <select id="responseselect${sectionCounter}${++responseCounter}" class="Select">
              <option value="" disabled selected hidden>resultat</option>
              <option value="Manager" class="yellow" data-target="">Mauvaise réponse</option>
              <option value="Managers" class="red" data-target="">Mauvaise réponse(-)</option>
              <option value="Designer" class="green" data-target="">Bonne réponse</option>
            </select>
            <input type="number" class="point" required placeholder="not ${list.children.length + 1}" />
            <i class="fa-regular fa-trash-can delete delete-btn"></i>`;
            list.appendChild(newItem);
            attachDeleteEvent(newItem);
            // Re-attach change event for newly added selects
            newItem.querySelector('.Select').addEventListener("change", handleSelectChanges);
        });
    }
}

// Handle deleting responses
function attachDeleteEvent(element) {
    const deleteButton = element.querySelector(".delete-btn");
    if (deleteButton) {
        deleteButton.addEventListener("click", function () {
            this.closest("li").remove();
        });
    }
}

// Handle adding a new question
function attachAddQuestionEvent(sectionElement) {
    const addQuestionButton = sectionElement.querySelector(".Ajouter-question");
    if (addQuestionButton) {
        addQuestionButton.addEventListener("click", function (event) {
            event.preventDefault();

            questionCounter++;
            const questionnaireContainer = sectionElement.querySelector(".questionnaire-container");
            if (!questionnaireContainer) return;

            // Créer un div pour l'espacement blanc
            const spacer = document.createElement("div");
            spacer.className = "question-separator";

            // Créer la nouvelle question
            const newQuestionnaire = document.createElement("div");
            newQuestionnaire.className = "input-group";

            newQuestionnaire.innerHTML = `
        <div class="questionnaire">
            <div class="input-group">
                <div class="display-1">
                    <div class="textarea">
                        <textarea name="" id="previews${bryans5++}" required placeholder="Question"></textarea>
                    </div>
                    <div class="file-inputa">
                        <div class="eme">
                        <label for="fileinputs${imagerevue0++}"><i class="fa-regular fa-image"></i></label>
                        <input type="file" id="fileinputs${imagerevu0++}" data-preview="imagepreviews${imageprevu0++}" data-result="previews${bryans4++}" class="file-input" name="" style="display: none;">
                        <img id="imagepreviews${imageprevus0++}" alt="Aperçu de l'image" />
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
                        <input type="text" class="heckbox-reponce" placeholder="reponse 1" required />
                         <label for="imagine${imaginons8++}"
                          ><i class="fa-regular fa-image"></i
                        ></label>
                        <input
                          type="file"
                          id="imagine${imaginons9++}"
                          class="file-input"
                          data-preview="imaginationss${imaginons10++}"
                          name=""
                          style="display: none"
                        />
                        <img id="imaginationss${imaginons11++}" class="img" alt="" />
                        <select id="responseselect${sectionCounter}${++responseCounter}" class="Select">
                            <option value="" disabled selected hidden>resultat</option>
                            <option value="Manager" class="yellow" data-target="">Mauvaise réponse</option>
                            <option value="Managers" class="red" data-target="">Mauvaise réponse(-)</option>
                            <option value="Designer" class="green" data-target="">Bonne réponse</option>
                        </select>
                        <input type="number" class="point" required placeholder="not 1" />
                        <i class="fa-regular fa-trash-can delete delete-btn"></i>
                    </li>
                </ol>
                <a class="add-response" href="#"><input type="radio"><p>Ajouter une autre proposition de réponse ou <span>ajouter '' Autre ''</span></p></a>
            </div>
        </div>`;

            // Ajouter le div de séparation avant la nouvelle question
            questionnaireContainer.appendChild(spacer); // Ajoute l'espace blanc
            questionnaireContainer.appendChild(newQuestionnaire); // Ajoute la nouvelle question

            // Attacher les événements à newQuestionnaire
            attachAllEvents(newQuestionnaire);
        });
    }
}


// Handle deleting a questionnaire
function attachDeleteQuestionnaireEvent(sectionElement) {
    const deleteQuestionnaireButtons = sectionElement.querySelectorAll(".delete-questionnaire");

    deleteQuestionnaireButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            // Trouver l'élément .questionnaire le plus proche
            const questionnaire = this.closest(".questionnaire");

            if (questionnaire) {
                // Trouver le parent .input-group contenant le questionnaire.
                const inputGroup = questionnaire.closest(".input-group");

                if (inputGroup) {
                    // Trouver le .question-separator qui précède immédiatement le .input-group
                    const previousElement = inputGroup.previousElementSibling;
                    if (previousElement && previousElement.classList.contains("question-separator")) {
                        // Supprimer le .question-separator suivant
                        previousElement.remove();
                        console.log('question-separator suivant supprimé');
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
        deleteSectionButton.addEventListener("click", function () {
            this.closest(".sectio-container").remove();
        });
    }
}

function attachDeleteQuestionnaireEvents(sectionElement) {
    const deleteQuestionnaireButtons = sectionElement.querySelectorAll(".delete-questionnaires");
    let firstParentRemoved = false;
    deleteQuestionnaireButtons.forEach(function (button) {
        button.addEventListener("click", function () {
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
// });
