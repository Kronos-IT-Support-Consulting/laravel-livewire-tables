<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Helpers;

use PHPUnit\Framework\Attributes\Test;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class DebugHelpersTest extends TestCase
{
    #[Test]
    public function can_get_debug_status(): void
    {
        $this->assertTrue($this->basicTable->debugIsDisabled());

        $this->basicTable->setDebugEnabled();

        $this->assertTrue($this->basicTable->debugIsEnabled());

        $this->basicTable->setDebugDisabled();

        $this->assertTrue($this->basicTable->debugIsDisabled());
    }
}
