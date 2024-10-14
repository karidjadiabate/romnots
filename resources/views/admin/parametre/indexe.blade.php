


{{--  --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = [{
                red: 'red_color1',
                green: 'green_color1',
                checkboxes: '#option1_enseignant input[type="checkbox"]'
            },
            {
                red: 'red_color2',
                green: 'green_color2',
                checkboxes: '#option1_etudiant input[type="checkbox"]'
            },
            {
                red: 'red_color3',
                green: 'green_color3',
                checkboxes: '#option1_matiere input[type="checkbox"]'
            },
            {
                red: 'red_color4',
                green: 'green_color4',
                checkboxes: '#option2_filiere input[type="checkbox"]'
            },
            {
                red: 'red_color5',
                green: 'green_color5',
                checkboxes: '#option2_classe input[type="checkbox"]'
            },
            {
                red: 'red_color6',
                green: 'green_color6',
                checkboxes: '#option2_c input[type="checkbox"]'
            },
            {
                red: 'red_color7',
                green: 'green_color7',
                checkboxes: '#option3_c input[type="checkbox"]'
            },
            {
                red: 'red_color8',
                green: 'green_color8',
                checkboxes: '#option3_sujet input[type="checkbox"]'
            }
        ];

        function updateCouleurGreenDisplay(section) {
            const allChecked = Array.from(document.querySelectorAll(section.checkboxes)).every(checkbox =>
                checkbox.checked);
            document.getElementById(section.green).style.display = allChecked ? 'flex' : 'none';
            document.getElementById(section.red).style.display = allChecked ? 'none' : 'flex';
        }

        function toggleCheckboxes(section, checkState) {
            document.querySelectorAll(section.checkboxes).forEach(checkbox => checkbox.checked = checkState);
            updateCouleurGreenDisplay(section);
        }

        function addEventListeners(section) {
            document.querySelectorAll(section.checkboxes).forEach(checkbox => {
                checkbox.addEventListener('change', () => updateCouleurGreenDisplay(section));
            });

            document.getElementById(section.green).addEventListener('click', function() {
                toggleCheckboxes(section, false);
            });

            document.getElementById(section.red).addEventListener('click', function() {
                toggleCheckboxes(section, true);
            });
        }

        sections.forEach(section => {
            updateCouleurGreenDisplay(section);
            addEventListeners(section);
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = document.getElementById('file-input');
        const preview = document.getElementById('preview');
        const deleteButton = document.getElementById('delete-button');
        const downloadButton = document.getElementById('download-button');

        // Fonction de mise à jour de l'aperçu
        const updatePreview = (src = '', display = 'none') => {
            preview.src = src;
            preview.style.display = display;
        };

        // Gestionnaire pour le changement de fichier
        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = event => updatePreview(event.target.result, 'block');
                reader.readAsDataURL(file);
            }
        });

        // Gestionnaire pour supprimer l'image
        deleteButton.addEventListener('click', () => updatePreview());

        // Gestionnaire pour télécharger l'image
        downloadButton.addEventListener('click', () => fileInput.click());
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.solid_distances').forEach(element => {
            element.addEventListener('click', () => {
                const nomCell = element.closest('tr').querySelector('td[data-label="Nom"]');
                const nomAffiche = document.getElementById('nom_affiche');

                nomAffiche.textContent = nomCell.textContent.trim();
                Object.assign(nomAffiche.style, {
                    textTransform: 'capitalize',
                    color: '#293d7a',
                    fontWeight: 'bold'
                });
            });
        });
    });
</script>
{{--  --}}
