<?php

namespace Karriere\PhpSpecMatchers\Matchers;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;

class BeEmptyMatcher implements Matcher
{
    /**
     * Checks if matcher supports provided subject and matcher name.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return bool
     */
    public function supports($name, $subject, array $arguments)
    {
        return $name === 'beEmpty';
    }

    /**
     * Evaluates positive match.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @throws FailureException
     */
    public function positiveMatch($name, $subject, array $arguments)
    {
        if (!empty($subject)) {
            if (is_array($subject)) {
                $message = sprintf(
                    'Expected an empty response but got an array (%s).',
                    implode(',', $subject)
                );
            } elseif (is_numeric($subject)) {
                $message = sprintf(
                    'Expected an empty response but got %d.',
                    $subject
                );
            } else {
                $message = sprintf(
                    'Expected an empty response but got "%s".',
                    $subject
                );
            }

            throw new FailureException($message);
        }
    }

    /**
     * Evaluates negative match.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @throws FailureException
     */
    public function negativeMatch($name, $subject, array $arguments)
    {
        if (empty($subject)) {
            throw new FailureException('The return value should not be empty.');
        }
    }

    /**
     * Returns matcher priority.
     *
     * @return int
     */
    public function getPriority()
    {
        return 0;
    }
}
