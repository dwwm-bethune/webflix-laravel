<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;

    public $search = '';
    public $orderBy = 'id';
    public $order = 'ASC';
    public $editing = null;
    public $editingTitle = '';
    public $byPage = 5;
    // @todo Faire la suppression de plusieurs Films...
    // Dès que ce tableau se remplit, on affiche un bouton
    // "Supprimer tout" et là on supprimer avec une action
    // les ids choisis
    public $toDelete = [];
    // @todo Faire les filtres par catégories...
    public $toFilters = [];
    protected $queryString = [
        'search' => ['except' => ''],
    ];
    protected $listeners = ['incrementCounter'];

    public function incrementCounter($value)
    {
        $this->byPage = $value;
    }

    public function sortBy($orderBy)
    {
        if ($this->orderBy === $orderBy) {
            $this->order = $this->order === 'ASC' ? 'DESC' : 'ASC';
        }

        $this->orderBy = $orderBy;
        $this->gotoPage(1);
    }

    public function setEditing($id, $title)
    {
        $this->editing = $id;
        $this->editingTitle = $title;
    }

    public function update()
    {
        $this->validate([
            'editingTitle' => 'required|min:2',
        ]);

        $movie = Movie::find($this->editing);
        $movie->update([
            'title' => $this->editingTitle,
        ]);

        $this->editing = null;
        $this->editingTitle = '';
    }

    public function render()
    {
        return view('livewire.user', [
            'movies' => Movie::where('title', 'LIKE', '%'.$this->search.'%')
                ->orderBy($this->orderBy, $this->order)
                ->paginate($this->byPage),
        ]);
    }
}
