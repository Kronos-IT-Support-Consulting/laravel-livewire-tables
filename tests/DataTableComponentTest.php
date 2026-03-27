<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Illuminate\View\ViewException;
use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Exceptions\NoColumnsException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables\NoColumnsTable;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables\NoPrimaryKeyTable;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

use PHPUnit\Framework\Attributes\Test;

class DataTableComponentTest extends TestCase
{
    #[Test]
    public function primary_key_can_be_set(): void
    {
        $this->assertSame('id', $this->basicTable->getPrimaryKey());

        $this->basicTable->setPrimaryKey('name');

        $this->assertSame('name', $this->basicTable->getPrimaryKey());
    }

    #[Test]
    public function primary_key_can_be_checked_for_existence(): void
    {
        $this->assertTrue($this->basicTable->hasPrimaryKey());

        $this->basicTable->setPrimaryKey(null);

        $this->assertFalse($this->basicTable->hasPrimaryKey());
    }

    #[Test]
    public function primary_key_has_to_be_set(): void
    {
        $this->expectException(ViewException::class);
        Livewire::test(NoPrimaryKeyTable::class)
            ->call('setSearch', 'abcd');
    }

    #[Test]
    public function default_fingerprint_will_always_be_the_same_for_same_datatable(): void
    {
        $this->assertSame(
            [
                $this->basicTable->getDataTableFingerprint(),
                $this->basicTable->getDataTableFingerprint(),
                $this->basicTable->getDataTableFingerprint(),
            ],
            [
                $this->basicTable->getDataTableFingerprint(),
                $this->basicTable->getDataTableFingerprint(),
                $this->basicTable->getDataTableFingerprint(),
            ]
        );
        // Changed due to PHP 7.4
        $this->assertSame($this->basicTable->getDataTableFingerprint(), $this->defaultFingerprintingAlgo(PetsTable::class));

    }

    #[Test]
    public function default_datatable_fingerprints_will_be_different_for_each_table(): void
    {
        $mockTable = new class extends PetsTable {};

        $this->assertNotSame($this->basicTable->getDataTableFingerprint(), $mockTable->getDataTableFingerprint());
    }

    #[Test]
    public function default_fingerprint_will_be_url_friendy(): void
    {
        $mocks = [];
        for ($i = 0; $i < 9; $i++) {
            $mocks[$i] = new class extends PetsTable {};
            $this->assertFalse(filter_var('http://'.$mocks[$i]->getDataTableFingerprint().'.dev', FILTER_VALIDATE_URL) === false);
        }
        // control
        $this->assertTrue(filter_var('http://[9/$].dev', FILTER_VALIDATE_URL) === false);
    }

    #[Test]
    public function minimum_one_column_expected(): void
    {
        $this->expectException(NoColumnsException::class);
        $table = new NoColumnsTable;
        $table->boot();
        $table->bootedComponentUtilities();
        $table->bootedWithData();
        $table->bootedWithColumns();
        $table->bootedWithColumnSelect();
        $table->bootedWithSecondaryHeader();
        $table->booted();
        $table->renderingWithData($view, []);
        $table->renderingWithPagination($view, []);
        $table->render();

    }
}
