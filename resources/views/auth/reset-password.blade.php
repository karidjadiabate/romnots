@include('frontend.header')

@section('title', 'AKP ROM-Note - Mise à jour Mot de passe')

<main id="main">
    <!-- ======= Connexion Section ======= -->
    <section class="conn" data-aos=" fade-up" data-aos-easing="ease-in-out" data-aos-duration="500" style="height: 55vh;">
        <div class="conn-child d-flex justify-content-between align-items-center">
            <div class="col-lg-6 d-flex align-items-center justify-content-center  box-conn ">
                <div class="col-lg-12 text-center conn-text">
                    <h1 class="conn-title">Bienvenue</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center justify-content-center flex-column">
                <div class="col-md-12 d-flex align-items-end justify-content-end conn-return p-3">
                    <a href="index.html" class="btn btn-custom">Retour</a>
                </div>

                <div class="col-md-12 text-center logo-register  p-3">
                    <h1 class="text-light logo-text"><a href="index.html"><span
                                class="akp-title navbar-title">AKP</span> <span class="akp-title">ROM-Note</span></a>
                    </h1>
                </div>

                <div class="col-md-12 text-center conn-subtitle p-3">
                    <h2 class="logo-text">Mot de passe oublié</a></h2>
                </div>

                <form action="{{ route('password.update') }}" method="POST" role="form">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    <input type="hidden" name="email" value="{{ old('email', request()->email) }}">

                    <div class="form-row form-row-pwd">
                        <div class="col-md-12 form-group form-email">
                            <label for="password"> Mot de passe</label>
                            <input type="password" name="password" class="form-control conn-input" id="fg-password"
                                placeholder="Entrez le nouveau mot de passe" data-rule="fg-password" />
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <i class="fa-solid fa-lock"></i>
                            <span class="pwd" onclick="togglePassword1()">
                                <i class="fa-regular fa-eye fa-eye1" style="display: none;"></i>
                                <i class="fa-regular fa-eye-slash fa-eye-slash1"></i>
                            </span>
                            <div class="validate"></div>
                        </div>
                        <div class="col-md-12 form-group form-pwd">
                            <label for="fg-confpassword">Confirmation</label>
                            <input type="password" class="form-control conn-input" name="password_confirmation"
                                id="fg-confpassword" placeholder="Confirmez le mot de passe"
                                data-rule="fg-confpassword" />
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                            <i class="fa-solid fa-lock"></i>
                            <span class="conf-pwd" onclick="togglePassword2()">
                                <i class="fa-regular fa-eye fa-eye2" style="display: none;"></i>
                                <i class="fa-regular fa-eye-slash fa-eye-slash2"></i>
                            </span>
                            <div class="validate"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-save-register w-100  px-3">Confirmer</button>
                        <div class="validate"></div>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

@include('auth.footer')
