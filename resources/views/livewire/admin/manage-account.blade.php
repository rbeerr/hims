<div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="mb-4 text-2xl font-extrabold">Manage Account</h2>
                    <button class="font-bold btn btn-success" onclick="create_modal.showModal()">CREATE ANACCOUNT</button>
                </div>

                {{-- CREATE ACCOUNT MODAL --}}
                @livewire('create-account-modal', ['key' => 'create-modal'])

                {{-- Filter Role --}}
                <div class="mb-4">
                    <label for="userTypeFilter" class="]mb-2 text-sm font-bold">Filter by Role:</label>
                    <select id="userTypeFilter" wire:model="userTypeFilter" class="w-auto max-w-xs px-2 py-2 text-center border border-green-500 rounded outline-none focus:border-green-500">
                        <option value="">All</option>
                        <option value="1">Admin</option>
                        <option value="2">Employee</option>
                    </select>
                </div>

                {{-- DISPLAY ACCOUNT --}}
                <div class="overflow-x-auto">
                    <table class="table table-lg">
                        <thead>
                            <tr class="bg-green-800">
                                <th class="text-lg text-center text-white border-r font-extrabol">Profile Picture</th>
                                <th class="text-lg text-center text-white border-r font-extrabol">Name</th>
                                <th class="text-lg text-center text-white border-r font-extrabol">Email</th>
                                <th class="text-lg text-center text-white font-extrabol">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $index => $account)
                                <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-200' }} ">
                                    <td class="text-center border-r border-gray-400">
                                        <div class="flex items-center justify-center h-full">
                                            <img src="{{ asset('storage/' . $account->profile_picture) }}" alt="{{ $account->name }}" width="50" height="50" class="rounded-full ">
                                        </div>
                                    </td>
                                    <td class="text-center border-r border-gray-400">{{ $account->name }}</td>
                                    <td class="text-center border-r border-gray-400">{{ $account->email }}</td>
                                    <td class="text-center">
                                        {{-- Update Button --}}
                                        <button class="btn btn-info" onclick="update_modal.showModal()"
                                            wire:click="openUpdateModal({{ $account->id }})"
                                            wire:key="update-modal{{ $account->id }}">Update</button>
                                        {{-- Delete Button --}}
                                        <button class="btn btn-error" wire:click="confirmDelete({{ $account->id }})"
                                            wire:key="delete-modal{{ $account->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- End Display Account --}}

                {{-- UPDATE ACCOUNT --}}
                <dialog id="update_modal" class="modal" wire:ignore.self>
                    <div class="modal-box">
                        <h3 class="text-3xl font-bold text-center">Update Account</h3>
                        <form method="dialog">
                            <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
                        </form>

                        <div class="relative">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <div class="relative">
                                <input label="Name" placeholder="Ex: Taylor Swift" wire:model="name" id="update_name"
                                    class="w-full pl-10 input input-bordered" type="text" name="name" autofocus
                                    autocomplete="name" />
                                @error('name')
                                    <small class="text-error">{{ $message }}</small>
                                @enderror
                                <svg class="absolute w-8 h-8 text-black top-2 left-2" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <div class="relative">
                                <input label="name" placeholder="your email" wire:model="email" id="update_email"
                                    class="w-full pl-10 input input-bordered" type="text" name="email" />
                                @error('email')
                                    <small class="text-error">{{ $message }}</small>
                                @enderror
                                <svg class="absolute w-8 h-8 text-black top-2 left-2" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <div class="relative">
                                <input label="phone" placeholder="Strong Password" wire:model="password"
                                    id="update_password" class="w-full pl-10 pr-2 input input-bordered" type="password"
                                    name="password" />

                                <svg class="absolute w-8 h-8 text-black top-2 left-2" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <rect x="5" y="11" width="14" height="10" rx="2" />
                                    <circle cx="12" cy="16" r="1" />
                                    <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="update_profile_picture" value="{{ __('Update Profile Picture') }}" />
                            <input type="file" wire:model="update_profile_picture" class="w-full input" id="update_profile_picture">
                            @error('update_profile_picture') <span class="text-error">{{ $message }}</span> @enderror
                        </div>


                        <div class="flex justify-center mt-4">
                            <x-jet-button class="text-white bg-green-500 hover:bg-green-600" wire:click="update">
                                {{ __('Save Changes') }}
                            </x-jet-button>
                        </div>

                    </div>
                </dialog>
                {{-- End Update Account --}}

                 {{-- DELETE CONFIRMATION MODAL  --}}
                @if ($showDeleteModal)
                    <div class="fixed inset-0 z-50 flex items-center justify-center">
                        <!-- Add this div for the blurry background -->
                        <div class="absolute inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-md"></div>
                        <!-- End of blurry background -->
                        <div class="relative p-4 bg-white rounded-lg shadow-md">
                            <h2 class="mb-4 text-xl font-bold">Confirm Deletion</h2>
                            <p>Are you sure you want to delete this account?</p>
                            <div class="flex items-center justify-between mt-4 space-x-2">
                                <button class="btn btn-error" wire:click="deleteAccount">Delete</button>
                                <button class="btn btn-secondary"
                                    wire:click="$set('showDeleteModal', false)">Cancel</button>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- End Delete Account --}}

            </div>
        </div>
    </div>
</div>
