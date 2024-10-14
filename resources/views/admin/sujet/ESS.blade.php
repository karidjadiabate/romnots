document.addEventListener("DOMContentLoaded", function() {
    let counters = {
        section: document.querySelectorAll(".sectio-container").length,
        question: 1,
        response: 0,
        image: 0,
        file: 0,
    };

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

                if (selectedOption.value === "mauvaise_reponse") {
                    inputElement.disabled = true;
                } else {
                    inputElement.disabled = false;
                }
            }
        }
    }



    // Créer une première question par défaut
    createQuestion(document.querySelector(".sectio-container"));

    function createQuestion(sectionElement) {
        if (!(sectionElement instanceof HTMLElement)) {
            console.error("sectionElement is not a valid DOM element.");
            return;
        }

        const questionIndex = sectionElement.querySelectorAll(".questionnaire").length;
        const questionnaireContainer = sectionElement.querySelector(".questionnaire-container");
        if (!questionnaireContainer) return;

        const questionNumber = counters.question++;

        if (questionIndex > 0) {
            const spacer = document.createElement("div");
            spacer.className = "question-separator";
            questionnaireContainer.appendChild(spacer);
        }

        const newQuestionnaire = document.createElement("div");
        newQuestionnaire.className = "input-group";
        newQuestionnaire.setAttribute("data-question-index", questionIndex);

        const fileInputId = `fileinputs_${counters.file++}`;
        const imagePreviewId = `imagepreviews_${counters.image++}`;
        const responseInputId = `response_${counters.response++}`;

        newQuestionnaire.innerHTML = `
        <div class="questionnaire">
            <div class="input-group">
                <div class="display-1">
                    <div class="textarea">
                        <textarea name="sections[${counters.section - 1}][questions][${questionIndex}][libquestion]" required placeholder="Question ${questionNumber}"></textarea>
                    </div>
                    <div class="file-inputa">
                        <div class="eme">
                            <label for="${fileInputId}"><i class="fa-regular fa-image"></i></label>
                            <input type="file" id="${fileInputId}" data-preview="${imagePreviewId}" class="file-input" name="sections[${counters.section - 1}][questions][${questionIndex}][image]" style="display: none;">
                            <img id="${imagePreviewId}" alt="Aperçu de l'image" style="display: none;" />
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
                        <input type="text" class="heckbox-reponce" id="${responseInputId}" name="sections[${counters.section - 1}][questions][${questionIndex}][reponses][0][libreponse]" placeholder="réponse 1" required />
                        <label for="${responseInputId}"><i class="fa-regular fa-image"></i></label>
                        <input type="file" id="imagine${counters.file++}" class="file-input" data-preview="imaginationss${counters.image++}" name="sections[${counters.section - 1}][questions][${questionIndex}][reponses][0][image]" style="display: none" />
                        <img id="imaginationss${counters.image++}" class="img" alt="Aperçu de l'image" />
                        <select name="sections[${counters.section - 1}][questions][${questionIndex}][reponses][0][result]" class="Select">
                            <option value="" disabled selected hidden>résultat</option>
                            <option value="bonne_reponse" class="green">Bonne réponse</option>
                            <option value="mauvaise_reponse" class="yellow">Mauvaise réponse</option>
                            <option value="mauvaise_reponse-" class="red">Mauvaise réponse(-)</option>
                        </select>
                        <input type="number" class="point" name="sections[${counters.section - 1}][questions][${questionIndex}][reponses][0][points]" required placeholder="note" />
                        <i class="fa-regular fa-trash-can delete delete-btn"></i>
                    </li>
                </ol>
                <a class="add-response" href="#"><input type="radio" /><p>Ajouter une autre proposition de réponse ou <span>ajouter '' Autre ''</span></p></a>
            </div>
        </div>`;

        questionnaireContainer.appendChild(newQuestionnaire);
        attachAllEvents(newQuestionnaire);
    }



    function attachAllEvents(sectionElement) {

        attachAddQuestionEvent(sectionElement);
        attachDeleteEvent(sectionElement);
        attachDeleteQuestionnaireEvent(sectionElement);
        attachDeleteSectionEvent(sectionElement);

        sectionElement.querySelectorAll('.Select').forEach(selectElement => {
            selectElement.addEventListener("change", handleSelectChanges);
        });
    }

    // Fonction pour ajouter l'événement d'ajout de question
    function attachAddQuestionEvent(sectionElement) {
        const addQuestionButton = document.querySelector("a.Ajouter-question");

        if (addQuestionButton) {
            console.log("Bouton Ajouter question trouvé");
            addQuestionButton.addEventListener("click", function(event) {
                event.preventDefault();
                createQuestion(sectionElement);
            });
        } else {
            console.error("Le bouton Ajouter-question n'a pas été trouvé dans la section.");
        }
    }


    // Fonction pour ajouter l'événement de suppression
    function attachDeleteEvent(element) {
        const deleteButton = element.querySelector(".delete-btn");
        if (deleteButton) {
            deleteButton.addEventListener("click", function() {
                this.closest("li").remove();
            });
        }
    }

    function attachDeleteQuestionnaireEvent(sectionElement) {
        const deleteQuestionnaireButtons = sectionElement.querySelectorAll(".delete-questionnaire");
        deleteQuestionnaireButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                const questionnaire = this.closest(".questionnaire");
                if (questionnaire) {
                    questionnaire.remove();
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

    // Initialisation des événements pour chaque section existante
    document.querySelectorAll(".sectio-container").forEach(attachAllEvents);

    // Ajout d'une section
    document.querySelector(".Ajouter-section")?.addEventListener("click", function(event) {
        event.preventDefault();

        const sectionsContainer = document.querySelector(".section-container");
        if (sectionsContainer) {
            counters.section++;

            const newSections = document.createElement("div");
            newSections.className = "sa";
            newSections.innerHTML = `
                        <i class="fa-solid fa-x delete-questionnaires"></i>
                        <div class="input-group">
                            <input type="text" name="sections[${counters.section - 1}][titre]" id="phone" placeholder="Sous titre ${counters.section}" required />
                        </div>
                        <div class="input-group input-with-icon">
                            <input type="text" name="sections[${counters.section - 1}][soustitre]" id="preview${counters.file++}" placeholder="Libellé de section 1" required />
                            <label for="file-input${counters.file++}" class="icon-label"><i class="fa-regular fa-image"></i></label>
                            <input type="file" class="file-input" id="file-input${counters.file++}" data-preview="image-preview${counters.image++}" data-result="preview${counters.file++}" name="sections[${counters.section - 1}][image]" style="display: none" />
                            <img id="image-preview${counters.image++}" alt="" />
                        </div>`;

            sectionsContainer.appendChild(newSections);
            attachAllEvents(newSections);
        }
    })
});
{{--  --}}
{{--  --}}
 const counters = {
            section: 0,
            file: 0,
            image: 0,
            response: 0
        };

        // Fonction pour ajouter une section
        function addSection() {
            counters.section++; // Incrémente le compteur de sections

            const sectionsContainer = document.querySelector(".section-container");
            const newSection = document.createElement("div");
            newSection.className = "section";
            newSection.setAttribute('data-section-index', counters.section - 1);
            newSection.innerHTML = `
        <div class="sa">
            <i class="fa-solid fa-x delete-questionnaires"></i>
            <div class="input-group">
                <input type="text" name="sections[${counters.section - 1}][titre]" placeholder="Sous titre ${counters.section}" required />
            </div>
            <div class="input-group input-with-icon">
                <input type="text" name="sections[${counters.section - 1}][soustitre]" placeholder="Libellé de section ${counters.section}" required />
                <label for="file-input${counters.file}" class="icon-label"><i class="fa-regular fa-image"></i></label>
                <input type="file" class="file-input" id="file-input${counters.file}" name="sections[${counters.section - 1}][image]" style="display: none" onchange="previewImage(event, 'image-preview${counters.image}')"/>
                <img id="image-preview${counters.image}" alt="Aperçu de l'image" />
            </div>
            <div class="questionnaire-container">
                <div class="input-group">
                    <div class="questionnaire">
                        <div class="input-group">
                            <textarea name="sections[${counters.section - 1}][questions][0][libquestion]" required placeholder="Question 1"></textarea>
                        </div>
                        <div class="file-inputa">
                            <label for="fileinputs${counters.file + 1}"><i class="fa-regular fa-image"></i></label>
                            <input type="file" id="fileinputs${counters.file + 1}" name="sections[${counters.section - 1}][questions][0][image]" style="display: none;" onchange="previewImage(event, 'imagepreviews${counters.image + 1}')"/>
                            <img id="imagepreviews${counters.image + 1}" alt="Aperçu de l'image" />
                        </div>
                        <i class="fa-solid fa-xmark deletes delete-questionnaire"></i>
                    </div>
                </div>
                <ol class="circle-list">
                    <li>
                        <input type="text" name="sections[${counters.section - 1}][questions][0][reponses][0][libreponse]" placeholder="Réponse 1" required />
                        <select name="sections[${counters.section - 1}][questions][0][reponses][0][result]">
                            <option value="" disabled selected hidden>Résultat</option>
                            <option value="bonne_reponse">Bonne réponse</option>
                            <option value="mauvaise_reponse">Mauvaise réponse</option>
                            <option value="mauvaise_reponse-">Mauvaise réponse (-)</option>
                        </select>
                        <input type="number" name="sections[${counters.section - 1}][questions][0][reponses][0][points]" required placeholder="La note" />
                        <i class="fa-regular fa-trash-can delete delete-btn"></i>
                    </li>
                </ol>
                <a class="add-response" href="#">Ajouter une autre réponse</a>
            </div>
            <a href="#" class="Ajouter-question"><i class="fa-solid fa-circle-plus"></i> Ajouter une question</a>
        </div>`;

            counters.file += 2; // Increment after use
            counters.image += 2; // Increment after use

            sectionsContainer.appendChild(newSection);
            attachAllEvents(newSection);
        }

        // Événement pour le bouton "Ajouter section"
        document.querySelector(".Ajouter-section")?.addEventListener("click", function(event) {
            event.preventDefault();
            addSection(); // Ajoute une nouvelle section
        });

        // Attacher la section par défaut lors du chargement de la page
        document.addEventListener("DOMContentLoaded", function() {
            addSection(); // Appel de la fonction pour ajouter une section par défaut
        });

        function attachAllEvents(newSection) {
            const deleteBtn = newSection.querySelector('.delete-questionnaires');
            deleteBtn.addEventListener('click', function() {
                console.log('Section supprimée');
                newSection.remove(); // Supprime la section
                reindexSections(); // Réindexe les sections restantes
                counters.section = document.querySelectorAll('.section').length; // Mise à jour du compteur
            });

            // Attacher l'événement pour ajouter une nouvelle question
            const addQuestionBtn = newSection.querySelector('.Ajouter-question');
            addQuestionBtn.addEventListener('click', function(event) {
                event.preventDefault();
                addQuestion(newSection); // Ajoute une question à la section
            });

            // Attacher l'événement pour ajouter une nouvelle réponse
            const addResponseBtn = newSection.querySelector('.add-response');
            addResponseBtn.addEventListener('click', function(event) {
                event.preventDefault();
                addResponse(newSection); // Ajoute une réponse à la dernière question
            });
        }

        // Fonction pour ajouter une question
        function addQuestion(section) {
            const questionCount = section.querySelectorAll('.questionnaire').length;
            const newQuestion = document.createElement("div");
            newQuestion.className = "questionnaire";
            newQuestion.innerHTML = `
        <div class="input-group">
            <textarea name="sections[${section.getAttribute('data-section-index')}][questions][${questionCount}][libquestion]" required placeholder="Question ${questionCount + 1}"></textarea>
        </div>
        <div class="file-inputa">
            <label for="fileinputs${counters.file}"><i class="fa-regular fa-image"></i></label>
            <input type="file" id="fileinputs${counters.file}" name="sections[${section.getAttribute('data-section-index')}][questions][${questionCount}][image]" style="display: none;" onchange="previewImage(event, 'imagepreviews${counters.image}')"/>
            <img id="imagepreviews${counters.image}" alt="Aperçu de l'image" />
        </div>
        <i class="fa-solid fa-xmark deletes delete-questionnaire"></i>
    `;

            section.querySelector('.questionnaire-container').appendChild(newQuestion);
            counters.file++;
            counters.image++;
        }

        // Fonction pour ajouter une réponse
        function addResponse(section) {
            const questionIndex = section.querySelectorAll('.questionnaire').length - 1; // Dernière question
            const responseList = section.querySelector('.circle-list');
            const responseCount = responseList.querySelectorAll('li').length;

            const newResponse = document.createElement("li");
            newResponse.innerHTML = `
        <input type="text" name="sections[${section.getAttribute('data-section-index')}][questions][${questionIndex}][reponses][${responseCount}][libreponse]" placeholder="Réponse ${responseCount + 1}" required />
        <select name="sections[${section.getAttribute('data-section-index')}][questions][${questionIndex}][reponses][${responseCount}][result]">
            <option value="" disabled selected hidden>Résultat</option>
            <option value="bonne_reponse">Bonne réponse</option>
            <option value="mauvaise_reponse">Mauvaise réponse</option>
            <option value="mauvaise_reponse-">Mauvaise réponse (-)</option>
        </select>
        <input type="number" name="sections[${section.getAttribute('data-section-index')}][questions][${questionIndex}][reponses][${responseCount}][points]" required placeholder="La note" />
        <i class="fa-regular fa-trash-can delete delete-btn"></i>
    `;

            responseList.appendChild(newResponse);
        }

        // Prévisualisation de l'image
        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById(previewId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        // Réindexation des sections, questions et réponses
        function reindexSections() {
            const sections = document.querySelectorAll(".section");
            sections.forEach((section, sectionIndex) => {
                section.setAttribute('data-section-index', sectionIndex);

                const titleInput = section.querySelector('input[name^="sections"]');
                if (titleInput) {
                    titleInput.placeholder = `Sous titre ${sectionIndex + 1}`;
                }

                const subTitleInput = section.querySelector('input[name*="soustitre"]');
                if (subTitleInput) {
                    subTitleInput.placeholder = `Libellé de section ${sectionIndex + 1}`;
                }

                const questions = section.querySelectorAll('.questionnaire');
                questions.forEach((question, questionIndex) => {
                    const questionTextArea = question.querySelector('textarea');
                    questionTextArea.placeholder = `Question ${questionIndex + 1}`;
                });
            });
        }









      {{--  --}}


      // Fonction pour ajouter une section
      function addSection() {
          counters.section++; // Incrémente le compteur de sections
          const sectionIndex = counters.section - 1;
          const sectionsContainer = document.querySelector(".section-container");

          const newSection = document.createElement("div");
          newSection.className = "section";
          newSection.setAttribute('data-section-index', sectionIndex);

          newSection.innerHTML = `
      <div class="sa">
          <i class="fa-solid fa-x delete-questionnaires"></i>
          <div class="input-group">
              <input type="text" name="sections[${sectionIndex}][titre]" placeholder="Sous titre ${counters.section}" required />
          </div>
          <div class="input-group input-with-icon">
              <input type="text" name="sections[${sectionIndex}][soustitre]" placeholder="Libellé de section ${counters.section}" required />
              <label for="file-input${sectionIndex}" class="icon-label"><i class="fa-regular fa-image"></i></label>
              <input type="file" class="file-input" id="file-input${sectionIndex}" name="sections[${sectionIndex}][image]" style="display: none" />
              <img id="image-preview${sectionIndex}" alt="" style="max-width: 100px; display: none;" />
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
                                          <textarea name="sections[${sectionIndex}][questions][0][libquestion]" required placeholder="Question 1"></textarea>
                                      </div>
                                      <div class="file-inputa">
                                          <div class="eme">
                                              <label for="fileinputs${sectionIndex}"><i class="fa-regular fa-image"></i></label>
                                              <input type="file" id="fileinputs${sectionIndex}" name="sections[${sectionIndex}][questions][0][image]" style="display: none;">
                                              <img id="imagepreviews${sectionIndex}" alt="" style="max-width: 100px; display: none;" />
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
                                          <input type="text" class="heckbox-reponce" name="sections[${sectionIndex}][questions][0][reponses][0][libreponse]" required placeholder="Réponse 1" />
                                          <select name="sections[${sectionIndex}][questions][0][reponses][0][result]" class="Select">
                                              <option value="" disabled selected hidden>Résultat</option>
                                              <option value="bonne_reponse" class="green">Bonne réponse</option>
                                              <option value="mauvaise_reponse" class="yellow">Mauvaise réponse</option>
                                              <option value="mauvaise_reponse-" class="red">Mauvaise réponse(-)</option>
                                          </select>
                                          <input type="number" class="point" name="sections[${sectionIndex}][questions][0][reponses][0][points]" required placeholder="Note" />
                                          <i class="fa-regular fa-trash-can delete delete-btn"></i>
                                      </li>
                                  </ol>
                                  <a class="add-response" href="#"><input type="radio" />
                                      <p>Ajouter une autre proposition de réponse ou <span id="ajouts">ajouter '' Autre ''</span></p>
                                  </a>
                              </div>
                          </div>
                      </div>
                      <a href="#" class="Ajouter-question"><i class="fa-solid fa-circle-plus"></i> Ajouter une question</a>
                  </div>
              </div>
          </div>
      </div>
  `;

          sectionsContainer.appendChild(newSection);
          attachAllEvents(newSection);
      };

      // Fonction pour ajouter une question
      function addQuestion(section) {
          counters.response++; // Incrémente le compteur de réponses
          const questionContainer = section.querySelector('.questionnaire-container');

          // Créer un nouvel élément div pour la nouvelle question
          const newQuestion = document.createElement("div");
          newQuestion.className = "questionnaire";

          // Ajouter un séparateur si nécessaire
          const spacer = document.createElement("div");
          spacer.className = "question-separator";

          newQuestion.innerHTML = `
      <div class="input-group">
          <div class="display-1">
              <div class="textarea">
                  <textarea name="sections[${section.getAttribute('data-section-index')}][questions][${counters.response}][libquestion]" required placeholder="Question ${counters.response + 1}"></textarea>
              </div>
              <div class="file-inputa">
                  <div class="eme">
                      <label for="fileinputs${counters.file}"><i class="fa-regular fa-image"></i></label>
                      <input type="file" id="fileinputs${counters.file}" name="sections[${section.getAttribute('data-section-index')}][questions][${counters.response}][image]" style="display: none;">
                      <img id="imagepreviews${counters.file}" alt="" style="max-width: 100px; display: none;" />
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
                  <input type="text" class="heckbox-reponce" id="response-${counters.response}" name="sections[${section.getAttribute('data-section-index')}][questions][${counters.response}][reponses][0][libreponse]" required placeholder="Réponse 1" />
                  <label for="response-${counters.response}"><i class="fa-regular fa-image"></i></label>
                  <input type="file" id="response-image-${counters.response}" class="file-input" name="sections[${section.getAttribute('data-section-index')}][questions][${counters.response}][reponses][0][image]" style="display: none;" />
                  <img id="imaginations-${counters.response}" class="img" alt="" />
                  <select name="sections[${section.getAttribute('data-section-index')}][questions][${counters.response}][reponses][0][result]" id="result-${counters.response}" class="Select">
                      <option value="" disabled selected hidden>Résultat</option>
                      <option value="bonne_reponse" class="green" data-target="1">Bonne réponse</option>
                      <option value="mauvaise_reponse" class="yellow" data-target="2">Mauvaise réponse</option>
                      <option value="mauvaise_reponse-" class="red" data-target="3">Mauvaise réponse(-)</option>
                  </select>
                  <input type="number" id="point-${counters.response}" class="point" name="sections[${section.getAttribute('data-section-index')}][questions][${counters.response}][reponses][0][points]" required placeholder="Note" /><i class="fa-regular fa-trash-can delete delete-btn"></i>
              </li>
          </ol>
          <a class="add-response" href="#"><input type="radio" />
              <p>
                  Ajouter une autre proposition de réponse ou <span id="ajouts">ajouter '' Autre ''</span>
              </p>
          </a>
      </div>
  `;

          questionContainer.appendChild(spacer); // Ajouter le séparateur si nécessaire
          questionContainer.appendChild(newQuestion); // Ajouter la nouvelle question
          attachAllEvents(newQuestion); // Attachez les événements à la nouvelle question
      }


      // Événement pour le bouton "Ajouter question"
      document.querySelectorAll(".Ajouter-question").forEach(button => {
          button.addEventListener("click", function(event) {
              event.preventDefault();
              const section = button.closest('.section'); // Trouvez la section parente
              addQuestion(section); // Ajoutez une nouvelle question à cette section
          });
      });



      // Fonction pour gérer les prévisualisations d'images
      function handleImagePreview(input, preview) {
          const file = input.files[0];
          if (file) {
              const reader = new FileReader();
              reader.onload = function(e) {
                  preview.src = e.target.result;
                  preview.style.display = 'block'; // Affiche l'image
              };
              reader.readAsDataURL(file); // Convertit l'image en base64
          } else {
              preview.src = '';
              preview.style.display = 'none'; // Cache l'image si aucun fichier
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

          // Ajout d'événement pour le preview d'image lors du choix d'un fichier
          const fileInputs = sectionOrQuestion.querySelectorAll('.file-input');
          fileInputs.forEach(input => {
              const previewId = input.getAttribute('id').replace('file-input', 'image-preview');
              const previewElement = document.getElementById(previewId);
              input.addEventListener('change', function() {
                  handleImagePreview(input, previewElement);
              });
          });

          // Attacher un événement pour le bouton "Ajouter question"
          const addQuestionBtn = sectionOrQuestion.querySelector('.Ajouter-question');
          if (addQuestionBtn) {
              addQuestionBtn.addEventListener('click', function(event) {
                  event.preventDefault();
                  addQuestion(sectionOrQuestion); // Ajoute une nouvelle question à la section
              });
          }

          const deleteQuestionBtn = sectionOrQuestion.querySelector('.delete-questionnaire');
          if (deleteQuestionBtn) {
              deleteQuestionBtn.addEventListener('click', function() {
                  sectionOrQuestion.remove(); // Supprime la question
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
          addSection(); // Appel de la fonction pour ajouter une section par défaut
      });

      // Réindexation des sections, questions et réponses
      function reindexSections() {
          const sections = document.querySelectorAll(".section");
          sections.forEach((section, sectionIndex) => {
              section.setAttribute('data-section-index', sectionIndex);

              // Mise à jour du placeholder du titre et du sous-titre
              const titleInput = section.querySelector('input[name^="sections"]');
              if (titleInput) {
                  titleInput.placeholder = `Sous titre ${sectionIndex + 1}`;
              }

              const subTitleInput = section.querySelector('input[name*="soustitre"]');
              if (subTitleInput) {
                  subTitleInput.placeholder = `Libellé de section ${sectionIndex + 1}`;
              }

              const questions = section.querySelectorAll('.questionnaire');
              questions.forEach((question, questionIndex) => {
                  const questionTextArea = question.querySelector('textarea[name*="libquestion"]');
                  if (questionTextArea) {
                      questionTextArea.placeholder = `Question ${questionIndex + 1}`;
                  }

                  const responses = question.querySelectorAll('li');
                  responses.forEach((response, responseIndex) => {
                      const responseInput = response.querySelector('input[name*="libreponse"]');
                      if (responseInput) {
                          responseInput.placeholder = `Réponse ${responseIndex + 1}`;
                      }
                  });
              });
          });
      }

      {{--  --}}


      const counters = {
        section: 0,
        file: 0,
        image: 0,
        response: 0

    };

    // Fonction pour ajouter une section
    function addSection() {
        counters.section++; // Incrémente le compteur de sections
        counters.file++;
        const sectionsContainer = document.querySelector(".section-container");
        const newSection = document.createElement("div");
        newSection.className = "section";
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
            <input type="file" class="file-input" id="file-input-${counters.file}" name="sections[${counters.section - 1}][image]" style="display: none" />
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
                                            <input type="file" id="fileinputs-${counters.file}" name="sections[${counters.section - 1}][questions][0][image]" style="display: none;">
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
                                        <label for="imagine-${counters.file}"><i class="fa-regular fa-image"></i></label>
                                        <input type="file" id="imagine-${counters.file}" class="file-input" data-preview="imaginations-${counters.file}" name="" style="display: none" />
                                        <img id="imaginations-${counters.file}" class="img" alt="" />
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
        attachAllEvents(newSection);
    }


    function addQuestion(section) {
        const questionIndex = section.querySelectorAll('.questionnaire').length; // Compte les questions existantes
        const uniqueFileInputId = `fileinputs${counters.file}`;
        const uniqueImagePreviewId = `imagepreviews${counters.file}`;
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
                    <input type="file" id="${uniqueFileInputId}" name="sections[${section.getAttribute('data-section-index')}][questions][${questionIndex}][image]" style="display: none;">
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
                <label for="reponse-${questionIndex}-1"><i class="fa-regular fa-image"></i></label>
                <input type="file" id="imagine-${questionIndex}" class="file-input" data-preview="imaginations" name="" style="display: none" />
                <img id="imaginations-${questionIndex}" class="img" alt="" />
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
            <p>
            Ajouter une autre proposition de réponse ou <span id="ajouts">ajouter '' Autre ''</span>
            </p>
        </a>
    </div>
`;

        const spacer = document.createElement('div');
        spacer.className = 'question-separator'; // Ajoutez votre propre style pour ce séparateur dans le CSS
        section.querySelector('.questionnaire-container').appendChild(spacer);
        // Ajouter la nouvelle question au conteneur
        section.querySelector('.questionnaire-container').appendChild(newQuestion);
        // Attacher les événements à la nouvelle question
        attachAllEvents(newQuestion);

        // Incrémente le compteur de fichiers pour assurer des IDs uniques
        counters.file++;
    }



    // Fonction pour gérer les prévisualisations d'images
    function handleImagePreview(input, preview) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Affiche l'image
            };
            reader.readAsDataURL(file); // Convertit l'image en base64
        } else {
            preview.src = '';
            preview.style.display = 'none'; // Cache l'image si aucun fichier
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

        // Ajout d'événement pour le preview d'image lors du choix d'un fichier
        const fileInputs = sectionOrQuestion.querySelectorAll('.file-input');
        fileInputs.forEach(input => {
            const previewId = input.getAttribute('data-preview'); // Utilise l'attribut data-preview
            const previewElement = document.getElementById(previewId);
            input.addEventListener('change', function() {
                handleImagePreview(input, previewElement);
            });
        });

        // Attacher un événement pour le bouton "Ajouter question"
        const addQuestionBtn = sectionOrQuestion.querySelector('.Ajouter-question');
        if (addQuestionBtn) {
            addQuestionBtn.addEventListener('click', function(event) {
                event.preventDefault();
                addQuestion(sectionOrQuestion); // Ajoute une nouvelle question à la section
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

                sectionOrQuestion.remove(); // Supprimer la question
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
        addSection(); // Appel de la fonction pour ajouter une section par défaut
    });

    // Réindexation des sections, questions et réponses
    function reindexSections() {
        const sections = document.querySelectorAll(".section");
        sections.forEach((section, sectionIndex) => {
            section.setAttribute('data-section-index', sectionIndex);

            // Mise à jour du placeholder du titre et du sous-titre
            const titleInput = section.querySelector('input[name^="sections"]');
            if (titleInput) {
                titleInput.placeholder = `Sous titre ${sectionIndex + 1}`;
            }

            const subTitleInput = section.querySelector('input[name*="soustitre"]');
            if (subTitleInput) {
                subTitleInput.placeholder = `Libellé de section ${sectionIndex + 1}`;
            }

            const questions = section.querySelectorAll('.questionnaire');
            questions.forEach((question, questionIndex) => {
                const questionTextArea = question.querySelector('textarea[name*="libquestion"]');
                if (questionTextArea) {
                    questionTextArea.placeholder = `Question ${questionIndex + 1}`;
                }

                const responses = question.querySelectorAll('li');
                responses.forEach((response, responseIndex) => {
                    const responseInput = response.querySelector('input[name*="libreponse"]');
                    if (responseInput) {
                        responseInput.placeholder = `Réponse ${responseIndex + 1}`;
                    }
                });
            });
        });
    }




