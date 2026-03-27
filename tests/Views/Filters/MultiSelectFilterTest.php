<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Test;

class MultiSelectFilterTest extends TestCase
{
    public array $optionsArray = [];

    public function test_array_setup(): array
    {
        $this->optionsArray = $optionsArray = array_values(['Cartman', 'Tux', 'May', 'Ben', 'Chico']);
        $this->assertNotEmpty($optionsArray);

        return $optionsArray;
    }

    #[Test]
    public function can_get_filter_name(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertSame('Active', $filter->getName());
    }

    #[Test]
    public function can_get_filter_key(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertSame('active', $filter->getKey());
    }

    #[Test]
    public function can_get_filter_configs(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertSame([], $filter->getConfigs());

        $filter->config(['foo' => 'bar']);

        $this->assertSame(['foo' => 'bar'], $filter->getConfigs());
    }

    #[Test]
    public function get_a_single_filter_config(): void
    {
        $filter = MultiSelectFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertSame('bar', $filter->getConfig('foo'));
    }

    #[Test]
    public function can_get_filter_default_value(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertSame([], $filter->getDefaultValue());
    }

    #[Test]
    public function can_get_filter_callback(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertFalse($filter->hasFilterCallback());

        $filter = MultiSelectFilter::make('Active')
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('name', '=', $value);
            });

        $this->assertTrue($filter->hasFilterCallback());
        $this->assertIsCallable($filter->getFilterCallback());
    }

    #[Test]
    public function can_get_filter_pill_title(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertSame('Active', $filter->getFilterPillTitle());

        $filter = MultiSelectFilter::make('Active')
            ->setFilterPillTitle('User Status');

        $this->assertSame('User Status', $filter->getFilterPillTitle());
    }

    #[Test]
    public function can_check_if_filter_has_configs(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertFalse($filter->hasConfigs());

        $filter = MultiSelectFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfigs());
    }

    #[Test]
    public function can_check_filter_config_by_name(): void
    {
        $filter = MultiSelectFilter::make('Active')
            ->config(['foo' => 'bar']);

        $this->assertTrue($filter->hasConfig('foo'));
        $this->assertFalse($filter->hasConfig('bar'));
    }

    #[Test]
    public function can_check_if_filter_is_hidden_from_menus(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromMenus());
        $this->assertTrue($filter->isVisibleInMenus());

        $filter->hiddenFromMenus();

        $this->assertTrue($filter->isHiddenFromMenus());
        $this->assertFalse($filter->isVisibleInMenus());
    }

    #[Test]
    public function can_check_if_filter_is_hidden_from_pills(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromPills());
        $this->assertTrue($filter->isVisibleInPills());

        $filter->hiddenFromPills();

        $this->assertTrue($filter->isHiddenFromPills());
        $this->assertFalse($filter->isVisibleInPills());
    }

    #[Test]
    public function can_check_if_filter_is_hidden_from_count(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertFalse($filter->isHiddenFromFilterCount());
        $this->assertTrue($filter->isVisibleInFilterCount());

        $filter->hiddenFromFilterCount();

        $this->assertTrue($filter->isHiddenFromFilterCount());
        $this->assertFalse($filter->isVisibleInFilterCount());
    }

    #[Test]
    public function can_check_if_filter_is_reset_by_clear_button(): void
    {
        $filter = MultiSelectFilter::make('Active');

        $this->assertTrue($filter->isResetByClearButton());

        $filter->notResetByClearButton();

        $this->assertFalse($filter->isResetByClearButton());
    }

    #[Test]
    #[Depends("test_array_setup")]
    public function can_set_filter_to_number(array $optionsArray): void
    {
        $filter = MultiSelectFilter::make('BreedID')->options($optionsArray);
        $this->assertSame(123, $filter->validate(123));
        $this->assertSame('123', $filter->validate('123'));
    }

    #[Test]
    #[Depends("test_array_setup")]
    public function can_set_filter_to_valid_value(array $optionsArray): void
    {
        $filter = MultiSelectFilter::make('BreedID')->options($optionsArray);
        $this->assertSame($optionsArray, $filter->getOptions());
        $this->assertSame(['1', '3'], $filter->validate([0 => '1', 1 => '3']));
        $this->assertSame(['1', '3'], $filter->validate([0 => '1', 1 => '3', 2 => '99']));
    }

    #[Test]
    public function can_get_if_filter_empty(): void
    {
        $filter = MultiSelectFilter::make('Active');
        $this->assertTrue($filter->isEmpty(''));
        $this->assertTrue($filter->isEmpty([]));
        $this->assertTrue($filter->isEmpty('123'));
        $this->assertTrue($filter->isEmpty('test'));
        $this->assertFalse($filter->isEmpty([1]));
    }

    #[Test]
    public function can_set_custom_filter_view(): void
    {
        $filter = MultiSelectFilter::make('Active');
        $this->assertSame('livewire-tables::components.tools.filters.multi-select', $filter->getViewPath());
        $filter->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', $filter->getViewPath());
    }
}
