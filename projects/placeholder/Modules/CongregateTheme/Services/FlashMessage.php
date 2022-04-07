<?php

namespace Modules\CongregateTheme\Services;

use Illuminate\Contracts\Session\Session;
use Modules\CongregateContract\Theme\FlashMessageInterface;

class FlashMessage implements FlashMessageInterface
{

    private Session $session;

    private const SUCCESS = 'success',
        INFO  = 'info',
        WARNING = 'warning',
        ERROR = 'error';

    private const PREFIX = 'notification_';

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function success(string $message, array $context = []): void
    {
        $this->doFlashing(self::SUCCESS, $message, $context);
    }

    public function information($message, array $context = []): void
    {
        $this->doFlashing(self::INFO, $message, $context);
    }

    public function warning($message, array $context = []): void
    {
        $this->doFlashing(self::WARNING, $message, $context);
    }

    public function error($message, array $context = []): void
    {
        $this->doFlashing(self::ERROR, $message, $context);
    }

    public function flash(string $type, string $message, array $context = []): void
    {
        $this->doFlashing(self::PREFIX . $type, $message, $context);
    }

    public function reflash(): void
    {
        $this->session->reflash();
    }

    public function hasSuccess(): bool
    {
        return $this->has(self::SUCCESS);
    }

    public function getSuccess(): array | null
    {
        return $this->get(self::SUCCESS);
    }

    public function hasWarning(): bool
    {
        return $this->has(self::WARNING);
    }

    public function getWarning(): array | null
    {
        return $this->get(self::WARNING);
    }

    public function hasError(): bool
    {
        return $this->has(self::ERROR);
    }

    public function getError(): array | null
    {
        return $this->get(self::ERROR);
    }

    public function hasInformation(): bool
    {
        return $this->has(self::INFO);
    }

    public function getInformation(): array | null
    {
        return $this->get(self::INFO);
    }

    public function has(string $type): bool
    {
        return $this->session->has(self::PREFIX . $type);
    }

    public function get(string $type): array | null
    {
        $data = $this->session->get(self::PREFIX . $type);
        return $data;
    }
    public function set(string $type, string $message, array $context = []): void
    {
        $this->doFlashing($type, $message, $context);
    }

    protected function doFlashing(string $type, string $message, array $context = []): void
    {
        $this->session->flash(self::PREFIX . $type, ['message' => $message, 'context' => $context]);
    }
}
