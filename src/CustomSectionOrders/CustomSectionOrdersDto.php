<?php

declare(strict_types=1);

namespace OJS\CustomSectionOrders;

class CustomSectionOrdersDto 
{
    public int $customSectionOrderId;
    public int $issueId;
    public int $sectionId;
    public float $seq;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->customSectionOrderId = (int) ($row["custom_section_order_id"] ?? 0);
        $this->issueId = (int) ($row["issue_id"] ?? 0);
        $this->sectionId = (int) ($row["section_id"] ?? 0);
        $this->seq = (float) ($row["seq"] ?? 0);
    }
}