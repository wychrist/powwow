<?php

namespace Modules\CongregateBackend\Events;

use Illuminate\Http\Request;

class BackendTableFetchEvent
{

    private $result = [];
    private $previousCursor = [];
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(private Request $request, private array $cursor)
    {
        $this->previousCursor = $cursor;
    }

    public static function makeName(string $resource): string
    {
        return "backend:table-{$resource}";
    }

    public function getPage(): int
    {
        return $this->cursor['page'] ?? 1;
    }

    public function setPage(int $page): self
    {
        $this->cursor['page'] = $page;
        return $this;
    }

    public function getLimit(): int
    {
        return $this->cursor['limit'] ??  25;
    }

    public function setLastId(int $id): self
    {
        $this->cursor['last_id']  = $id;
        return $this;
    }

    public function getLastId(): int
    {
        return $this->cursor['last_id'] ??  0;
    }

    public function getOrderBy(): array
    {
        return $this->cursor['order_by'] ?? [];
    }

    public function getFilters(): array
    {
        return $this->cursor['filters'] ?? [];
    }

    public function getFields(): array
    {
        return $this->cursor['fields'] ?? [];
    }

    public function setResult(array $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function toArray(): array
    {
        return [
            'cursor' => [
                'next' => base64_encode(json_encode($this->cursor)),
                'previous' => base64_encode(json_encode($this->previousCursor)),
            ],
            'result' => $this->result
        ];
    }
}
