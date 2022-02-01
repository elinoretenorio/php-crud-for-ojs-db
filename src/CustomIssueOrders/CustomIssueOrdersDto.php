<?php

declare(strict_types=1);

namespace OJS\CustomIssueOrders;

class CustomIssueOrdersDto 
{
    public int $customIssueOrderId;
    public int $issueId;
    public int $journalId;
    public float $seq;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->customIssueOrderId = (int) ($row["custom_issue_order_id"] ?? 0);
        $this->issueId = (int) ($row["issue_id"] ?? 0);
        $this->journalId = (int) ($row["journal_id"] ?? 0);
        $this->seq = (float) ($row["seq"] ?? 0);
    }
}