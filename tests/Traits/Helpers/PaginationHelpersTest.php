<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use PHPUnit\Framework\Attributes\Test;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class PaginationHelpersTest extends TestCase
{
    #[Test]
    public function can_get_pagination_status(): void
    {
        $this->assertTrue($this->basicTable->paginationIsEnabled());

        $this->basicTable->setPaginationDisabled();

        $this->assertTrue($this->basicTable->paginationIsDisabled());

        $this->basicTable->setPaginationEnabled();

        $this->assertTrue($this->basicTable->paginationIsEnabled());
    }

    #[Test]
    public function can_get_pagination_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->paginationVisibilityIsEnabled());

        $this->basicTable->setPaginationVisibilityDisabled();

        $this->assertTrue($this->basicTable->paginationVisibilityIsDisabled());

        $this->basicTable->setPaginationVisibilityEnabled();

        $this->assertTrue($this->basicTable->paginationVisibilityIsEnabled());
    }

    #[Test]
    public function can_get_computed_page_name(): void
    {
        $this->assertSame('page', $this->basicTable->getComputedPageName());

        $this->basicTable->setTableName('users');

        $this->assertSame('usersPage', $this->basicTable->getComputedPageName());

        $this->basicTable->setPageName('newPage');

        $this->assertSame('newPage', $this->basicTable->getComputedPageName());
    }

    #[Test]
    public function can_get_per_page_selection(): void
    {
        $this->assertSame(10, $this->basicTable->getPerPage());
    }

    #[Test]
    public function can_get_per_page_accepted(): void
    {
        $this->assertSame([10, 25, 50], $this->basicTable->getPerPageAccepted());
    }

    #[Test]
    public function can_get_per_page_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->perPageVisibilityIsEnabled());

        $this->basicTable->setPerPageVisibilityDisabled();

        $this->assertTrue($this->basicTable->perPageVisibilityIsDisabled());

        $this->basicTable->setPerPageVisibilityEnabled();

        $this->assertTrue($this->basicTable->perPageVisibilityIsEnabled());
    }

    #[Test]
    public function can_check_and_set_pagination_method(): void
    {
        $this->assertTrue($this->basicTable->isPaginationMethod('standard'));

        $this->basicTable->setPaginationMethod('simple');

        $this->assertTrue($this->basicTable->isPaginationMethod('simple'));

        $this->basicTable->setPaginationMethod('standard');

        $this->assertTrue($this->basicTable->isPaginationMethod('standard'));
    }

    #[Test]
    public function can_check_per_page_displayed_item_count(): void
    {
        $this->assertSame(5, $this->basicTable->getPerPageDisplayedItemCount());

    }

    #[Test]
    public function can_check_per_page_displayed_items(): void
    {
        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getPerPageDisplayedItemIds());

    }

    #[Test]
    public function can_enable_detailed_pagination(): void
    {

        $this->assertTrue($this->basicTable->showPaginationDetails());

        $this->basicTable->setDisplayPaginationDetailsDisabled();

        $this->assertFalse($this->basicTable->showPaginationDetails());

        $this->basicTable->setDisplayPaginationDetailsEnabled();

        $this->assertTrue($this->basicTable->showPaginationDetails());
    }

    #[Test]
    public function can_disable_detailed_pagination(): void
    {

        $this->assertTrue($this->basicTable->showPaginationDetails());

        $this->basicTable->setDisplayPaginationDetailsDisabled();

        $this->assertFalse($this->basicTable->showPaginationDetails());

    }

    #[Test]
    public function can_get_pagination_field_attributes(): void
    {

        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => ''], $this->basicTable->getPerPageFieldAttributes());

        $this->basicTable->setPerPageFieldAttributes(
            [
                'class' => 'bg-blue-500 dark:bg-red-500',
                'default-colors' => true,
            ]
        );

        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => 'bg-blue-500 dark:bg-red-500'], $this->basicTable->getPerPageFieldAttributes());

        $this->basicTable->setPerPageFieldAttributes(
            [
                'default-styling' => false,
            ]
        );

        $this->assertSame(['default-styling' => false, 'default-colors' => true, 'class' => 'bg-blue-500 dark:bg-red-500'], $this->basicTable->getPerPageFieldAttributes());

    }
}
