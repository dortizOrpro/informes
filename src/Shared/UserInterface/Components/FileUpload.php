<?php

namespace Src\Shared\UserInterface\Components;

use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public string $title;

    public string $description;

    public $archivo;

    #[Modelable]
    public array $archivos;

    public function delete(int $index)
    {
        array_splice($this->archivos, $index, 1);
    }

    public function updatedArchivo(TemporaryUploadedFile $item)
    {
        $this->archivos[] = [
            'filename' => $item->getClientOriginalName(),
            'filepath' => $item->getRealPath(),
            'filesize' => $item->getSize(),
        ];
    }

    public function render()
    {
        return view('cds::file-upload');
    }
}
