<?php
namespace OmekaTheme\Helper;

use Laminas\View\Helper\AbstractHelper;

class SafeCssColor extends AbstractHelper
{

    /**
     * Validates a hex color before it is printed inside a <style> block.
     *
     * Anything else would let a theme setting inject arbitrary CSS, or close
     * the style element and inject markup.
     *
     * @param string $value The color to validate.
     * @return string|null The color, or null when it is not a valid hex color.
     */
    public function __invoke($value)
    {
        $value = trim((string) $value);

        if (!preg_match('/^#([0-9a-f]{3}|[0-9a-f]{6})$/i', $value)) {
            return null;
        }

        return $value;
    }
}
