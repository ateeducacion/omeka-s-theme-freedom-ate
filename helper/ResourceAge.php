<?php
namespace OmekaTheme\Helper;

use DateTime;
use Exception;
use Laminas\View\Helper\AbstractHelper;

class ResourceAge extends AbstractHelper
{

    /**
     * Describes how long ago a resource was published.
     *
     * Uses dcterms:date when the resource has one, falling back to the record
     * creation timestamp otherwise.
     *
     * Recent resources get a relative label ("3 days ago"); once past a year
     * the relative form stops being informative, so the year is shown instead.
     * Each label comes with a short form for narrow screens.
     *
     * @param object $resource The resource to date.
     * @return array|null ['long' => string, 'short' => string], or null when
     *                    no usable date could be found.
     */
    public function __invoke($resource)
    {
        if (!$resource) {
            return null;
        }

        $date = null;

        if (method_exists($resource, 'value')) {
            $date = $this->parseDate((string) $resource->value('dcterms:date'));
        }

        // dcterms:date is free text, so it may be absent or unparseable.
        if (!$date && method_exists($resource, 'created')) {
            $date = $resource->created();
        }

        if (!$date) {
            return null;
        }

        return $this->format($date, $this->getView()->plugin('translate'));
    }

    /**
     * Builds the long and short labels for a date.
     *
     * @param DateTime $date
     * @param callable $translate
     * @return array
     */
    protected function format(DateTime $date, callable $translate)
    {
        // Months and years come from the calendar interval, not from dividing
        // days: 364 days is 11 months and change, never 12.
        $diff = (new DateTime())->diff($date);
        $days = $diff->days;

        if ($diff->y >= 1) {
            // Past a year "N years ago" says little, so show the year itself.
            $year = $date->format('Y');

            return [
                'long' => $year,
                'short' => $year,
            ];
        }

        if ($days < 1) {
            return [
                'long' => $translate('today'),
                'short' => $translate('today'),
            ];
        }

        if ($days < 7) {
            return [
                'long' => sprintf($translate($days == 1 ? '%s day ago' : '%s days ago'), $days),
                'short' => sprintf($translate('%sd'), $days),
            ];
        }

        if ($days < 30) {
            $weeks = (int) floor($days / 7);
            return [
                'long' => sprintf($translate($weeks == 1 ? '%s week ago' : '%s weeks ago'), $weeks),
                'short' => sprintf($translate('%sw'), $weeks),
            ];
        }

        // Round to the nearest month, so 1 month + 29 days reads as 2 months
        // rather than 1. Capped at 11: 12 would contradict "less than a year".
        $months = $diff->d >= 15 ? $diff->m + 1 : $diff->m;
        $months = min($months, 11);

        return [
            'long' => sprintf($translate($months == 1 ? '%s month ago' : '%s months ago'), $months),
            'short' => sprintf($translate('%smo'), $months),
        ];
    }

    /**
     * Parses a Dublin Core date, which is free text and often partial.
     *
     * @param string $value
     * @return DateTime|null
     */
    protected function parseDate($value)
    {
        $value = trim($value);

        if ('' === $value) {
            return null;
        }

        // Complete partial dates so DateTime does not reject them.
        if (preg_match('/^\d{4}$/', $value)) {
            $value .= '-01-01';
        } elseif (preg_match('/^\d{4}-\d{2}$/', $value)) {
            $value .= '-01';
        }

        try {
            $date = new DateTime($value);
        } catch (Exception $e) {
            return null;
        }

        // DateTime silently resolves some non-dates to "now" ("n.d.", "s.f.")
        // and only reports them as warnings, which would read as "today".
        $errors = DateTime::getLastErrors();
        if ($errors && ($errors['warning_count'] || $errors['error_count'])) {
            return null;
        }

        return $date;
    }
}
