<?php

declare(strict_types=1);

namespace Los\ResponseTime;

final class Options
{
    public function __construct(private readonly string $headerName = ResponseTime::HEADER_NAME)
    {
    }

    public function headerName(): string
    {
        return $this->headerName;
    }
}
