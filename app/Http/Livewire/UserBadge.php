<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserBadge extends Component
{
    public $userCount;

    protected $listeners = ['echo:users,App\\Events\\UserChanged' => 'updateUserCount'];

    // protected $listeners = ['userChanged' => 'updateUserCount'];

    public function mount() {
        $this->userCount = User::count();
    }

    public function updateUserCount() {
        $this->userCount = User::count();
    }

    public function render() {
        return view('livewire.user-badge');
    }
}
