<?php

namespace Rappasoft\LaravelLivewireTables;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Traits\HasAllTraits;

abstract class DataTableComponent extends Component
{
    use HasAllTraits;

    #[On('refreshDatatable')]
    public function refreshDatatable(): void
    {
        // No-op: Livewire re-renders the component when any event handler runs
    }

    /**
     * Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
     */
    public function boot(): void
    {
        //
    }

    /**
     * Runs on every request, after the component is mounted or hydrated, but before any update methods are called
     */
    public function booted(): void {}

    public function render(): Application|Factory|View
    {
        return view('livewire-tables::datatable');
    }
}
