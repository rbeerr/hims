<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Events\UserChanged;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class CreateAccountModal extends ModalComponent
{

    use WithFileUploads;

    public $user;
    public $name;
    public $email;
    public $password;
    public $user_type;
    public $password_confirmation;
    public $profile_picture;

    public function render()
    {
        return view('livewire.admin.create-account-modal');
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'user_type', 'password_confirmation']);
    }

    public function createAccount()
    {
        // Validation (you can add more validation rules)
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => 'required|string|confirmed',
            'user_type' => ['required', 'in:1,2'],
            'profile_picture' => 'image|max:2048',
        ], [
            'email.email' => 'The email must include the "@yourmail" symbol.',
        ]);

        $profile_picture = null;

        if ($this->profile_picture) {
            $profile_picture = $this->profile_picture->store('profile-pictures', 'public');
        }

        // Create a new account record
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'user_type' => $this->user_type,
            'profile_picture' => $profile_picture,
        ]);

        // Emit the UserChanged event
        event(new UserChanged($user));

        // After creating the user, reset fields
        $this->reset(['name', 'email', 'password', 'user_type', 'password_confirmation']);


        return redirect('manage-account');
    }
}
