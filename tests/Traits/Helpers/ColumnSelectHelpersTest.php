<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use PHPUnit\Framework\Attributes\Test;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ColumnSelectHelpersTest extends TestCase
{
    #[Test]
    public function can_get_column_select_status(): void
    {
        $this->assertTrue($this->basicTable->columnSelectIsEnabled());

        $this->basicTable->setColumnSelectDisabled();

        $this->assertTrue($this->basicTable->columnSelectIsDisabled());

        $this->basicTable->setColumnSelectEnabled();

        $this->assertTrue($this->basicTable->columnSelectIsEnabled());
    }

    #[Test]
    public function can_get_remember_column_selection_status(): void
    {
        $this->assertTrue($this->basicTable->rememberColumnSelectionIsEnabled());

        $this->basicTable->setRememberColumnSelectionDisabled();

        $this->assertTrue($this->basicTable->rememberColumnSelectionIsDisabled());

        $this->basicTable->setRememberColumnSelectionEnabled();

        $this->assertTrue($this->basicTable->rememberColumnSelectionIsEnabled());
    }

    #[Test]
    public function can_set_column_select_hidden_on_mobile_status(): void
    {
        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnMobile());

        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnTablet());

        $this->basicTable->setColumnSelectHiddenOnMobile();

        $this->assertTrue($this->basicTable->getColumnSelectIsHiddenOnMobile());

        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnTablet());
    }

    #[Test]
    public function can_set_column_select_hidden_on_tablet_status(): void
    {
        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnMobile());

        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnTablet());

        $this->basicTable->setColumnSelectHiddenOnTablet();

        $this->assertFalse($this->basicTable->getColumnSelectIsHiddenOnMobile());

        $this->assertTrue($this->basicTable->getColumnSelectIsHiddenOnTablet());
    }
}
