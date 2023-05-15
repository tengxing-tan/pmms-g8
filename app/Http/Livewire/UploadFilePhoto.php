<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFilePhoto extends Component
{
    use WithFileUploads;
    public $photo;
    
    public function render()
    {
        return view('livewire.upload-file-photo');
    }

    public function save()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        $this->photo->store('item_photos');
    }
}
