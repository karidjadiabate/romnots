<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des devoirs & examens</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
        integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #F8F8F8;
            color: #353E4A;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .search-bar {
            position: relative;
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        .search-bar input {
            border: 1px solid #DBDEE2;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 14px;
            padding-left: 35px;
        }

        .search-bar i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #8993A0;
        }

        .fc-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .fc-toolbar h2 {
            color: #353E4A;
            font-size: 20px;
            margin-left: 10px;
        }

        .fc-button-group .fc-button {
            background-color: #1E5AE6;
            color: white;
            border: none;
        }

        .fc-button-group .fc-button:hover {
            background-color: #003CC8;
        }

        .fc-state-active {
            background-color: #003CC8 !important;
        }

        .fc-today-button {
            display: none;
        }

        .fc-right {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .fc-center {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .fc-left {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>

    <div class="container principal">
        <div id="calendar"></div>
    </div>

    <!-- Charger jQuery, moment.js et FullCalendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/fr.js"></script>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                locale: 'fr',
                header: {
                    left: 'createButton', // Le bouton "Créer" à gauche
                    center: 'searchBar title', // La barre de recherche suivie du titre centré
                    right: 'agendaDay,agendaWeek,month prev,next' // Boutons à droite
                },
                customButtons: {
                    createButton: {
                        text: '+ Créer',
                        click: function() {
                            alert('Créer un nouvel événement');
                        }
                    }
                },
                defaultDate: '2024-07-01',
                editable: true,
                events: [{
                        title: 'Économie MA2A',
                        start: '2024-07-15T08:00:00',
                        end: '2024-07-15T12:00:00',
                        className: 'event-economie-ma2a',
                        description: 'Économie pour MA2A',
                    },
                    {
                        title: 'Économie CFIC',
                        start: '2024-07-23T08:00:00',
                        end: '2024-07-23T12:00:00',
                        className: 'event-economie-ma2a',
                        description: 'Économie pour CFIC',
                    }
                ],
                eventRender: function(event, element) {
                    element.find('.fc-title').append(
                        '<span class="fc-delete-icon fa fa-times"></span>');
                }
            });

            // Injecter la barre de recherche avant le titre dans la section center
            $(".fc-center").prepend(`
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher...">
                </div>
            `);
        });
    </script>

</body>

</html>
