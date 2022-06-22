<?php

class emailverificationmanager
{
    function generate_activation_code(): string
    {
        return bin2hex(random_bytes(16));
    }
}
