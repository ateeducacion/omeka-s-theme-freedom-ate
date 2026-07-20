<?php
namespace OmekaTheme\Helper;

use Laminas\View\Helper\AbstractHelper;

class SafeUrl extends AbstractHelper
{

    /**
     * Validates a URL coming from a theme setting before it is used in a href.
     *
     * Only absolute http(s) URLs and site-internal paths are allowed, so that
     * schemes such as javascript: or data: never reach the markup.
     *
     * @param string $value The URL to validate.
     * @return string|null The URL, or null when it is not safe to link to.
     */
    public function __invoke($value)
    {
        $value = trim((string) $value);

        if ('' === $value) {
            return null;
        }

        // Internal path. "//host" is protocol-relative and leaves the site, so
        // it is not treated as internal.
        if (0 === strpos($value, '/') && 0 !== strpos($value, '//')) {
            return $value;
        }

        if (preg_match('#^https?://#i', $value)) {
            return $value;
        }

        return null;
    }
}
