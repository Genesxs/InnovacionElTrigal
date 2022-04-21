<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <x-jet-label value="{{ __('Documento Identificacion') }}" />

                    <x-jet-input class="{{ $errors->has('documento_identificacion') ? 'is-invalid' : '' }}" type="number" name="documento_identificacion"
                                 :value="old('documento_identificacion')" required autofocus autocomplete="documento_identificacion" />
                    <x-jet-input-error for="documento_identificacion"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Name') }}" />

                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autofocus autocomplete="name" />
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Apellidos') }}" />

                    <x-jet-input class="{{ $errors->has('apellidos') ? 'is-invalid' : '' }}" type="text" name="apellidos"
                                 :value="old('apellidos')" required autofocus autocomplete="apellidos" />
                    <x-jet-input-error for="apellidos"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Teléfono') }}" />

                    <x-jet-input class="{{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="text" name="telefono"
                                 :value="old('telefono')" required autofocus autocomplete="telefono" />
                    <x-jet-input-error for="telefono"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Sede') }}" />
                    <select class="form-control" name="sede" id="sede_id">
                        <option value="">Seleccione su sede</option>
                        <option value="1">Aguas claras</option>
                        <option value="2">Olas</option>
                        <option value="3">Caribe</option>
                        <option value="4">Manantiales</option>
                    </select>
                    <x-jet-input-error for="sede"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Confirm Password') }}" />

                    <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted mr-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button>
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>