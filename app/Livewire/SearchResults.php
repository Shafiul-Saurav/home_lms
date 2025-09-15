<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class SearchResults extends Component
{
    use WithPagination;

    public $query;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['query'];

    public function mount($query = null)
    {
        $this->query = $query;
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = collect();

        if ($this->query) {
            $products = Product::where(function($q) {
                    $q->where('name', 'like', '%' . $this->query . '%')
                      ->orWhere('description', 'like', '%' . $this->query . '%');
                })
                ->where('is_active', 1)
                ->where('is_stock', 1)
                ->paginate(12);
        }

        return view('livewire.search-results', [
            'products' => $products,
            'searchQuery' => $this->query
        ]);
    }
}
