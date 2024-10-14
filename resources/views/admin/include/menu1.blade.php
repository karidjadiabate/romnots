<style>
    /* Style pour l'élément actif */
    .custom-profile-dropdown {
        background-color: #FFFFFF;
        border-radius: 12px;
        padding: 10px;
        box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.1);
    }

    .custom-profile-dropdown .dropdown-header h6 {
        color: #4A41C5;
        margin-bottom: 5px;
    }

    .custom-profile-dropdown .view-profile {
        color: #4A41C5;
        font-size: 12px;
    }

    .custom-profile-dropdown .dropdown-item {
        display: flex;
        align-items: center;
        color: #4A41C5;
        font-size: 14px;
        padding: 10px 15px;
    }

    .custom-profile-dropdown .dropdown-item .icon {
        width: 20px;
        height: 20px;
        margin-right: 10px;
        fill: #4A41C5;
    }

    .custom-profile-dropdown .dropdown-divider {
        margin: 10px 0;
    }

    .nav-item.active .nav-link {
        color: #38B293;
    }

    .nav-item.active .nav-link svg path {
        fill: #38B293;
    }

    input[type="search"]::-webkit-search-cancel-button {
        -webkit-appearance: none;
        appearance: none;
    }

    input[type="search"]::-moz-search-cancel-button {
        display: none;
    }

    .search-bar .input-group-text {
        border: 2px solid white;
        background-color: #4a3dbb;
        border-radius: 6px;
        padding: 5px 6px;
    }

    .search-bar .fa-magnifying-glass {
        margin-right: 5px;
        color: white;
    }

    .search-bar .form-control {
        background-color: #4a3dbb;
        color: white;
        border: none;
        outline: none;
        height: 30px;
        font-size: 12px;
        padding-left: 0;
    }

    .search-bar .search-input::placeholder {
        color: white;
    }

    #profi svg {
        background-color:
    }

    .badge.notification {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: red;
        color: white;
        font-size: 0.75rem;
        padding: 0.25em 0.4em;
        border-radius: 1.25rem;
    }


    /*  */
    /* Style personnalisé pour le dropdown de notification */
    .custom-dropdown {
        width: 230px;

        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .notification-empty {
        text-align: center;
        padding: 20px;
        color: #9494C9;

    }

    .notification-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    .notification-icon svg {
        fill: #9494C9;

    }

    .notification-text {
        font-size: 16px;
        color: #9494C9;
    }

    .notification-text a {
        text-decoration: none
    }

    .notification-text p {
        text-decoration: none;
        color: #4a3dbb;
    }

    .no-notifications {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #9494C9;
    }

    .no-notifications i {
        font-size: 40px !important;
        margin-bottom: 9px;

    }

    /* Style pour le conteneur de l'icône avec arrière-plan */
    .icon-background {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background-color: #e0e0e0;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    /* Style de l'icône */
    .icon-background i {
        font-size: 24px;
        color: #4c45dd;
    }

    /*  */
    /* Style du menu déroulant personnalisé */
    .custom-profile-dropdown {
        width: 250px;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .dropdown-header {
        display: flex;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .dropdown-header .profile-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
        /* Espace entre l'image et le texte */
    }

    .dropdown-header .profile-info {
        text-align: left;
    }

    .dropdown-header h6 {
        margin: 0;
        font-weight: bold;
        color: #333;
    }

    .dropdown-header .view-profile {
        font-size: 12px;
        color: #666;
        text-decoration: none;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 10px;
        font-size: 14px;
        color: #333;
    }

    #profi .dropdown-item svg {
        margin-right: 10px;
        color: #4a41c5;
        width: 24px;
        height: 24px;
    }

    .dropdown-divider {
        margin: 0.5rem 0;
        border-top: 1px solid #ddd;
    }

    /* modal signature */

    /* .modal {
        width: 500px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
        padding: 20px;
    } */

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-header h2 {
        margin: 0;
        color: #4a3dbb;
        font-size: 24px;
    }

    .close-btn {
        cursor: pointer;
        color: #4a3dbb;
        font-size: 24px;
        border: none;
        background: none;
    }

    .tab-container {
        display: flex;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
    }

    .tab-link {
        padding: 10px 20px;
        color: #4a3dbb;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
        border-bottom: 2px solid transparent;
    }

    .tab-link.active {
        border-bottom: 2px solid #4a3dbb;
        font-weight: bold;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .signature-area {
        width: 100%;
        height: 200px;
        border: 1px solid #ddd;
        background-color: #f8f8f8;
    }

    .upload-area {
        border: 2px dashed #4a3dbb;
        border-radius: 10px;
        background-color: #f8f8f8;
        padding: 40px;
        text-align: center;
        color: #aaa;
        font-size: 18px;
        position: relative;
    }

    /* .upload-area::after {
            content: "OU";
            display: block;
            margin: 20px 0;
            color: #777;
        } */

    .upload-button {
        background-color: #38B293;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 0%;
        cursor: pointer;
        font-size: 16px;
        display: inline-flex;
        align-items: center;
    }

    .upload-button i {
        margin-right: 5px;
    }
</style>
<nav class="navbar navbar-expand-lg  ">
    <div class="container-fluid">
        <!-- logo -->
        <a class="navbar-brand" href="#" style="margin-left:5px;">AKP <span>ROM-Note</span></a>
        <!-- menu -->
        <button class="navbar-toggler" type="button" id="toggleButton" aria-controls="offcanvasScrolling"
            aria-expanded="false" aria-label="Toggle navigation">

            <form class="d-flex search-bar" id="sea" role="search">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input class="form-control search-input" type="search" placeholder="Rechercher..."
                            aria-label="Search">
                    </span>
                </div>
            </form>


            <!-- Search bar -->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item dropdown" id="noti">
                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    @unless (auth()->user()->unreadNotifications->isEmpty())
                        <span id="notificationCounter"
                            class="badge notification">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endunless

                </a>
                <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                    <li class="notification-empty">
                        <div class="notification-icon">
                        </div>
                        <div class="notification-text">
                            <div class="icon-background">
                                <i class="fas fa-bell fa-fw"></i>
                            </div>
                            @forelse (auth()->user()->unreadNotifications as $notification)
                                @if (isset($notification->data['demoId']))
                                    <a href="{{ route('demo.notification', ['notification' => $notification->id]) }}">
                                        <p>Nouvelle demande de démo numéro
                                            <strong>{{ $notification->data['demoId'] }}</strong>
                                        </p>
                                    </a>
                                @elseif (isset($notification->data['demandeInscriptionId']))
                                    <a
                                        href="{{ route('demandeinscription.notification', ['notification' => $notification->id]) }}">
                                        <p>Nouvelle demande d'inscription numéro
                                            <strong>{{ $notification->data['demandeInscriptionId'] }}</strong>
                                        </p>
                                    </a>
                                @endif

                            @empty
                                <div class="no-notifications">
                                    <p>Aucune notification</p>
                                </div>
                            @endforelse
                        </div>
                    </li>
                </ul>

            </li>
            &nbsp;&nbsp;

            </span>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item dropdown" id="profi">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    @if (auth()->user()->image)
                        <img src="{{ asset('storage/profile/' . auth()->user()->image) }}" alt="User"
                            class="rounded-circle profile-image" style="width: 40px; height: 35x; margin-top:-5px">
                    @else
                        <img src="{{ Avatar::create(auth()->user()->nom . ' ' . auth()->user()->prenom)->toBase64() }}"
                            alt="User" class="rounded-circle profile-image"
                            style="width: 40px; height: 35x; margin-top:-5px">
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end custom-profile-dropdown">
                    <li class="dropdown-header d-flex align-items-center">
                        @if (auth()->user()->image)
                            <img src="{{ asset('storage/profile/' . auth()->user()->image) }}" alt="User"
                                class="rounded-circle profile-image">
                        @else
                            <img src="{{ Avatar::create(auth()->user()->nom . ' ' . auth()->user()->prenom)->toBase64() }}"
                                alt="User" class="rounded-circle profile-image">
                        @endif


                        <div class="profile-info">
                            <h6 class="mt-2">{{ auth()->user()->nom . "\n" . auth()->user()->prenom }}</h6>
                            <a href="{{ route('moncompte') }}" class="view-profile">Voir le profil</a>
                        </div>
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="">
                            <!-- SVG pour Signature -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="25.943" height="25.125"
                                viewBox="0 0 25.943 25.125">
                                <path id="Tracé_456" data-name="Tracé 456"
                                    d="M13.14,9.771a53.017,53.017,0,0,0-7.41,11.218A1.441,1.441,0,0,1,3.152,19.7,55.879,55.879,0,0,1,10.984,7.858a25.093,25.093,0,0,1,3.611-3.43,9.606,9.606,0,0,1,1.618-1A4.018,4.018,0,0,1,17.893,3a1.786,1.786,0,0,1,.971.281A1.815,1.815,0,0,1,19.5,4a2.677,2.677,0,0,1,.246,1.252,10.774,10.774,0,0,1-.43,2.422c-.482,1.792-1.329,4.167-2.172,6.512l-.118.329c-.815,2.269-1.618,4.5-2.14,6.285-.141.481-.256.912-.344,1.29,1-.8,2.232-2.012,3.541-3.3l.043-.042c1.271-1.248,2.615-2.569,3.749-3.476a7.98,7.98,0,0,1,1.754-1.125,2.2,2.2,0,0,1,2.489.328,2.8,2.8,0,0,1,.748,1.811,7.209,7.209,0,0,1-.125,1.743,33.069,33.069,0,0,1-.985,3.711l-.06.195c-.333,1.083-.631,2.049-.8,2.826a10.288,10.288,0,0,0,1.376-1.853,1.441,1.441,0,1,1,2.458,1.506,10.643,10.643,0,0,1-2.452,2.96,3.035,3.035,0,0,1-3.265.459,2.145,2.145,0,0,1-1.12-1.8,5.873,5.873,0,0,1,.128-1.607c.189-.969.555-2.157.9-3.28L23,20.89a30.564,30.564,0,0,0,.9-3.364q.019-.109.034-.209-.123.093-.261.2c-1.006.8-2.249,2.023-3.571,3.322l-.043.042c-1.27,1.248-2.615,2.569-3.749,3.476a7.985,7.985,0,0,1-1.754,1.125,2.055,2.055,0,0,1-3.085-1.676,5.027,5.027,0,0,1,.033-1.157,18.406,18.406,0,0,1,.614-2.667c.547-1.87,1.377-4.179,2.18-6.412l.132-.367c.856-2.381,1.656-4.632,2.1-6.285q.059-.218.106-.412-.154.106-.322.231A22.294,22.294,0,0,0,13.14,9.771Z"
                                    transform="translate(-3 -3)" fill="#4a41c5" />
                            </svg> Signature</a>
                    </li>
                    <li><a class="dropdown-item" href="#">
                            <!-- SVG pour Signature -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="34.52" height="25.119"
                                viewBox="0 0 34.52 25.119">
                                <g id="Groupe_280" data-name="Groupe 280" transform="translate(0 0)">
                                    <path id="Tracé_457" data-name="Tracé 457"
                                        d="M39.14,153.119c4.009,0,6.744-1.122,7.477-3.079a4.9,4.9,0,0,0-.147-4.2,1.35,1.35,0,0,1-.1-1.416c.243-.637.586-.93,1.81-.93.389,0,.783.05,1.269.05a14.253,14.253,0,0,0,1.466.05,4.376,4.376,0,0,0,4.6-3.129,6.475,6.475,0,0,0-1.122-6.011C51.55,130.689,45,128,38.407,128c-9.433,0-17.107,5.424-17.107,12.072C21.3,149.06,31.709,153.119,39.14,153.119Zm-.733-22.187c5.52,0,11.339,2.3,13.538,5.328a3.527,3.527,0,0,1,.683,3.372c-.2.783-.536,1.077-1.759,1.077-.389,0-.783-.05-1.223-.05a14.249,14.249,0,0,0-1.466-.05,4.438,4.438,0,0,0-4.494,2.735,4.213,4.213,0,0,0,.147,3.715,2.082,2.082,0,0,1,.1,1.956c-.147.389-1.562,1.223-4.787,1.223-6.208-.05-14.908-3.179-14.908-10.166C24.232,135.037,30.586,130.932,38.407,130.932Z"
                                        transform="translate(-21.3 -128)" fill="#4a41c5" />
                                    <path id="Tracé_458" data-name="Tracé 458"
                                        d="M325.3,350.608a3.91,3.91,0,1,0,3.912-3.908A3.92,3.92,0,0,0,325.3,350.608Zm3.912-.976a.976.976,0,1,1-.976.976A.98.98,0,0,1,329.212,349.632Z"
                                        transform="translate(-311.373 -336.681)" fill="#4a41c5" />
                                    <path id="Tracé_459" data-name="Tracé 459"
                                        d="M168.522,448.709c-.293-1.516-1.319-1.709-1.759-1.709a.6.6,0,0,0-.293.05,2.07,2.07,0,0,0-1.709,1.759,1.7,1.7,0,0,0,.93,1.855,2.864,2.864,0,0,0,1.37.344,1.66,1.66,0,0,0,1.466-.783,2.084,2.084,0,0,0,0-1.516Z"
                                        transform="translate(-158.159 -432.386)" fill="#4a41c5" />
                                    <path id="Tracé_460" data-name="Tracé 460"
                                        d="M111.613,349.119c.1-.05.147-.05.2-.1a1.639,1.639,0,0,0,1.37-1.516c.1-1.173-.976-1.613-1.466-1.81l-.05-.05a1.991,1.991,0,0,0-.733-.147,1.832,1.832,0,0,0-1.613.93,2,2,0,0,0-.05,1.956,1.606,1.606,0,0,0,1.466.93A2.853,2.853,0,0,0,111.613,349.119Z"
                                        transform="translate(-105.015 -335.536)" fill="#4a41c5" />
                                    <path id="Tracé_461" data-name="Tracé 461"
                                        d="M179.6,258.267a2.639,2.639,0,0,0,2.249-2.1,1.792,1.792,0,0,0-1.37-1.663,2.139,2.139,0,0,0-2.346.93,1.985,1.985,0,0,0,0,1.956A1.649,1.649,0,0,0,179.6,258.267Z"
                                        transform="translate(-170.702 -248.642)" fill="#4a41c5" />
                                    <path id="Tracé_462" data-name="Tracé 462"
                                        d="M291.909,222.314h.344a1.73,1.73,0,0,0,1.709-1.416,1.859,1.859,0,0,0-1.269-2,3.185,3.185,0,0,0-.683-.1,1.81,1.81,0,0,0-1.81,1.855,1.754,1.754,0,0,0,.44,1.173A1.611,1.611,0,0,0,291.909,222.314Z"
                                        transform="translate(-277.881 -214.64)" fill="#4a41c5" />
                                    <path id="Tracé_463" data-name="Tracé 463"
                                        d="M406.519,222.168a.938.938,0,0,0,.344-.05A1.689,1.689,0,0,0,408.476,221a1.648,1.648,0,0,0-.637-1.906,1.97,1.97,0,0,0-1.122-.389,1.81,1.81,0,0,0-1.81,1.663,1.6,1.6,0,0,0,.389,1.319A1.953,1.953,0,0,0,406.519,222.168Z"
                                        transform="translate(-387.315 -214.545)" fill="#4a41c5" />
                                    <path id="Tracé_464" data-name="Tracé 464"
                                        d="M517.493,250.968a1.586,1.586,0,0,0,.683.147,1.62,1.62,0,0,0,1.516-1.173,1.977,1.977,0,0,0-.88-2.2,2.022,2.022,0,0,0-.93-.243,1.755,1.755,0,0,0-.389,3.468Z"
                                        transform="translate(-493.45 -242.025)" fill="#4a41c5" />
                                </g>
                            </svg>Apparence & <br>accessibilité </a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('moncompte') }}">
                            <!-- SVG pour Compte -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="26.173" height="24.538"
                                viewBox="0 0 26.173 24.538">
                                <path id="sliders-solid"
                                    d="M0,36.448a1.634,1.634,0,0,0,1.636,1.636h2.8a4.088,4.088,0,0,0,7.494,0H24.538a1.636,1.636,0,0,0,0-3.272H11.926a4.088,4.088,0,0,0-7.494,0h-2.8A1.634,1.634,0,0,0,0,36.448Zm6.543,0a1.636,1.636,0,1,1,1.636,1.636A1.636,1.636,0,0,1,6.543,36.448Zm9.815-8.179A1.636,1.636,0,1,1,17.994,29.9,1.636,1.636,0,0,1,16.358,28.269Zm1.636-4.09a4.082,4.082,0,0,0-3.747,2.454H1.636a1.636,1.636,0,1,0,0,3.272H14.247a4.088,4.088,0,0,0,7.494,0h2.8a1.636,1.636,0,1,0,0-3.272h-2.8A4.082,4.082,0,0,0,17.994,24.179ZM9.815,21.725a1.636,1.636,0,1,1,1.636-1.636A1.636,1.636,0,0,1,9.815,21.725Zm3.747-3.272a4.088,4.088,0,0,0-7.494,0H1.636a1.636,1.636,0,1,0,0,3.272H6.068a4.088,4.088,0,0,0,7.494,0H24.538a1.636,1.636,0,1,0,0-3.272Z"
                                    transform="translate(0 -16)" fill="#4a41c5" />
                            </svg> Compte</a>
                    </li>
                    @if (auth()->user()->role_id === 3)
                        <li><a class="dropdown-item" href="{{ route('apropos.admin') }}">
                                <!-- SVG pour A propos -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.729" height="27.457"
                                    viewBox="0 0 13.729 27.457">
                                    <path id="Tracé_452" data-name="Tracé 452"
                                        d="M36.012,49.728H32.58V37.716A1.715,1.715,0,0,0,30.864,36H27.432a1.716,1.716,0,0,0,0,3.432h1.716v10.3H25.716a1.716,1.716,0,1,0,0,3.432h10.3a1.716,1.716,0,0,0,0-3.432Z"
                                        transform="translate(-24 -25.704)" fill="#4a41c5" />
                                    <path id="Tracé_453" data-name="Tracé 453"
                                        d="M39.432,6.864A3.432,3.432,0,1,0,36,3.432a3.432,3.432,0,0,0,3.432,3.432Z"
                                        transform="translate(-32.568)" fill="#4a41c5" />
                                </svg> A propos</a>
                        </li>
                    @elseif(auth()->user()->role_id === 2)
                        <li><a class="dropdown-item" href="{{ route('apropos.professeur') }}">
                                <!-- SVG pour A propos -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.729" height="27.457"
                                    viewBox="0 0 13.729 27.457">
                                    <path id="Tracé_452" data-name="Tracé 452"
                                        d="M36.012,49.728H32.58V37.716A1.715,1.715,0,0,0,30.864,36H27.432a1.716,1.716,0,0,0,0,3.432h1.716v10.3H25.716a1.716,1.716,0,1,0,0,3.432h10.3a1.716,1.716,0,0,0,0-3.432Z"
                                        transform="translate(-24 -25.704)" fill="#4a41c5" />
                                    <path id="Tracé_453" data-name="Tracé 453"
                                        d="M39.432,6.864A3.432,3.432,0,1,0,36,3.432a3.432,3.432,0,0,0,3.432,3.432Z"
                                        transform="translate(-32.568)" fill="#4a41c5" />
                                </svg> A propos</a>
                        </li>
                    @elseif(auth()->user()->role_id === 4)
                        <li><a class="dropdown-item" href="{{ route('apropos.superadmin') }}">
                                <!-- SVG pour A propos -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.729" height="27.457"
                                    viewBox="0 0 13.729 27.457">
                                    <path id="Tracé_452" data-name="Tracé 452"
                                        d="M36.012,49.728H32.58V37.716A1.715,1.715,0,0,0,30.864,36H27.432a1.716,1.716,0,0,0,0,3.432h1.716v10.3H25.716a1.716,1.716,0,1,0,0,3.432h10.3a1.716,1.716,0,0,0,0-3.432Z"
                                        transform="translate(-24 -25.704)" fill="#4a41c5" />
                                    <path id="Tracé_453" data-name="Tracé 453"
                                        d="M39.432,6.864A3.432,3.432,0,1,0,36,3.432a3.432,3.432,0,0,0,3.432,3.432Z"
                                        transform="translate(-32.568)" fill="#4a41c5" />
                                </svg> A propos</a>
                        </li>
                    @endif

                    @if (auth()->user()->role_id === 3)
                        <li><a class="dropdown-item" href="{{ route('aideconfidentialite.admin') }}">
                                <!-- SVG pour Aide & Confidentialité -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="17.664" height="35.327"
                                    viewBox="0 0 17.664 35.327">
                                    <path id="Tracé_450" data-name="Tracé 450"
                                        d="M32.832,0A8.842,8.842,0,0,0,24,8.832a2.208,2.208,0,1,0,4.416,0,4.416,4.416,0,0,1,8.832,0c0,1.915-1.126,3.09-2.976,4.8-1.712,1.576-3.648,3.362-3.648,6.242a2.208,2.208,0,0,0,4.416,0c0-.9.845-1.725,2.225-3,1.854-1.712,4.4-4.056,4.4-8.043A8.842,8.842,0,0,0,32.832,0Z"
                                        transform="translate(-24)" fill="#4a41c5" />
                                    <path id="Tracé_451" data-name="Tracé 451"
                                        d="M40.416,72a4.416,4.416,0,1,0,4.416,4.416A4.416,4.416,0,0,0,40.416,72Z"
                                        transform="translate(-31.584 -45.505)" fill="#4a41c5" />
                                </svg> Aide & confidentialité</a>
                        </li>
                    @elseif(auth()->user()->role_id === 2)
                        <li><a class="dropdown-item" href="{{ route('aideconfidentialite.professeur') }}">
                                <!-- SVG pour Aide & Confidentialité -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="17.664" height="35.327"
                                    viewBox="0 0 17.664 35.327">
                                    <path id="Tracé_450" data-name="Tracé 450"
                                        d="M32.832,0A8.842,8.842,0,0,0,24,8.832a2.208,2.208,0,1,0,4.416,0,4.416,4.416,0,0,1,8.832,0c0,1.915-1.126,3.09-2.976,4.8-1.712,1.576-3.648,3.362-3.648,6.242a2.208,2.208,0,0,0,4.416,0c0-.9.845-1.725,2.225-3,1.854-1.712,4.4-4.056,4.4-8.043A8.842,8.842,0,0,0,32.832,0Z"
                                        transform="translate(-24)" fill="#4a41c5" />
                                    <path id="Tracé_451" data-name="Tracé 451"
                                        d="M40.416,72a4.416,4.416,0,1,0,4.416,4.416A4.416,4.416,0,0,0,40.416,72Z"
                                        transform="translate(-31.584 -45.505)" fill="#4a41c5" />
                                </svg> Aide & confidentialité</a>
                        </li>
                    @elseif(auth()->user()->role_id === 4)
                        <li><a class="dropdown-item" href="{{ route('aideconfidentialite.superadmin') }}">
                                <!-- SVG pour Aide & Confidentialité -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="17.664" height="35.327"
                                    viewBox="0 0 17.664 35.327">
                                    <path id="Tracé_450" data-name="Tracé 450"
                                        d="M32.832,0A8.842,8.842,0,0,0,24,8.832a2.208,2.208,0,1,0,4.416,0,4.416,4.416,0,0,1,8.832,0c0,1.915-1.126,3.09-2.976,4.8-1.712,1.576-3.648,3.362-3.648,6.242a2.208,2.208,0,0,0,4.416,0c0-.9.845-1.725,2.225-3,1.854-1.712,4.4-4.056,4.4-8.043A8.842,8.842,0,0,0,32.832,0Z"
                                        transform="translate(-24)" fill="#4a41c5" />
                                    <path id="Tracé_451" data-name="Tracé 451"
                                        d="M40.416,72a4.416,4.416,0,1,0,4.416,4.416A4.416,4.416,0,0,0,40.416,72Z"
                                        transform="translate(-31.584 -45.505)" fill="#4a41c5" />
                                </svg> Aide & confidentialité</a>
                        </li>
                    @endif
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <!-- SVG pour Déconnexion -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="26.81" height="30.726"
                                viewBox="0 0 26.81 30.726">
                                <g id="Groupe_279" data-name="Groupe 279" transform="translate(0 0)">
                                    <path id="Tracé_454" data-name="Tracé 454"
                                        d="M43.915,11.489A1.914,1.914,0,0,0,45.83,9.574V1.915a1.915,1.915,0,0,0-3.83,0v7.66a1.914,1.914,0,0,0,1.915,1.915Z"
                                        transform="translate(-30.51 0)" fill="#4a41c5" />
                                    <path id="Tracé_455" data-name="Tracé 455"
                                        d="M28.341,21.929a1.915,1.915,0,1,0-2.558,2.85,9.38,9.38,0,0,1,3.194,7.052,9.574,9.574,0,1,1-19.149,0,9.38,9.38,0,0,1,3.195-7.052,1.915,1.915,0,1,0-2.559-2.849,13.4,13.4,0,1,0,17.877,0Z"
                                        transform="translate(-5.997 -14.596)" fill="#4a41c5" />
                                </g>
                            </svg> Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>





            <span class="solid" id="menuIcon" style="margin-top: 0; cursor: pointer;">
                <i class="fa-solid fa-bars"></i>
        </button>

        <div class="offcanvas offcanvas-start" style="background-color:#4a3dbb" data-bs-scroll="true"
            data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling"
            aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel"> <a class="navbar-brand" href="#"
                        style="margin-left:5px;">AKP <span>ROM-Note</span></a></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </li>
                    <!-- tableau de bord -->
                    @if (auth()->user()->role_id === 4)
                        <li class="nav-item" id="tableau">
                            <a class="nav-link " href="/superadmin">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34.798" height="34.798"
                                        viewBox="0 0 34.798 34.798">
                                        <path id="Tracé_366" data-name="Tracé 366"
                                            d="M3,20.4a1.933,1.933,0,0,0,1.933,1.933h11.6A1.933,1.933,0,0,0,18.466,20.4V4.933A1.933,1.933,0,0,0,16.533,3H4.933A1.933,1.933,0,0,0,3,4.933ZM3,35.865A1.933,1.933,0,0,0,4.933,37.8h11.6a1.933,1.933,0,0,0,1.933-1.933V28.132A1.933,1.933,0,0,0,16.533,26.2H4.933A1.933,1.933,0,0,0,3,28.132Zm19.332,0A1.933,1.933,0,0,0,24.265,37.8h11.6A1.933,1.933,0,0,0,37.8,35.865V20.4a1.933,1.933,0,0,0-1.933-1.933h-11.6A1.933,1.933,0,0,0,22.332,20.4ZM24.265,3a1.933,1.933,0,0,0-1.933,1.933v7.733A1.933,1.933,0,0,0,24.265,14.6h11.6A1.933,1.933,0,0,0,37.8,12.666V4.933A1.933,1.933,0,0,0,35.865,3Z"
                                            transform="translate(-3 -3)" fill="#fff" />
                                    </svg>
                                    <span>Tableau de Bord</span>
                                </div>
                            </a>
                        </li>
                    @elseif (auth()->user()->role_id === 3)
                        <li class="nav-item" id="tableau">
                            <a class="nav-link" href="/admin">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34.798" height="34.798"
                                        viewBox="0 0 34.798 34.798">
                                        <path id="Tracé_366" data-name="Tracé 366"
                                            d="M3,20.4a1.933,1.933,0,0,0,1.933,1.933h11.6A1.933,1.933,0,0,0,18.466,20.4V4.933A1.933,1.933,0,0,0,16.533,3H4.933A1.933,1.933,0,0,0,3,4.933ZM3,35.865A1.933,1.933,0,0,0,4.933,37.8h11.6a1.933,1.933,0,0,0,1.933-1.933V28.132A1.933,1.933,0,0,0,16.533,26.2H4.933A1.933,1.933,0,0,0,3,28.132Zm19.332,0A1.933,1.933,0,0,0,24.265,37.8h11.6A1.933,1.933,0,0,0,37.8,35.865V20.4a1.933,1.933,0,0,0-1.933-1.933h-11.6A1.933,1.933,0,0,0,22.332,20.4ZM24.265,3a1.933,1.933,0,0,0-1.933,1.933v7.733A1.933,1.933,0,0,0,24.265,14.6h11.6A1.933,1.933,0,0,0,37.8,12.666V4.933A1.933,1.933,0,0,0,35.865,3Z"
                                            transform="translate(-3 -3)" fill="#fff" />
                                    </svg>
                                    <span>Tableau de Bord</span>
                                </div>
                            </a>
                        </li>
                    @elseif(auth()->user()->role_id === 2)
                        <li class="nav-item" id="tableau">
                            <a class="nav-link" href="/professeur">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34.798" height="34.798"
                                        viewBox="0 0 34.798 34.798">
                                        <path id="Tracé_366" data-name="Tracé 366"
                                            d="M3,20.4a1.933,1.933,0,0,0,1.933,1.933h11.6A1.933,1.933,0,0,0,18.466,20.4V4.933A1.933,1.933,0,0,0,16.533,3H4.933A1.933,1.933,0,0,0,3,4.933ZM3,35.865A1.933,1.933,0,0,0,4.933,37.8h11.6a1.933,1.933,0,0,0,1.933-1.933V28.132A1.933,1.933,0,0,0,16.533,26.2H4.933A1.933,1.933,0,0,0,3,28.132Zm19.332,0A1.933,1.933,0,0,0,24.265,37.8h11.6A1.933,1.933,0,0,0,37.8,35.865V20.4a1.933,1.933,0,0,0-1.933-1.933h-11.6A1.933,1.933,0,0,0,22.332,20.4ZM24.265,3a1.933,1.933,0,0,0-1.933,1.933v7.733A1.933,1.933,0,0,0,24.265,14.6h11.6A1.933,1.933,0,0,0,37.8,12.666V4.933A1.933,1.933,0,0,0,35.865,3Z"
                                            transform="translate(-3 -3)" fill="#fff" />
                                    </svg>
                                    <span>Tableau de Bord</span>
                                </div>
                            </a>
                        </li>
                    @endif
                    <!-- role -->
                    @if (auth()->user()->role_id === 4)
                        {{--  <li class="nav-item" id="role">
                            <a class="nav-link" href="#"onclick="setActive(event, 'role')">
                                <div class="icon-text-container">
                                <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg" rect fill="#fff"
                                        height="31.318" width="34.798">
                                        <path
                                            d="M128,76a44,44,0,1,1-44,44A44,44,0,0,1,128,76Zm103.2-2a8,8,0,0,1-7,4,7.6,7.6,0,0,1-4-1.1l-4.6-2.7a24,24,0,0,1-7.6,4.4V84a8,8,0,0,1-16,0V78.6a24,24,0,0,1-7.6-4.4l-4.6,2.7a7.6,7.6,0,0,1-4,1.1,8,8,0,0,1-4-14.9l4.6-2.7A21.2,21.2,0,0,1,176,56a21.2,21.2,0,0,1,.4-4.4l-4.6-2.7a7.9,7.9,0,0,1-3-10.9,8.1,8.1,0,0,1,11-2.9l4.6,2.7a24,24,0,0,1,7.6-4.4V28a8,8,0,0,1,16,0v5.4a24,24,0,0,1,7.6,4.4l4.6-2.7a8.1,8.1,0,0,1,11,2.9,7.9,7.9,0,0,1-3,10.9l-4.6,2.7A21.2,21.2,0,0,1,224,56a21.2,21.2,0,0,1-.4,4.4l4.6,2.7A7.9,7.9,0,0,1,231.2,74ZM200,64a8,8,0,1,0-8-8A8,8,0,0,0,200,64Zm22.4,44.6a8,8,0,0,0-7,8.8A94.2,94.2,0,0,1,216,128a87.6,87.6,0,0,1-22.2,58.4,81.3,81.3,0,0,0-24.5-23,59.7,59.7,0,0,1-82.6,0,81.3,81.3,0,0,0-24.5,23A88,88,0,0,1,128,40a75,75,0,0,1,8.2.4,8,8,0,1,0,1.4-16c-3.1-.3-6.4-.4-9.6-.4A104,104,0,0,0,57.8,204.7l1.3,1.2a104,104,0,0,0,137.8,0l1.3-1.2A103.7,103.7,0,0,0,232,128a101.9,101.9,0,0,0-.7-12.4A8,8,0,0,0,222.4,108.6Z" />
                                    </svg>
                                    <span>Role</span>
                                </div>
                            </a>
                        </li> --}}

                        <!-- demande d'inscription -->
                        <li class="nav-item" id="inscription">
                            <a class="nav-link " href="{{ route('listedemandeinscription') }}">
                                <div class="icon-text-container">
                                    <svg data-name="Layer 1" id="Layer_1" fill="#fff" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path class="cls-1"
                                            d="M19.51,12v4.29a3.22,3.22,0,0,1-3.22,3.22H7.71a3.22,3.22,0,0,1-3.22-3.22V7.71A3.22,3.22,0,0,1,7.71,4.49H12"
                                            data-name="&lt;Path&gt;" id="_Path_" />
                                        <g data-name="&lt;Group&gt;" id="_Group_">
                                            <rect class="cls-1" data-name="&lt;Rectangle&gt;" height="3.17"
                                                id="_Rectangle_" transform="translate(2.3 15.02) rotate(-45)"
                                                width="3.28" x="17.64" y="3.14" />
                                            <polygon class="cls-1" data-name="&lt;Path&gt;" id="_Path_2"
                                                points="19.24 7.01 14.81 11.44 12.54 11.47 12.57 9.19 17 4.77 19.24 7.01" />
                                        </g>
                                    </svg>
                                    <span>Demande d'inscription</span>
                                </div>
                            </a>
                        </li>


                        <!-- demande demo -->
                        <li class="nav-item" id="inscription">
                            <a class="nav-link " href="{{ route('listedemandedemo') }}">
                                <div class="icon-text-container">
                                    <svg data-name="Layer 1" id="Layer_1" fill="#fff" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path class="cls-1"
                                            d="M19.51,12v4.29a3.22,3.22,0,0,1-3.22,3.22H7.71a3.22,3.22,0,0,1-3.22-3.22V7.71A3.22,3.22,0,0,1,7.71,4.49H12"
                                            data-name="&lt;Path&gt;" id="_Path_" />
                                        <g data-name="&lt;Group&gt;" id="_Group_">
                                            <rect class="cls-1" data-name="&lt;Rectangle&gt;" height="3.17"
                                                id="_Rectangle_" transform="translate(2.3 15.02) rotate(-45)"
                                                width="3.28" x="17.64" y="3.14" />
                                            <polygon class="cls-1" data-name="&lt;Path&gt;" id="_Path_2"
                                                points="19.24 7.01 14.81 11.44 12.54 11.47 12.57 9.19 17 4.77 19.24 7.01" />
                                        </g>
                                    </svg>
                                    <span>Demande demo</span>
                                </div>
                            </a>
                        </li>

                        <!-- school -->
                        <li class="nav-item" id="school">
                            <a class="nav-link " href="{{ route('etablissement.index') }}">
                                <div class="icon-text-container">
                                    <svg height="52" fill="#fff" viewBox="0 0 512 512" width="48"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <title />
                                        <path
                                            d="M256,368a16,16,0,0,1-7.94-2.11L108,285.84a8,8,0,0,0-12,6.94V368a16,16,0,0,0,8.23,14l144,80a16,16,0,0,0,15.54,0l144-80A16,16,0,0,0,416,368V292.78a8,8,0,0,0-12-6.94L263.94,365.89A16,16,0,0,1,256,368Z" />
                                        <path
                                            d="M495.92,190.5s0-.08,0-.11a16,16,0,0,0-8-12.28l-224-128a16,16,0,0,0-15.88,0l-224,128a16,16,0,0,0,0,27.78l224,128a16,16,0,0,0,15.88,0L461,221.28a2,2,0,0,1,3,1.74V367.55c0,8.61,6.62,16,15.23,16.43A16,16,0,0,0,496,368V192A14.76,14.76,0,0,0,495.92,190.5Z" />
                                    </svg>
                                    <span>Etablissement</span>
                                </div>
                            </a>
                        </li>

                        <!-- utilisateurs -->
                        <li class="nav-item" id="users">
                            <a class="nav-link " href="{{ route('administrateur') }}">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#fff"
                                        viewBox="0 0 640 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M144 160A80 80 0 1 0 144 0a80 80 0 1 0 0 160zm368 0A80 80 0 1 0 512 0a80 80 0 1 0 0 160zM0 298.7C0 310.4 9.6 320 21.3 320l213.3 0c.2 0 .4 0 .7 0c-26.6-23.5-43.3-57.8-43.3-96c0-7.6 .7-15 1.9-22.3c-13.6-6.3-28.7-9.7-44.6-9.7l-42.7 0C47.8 192 0 239.8 0 298.7zM320 320c24 0 45.9-8.8 62.7-23.3c2.5-3.7 5.2-7.3 8-10.7c2.7-3.3 5.7-6.1 9-8.3C410 262.3 416 243.9 416 224c0-53-43-96-96-96s-96 43-96 96s43 96 96 96zm65.4 60.2c-10.3-5.9-18.1-16.2-20.8-28.2l-103.2 0C187.7 352 128 411.7 128 485.3c0 14.7 11.9 26.7 26.7 26.7l300.6 0c-2.1-5.2-3.2-10.9-3.2-16.4l0-3c-1.3-.7-2.7-1.5-4-2.3l-2.6 1.5c-16.8 9.7-40.5 8-54.7-9.7c-4.5-5.6-8.6-11.5-12.4-17.6l-.1-.2-.1-.2-2.4-4.1-.1-.2-.1-.2c-3.4-6.2-6.4-12.6-9-19.3c-8.2-21.2 2.2-42.6 19-52.3l2.7-1.5c0-.8 0-1.5 0-2.3s0-1.5 0-2.3l-2.7-1.5zM533.3 192l-42.7 0c-15.9 0-31 3.5-44.6 9.7c1.3 7.2 1.9 14.7 1.9 22.3c0 17.4-3.5 33.9-9.7 49c2.5 .9 4.9 2 7.1 3.3l2.6 1.5c1.3-.8 2.6-1.6 4-2.3l0-3c0-19.4 13.3-39.1 35.8-42.6c7.9-1.2 16-1.9 24.2-1.9s16.3 .6 24.2 1.9c22.5 3.5 35.8 23.2 35.8 42.6l0 3c1.3 .7 2.7 1.5 4 2.3l2.6-1.5c16.8-9.7 40.5-8 54.7 9.7c2.3 2.8 4.5 5.8 6.6 8.7c-2.1-57.1-49-102.7-106.6-102.7zm91.3 163.9c6.3-3.6 9.5-11.1 6.8-18c-2.1-5.5-4.6-10.8-7.4-15.9l-2.3-4c-3.1-5.1-6.5-9.9-10.2-14.5c-4.6-5.7-12.7-6.7-19-3l-2.9 1.7c-9.2 5.3-20.4 4-29.6-1.3s-16.1-14.5-16.1-25.1l0-3.4c0-7.3-4.9-13.8-12.1-14.9c-6.5-1-13.1-1.5-19.9-1.5s-13.4 .5-19.9 1.5c-7.2 1.1-12.1 7.6-12.1 14.9l0 3.4c0 10.6-6.9 19.8-16.1 25.1s-20.4 6.6-29.6 1.3l-2.9-1.7c-6.3-3.6-14.4-2.6-19 3c-3.7 4.6-7.1 9.5-10.2 14.6l-2.3 3.9c-2.8 5.1-5.3 10.4-7.4 15.9c-2.6 6.8 .5 14.3 6.8 17.9l2.9 1.7c9.2 5.3 13.7 15.8 13.7 26.4s-4.5 21.1-13.7 26.4l-3 1.7c-6.3 3.6-9.5 11.1-6.8 17.9c2.1 5.5 4.6 10.7 7.4 15.8l2.4 4.1c3 5.1 6.4 9.9 10.1 14.5c4.6 5.7 12.7 6.7 19 3l2.9-1.7c9.2-5.3 20.4-4 29.6 1.3s16.1 14.5 16.1 25.1l0 3.4c0 7.3 4.9 13.8 12.1 14.9c6.5 1 13.1 1.5 19.9 1.5s13.4-.5 19.9-1.5c7.2-1.1 12.1-7.6 12.1-14.9l0-3.4c0-10.6 6.9-19.8 16.1-25.1s20.4-6.6 29.6-1.3l2.9 1.7c6.3 3.6 14.4 2.6 19-3c3.7-4.6 7.1-9.4 10.1-14.5l2.4-4.2c2.8-5.1 5.3-10.3 7.4-15.8c2.6-6.8-.5-14.3-6.8-17.9l-3-1.7c-9.2-5.3-13.7-15.8-13.7-26.4s4.5-21.1 13.7-26.4l3-1.7zM472 384a40 40 0 1 1 80 0 40 40 0 1 1 -80 0z" />
                                    </svg>
                                    <span>admin</span>
                                </div>
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->role_id === 3)
                        <!-- niveaux -->
                        <li class="nav-item" id="niveaux">
                            <a class="nav-link " href="{{ route('niveau.index') }}">
                                <div class="icon-text-container">
                                    <div class="icon-text-container">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="43.75" height="35"
                                            viewBox="0 0 43.75 35">
                                            <path id="users-solid"
                                                d="M9.844,0A5.469,5.469,0,1,1,4.375,5.469,5.469,5.469,0,0,1,9.844,0ZM35,0a5.469,5.469,0,1,1-5.469,5.469A5.469,5.469,0,0,1,35,0ZM0,20.419a7.3,7.3,0,0,1,7.294-7.294h2.919a7.333,7.333,0,0,1,3.049.663,8.6,8.6,0,0,0-.13,1.524,8.753,8.753,0,0,0,2.96,6.562H1.456A1.462,1.462,0,0,1,0,20.419Zm27.706,1.456h-.048a8.729,8.729,0,0,0,2.96-6.562,9.362,9.362,0,0,0-.13-1.524,7.227,7.227,0,0,1,3.049-.663h2.919a7.3,7.3,0,0,1,7.294,7.294,1.457,1.457,0,0,1-1.456,1.456ZM15.313,15.313a6.562,6.562,0,1,1,6.562,6.562A6.562,6.562,0,0,1,15.313,15.313ZM8.75,33.175a9.114,9.114,0,0,1,9.112-9.112h8.025A9.114,9.114,0,0,1,35,33.175,1.825,1.825,0,0,1,33.175,35h-22.6A1.825,1.825,0,0,1,8.75,33.175Z"
                                                fill="#fff" />
                                        </svg>
                                        <span>Niveau</span>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <!-- filieres -->
                        <li class="nav-item" id="Filiere">
                            <a class="nav-link " href="{{ route('filiere.index') }}">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.318" height="34.798"
                                        viewBox="0 0 31.318 34.798">
                                        <path id="Tracé_381" data-name="Tracé 381"
                                            d="M34.318,5.48H9.96a3.48,3.48,0,0,0,0,6.96H34.318V35.058a1.74,1.74,0,0,1-1.74,1.74H9.96A6.96,6.96,0,0,1,3,29.838V8.96A6.96,6.96,0,0,1,9.96,2H32.578a1.74,1.74,0,0,1,1.74,1.74Zm-1.74,5.22H9.96a1.74,1.74,0,0,1,0-3.48H32.578Z"
                                            transform="translate(-3 -2)" fill="#fff" />
                                    </svg>
                                    <span>Filière</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item" id="Filiere">
                            <a class="nav-link" href="{{ route('matiere.index') }}">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.318" height="34.798"
                                        viewBox="0 0 31.318 34.798">
                                        <path id="Tracé_381" data-name="Tracé 381"
                                            d="M34.318,5.48H9.96a3.48,3.48,0,0,0,0,6.96H34.318V35.058a1.74,1.74,0,0,1-1.74,1.74H9.96A6.96,6.96,0,0,1,3,29.838V8.96A6.96,6.96,0,0,1,9.96,2H32.578a1.74,1.74,0,0,1,1.74,1.74Zm-1.74,5.22H9.96a1.74,1.74,0,0,1,0-3.48H32.578Z"
                                            transform="translate(-3 -2)" fill="#fff" />
                                    </svg>
                                    <span>Matiere</span>
                                </div>
                            </a>
                        </li>
                        <!-- classe -->
                        <li class="nav-item" id="classe">
                            <a class="nav-link " href="{{ route('classe.index') }}">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="38.889" height="35"
                                        viewBox="0 0 38.889 35">
                                        <g id="book" transform="translate(-2 -3.998)"
                                            style="isolation: isolate">
                                            <path id="Tracé_376" data-name="Tracé 376"
                                                d="M9.778,4A7.778,7.778,0,0,0,2,11.776V27.331a7.778,7.778,0,0,0,7.778,7.778l5.851.019a4.017,4.017,0,0,1,2.689,1.3,10.169,10.169,0,0,1,1.165,1.223A2.364,2.364,0,0,0,21.444,39c1.155-.006,1.53-.791,1.944-1.338a11.068,11.068,0,0,1,1.075-1.11,4.57,4.57,0,0,1,2.814-1.441h5.833a7.778,7.778,0,0,0,7.778-7.778V11.776A7.778,7.778,0,0,0,33.111,4H27.278a7.672,7.672,0,0,0-5.833,2.734A7.672,7.672,0,0,0,15.611,4Zm0,3.889h5.833A3.888,3.888,0,0,1,19.5,11.776l.012,20.706a7.135,7.135,0,0,0-3.9-1.262H9.778a3.888,3.888,0,0,1-3.889-3.889V11.776A3.888,3.888,0,0,1,9.778,7.887Zm17.5,0h5.833A3.888,3.888,0,0,1,37,11.776V27.331a3.888,3.888,0,0,1-3.889,3.889H27.278a7.153,7.153,0,0,0-3.9,1.287l.008-20.732A3.888,3.888,0,0,1,27.278,7.887Z"
                                                transform="translate(0 0)" fill="#fff" />
                                            <path id="Tracé_377" data-name="Tracé 377"
                                                d="M11.833,8H6v3.889h5.833Zm0,5.833H6v3.889h5.833ZM6,19.667h5.833v3.889H6ZM29.333,8H23.5v3.889h5.833ZM23.5,13.833h5.833v3.889H23.5Zm5.833,5.833H23.5v3.889h5.833Z"
                                                transform="translate(3.778 3.78)" fill="#fff"
                                                fill-rule="evenodd" />
                                        </g>
                                    </svg>

                                    <span>Classe</span>
                                </div>
                            </a>
                        </li>

                        <!-- etudiants -->
                        <li class="nav-item" id="etudiants">
                            <a class="nav-link" href="{{ route('etudiant') }}">
                                <div class="icon-text-container">
                                    <div class="icon-text-container">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="43.75" height="35"
                                            viewBox="0 0 43.75 35">
                                            <path id="users-solid"
                                                d="M9.844,0A5.469,5.469,0,1,1,4.375,5.469,5.469,5.469,0,0,1,9.844,0ZM35,0a5.469,5.469,0,1,1-5.469,5.469A5.469,5.469,0,0,1,35,0ZM0,20.419a7.3,7.3,0,0,1,7.294-7.294h2.919a7.333,7.333,0,0,1,3.049.663,8.6,8.6,0,0,0-.13,1.524,8.753,8.753,0,0,0,2.96,6.562H1.456A1.462,1.462,0,0,1,0,20.419Zm27.706,1.456h-.048a8.729,8.729,0,0,0,2.96-6.562,9.362,9.362,0,0,0-.13-1.524,7.227,7.227,0,0,1,3.049-.663h2.919a7.3,7.3,0,0,1,7.294,7.294,1.457,1.457,0,0,1-1.456,1.456ZM15.313,15.313a6.562,6.562,0,1,1,6.562,6.562A6.562,6.562,0,0,1,15.313,15.313ZM8.75,33.175a9.114,9.114,0,0,1,9.112-9.112h8.025A9.114,9.114,0,0,1,35,33.175,1.825,1.825,0,0,1,33.175,35h-22.6A1.825,1.825,0,0,1,8.75,33.175Z"
                                                fill="#fff" />
                                        </svg>
                                        <span>Etudiants</span>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <!-- Enseignants -->
                        <li class="nav-item" id="enseignants">
                            <a class="nav-link " href="{{ route('professeur') }}">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30.448" height="34.798"
                                        viewBox="0 0 30.448 34.798">
                                        <path id="user-tie-solid"
                                            d="M6.525,8.7a8.7,8.7,0,1,0,8.7-8.7A8.7,8.7,0,0,0,6.525,8.7Zm6.423,13.607,1.264,2.107-2.263,8.421L9.5,22.85a1.006,1.006,0,0,0-1.217-.768A10.961,10.961,0,0,0,0,32.711,2.087,2.087,0,0,0,2.087,34.8H28.362a2.087,2.087,0,0,0,2.087-2.087,10.961,10.961,0,0,0-8.285-10.63,1.016,1.016,0,0,0-1.217.768L18.5,32.834l-2.263-8.421L17.5,22.306a1.086,1.086,0,0,0-.931-1.645H13.885a1.087,1.087,0,0,0-.931,1.645Z"
                                            fill="#fff" />
                                    </svg>
                                    <span>Enseignants</span>
                                </div>
                            </a>
                        </li>
                    @endif




                    @if (auth()->user()->role_id === 3)
                        <!-- calendrier -->
                        <li class="nav-item" id="calendrier">
                            <a class="nav-link " href="{{ route('calendrier.admin') }}">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="33.158" height="35"
                                        viewBox="0 0 33.158 35">
                                        <g id="calendar-event-fill" transform="translate(-3 -2)"
                                            style="isolation: isolate">
                                            <path id="Tracé_374" data-name="Tracé 374"
                                                d="M10.368,3A7.369,7.369,0,0,0,3,10.368v1.842H36.158V10.368A7.369,7.369,0,0,0,28.789,3H10.368Z"
                                                transform="translate(0 0.842)" fill="#fff" />
                                            <path id="Tracé_375" data-name="Tracé 375"
                                                d="M12.211,2a1.842,1.842,0,0,1,1.842,1.842V7.526a1.842,1.842,0,1,1-3.684,0V3.842A1.842,1.842,0,0,1,12.211,2ZM3,16.737V29.632A7.369,7.369,0,0,0,10.368,37H28.789a7.369,7.369,0,0,0,7.368-7.368V16.737Zm23.947,3.684h1.842a1.843,1.843,0,0,1,1.842,1.842v1.842a1.843,1.843,0,0,1-1.842,1.842H26.947a1.843,1.843,0,0,1-1.842-1.842V22.263A1.843,1.843,0,0,1,26.947,20.421ZM28.789,3.842a1.842,1.842,0,0,0-3.684,0V7.526a1.842,1.842,0,0,0,3.684,0Z"
                                                transform="translate(0 0)" fill="#fff" fill-rule="evenodd" />
                                        </g>
                                    </svg>

                                    <span>Calendrier</span>
                                </div>
                            </a>
                        </li>
                    @elseif(auth()->user()->role_id === 2)
                        <li class="nav-item" id="calendrier">
                            <a class="nav-link " href="{{ route('calendrier.professeur') }}">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="33.158" height="35"
                                        viewBox="0 0 33.158 35">
                                        <g id="calendar-event-fill" transform="translate(-3 -2)"
                                            style="isolation: isolate">
                                            <path id="Tracé_374" data-name="Tracé 374"
                                                d="M10.368,3A7.369,7.369,0,0,0,3,10.368v1.842H36.158V10.368A7.369,7.369,0,0,0,28.789,3H10.368Z"
                                                transform="translate(0 0.842)" fill="#fff" />
                                            <path id="Tracé_375" data-name="Tracé 375"
                                                d="M12.211,2a1.842,1.842,0,0,1,1.842,1.842V7.526a1.842,1.842,0,1,1-3.684,0V3.842A1.842,1.842,0,0,1,12.211,2ZM3,16.737V29.632A7.369,7.369,0,0,0,10.368,37H28.789a7.369,7.369,0,0,0,7.368-7.368V16.737Zm23.947,3.684h1.842a1.843,1.843,0,0,1,1.842,1.842v1.842a1.843,1.843,0,0,1-1.842,1.842H26.947a1.843,1.843,0,0,1-1.842-1.842V22.263A1.843,1.843,0,0,1,26.947,20.421ZM28.789,3.842a1.842,1.842,0,0,0-3.684,0V7.526a1.842,1.842,0,0,0,3.684,0Z"
                                                transform="translate(0 0)" fill="#fff" fill-rule="evenodd" />
                                        </g>
                                    </svg>

                                    <span>Calendrier</span>
                                </div>
                            </a>
                        </li>
                    @endif
                    <!-- sujet -->
                    @if (auth()->user()->role_id === 2)
                        <li class="nav-item" id="sujet">
                            <a class="nav-link" href="{{ route('sujet.professeur') }}">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                        viewBox="0 0 35 35">
                                        <path id="Soustraction_4" data-name="Soustraction 4"
                                            d="M27.223,35H7.777A7.786,7.786,0,0,1,0,27.223V7.777A7.786,7.786,0,0,1,7.777,0H27.223A7.786,7.786,0,0,1,35,7.777V27.223A7.786,7.786,0,0,1,27.223,35Zm-3.89-13.608a1.944,1.944,0,1,0,1.944,1.944A1.946,1.946,0,0,0,23.333,21.392Zm-11.665,0a1.944,1.944,0,1,0,1.944,1.944A1.946,1.946,0,0,0,11.667,21.392Zm11.665-5.833A1.944,1.944,0,1,0,25.277,17.5,1.946,1.946,0,0,0,23.333,15.559Zm-11.665,0A1.944,1.944,0,1,0,13.611,17.5,1.946,1.946,0,0,0,11.667,15.559ZM23.333,9.725a1.945,1.945,0,1,0,1.944,1.946A1.947,1.947,0,0,0,23.333,9.725Zm-11.665,0a1.945,1.945,0,1,0,1.944,1.946A1.947,1.947,0,0,0,11.667,9.725Z"
                                            fill="#fff" />
                                    </svg>


                                    <span>Sujet</span>
                                </div>
                            </a>
                        </li>

                        <!-- correction -->
                        <li class="nav-item" id="correction">
                            <a class="nav-link " href="#">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="38.889" height="35"
                                        viewBox="0 0 38.889 35">
                                        <g id="printer2" transform="translate(-2 -3)" style="isolation: isolate">
                                            <path id="Tracé_379" data-name="Tracé 379"
                                                d="M2,11.833A5.833,5.833,0,0,1,7.833,6h3.889a1.945,1.945,0,0,1,.87.205L16.07,7.944H35.056a5.833,5.833,0,0,1,5.833,5.833V23.5a5.833,5.833,0,0,1-5.833,5.833H31.167V25.444h3.889A1.944,1.944,0,0,0,37,23.5V13.778a1.944,1.944,0,0,0-1.944-1.944H15.611a1.944,1.944,0,0,1-.87-.205L11.263,9.889H7.833a1.944,1.944,0,0,0-1.944,1.944V23.5a1.944,1.944,0,0,0,1.944,1.944h3.889v3.889H7.833A5.833,5.833,0,0,1,2,23.5Z"
                                                transform="translate(0 2.833)" fill="#fff" fill-rule="evenodd" />
                                            <path id="Tracé_380" data-name="Tracé 380"
                                                d="M8.889,6.889A3.889,3.889,0,0,1,12.778,3H24.444a3.889,3.889,0,0,1,3.889,3.889v3.889H24.444V6.889H12.778v3.659L9.758,9.039a1.945,1.945,0,0,0-.87-.205ZM28.333,28.278v5.833A3.889,3.889,0,0,1,24.444,38H12.778a3.889,3.889,0,0,1-3.889-3.889V24.389a1.944,1.944,0,0,1,0-3.889H28.333a1.944,1.944,0,1,1,0,3.889Zm-3.889-3.889H12.778v9.722H24.444ZM8.889,16.611a1.944,1.944,0,1,1-1.944-1.944A1.944,1.944,0,0,1,8.889,16.611Z"
                                                transform="translate(2.833)" fill="#fff" fill-rule="evenodd" />
                                        </g>
                                    </svg>

                                    <span>Correction</span>
                                </div>
                            </a>
                        </li>
                    @elseif(auth()->user()->role_id === 3)
                        <li class="nav-item" id="sujet">
                            <a class="nav-link" href="{{ route('sujet.admin') }}">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                        viewBox="0 0 35 35">
                                        <path id="Soustraction_4" data-name="Soustraction 4"
                                            d="M27.223,35H7.777A7.786,7.786,0,0,1,0,27.223V7.777A7.786,7.786,0,0,1,7.777,0H27.223A7.786,7.786,0,0,1,35,7.777V27.223A7.786,7.786,0,0,1,27.223,35Zm-3.89-13.608a1.944,1.944,0,1,0,1.944,1.944A1.946,1.946,0,0,0,23.333,21.392Zm-11.665,0a1.944,1.944,0,1,0,1.944,1.944A1.946,1.946,0,0,0,11.667,21.392Zm11.665-5.833A1.944,1.944,0,1,0,25.277,17.5,1.946,1.946,0,0,0,23.333,15.559Zm-11.665,0A1.944,1.944,0,1,0,13.611,17.5,1.946,1.946,0,0,0,11.667,15.559ZM23.333,9.725a1.945,1.945,0,1,0,1.944,1.946A1.947,1.947,0,0,0,23.333,9.725Zm-11.665,0a1.945,1.945,0,1,0,1.944,1.946A1.947,1.947,0,0,0,11.667,9.725Z"
                                            fill="#fff" />
                                    </svg>


                                    <span>Sujet</span>
                                </div>
                            </a>
                        </li>

                        <!-- correction -->
                        <li class="nav-item" id="correction">
                            <a class="nav-link " href="#">
                                <div class="icon-text-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="38.889" height="35"
                                        viewBox="0 0 38.889 35">
                                        <g id="printer2" transform="translate(-2 -3)" style="isolation: isolate">
                                            <path id="Tracé_379" data-name="Tracé 379"
                                                d="M2,11.833A5.833,5.833,0,0,1,7.833,6h3.889a1.945,1.945,0,0,1,.87.205L16.07,7.944H35.056a5.833,5.833,0,0,1,5.833,5.833V23.5a5.833,5.833,0,0,1-5.833,5.833H31.167V25.444h3.889A1.944,1.944,0,0,0,37,23.5V13.778a1.944,1.944,0,0,0-1.944-1.944H15.611a1.944,1.944,0,0,1-.87-.205L11.263,9.889H7.833a1.944,1.944,0,0,0-1.944,1.944V23.5a1.944,1.944,0,0,0,1.944,1.944h3.889v3.889H7.833A5.833,5.833,0,0,1,2,23.5Z"
                                                transform="translate(0 2.833)" fill="#fff" fill-rule="evenodd" />
                                            <path id="Tracé_380" data-name="Tracé 380"
                                                d="M8.889,6.889A3.889,3.889,0,0,1,12.778,3H24.444a3.889,3.889,0,0,1,3.889,3.889v3.889H24.444V6.889H12.778v3.659L9.758,9.039a1.945,1.945,0,0,0-.87-.205ZM28.333,28.278v5.833A3.889,3.889,0,0,1,24.444,38H12.778a3.889,3.889,0,0,1-3.889-3.889V24.389a1.944,1.944,0,0,1,0-3.889H28.333a1.944,1.944,0,1,1,0,3.889Zm-3.889-3.889H12.778v9.722H24.444ZM8.889,16.611a1.944,1.944,0,1,1-1.944-1.944A1.944,1.944,0,0,1,8.889,16.611Z"
                                                transform="translate(2.833)" fill="#fff" fill-rule="evenodd" />
                                        </g>
                                    </svg>

                                    <span>Correction</span>
                                </div>
                            </a>
                        </li>
                    @endif


                </ul>


            </div>
        </div>
    </div>


    {{-- modal --}}
    <div class="modal fade" id="signature" tabindex="-1" aria-labelledby="signatureModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h2>Signature</h2>
            <button class="close-btn" onclick="closeModal()">&times;</button>
        </div>

        <!-- Tabs pour Dessiner et Importer -->
        <div class="tab-container">
            <a href="#" class="tab-link active" onclick="openTab(event, 'draw')">Dessiner</a>
            <a href="#" class="tab-link" onclick="openTab(event, 'import')">Importer</a>
        </div>

        <!-- Contenu des tabs -->
        <div id="draw" class="tab-content active">
            <div class="signature-area"></div>
        </div>

        <div id="import" class="tab-content">
            <div class="upload-area" onclick="triggerFileUpload()">
                Glisser déposer une signature
                <br>
                OU
                <br>
                <button class="upload-button" onclick="triggerFileUpload()">
                    <i class="fas fa-plus"></i> Charger
                </button>
                <input type="file" id="fileInput" accept="image/*" style="display: none;">
            </div>
        </div>
    </div>
    {{--  --}}
</nav>





<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuIcon = document.getElementById('menuIcon');
        const offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasScrolling'));

        menuIcon.addEventListener('click', () => offcanvas.toggle());

        document.getElementById('toggleButton').addEventListener('click', (e) => {
            if (e.target !== menuIcon && !menuIcon.contains(e.target)) e.stopPropagation();
        });

        const navLinks = document.querySelectorAll('.nav-link');
        const activeLink = sessionStorage.getItem('activeLink');
        if (activeLink) document.querySelector(`[href="${activeLink}"]`)?.classList.add('active');

        navLinks.forEach(link => link.addEventListener('click', () => {
            navLinks.forEach(link => link.classList.remove('active'));
            link.classList.add('active');
            sessionStorage.setItem('activeLink', link.getAttribute('href'));
        }));
    });

    function openTab(event, tabName) {
        // Cache tous les contenus de tabs
        document.querySelectorAll('.tab-content').forEach(function(tabContent) {
            tabContent.classList.remove('active');
        });

        // Supprime la classe active de tous les liens de tabs
        document.querySelectorAll('.tab-link').forEach(function(tabLink) {
            tabLink.classList.remove('active');
        });

        // Affiche le contenu du tab sélectionné
        document.getElementById(tabName).classList.add('active');
        event.currentTarget.classList.add('active');
    }

    function closeModal() {
        alert('Modal fermé');
    }

    function triggerFileUpload() {
        document.getElementById('fileInput').click();
    }
</script>
