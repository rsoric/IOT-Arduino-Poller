<?php

    function sanitizeInput($input)
    {
        $input = filter_var($input);
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
