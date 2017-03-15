<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait StatusTrait
{

    public function allStatuses()
    {
        return collect(config('leflance.statuses'));
    }

    public function getStatusWaiting(): Collection
    {
        return collect($this->allStatuses()->get('waiting'));
    }

    public function getStatusWork(): Collection
    {
        return collect($this->allStatuses()->get('work'));
    }

    public function getStatusComplete(): Collection
    {
        return collect($this->allStatuses()->get('complete'));
    }

    /**
     * @return int
     */
    public function getCurrentStatusId(): int
    {
        return $this->status_id;
    }


    public function waiting(): bool
    {
        if ($this->getCurrentStatusId() === $this->getStatusWaiting()->get('id')) {
            return true;
        }
        return false;
    }

    public function work(): bool
    {
        if ($this->getCurrentStatusId() === $this->getStatusWork()->get('id')) {
            return true;
        }
        return false;
    }

    public function status()
    {
        return $this;
    }

    public function name($statusId = null)
    {
        if (is_null($statusId)) {
            $statusId = $this->getCurrentStatusId();
        }

        $status = $this->allStatuses()->where('id', $statusId)->first();
        if (!is_null($status)) {
            return $status['name'];
        }
        return null;
    }
}