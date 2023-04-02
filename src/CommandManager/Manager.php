<?php

namespace Kathamo\App\CommandManager;

class Manager
{
    public function input($label)
    {
        return readline(
            sprintf(" %s%s %s", "\033[1;34m", $label, "\033[0m")
        );
    }
}
