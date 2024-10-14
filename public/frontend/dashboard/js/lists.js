(function () {
    let currentPage = 1;
    let rowsPerPage = 5; // Valeur par défaut pour les lignes par page

    document.addEventListener('DOMContentLoaded', function () {
        // Récupérer les éléments HTML
        const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
        const tableId = rowsPerPageSelect.getAttribute('data-table-id');

        searchTable(`${tableId} tbody`, 'searchInput', 'noResults');
        if (rowsPerPageSelect) {
            rowsPerPageSelect.addEventListener('change', function () {
                rowsPerPage = parseInt(this.value);
                currentPage = 1;
                paginateTable(tableId);
            });
        }

        paginateTable(tableId);
    });


    /**
     * Filtre les lignes du tableau en fonction du sujet donné.
     * @param {string} subject - Le sujet à filtrer.
     * @param {string} tableId - Le sélecteur de l'élément table.
     */
    function filterTable(subject, tableId) {
        const tables = document.querySelectorAll(`${tableId} tbody`);
        tables.forEach(table => {
            const rows = table.querySelectorAll('tr');
            rows.forEach(row => {
                const subjectCell = row.cells[5];
                if (subjectCell) {
                    row.style.display = subject === '' || subjectCell.textContent.trim() === subject ? '' : 'none';
                }
            });
        });
        paginateTable(tableId);
    }

    /**
     *
     * @param {string} tbodyId - Le sélecteur de l'élément tbody.
     * @param {string} searchInputId - L'ID de l'élément d'entrée de recherche.
     */
    function searchTable(tbodyId, searchInputId, noResultsId) {
        const searchInput = document.getElementById(searchInputId);
        const noResultsMessage = document.getElementById(noResultsId);

        searchInput.addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll(`${tbodyId} tr`);
            let found = false;

            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                let match = false;
                for (let i = 0; i < cells.length; i++) {
                    if (cells[i].textContent.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                row.style.display = match ? '' : 'none';
                if (match) {
                    found = true;
                }
            });

            noResultsMessage.style.display = found ? 'none' : 'block';
            paginateTable(tbodyId);
        });
    }

    /**
     *
     * @param {string} tableId - Le sélecteur de l'élément table.
     */
    function paginateTable(tableId) {
        const rows = document.querySelectorAll(`${tableId} tbody tr`);
        const totalRows = rows.length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);

        rows.forEach((row, index) => {
            if (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Met à jour les boutons "Précédent" et "Suivant"
        document.querySelector('.prev').disabled = currentPage === 1;
        document.querySelector('.next').disabled = currentPage === totalPages;

        document.querySelector('.prev').onclick = () => {
            if (currentPage > 1) {
                currentPage--;
                paginateTable(tableId);
            }
        };

        document.querySelector('.next').onclick = () => {
            if (currentPage < totalPages) {
                currentPage++;
                paginateTable(tableId);
            }
        };

        // Met à jour l'affichage de la pagination
        document.querySelector('.pagination-buttons .active').textContent = currentPage;
        document.querySelector('.pagination-buttons span').textContent = `sur ${totalPages}`;
    }

    /**
     * Exporter le tableau vers un fichier Excel.
     * @param {string} tableId - Le sélecteur de l'élément table.
     */
    function exportTableToExcel(tableId) {
        const table = document.querySelector(tableId);
        if (!table) return;

        const pageTitle = document.querySelector('h1') ? document.querySelector('h1').textContent : 'default';
        const fileName = pageTitle.trim() || 'data';
        const workbook = XLSX.utils.book_new();
        const rows = Array.from(table.rows).map(row => {
            const cells = Array.from(row.cells);
            return cells.filter((cell, index) => index !== cells.length - 1).map(cell => cell.textContent);
        });
        const worksheet = XLSX.utils.aoa_to_sheet(rows);
        XLSX.utils.sheet_add_aoa(worksheet, [[pageTitle]], { origin: 'A1' });
        const range = XLSX.utils.decode_range(worksheet['!ref']);
        worksheet['!merges'] = [{ s: { r: 0, c: 0 }, e: { r: 0, c: range.e.c } }];
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
        XLSX.writeFile(workbook, `${fileName}.xlsx`);
    }

    /**
     * Exporter le tableau vers un fichier PDF.
     * @param {string} tableId - Le sélecteur de l'élément table.
     */
    function exportTableToPDF(tableId) {
        const table = document.querySelector(tableId);
        if (!table) return;
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l');
        const pageTitle = document.querySelector('h1') ? document.querySelector('h1').textContent : 'default';
        const fileName = pageTitle.trim() || 'data';
        doc.setFontSize(18);
        doc.text(pageTitle, doc.internal.pageSize.getWidth() / 2, 10, { align: 'center' });
        doc.autoTable({ html: table, startY: 20 });
        doc.save(`${fileName}.pdf`);
    }

    /**
     * Imprimer la div courante.
     */
    function printDiv() {
        window.print();
    }

    // Exposer les fonctions pour une utilisation globale
    window.filterTable = filterTable;
    window.searchTable = searchTable;
    window.paginateTable = paginateTable;
    window.exportTableToExcel = exportTableToExcel;
    window.exportTableToPDF = exportTableToPDF;
    window.printDiv = printDiv;
})();

function setActive(event, id) {
    event.preventDefault();

    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });

    document.getElementById(id).classList.add('active');
}
(function () {
    const filters = {};
    let tableConfig = {};
    const tableId = '';

    /**
     * Fonction pour définir la configuration des colonnes du tableau dynamiquement
     * @param {Object} config
     */
    window.setTableConfig = function (config) {
        tableConfig = config;
    };

    /**
     * Fonction générique pour appliquer un filtre basé sur le type et la valeur
     * @param {string} type
     * @param {string} value
     */
    window.applyFilter = function (type, value) {
        filters[type] = value;
        filterTable(tableId); // Applique le filtre au tableau spécifié
    };

    /**
     * Fonction pour filtrer le tableau en fonction des filtres sélectionnés
     * @param {string} tableId
     */
    function filterTable(tableId) {
        const rows = document.querySelectorAll(`${tableId} tbody tr`);
        rows.forEach(row => {
            let visible = true;

            // Vérifie chaque type de filtre appliqué
            Object.keys(filters).forEach(type => {
                const filterValue = filters[type];
                const columnIndex = getColumnIndex(type); // Utilise getColumnIndex pour trouver l'index de la colonne
                const cellValue = row.cells[columnIndex] ? row.cells[columnIndex].textContent.trim() : '';
                if (filterValue && cellValue !== filterValue) {
                    visible = false;
                }
            });

            row.style.display = visible ? '' : 'none'; // Affiche ou masque la ligne
        });
    }

    /**

     * @param {string} type
     * @returns {number}
     */
    function getColumnIndex(type) {
        return tableConfig[type] !== undefined ? tableConfig[type] : -1;
    }
})();
