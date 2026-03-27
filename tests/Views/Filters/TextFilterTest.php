<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Test;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

final class TextFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = TextFilter::make('Active');
    }

    #[Test]
    public function can_get_filter_callback(): void
    {
        $filter = TextFilter::make('Active');

        $this->assertFalse($filter->hasFilterCallback());

        $filter = TextFilter::make('Active')
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('name', '=', $value);
            });

        $this->assertTrue($filter->hasFilterCallback());
        $this->assertIsCallable($filter->getFilterCallback());
    }

    #[Test]
    public function can_not_exceed_text_filter_max_length(): void
    {
        $filter = TextFilter::make('BreedID')->config(['maxlength' => 10]);
        $this->assertFalse($filter->validate('testtesttesttesttest'));
    }

    #[Test]
    public function can_set_text_filter_to_number(): void
    {
        $filter = TextFilter::make('BreedID');
        $this->assertSame('123', $filter->validate(123));
        $this->assertSame('123', $filter->validate('123'));
    }

    #[Test]
    public function can_set_text_filter_to_text(): void
    {
        $filter = TextFilter::make('BreedID');
        $this->assertSame('test', $filter->validate('test'));
    }

    #[Test]
    public function can_get_if_text_filter_empty(): void
    {
        $filter = TextFilter::make('Active');
        $this->assertTrue($filter->isEmpty(''));
        $this->assertFalse($filter->isEmpty('123'));
        $this->assertFalse($filter->isEmpty('test'));
    }

    #[Test]
    public function can_set_custom_filter_view(): void
    {
        $filter = TextFilter::make('Active');

        $this->assertSame('livewire-tables::components.tools.filters.text-field', $filter->getViewPath());
        $filter->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', $filter->getViewPath());
    }
}
