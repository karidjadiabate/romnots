document.addEventListener('DOMContentLoaded', function () {
    const progress = document.getElementById("progress");
    const formSteps = document.querySelectorAll(".form-step");
    const progressSteps = document.querySelectorAll(".progress-step");
    const textarea = document.querySelector("textarea");

    let formStepsNum = 0;

    function updateFormSteps() {
        formSteps.forEach((formStep) => {
            formStep.classList.remove("form-step-active");
        });
        formSteps[formStepsNum].classList.add("form-step-active");
    }

    function updateProgressbar() {
        progressSteps.forEach((progressStep, idx) => {
            if (idx < formStepsNum + 1) {
                progressStep.classList.add("progress-step-active");
            } else {
                progressStep.classList.remove("progress-step-active");
            }
        });
        const progressActive = document.querySelectorAll(".progress-step-active");
        progress.style.width = ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
    }

    // Fonction de validation pour les selects et les inputs
    function validateFormInputs() {
        const selects = ['position', 'positions', 'positions1', 'positions2'];
        const inputs = ['time', 'consigne'];
        let allValid = true;

        // Vérification des selects
        selects.forEach(selectId => {
            const selectElement = document.getElementById(selectId);
            if (selectElement && selectElement.value === '') {
                allValid = false;
            }
        });

        // Vérification des inputs
        inputs.forEach(inputId => {
            const inputElement = document.getElementById(inputId);
            if (inputElement && inputElement.value === '') {
                allValid = false;
            }
        });

        // Mise à jour de l'état des boutons "Suivant"
        const nextBtns = document.querySelectorAll(".btn-next");
        nextBtns.forEach(btn => {
            btn.disabled = !allValid;
            btn.classList.toggle("btn-disabled", !allValid); // Ajoute ou enlève la classe
        });

        return allValid;
    }

    function handleChange(event) {
        validateFormInputs();
    }

    // Ajout d'événements pour les selects
    const selects = ['position', 'positions', 'positions1', 'positions2'];
    selects.forEach(selectId => {
        const selectElement = document.getElementById(selectId);
        if (selectElement) {
            selectElement.addEventListener('change', handleChange);
        }
    });

    // Ajout d'événements pour les inputs
    const inputs = ['time', 'consigne'];
    inputs.forEach(inputId => {
        const inputElement = document.getElementById(inputId);
        if (inputElement) {
            inputElement.addEventListener('input', handleChange); // Utilisez 'input' pour les <input>
        }
    });

    // Écouteur pour les boutons "Suivant" (en utilisant une classe)
    const nextBtns = document.querySelectorAll(".btn-next");
    nextBtns.forEach(btn => {
        btn.addEventListener('click', (event) => {
            event.preventDefault(); // Empêcher le passage à l'étape suivante si la validation échoue
            if (validateFormInputs()) {
                formStepsNum++;
                updateFormSteps();
                updateProgressbar();
            }
        });
    });

    // Écouteur pour le bouton "Précédent"
    document.getElementById("btn-prev").addEventListener('click', () => {
        if (formStepsNum > 0) {
            formStepsNum--;
            updateFormSteps();
            updateProgressbar();
        }
    });

    if (textarea) {
        textarea.addEventListener("keyup", e => {
            textarea.style.height = "auto";
            textarea.style.height = `${e.target.scrollHeight}px`;
        });
    }

    updateFormSteps();
    validateFormInputs(); // Validation initiale pour les boutons "Suivant"
});
