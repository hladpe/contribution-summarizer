<?php

class Summarizer
{
    /**
     * @return array
     */
    public static function findRepositories(): array
    {
        return array_map('realpath', array_filter(glob('repositories/*/.git'), 'is_dir'));
    }

    /**
     * @param array $repositories
     * @return array
     */
    public static function exportContributionsDates(array $repositories): array
    {
        $dates = [];
        foreach ($repositories as $repository) {
            $dates += static::exportLogDates(static::getLog($repository));
        }
        return static::sortDates($dates);
    }

    /**
     * @param string $repository
     * @return string
     */
    private static function getLog(string $repository): string
    {
        return shell_exec('git --git-dir=' . $repository . ' log');
    }

    /**
     * @param string $log
     * @return array
     */
    private static function exportLogDates(string $log): array
    {
        return array_map(function (string $row) {
            return new DateTimeImmutable(trim(str_replace('Date:', '', $row)));
        }, static::parseLogDates($log));
    }

    /**
     * @param string $log
     * @return array
     */
    private static function parseLogDates(string $log): array
    {
        return array_filter(explode(PHP_EOL, $log), function (string $row) {
            return strpos($row, 'Date:') === 0;
        });
    }

    /**
     * @param array $dates
     * @return array
     */
    private static function sortDates(array $dates): array
    {
        usort($dates, ['Summarizer', 'sortDate']);
        return $dates;
    }

    /**
     * @param DateTimeImmutable $lpha
     * @param DateTimeImmutable $beta
     * @return int
     */
    private static function sortDate(DateTimeImmutable $lpha, DateTimeImmutable $beta) {
        return $lpha->getTimestamp() - $beta->getTimestamp();
    }
}