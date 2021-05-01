<?php

namespace Powwow\Realtime;

class Payload
{
    protected array $channels;
    protected string $event;
    protected array $data;
    protected ?string $socketId;
    protected array $params;

    public function __construct(
        array $channels,
        string $event,
        array $data,
        ?string $socketId = null,
        array $params  = []
    ) {
        $this->channels = [];
        $this->params = $params;
        $this->event = $event;
        $this->data = $data;
        $this->socketId = $socketId;

        $this->setChannels($channels);
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public  function getEvent(): string
    {
        return $this->event;
    }

    public function setEvent(string $event): self
    {
        $this->event = $event;
        return $this;
    }

    public function getChannels(): array
    {
        return array_values($this->channels);
    }

    public function getSocketId(): ?string
    {
        return $this->socketId;
    }

    public function setSocketId(string $socketId): self
    {
        $this->socketId = $socketId;
        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params): self
    {
        $this->params = $params;
        return $this;
    }


    public function setParam($name, $value): self
    {
        $this->params[$name] = $value;
        return $this;
    }


    public function getParam($name)
    {
        return (isset($this->params[$name])) ? $this->params[$name] : null;
    }

    public function setChannels(array $channels): self
    {
        foreach ($channels as $channel) {
            $this->channels[$channel] = $channel;
        }

        return $this;
    }

    public function appendChannel(string $channel): self
    {
        $this->channels[$channel] = $channel;
        return $this;
    }

    public function removeChanel(string $channel): self
    {
        if (isset($this->channels[$channel])) {
            unset($this->channels[$channel]);
        }

        return $this;
    }
}
