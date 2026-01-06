<?php

namespace Src\Gui\Domain\Contracts;

interface GuiRepositoryContract
{
    public function list(string $grupo): array;
}
