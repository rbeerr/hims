<dialog id="create_modal" class="modal" wire:ignore.self>
    <div class="modal-box">
        <h3 class="text-3xl font-bold text-center">Create an Account</h3>
        <form method="dialog">
            <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2" wire:click="resetForm">✕</button>
        </form>

        <!-- Name Input -->
        <div class="relative">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <div class="relative">
                <input label="Name" placeholder="Ex: Taylor Swift" wire:model.defer="name"
                    class="w-full pl-10 input input-bordered" id="name" type="text" name="name" autofocus
                    autocomplete="name" />
                @error('name')
                    <small class="text-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Email Input -->
        <div class="relative">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <div class="relative">
                <input label="name" placeholder="Ex: taylor13@gmail.com" wire:model.defer="email" id="email"
                    class="w-full pl-10 input input-bordered" type="text" name="email" />
                @error('email')
                    <small class="text-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Password Input -->
        <div class="relative">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <div class="relative">
                <input label="phone" placeholder="Strong Password" wire:model.defer="password" id="password"
                    class="w-full pl-10 pr-2 input input-bordered" type="password" name="password" />
                @error('password')
                    <small class="text-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Password Confirmation Input -->
        <div class="relative">
            <x-jet-label for="passwordConfirmation" value="{{ __('Confirm Password') }}" />
            <div class="relative">

                <input label="password_confirmation" placeholder="Confirm Password"
                    wire:model.defer="password_confirmation" id="password_confirmation"
                    class="w-full pl-10 pr-2 input input-bordered" type="password" name="password_confirmation" />
                @error('password_confirmation')
                    <small class="text-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <x-jet-label for="role" value="{{ __('Role') }}" />
            <select id="role" class="block w-full mt-1" wire:model="user_type" required>
                <option value="">--Select User Type--</option>
                <option value="1">Admin</option>
                <option value="2">Employee</option>
            </select>
        </div>

        <div class="mt-4">
            <x-jet-label for="profile_picture" value="{{ __('Profile Picture') }}" />
            <input type="file" wire:model="profile_picture" class="w-full input" id="profile_picture">
            @error('profile_picture') <span class="text-error">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-4">
            <x-jet-button class="text-white bg-green-500 hover:bg-green-600" wire:click="createAccount">
                {{ __('Create') }}
            </x-jet-button>
        </div>

    </div>
</dialog>


{{-- <dialog id="create_modal" class="modal" wire:ignore.self>

    <div class="modal-box">
        <h3 class="text-3xl font-bold text-center">Create an Account</h3>
        <form method="dialog">
            <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
        </form>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="relative">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <div class="relative">
                    <input label="Name" placeholder="Ex: Taylor Swift" class="w-full pl-10 input input-bordered"
                        id="name" type="text" name="name" :value="old('name')" required autofocus
                        autocomplete="name" />
                    @error('name')
                        <small class="text-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="relative mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <div class="relative">
                    <input label="email" placeholder="Ex: taylor13@gmail.com" class="w-full pl-10 input input-bordered"
                        id="email" type="email" name="email" :value="old('email')" required />
                    @error('email')
                        <small class="text-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="relative mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <input label="password" placeholder="Strong Password" class="w-full pl-10 input input-bordered"
                        id="password" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <small class="text-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="relative mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <div class="relative">
                    <input label="confirm_password" placeholder="Confirm Strong Password"
                        class="w-full pl-10 input input-bordered" id="password_confirmation" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>
            </div>

            <div class="relative mt-4">
                <x-jet-label for="role" value="{{ __('Role') }}" />
                <select id="role" class="block w-full mt-1 input input-bordered" name="role" required>
                    <option value="Employee">Employee</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" />
                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="text-sm text-gray-600 underline hover:text-gray-900">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="text-sm text-gray-600 underline hover:text-gray-900">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex justify-center mt-4">
                <x-jet-button class="text-white bg-green-500 hover:bg-green-600" wire:click="registerAccount">
                    {{ __('Create') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</dialog> --}}
