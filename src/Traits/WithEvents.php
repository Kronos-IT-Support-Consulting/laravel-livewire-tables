<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\Attributes\On;

trait WithEvents
{
    #[On('setSort')]
    public function setSortEvent($field, $direction): void
    {
        $this->setSort($field, $direction);
    }

    #[On('clearSorts')]
    public function clearSortEvent(): void
    {
        $this->clearSorts();
    }

    #[On('setFilter')]
    public function setFilterEvent($filter, $value): void
    {
        $this->setFilter($filter, $value);
    }

    #[On('clearFilters')]
    public function clearFilterEvent(): void
    {
        $this->setFilterDefaults();
    }
}
