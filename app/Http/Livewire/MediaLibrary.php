<?php

namespace App\Http\Livewire;

use App\Models\Media;
use App\Services\MediaService;
use Livewire\Component;
use Livewire\WithFileUploads;

class MediaLibrary extends Component
{

    use WithFileUploads;

    public $name;
    public $value;
    public $title;
    public $featured_image_url;
    public $selectedMedia;
    public $chosenMedia;
    public $medias = [];
    public $files;

    public function mount($name, $value = null, $title = null, $featured_image_url)
    {
        $this->name = $name;
        $this->value = $value;
        $this->title = $title ?? __('Featured Image');
        $this->featured_image_url = $featured_image_url;
        $this->setSelectedMedia();
        $this->getMedias();
    }

    public function updatedFiles()
    {
        $this->upload();
    }

    public function getMedias()
    {
        $medias         = Media::where('variant_name', Media::VARIANT_NAME_THUMB)->latest()->get();
        $this->medias   = $medias;
    }

    public function selectMedia($media)
    {
        $this->selectedMedia = Media::findOrFail($media);
    }

    public function chooseMedia()
    {
        if ($this->selectedMedia) :
            $this->chosenMedia = Media::findOrFail($this->selectedMedia->id);
            $this->selectedMedia = null;

            $this->emit('mediaChosen', $this->chosenMedia->id);
        endif;
    }

    public function setSelectedMedia()
    {
        if ($this->value) :
            $this->selectedMedia = Media::findOrFail($this->value);
        endif;
    }

    public function upload()
    {
        foreach ($this->files as $file) :
            MediaService::upload($file);
        endforeach;

        $this->getMedias();
    }

    public function render()
    {
        return view('livewire.media-library');
    }
}
