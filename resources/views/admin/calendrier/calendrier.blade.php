<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des devoirs & examens</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
        integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
        integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/html/admin.css') }}">

    <style>
        body {
            font-family: 'poppins', sans-serif;
            background-color: #F8F8F8;
            color: #353E4A;
        }

        .containers {
            max-width: 1100px;
            margin: 0 auto;
        }






        .search-container {
            display: flex;
            align-items: center;
        }

        .search-bar {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        .search-bar input {
            border: 1px solid #DBDEE2;
            border-radius: 5px;
            padding: 10px 20px;
            width: 100%;
            font-size: 14px;
            padding-left: 35px;
            outline: none;
            box-shadow: none
        }

        .search-bar i.fa-search {
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
            width: 50% !important;
        }

        .fc-toolbar .fc-left .fc-button-group {
            display: flex;
            align-items: center;
        }

        .fc-day-header {
            background-color: #fff !important;
            color: #353E4A;
            font-weight: bold;
            text-align: center;
        }

        .fc-day-header .fc-widget-header {
            background-color: #E90C0C
        }

        .fc-day {
            background-color: #F8F8F8;
            gap: 10px
        }

        .fc-today {
            background-color: #C0CCFE !important;
        }

        .fc-event {
            border: 1px solid #8993A04D;
            border-radius: 4px;
            padding: 5px;
        }

        .event-economie-ma2a {
            background-color: #C0CCFE;
            color: #353E4A;
        }

        .fc-event .fc-time {
            color: #1E5AE6;
            font-weight: bold;
        }

        .fc {
            direction: ltr;
            text-align: left;
            background-color: #fff;
            border: 1px solid #E3E7EE;
        }

        .fc-event .fc-title {
            color: #353E4A;
        }

        .fc td,
        .fc th {
            /* border-style: solid;
            border-width: 1px; */
            padding: 0;
            vertical-align: top;
        }

        .fc td {
            border-style: solid;
            border-width: 6px;
            border-color: orange;

        }

        .fc thead td:first-child {
            border-top-color: red !important;

        }




        .fc th {

            border-style: none;
            height: 2rem;


        }

        .fc-day-grid-event .fc-content {
            white-space: normal;
        }

        .fc-event .fc-delete-icon {
            color: #E90C0C;
            float: right;
            margin-left: 10px;
        }

        /* .fc-button-group .fc-button {
            background-color: #1E5AE6;
            color: white;
            border: none;
        }

        .fc-button-group .fc-button:hover {
            background-color: #003CC8;
        } */

        /* .fc-state-active {
            background-color: #003CC8 !important;
        } */

        /* Cacher le bouton aujourd'hui */
        .fc-today-button {
            display: none;
        }

        .fc-left .fc-button-group {
            order: 3;
            display: flex;

        }

        .fc-center {
            display: flex !important;
            justify-content: flex-start;
            align-items: center;

        }

        .fc-right {
            order: 1;
            display: flex;

        }
    </style>
</head>

<body>
    <!-- header -->
    @include('admin.include.menu')
    <!-- accueil -->

    <div class="containers principal">
        <H1>Calendriers des dévoirs & examens</H1>
        <div id="calendar"></div>
    </div>

    <!-- Charger jQuery, moment.js et FullCalendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"
        integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/fr.js"></script>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                locale: 'fr',
                header: {
                    left: 'createButton', // Le bouton "Créer" à gauche
                    center: 'searchBar title ', // La barre de recherche suivie du titre centré
                    right: 'agendaDay,agendaWeek,month prev,next' // Les boutons "Jour", "Semaine", "Mois", et "Précédent", "Suivant" à droite
                },
                customButtons: {
                    createButton: {
                        text: '+ Créer', // Texte du bouton "Créer"
                        click: function() {
                            // Action lorsque le bouton est cliqué
                            alert('Créer un nouvel événement');
                        }
                    },

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
