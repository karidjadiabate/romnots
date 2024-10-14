@include('frontend.header')

@section('title', 'AKP ROM-Note - Connexion')

<main id="main">
    <!-- ======= Connexion Section ======= -->
    <section class="conn" data-aos=" fade-up" data-aos-easing="ease-in-out" data-aos-duration="500" style="height: 55vh;">
        <div class="conn-child d-flex justify-content-between align-items-center">
            <div class="col-lg-6 d-flex align-items-center justify-content-center box-conn">
                <div class="col-lg-12 text-center conn-text">
                    <h1 class="conn-title">Bienvenue</h1>
                    <p class="text-conn">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>

            <div class="col-lg-6 position-relative d-flex align-items-center justify-content-center flex-column">
                <div class="col-md-12 d-flex align-items-end justify-content-end conn-return p-3">
                    <a href="{{ route('home') }}" class="btn btn-custom">Retour</a>
                </div>

                <div class="col-md-12 text-center logo-reg logo-reg-desktop p-3">
                    <h1 class="text-light logo-text"><a href="{{ route('login') }}"><span
                                class="akp-title navbar-title">AKP</span> <span class="akp-title">ROM-Note</span></a>
                    </h1>
                </div>

                <div class="row col-md-12 mobile-head" style="display:none">
                    <div class="col-md-12 p-3 d-flex align-items-center justify-content-between">
                        <div class="col-md-6 text-center logo-reg d-flex justify-content-start p-3">
                            <h1 class="text-light logo-text"><a href="{{ route('login') }}"><span
                                        class="akp-title navbar-title">AKP</span> <span
                                        class="akp-title">ROM-Note</span></a></h1>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <a href="{{ route('home') }}" class="btn btn-custom">Retour</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center conn-subtitle p-3">
                    <h2 class="logo-text">Connexion</h2>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- Formulaire de connexion -->
                <form action="{{ route('login') }}" method="post" role="form" id="form-contain-conn">
                    @csrf <!-- Ajout du jeton CSRF obligatoire -->
                    <div class="form-row">
                        <div class="col-md-12 form-group form-email">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control conn-input" id="email"
                                placeholder="Entrez votre adresse email" data-rule="Email" />
                            <i class="fa-regular fa-envelope"></i>
                            <div class="validate"></div>
                        </div>
                        <div class="col-md-12 form-group form-pwd">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control conn-input" name="password" id="password"
                                placeholder="Entrez votre mot de passe" data-rule="password" />
                            <i class="fa-solid fa-lock"></i>
                            <span class="pwd-conn" onclick="togglePassword0()">
                                <i class="fa-regular fa-eye fa-eye0" style="display: none;"></i>
                                <i class="fa-regular fa-eye-slash fa-eye-slash0"></i>
                            </span>
                            <div class="validate"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <input type="checkbox" id="exampleInputEmail1"> <span class="checkbox-conn">Se souvenir de
                                moi</span>
                            <div class="validate"></div>
                        </div>
                        <div class="col-md-6 form-group" id="form-fgpwd">
                            <div class="text-center"><a href="javascript:void(0)" class="fgpwd">Mot de passe
                                    oublié?</a></div>
                            <div class="validate"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit"
                            class="form-control btn btn-save-conn conn-btn w-100  d-flex align-items-center justify-content-center">Se
                            connecter</button>
                        <div class="validate"></div>
                    </div>

                    <div class="col-md-12 form-group">
                        <div class="text-center create-compte"><span>Vous n'avez pas de compte ? </span><a
                                href="{{ route('demandeinscription') }}">Cliquez ici</a></div>
                        <div class="validate"></div>
                    </div>
                </form>

                <!-- Formulaire de récupération de mot de passe -->
                <form action="{{ route('password.email') }}" method="post" id="form-contain-fgpwd"
                    style="display: none;">
                    @csrf <!-- Ajout du jeton CSRF obligatoire -->
                    <div class="form-row">
                        <div class="col-md-12 form-group form-email">
                            <label for="fg-email">Email</label>
                            <input type="email" name="email" class="form-control conn-input" id="fg-email"
                                placeholder="Entrez votre email" data-rule="fg-email" />
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <i class="fa-regular fa-envelope"></i>
                            <div class="validate"></div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit"
                                class="form-control btn btn-save-register conn-btn w-100">Soumettre</button>
                            <div class="validate"></div>
                        </div>
                        <div class="col-md-12 form-group" id="return-to-conn">
                            <div class="text-center"><a href="javascript:void(0)" class="fgpwd">Retour à la
                                    connexion</a></div>
                            <div class="validate"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- End Contact Section -->
</main><!-- End #main -->

@include('auth.footer')
