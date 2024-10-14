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
    <title>Compte</title>

</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: white;
        margin: 0;
        padding: 0;
    }

    .account-container {
        width: 100%;
        max-width: 1200px;
        background-color: white;
        padding: 0px;
        border-radius: 10px;
        /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); */
        margin: 20px auto;
        display: flex;
        align-items: flex-start;
        gap: 40px;
    }

    .account-title {
        font-size: 32px;
        color: #4a3dbb;
        margin-bottom: 15px;
        margin-top: 3%;
        margin-left: 10%
    }

    .tabs {
        display: flex;
        margin-bottom: 50px;
        margin-left: 10%
    }

    .tab-link {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        margin-right: 15px;
        background-color: #f8f9fa;
        color: #4a3dbb;
        border: 1px solid transparent;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        transition: background-color 0.3s;
    }

    .tab-link.active {
        background-color: #ffffff;
        border-bottom: 3px solid #4a3dbb;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: flex;
        gap: 40px;

    }

    .profile-section {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .profile-img-container {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-img {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 3px solid #4a3dbb;
    }

    .photo-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: #ffffff;
        border: none;
        cursor: pointer;
        font-size: 14px;
        color: #4a3dbb;
        border-radius: 50%;
        padding: 5px;
    }

    .profile-actions {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .upload-btn,
    .delete-btn {
        background-color: #ffffff;
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: #4a3dbb;
        border-radius: 50%;
        padding: 10px;
    }

    .account-form {
        display: flex;
        flex-direction: column;
        /* width: 100%; */
        gap: 20px;
        margin-left: 10%
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        gap: 30px;
        flex-wrap: wrap;
    }

    .form-group {
        flex: 1;
        min-width: 280px;
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #4a3dbb;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 16px;
        color: #4a3dbb;
    }

    .form-group textarea {
        height: 100px;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #4a3dbb;
    }

    .notification-setting {
        display: flex;
        align-items: start;
        color: #4a3dbb;
    }

    .save-btn {
        align-self: flex-end;
        background-color: #38B293;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .save-btn:hover {
        background-color: #2d8a6c;
    }

    .password-group {
        position: relative;
    }

    .password-group i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #4a3dbb;
        cursor: pointer;
    }

    h2 {
        color: #4a3dbb;
    }

    hr {
        border: 1px solid #4a3dbb;
        width: 100%;
    }

    input::placeholder {
        color: #4a3dbb;
    }

    #security {

        margin-left: 20%;
        width: 100%
    }

    .profile-and-form {
        display: flex;
        gap: 40px;
        align-items: flex-start;
        width: 100%
    }

    #personal-info {
        width: 100%
    }
</style>


<body>
    <!-- header -->
    @include('admin.include.menu')
    <!-- accueil -->

    <h2 class="account-title">Compte</h2>
    <div class="tabs">
        <button class="tab-link active" data-tab="personal-info"><i class="fas fa-user"></i> Informations
            personnelles</button>
        <button class="tab-link" data-tab="security"><i class="fas fa-lock"></i> Sécurité</button>
    </div>
    <div class="account-container">
        <div id="personal-info" class="tab-content active">
            <div class="profile-and-form">
                <div class="profile-section">
                    <div class="profile-img-container">
                        @if (auth()->user()->image)
                            <img src="{{ asset('storage/profile/' . auth()->user()->image) }}" alt="User"
                                class="profile-img" id="user-image">
                        @else
                            <img src="{{ Avatar::create(auth()->user()->nom . ' ' . auth()->user()->prenom)->toBase64() }}"
                                alt="User" class="profile-img" id="user-image">
                        @endif
                        <button class="photo-btn" id="camera-btn"><i class="fas fa-camera"></i></button>

                    </div>
                    <div class="profile-actions">
                        <button class="upload-btn" onclick="document.getElementById('upload-input').click();"><i
                                class="fas fa-upload"></i></button>
                        <button class="delete-btn" onclick="deleteImage()"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>

                @if (auth()->user()->role_id == 2)
                    <form class="account-form" action="{{ route('updateprofile.professeur', auth()->user()->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="prenom">Prénoms</label>
                                <input type="text" id="prenom" name="prenom"
                                    value="{{ auth()->user()->prenom }}">
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" id="nom" name="nom" value="{{ auth()->user()->nom }}">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" id="contact" name="contact"
                                    value="{{ auth()->user()->contact }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" id="adresse" name="adresse"
                                    value="{{ auth()->user()->adresse }}">
                            </div>
                            <div class="form-group">
                                <label for="fonction">Fonction</label>
                                <input type="text" id="fonction" name="role_id"
                                    value="{{ auth()->user()->role->nomrole }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Sélectionnez un rôle</label>
                            <select name="role" id="role" class="form-control w-100">
                                <option value="1">Role</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="about">À propos</label>
                            <textarea id="about" name="about" placeholder="Rédiger votre biographie"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="notifications">Activité de Notifications</label>
                            <hr>
                        </div>
                        <div class="notification-setting">
                            <input type="checkbox" id="notifications" name="notifications" checked>
                            <label for="notifications">Je souhaite recevoir une notification de ROMNote lorsque de
                                nouveaux
                                projets sont disponibles</label>
                        </div>

                        <div class="form-group">
                            <input type="file" name="file" id="upload-input" accept="image/*"
                                style="display: none;" onchange="uploadImage(event)">
                        </div>

                        <button type="submit" class="save-btn">Sauvegarder</button>
                    </form>
                @elseif(auth()->user()->role_id === 3)
                    <form class="account-form" action="{{ route('updateprofile.admin', auth()->user()->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" id="nom" name="nom"
                                    value="{{ auth()->user()->nom }}">
                            </div>
                            <input type="file" name="file" id="upload-input" accept="image/*"
                                style="display: none;"onchange="uploadImage(event)">
                            <div class="form-group">
                                <label for="prenom">Prénoms</label>
                                <input type="text" id="prenom" name="prenom"
                                    value="{{ auth()->user()->prenom }}">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" id="contact" name="contact"
                                    value="{{ auth()->user()->contact }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ auth()->user()->email }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" id="adresse" name="adresse"
                                    value="{{ auth()->user()->adresse }}">
                            </div>

                            <div class="form-group">
                                <label for="fonction">Fonction</label>
                                <input type="text" id="fonction" name="role_id"
                                    value="{{ auth()->user()->role->nomrole }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Sélectionnez un rôle</label>
                            <select name="role" id="role" class="form-control w-100">
                                <option value="1">Role</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="about">À propos</label>
                            <textarea id="about" placeholder="Rédiger votre biographie"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="notifications">Activité de Notifications</label>
                            <hr>
                        </div>
                        <div class="notification-setting">
                            <input type="checkbox" id="notifications" checked>
                            <label for="notifications">Je souhaite recevoir une notification de ROMNote lorsque de
                                nouveaux
                                projets sont disponibles</label>
                        </div>

                        <button type="submit" class="save-btn">Sauvegarder</button>
                    </form>
                @elseif(auth()->user()->role_id == 4)
                    <form class="account-form" action="{{ route('updateprofile.superadmin', auth()->user()->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" id="nom" name="nom"
                                    value="{{ auth()->user()->nom }}">
                            </div>
                            <input type="file" name="file" id="upload-input" accept="image/*"
                                style="display: none;"onchange="uploadImage(event)">
                            <div class="form-group">
                                <label for="prenom">Prénoms</label>
                                <input type="text" id="prenom" name="prenom"
                                    value="{{ auth()->user()->prenom }}">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" id="contact" name="contact"
                                    value="{{ auth()->user()->contact }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ auth()->user()->email }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" id="adresse" name="adresse"
                                    value="{{ auth()->user()->adresse }}">
                            </div>

                            <div class="form-group">
                                <label for="fonction">Fonction</label>
                                <input type="text" id="fonction" name="role_id"
                                    value="{{ auth()->user()->role->nomrole }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Sélectionnez un rôle</label>
                            <select name="role" id="role" class="form-control w-100">
                                <option value="1">Role</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Sélectionnez un rôle</label>
                            <select name="role" id="role" class="form-control w-100">
                                <option value="1">Role</option>
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="about">À propos</label>
                            <textarea id="about" placeholder="Rédiger votre biographie"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="notifications">Activité de Notifications</label>
                            <hr>
                        </div>
                        <div class="notification-setting">
                            <input type="checkbox" id="notifications" checked>
                            <label for="notifications">Je souhaite recevoir une notification de ROMNote lorsque de
                                nouveaux
                                projets sont disponibles</label>
                        </div>

                        <button type="submit" class="save-btn">Sauvegarder</button>
                    </form>
                @endif
            </div>
        </div>

        @if (auth()->user()->role_id === 3)
            <div id="security" class="tab-content">
                <form class="account-form" action="{{ route('updatepassword.admin') }}" method="POST">
                    @csrf
                    <h2>Mot de passe </h2>
                    <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}">

                    <hr>
                    <div class="form-group password-group">
                        <label for="current-password"></label>
                        <input type="password" id="current-password" name="current_password"
                            placeholder="Mot de passe actuel">
                        <i class="fas fa-eye-slash" onclick="togglePassword('current-password', this)"></i>
                        @if ($errors->has('current_password'))
                            <span class="text-danger">{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>

                    <div class="form-group password-group">
                        <label for="new-password"></label>
                        <input type="password" id="new-password" name="password" placeholder="Nouveau mot de passe">
                        <i class="fas fa-eye-slash" onclick="togglePassword('new-password', this)"></i>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group password-group">
                        <label for="confirm-password"></label>
                        <input type="password" id="confirm-password" name="password_confirmation"
                            placeholder="Confirmez le nouveau mot de passe">
                        <i class="fas fa-eye-slash" onclick="togglePassword('confirm-password', this)"></i>
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="save-btn">Sauvegarder</button>
                </form>
            </div>
        @elseif(auth()->user()->role_id == 2)
            <div id="security" class="tab-content">
                <form class="account-form" action="{{ route('updatepassword.professeur') }}" method="POST">
                    @csrf
                    <h2>Mot de passe </h2>
                    <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}">

                    <hr>
                    <div class="form-group password-group">
                        <label for="current-password"></label>
                        <input type="password" id="current-password" name="current_password"
                            placeholder="Mot de passe actuel">
                        <i class="fas fa-eye-slash" onclick="togglePassword('current-password', this)"></i>
                        @if ($errors->has('current_password'))
                            <span class="text-danger">{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>

                    <div class="form-group password-group">
                        <label for="new-password"></label>
                        <input type="password" id="new-password" name="password" placeholder="Nouveau mot de passe">
                        <i class="fas fa-eye-slash" onclick="togglePassword('new-password', this)"></i>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group password-group">
                        <label for="confirm-password"></label>
                        <input type="password" id="confirm-password" name="password_confirmation"
                            placeholder="Confirmez le nouveau mot de passe">
                        <i class="fas fa-eye-slash" onclick="togglePassword('confirm-password', this)"></i>
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="save-btn">Sauvegarder</button>
                </form>
            </div>
        @elseif(auth()->user()->role_id == 4)
            <div id="security" class="tab-content">
                <form class="account-form" action="{{ route('updatepassword.superadmin') }}" method="POST">
                    @csrf
                    <h2>Mot de passe </h2>
                    <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}">

                    <hr>
                    <div class="form-group password-group">
                        <label for="current-password"></label>
                        <input type="password" id="current-password" name="current_password"
                            placeholder="Mot de passe actuel">
                        <i class="fas fa-eye-slash" onclick="togglePassword('current-password', this)"></i>
                        @if ($errors->has('current_password'))
                            <span class="text-danger">{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>

                    <div class="form-group password-group">
                        <label for="new-password"></label>
                        <input type="password" id="new-password" name="password" placeholder="Nouveau mot de passe">
                        <i class="fas fa-eye-slash" onclick="togglePassword('new-password', this)"></i>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group password-group">
                        <label for="confirm-password"></label>
                        <input type="password" id="confirm-password" name="password_confirmation"
                            placeholder="Confirmez le nouveau mot de passe">
                        <i class="fas fa-eye-slash" onclick="togglePassword('confirm-password', this)"></i>
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="save-btn">Sauvegarder</button>
                </form>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        document.getElementById('camera-btn').addEventListener('click', () => {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then((stream) => {
                    const video = document.createElement('video');
                    video.srcObject = stream;
                    video.play();

                    const modal = document.createElement('div');
                    modal.style.position = 'fixed';
                    modal.style.top = '50%';
                    modal.style.left = '50%';
                    modal.style.transform = 'translate(-50%, -50%)';
                    modal.style.zIndex = '1000';
                    modal.style.backgroundColor = 'white';
                    modal.style.padding = '20px';
                    modal.appendChild(video);

                    const captureBtn = document.createElement('button');
                    captureBtn.innerText = 'Capturer';
                    captureBtn.onclick = () => {
                        const canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                        const imageDataUrl = canvas.toDataURL('image/png');
                        document.getElementById('user-image').src = imageDataUrl;

                        stream.getTracks().forEach(track => track.stop());
                        document.body.removeChild(modal);
                    };

                    modal.appendChild(captureBtn);
                    document.body.appendChild(modal);
                })
                .catch((err) => {
                    alert('Erreur lors de l\'accès à la caméra : ' + err.message);
                });
        });

        function uploadImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('user-image').src = e.target.result;
            };

            reader.readAsDataURL(file);
        }

        function deleteImage() {
            document.getElementById('user-image').src =
                '{{ asset('frontend/dashboard/images/kad.jpg') }}';
        }

        document.querySelectorAll('.tab-link').forEach(button => {
            button.addEventListener('click', () => {
                const tabContentId = button.getAttribute('data-tab');
                document.querySelectorAll('.tab-content').forEach(tabContent => {
                    tabContent.classList.remove('active');
                });
                document.querySelectorAll('.tab-link').forEach(btn => {
                    btn.classList.remove('active');
                });
                document.getElementById(tabContentId).classList.add('active');
                button.classList.add('active');
            });
        });

        function togglePassword(fieldId, icon) {
            const field = document.getElementById(fieldId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>

</html>
