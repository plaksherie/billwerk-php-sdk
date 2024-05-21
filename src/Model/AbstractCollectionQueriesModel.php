<?php

namespace Billwerk\Sdk\Model;

use DateTime;
use Exception;

abstract class AbstractCollectionQueriesModel extends AbstractModel
{
    /**
     * Optional range defining the date and time attribute used to limit the query and also
     * defines the sorting. The sorting is always descending. Each resource offers different
     * range attributes. Each resource have a default range if non is defined
     */
    const RANGES = [];

    /**
     * Optional range defining the date and time attribute used to limit the query and also defines the sorting.
     * The sorting is always descending. Each resource offers different range attributes. Each resource have a
     * default range if non is defined
     *
     * @var string|null $range
     */
    protected ?string $range = null;

    /**
     * Time range from (inclusive). Local date and time (according to account timezone) on the form
     * yyyy-MM-dd, yyyyMMdd, yyyy-MM-ddTHH:mm, yyyy-MM-ddTHH:mm:ss or yyyy-MM-ddTHH:mm:ss.SSS.
     * Default from if no interval is given depends on the query. If the query limits on relation
     * e.g. customer and/or subscription, the default from will be epoch 1970-01-01, otherwise one month before to
     *
     * @var DateTime|null $from
     */
    protected ?DateTime $from = null;

    /**
     * Time range to (exclusive). Local date and time (according to account timezone) on the form
     * yyyy-MM-dd, yyyyMMdd, yyyy-MM-ddTHH:mm, yyyy-MM-ddTHH:mm:ss or yyyy-MM-ddTHH:mm:ss.SSS. Defaults to now
     *
     * @var DateTime|null $to
     */
    protected ?DateTime $to = null;

    /**
     * Limit from to and interval back in time. E.g. one week. Will take precedence over from.
     * Defined in ISO 8601 duration. See https://en.wikipedia.org/wiki/ISO_8601#Durations
     *
     * @var string|null $interval
     */
    protected ?string $interval = null;

    /**
     * Page size between 10 and 100 (default 20)
     *
     * @var int|null $size
     */
    protected ?int $size = null;

    /**
     * Used to get the next page if query results in multiple pages. Will be returned in response for
     * current page. The above parameters must be the same in all subsequent page requests
     *
     * @var string|null $nextPageToken
     */
    protected ?string $nextPageToken = null;

    /**
     * @return DateTime|null
     */
    public function getTo(): ?DateTime
    {
        return $this->to;
    }

    /**
     * @return string|null
     */
    public function getInterval(): ?string
    {
        return $this->interval;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @return string|null
     */
    public function getRange(): ?string
    {
        return $this->range;
    }

    /**
     * @return string|null
     */
    public function getNextPageToken(): ?string
    {
        return $this->nextPageToken;
    }

    /**
     * @return DateTime|null
     */
    public function getFrom(): ?DateTime
    {
        return $this->from;
    }

    /**
     * @param int|null $size
     *
     * @return self
     */
    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @param string|null $range
     *
     * @return self
     */
    public function setRange(?string $range): self
    {
        $this->range = $range;

        return $this;
    }

    /**
     * @param string|null $nextPageToken
     *
     * @return self
     */
    public function setNextPageToken(?string $nextPageToken): self
    {
        $this->nextPageToken = $nextPageToken;

        return $this;
    }

    /**
     * @param DateTime|null $from
     *
     * @return self
     */
    public function setFrom(?DateTime $from): self
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @param string|null $interval
     *
     * @return self
     */
    public function setInterval(?string $interval): self
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * @param DateTime|null $to
     *
     * @return self
     */
    public function setTo(?DateTime $to): self
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @param array $response
     *
     * @return void
     * @throws Exception
     */
    public function fromArrayDefault(array $response): void
    {
        if (isset($response['from'])) {
            $this->setFrom(new DateTime($response['from']));
        }

        if (isset($response['to'])) {
            $this->setTo(new DateTime($response['to']));
        }

        if (isset($response['interval'])) {
            $this->setInterval($response['interval']);
        }

        if (isset($response['size'])) {
            $this->setSize($response['size']);
        }

        if (isset($response['next_page_token'])) {
            $this->setNextPageToken($response['next_page_token']);
        }

        if (isset($response['range']) && in_array($response['range'], $this::RANGES, true)) {
            $this->setRange($response['range']);
        }
    }

    public function toApiDefault(): array
    {
        $result = [];

        if ( ! is_null($this->getFrom())) {
            $result['from'] = $this->getFrom()->format('Y-m-d\TH:i:s.v');
        }

        if ( ! is_null($this->getTo())) {
            $result['to'] = $this->getTo()->format('Y-m-d\TH:i:s.v');
        }

        if ( ! is_null($this->getRange())) {
            $result['range'] = $this->getRange();
        }

        if ( ! is_null($this->getInterval())) {
            $result['interval'] = $this->getInterval();
        }

        if ( ! is_null($this->getSize())) {
            $result['size'] = $this->getSize();
        }

        if ( ! is_null($this->getNextPageToken())) {
            $result['next_page_token'] = $this->getNextPageToken();
        }

        return $result;
    }
}