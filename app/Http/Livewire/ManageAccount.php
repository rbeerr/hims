<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Events\UserChanged;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class ManageAccount extends Component
{
    use WithFileUploads;
    public $accounts;
    public $name;
    public $email;
    public $password;
    public $selected_id;
    public $update_profile_picture;

    //Delete Variables
    public $showDeleteModal = false;
    public $accountToDelete;

    public $userTypeFilter = '';

    public function render()
    {
        // Check the role
        if ($this->userTypeFilter) {
            $this->accounts = User::where('user_type', $this->userTypeFilter)->get();
        } else {
            $this->accounts = User::all();
        }

        return view('livewire.admin.manage-account');
    }

    public function openUpdateModal($id)
    {
        $this->resetExcept('accounts');
        $account = User::find($id);
        $this->selected_id = $id;
        $this->name = $account->name;
        $this->email = $account->email;
        $this->update_profile_picture = $account->profile_picture;
    }

    // Update Account Function
    public function update()
    {
        // Validation
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|max:255' . $this->id,
        ], [
            'email.email' => 'The email must include the "@yourmail" symbol.',
        ]);

        // Update the account
        $account = User::find($this->selected_id);

        if ($account) {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
            ];

            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }

            if ($this->update_profile_picture) {
                $path = $this->update_profile_picture->store('profile_pictures', 'public');
                $data['profile_picture'] = $path;
            }

            $account->update($data);

            // Emit the UserChanged event
            event(new UserChanged());

            // Redirect to the manage-account page
            return redirect()->route('manage-account');
        }
    }

    // Confirm Delete
    public function confirmDelete($accountId)
    {
        $this->showDeleteModal = true;
        $this->accountToDelete = $accountId;
    }

    // Delete Account Function
    public function deleteAccount()
    {
        $account = User::find($this->accountToDelete);
        if ($account) {
            $account->delete();
            // Emit the UserChanged event
            event(new UserChanged());
        }


        $this->showDeleteModal = false;
        $this->accountToDelete = null;


        // Redirect to the manage-account page
        return redirect()->route('manage-account');
    }
}
