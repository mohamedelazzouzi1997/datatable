<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    public $search ='';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $deleteId = '';
    public $editedId = '';
    public $selected = [];
    public $user ='';
    public $name ='';
    public $new_status ='';
    public $status = 1;
    // public $count = User::count();

    public function deleteuser($id){
        $this->deleteId = $id;
        User::find($this->deleteId)->delete();
    }

    public function deleteUsers(){
        User::destroy($this->selected);
    }

    public function edituser($id){
        $this->editedId = $id;
        $this->name = User::where('id',$this->editedId)->first()->name;
        $this->new_status = User::where('id',$this->editedId)->first()->status;

    }
    public function edit(){
        $user = User::where('id',$this->editedId)->first();
        $user->name = $this->name;
        $user->status = $this->new_status;
        $user->update();

        $this->name = '';
        $this->editedId ='';
        $this->new_status ='';
    }

    public function render()
    {
        return view('livewire.datatable',[
            'users' => User::search($this->search)
                        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                        ->orWhereIn('status',($this->status == 1) ? ["admin","super admin"]:[$this->status] )
                        ->simplepaginate( $this->perPage ),
            'usercount' => User::count(),
            'perPage' => $this->perPage,
            'user_name' => $this->name,
            'user_status' => $this->new_status,
        ]);
    }
}
