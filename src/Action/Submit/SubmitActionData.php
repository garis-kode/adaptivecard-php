<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\Submit;

use AdaptiveCards\Node;

/**
 * Represents the data of an Action.Submit or Action.Execute.
 */
final class SubmitActionData extends Node
{
    /**
     * @param array<string, mixed> $customProperties
     */
    public function __construct(array $customProperties = [])
    {
        $this->with($customProperties);
    }

    /**
     * @param array<string, mixed> $customProperties
     */
    public static function make(array $customProperties = []): self
    {
        return new self($customProperties);
    }

    /**
     * Defines the optional Teams-specific portion of the action's data.
     * Valid values: "ImBackSubmitActionData", "InvokeSubmitActionData", "MessageBackSubmitActionData", "SigninSubmitActionData", "TaskFetchSubmitActionData".
     */
    public function msteams(TeamsSubmitActionDataInterface $msteams, bool $useCamelCaseKey = false): self
    {
        if ($useCamelCaseKey) {
            return $this->set('msTeams', $msteams);
        }

        return $this->set('msteams', $msteams);
    }

    /**
     * Set a custom key-value pair on the data object.
     */
    public function custom(string $key, mixed $value): self
    {
        return $this->set($key, $value);
    }

    /**
     * Merge multiple custom properties into the data object.
     *
     * @param array<string, mixed> $properties
     */
    public function with(array $properties): self
    {
        foreach ($properties as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    public function getType(): ?string
    {
        return null;
    }
}
