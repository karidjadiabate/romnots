<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <script src="{{ asset('frontend/dashboard/js/list.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/html/admin.css') }}">
    <title>Bienvenue sur ROMNote</title>

</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: white;
        margin: 0;
        padding: 0;
        color: #4a3dbb;
        line-height: 1.3;
    }

    .container {
        width: 90%;
        max-width: 1100px;
        margin: 20px auto;
        padding: 20px;
        margin-top: 5%
    }

    h1 {
        font-size: 26px;
        text-align: center;
        margin-bottom: 20px;
        text-align: center;
    }

    h2 {
        font-size: 20px;
        margin-top: 20px;
        text-align: center;
    }

    p {
        text-align: center;

    }

    .section {
        margin-bottom: 30px;
    }



    .text-center {
        text-align: center;
    }



    strong {
        font-style: italic;
    }
</style>
</head>

<body>
    <!-- header -->
    @include('admin.include.menu')
    <!-- accueil -->
    <div class="container">
        <h1>Ressources d'aide et Confidentialité ROMNote</h1>
        <div class="section">
            <h2>Aide à l'Utilisation de ROMNote</h2>
            <p>ROMNote est une application web conçue pour faciliter la création et la correction de sujets
                d'évaluations. Elle permet aux enseignants et administrateurs de gérer le processus d’évaluation des
                étudiants de manière simple et efficace.</p>
            <h2>Fonctionnalités principales :</h2>

            <p> <strong>Création de sujets d’évaluation :</strong>ROMNote permet de créer facilement des sujets avec des
                questions à choix multiples, des textes à trous,
                des questions ouvertes, etc. Vous pouvez personnaliser les évaluations selon vos besoins pédagogiques.
            </p>

            <p><strong>Génération de feuilles OMR : </strong>Les feuilles de réponses OMR (Optical Mark Recognition)
                peuvent être générées automatiquement à partir
                des sujets créés, prêtes à être imprimées pour la distribution aux étudiants.</p>

            <p> <strong>Correction automatique : </strong>ROMNote propose une correction automatique des réponses des
                étudiants grâce à la technologie OMR. Il
                suffit de scanner les feuilles OMR remplies et de les soumettre à ROMNote pour obtenir les résultats.
            </p>

            <p> <strong>Gestion des écoles et des étudiants : </strong>L’application offre une gestion complète des
                écoles, classes, et étudiants. Les évaluations peuvent être
                attribuées à des groupes spécifiques d’étudiants et leurs résultats suivis.</p>

            <p><strong>Rapports et statistiques : </strong>ROMNote permet d’analyser les résultats des évaluations avec
                des rapports détaillés. Ces statistiques
                aident à identifier les points forts et les domaines d’amélioration pour chaque étudiant ou groupe
                d’étudiants.</p>
        </div>

        <div class="section">
            <h2>Politique de Confidentialité</h2>
            <p>Chez ROMNote, nous accordons une grande importance à la confidentialité et à la protection des données de
                nos utilisateurs. Cette politique de confidentialité explique quelles données nous collectons, pourquoi
                nous les collectons, et comment elles sont utilisées.</p>
            <h2>1. Collecte des informations :</h2>
            <p>Nous collectons les données nécessaires à la fourniture de nos services, y compris : Les informations
                personnelles des enseignants et étudiants (nom, adresse email, numéro de téléphone). Les informations
                relatives aux évaluations (nom d’évaluation, classe, identifiant d’étudiant). Les résultats des
                évaluations et autres performances scolaires.</p>
            <h2>2. Utilisation des informations :</h2>
            <p>La création, la gestion et la correction des sujets d’évaluations. L’attribution des résultats aux
                étudiants et la génération de rapports. L’amélioration continue de l’expérience utilisateur.</p>
            <h2>3. Partage des informations :</h2>
            <p>Vos données ne seront jamais vendues ou partagées à des tiers à des fins commerciales. Nous partageons
                uniquement les informations avec des tiers lorsque cela est nécessaire pour fournir nos services (par
                exemple, pour l’hébergement ou l’analyse des données), et nous veillons à ce que ces partenaires
                respectent les mêmes normes de confidentialité.</p>
            <h2>4. Sécurité des données :</h2>
            <p>Nous prenons des mesures de sécurité appropriées pour protéger vos informations contre tout accès non
                autorisé, modification, divulgation ou destruction. Nous utilisons des protocoles de cryptage pour
                sécuriser vos données en transit et au repos.</p>
            <h2>5. Vos droits :</h2>
            <p>Vous avez le droit d’accéder, de corriger ou de supprimer vos informations personnelles à tout moment.
                Vous pouvez également demander à ce que vos données ne soient plus traitées. Pour exercer ces droits,
                contactez nous à : privacy@romnote.com.</p>
            <h2>Mises à jour de cette politique :</h2>
            <p>Nous nous réservons le droit de modifier cette politique de confidentialité de temps en temps. Toute
                modification sera publiée sur cette page, et si les changements sont significatifs, nous vous en
                informerons par email.</p>
        </div>
    </div>
    <!-- Footer -->
    @include('admin.include.footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
