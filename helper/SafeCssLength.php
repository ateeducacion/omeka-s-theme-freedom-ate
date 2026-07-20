<?php
namespace OmekaTheme\Helper;

use Laminas\View\Helper\AbstractHelper;

class SafeCssLength extends AbstractHelper
{

    /**
     * Validates a CSS length before it is printed into a style rule.
     *
     * Anything else would let a theme setting inject arbitrary CSS, or close
     * the style element and inject markup.
     *
     * @param string $value The length to validate, e.g. "40vh".
     * @return string|null The length, or null when it is not a valid length.
     */
    public function __invoke($value)
    {
        $value = trim((string) $value);

        if (!preg_match('/^\d+(\.\d+)?(px|rem|em|vh|vw|%)$/', $value)) {
            return null;
        }

        return $value;
    }
}
