<?php

namespace Modules\CongregateContract\Theme;

interface FlashMessageInterface
{
    public function success(string $message, array $context = []): void;

    public function information($message, array $context = []): void;

    public function warning($message, array $context = []): void;

    public function error($message, array $context = []): void;

    public function flash(string $type, string $message, array $context = []): void;

    public function reflash(): void;

    public function hasSuccess(): bool;

    public function getSuccess(): array | null;

    public function hasWarning(): bool;

    public function getWarning(): array | null;

    public function hasError(): bool;

    public function getError(): array | null;

    public function hasInformation(): bool;

    public function getInformation(): array | null;

    public function has(string $type): bool;

    public function get(string $type): array | null;
}
