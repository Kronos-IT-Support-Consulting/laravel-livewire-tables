<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

use PHPUnit\Framework\Attributes\Test;

class LoadingPlaceholderHelpersTest extends TestCase
{
    #[Test]
    public function can_get_loading_placeholder_status(): void
    {
        $this->assertFalse($this->basicTable->hasDisplayLoadingPlaceholder());

        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertTrue($this->basicTable->getDisplayLoadingPlaceholder());

        $this->assertTrue($this->basicTable->hasDisplayLoadingPlaceholder());

    }
}
