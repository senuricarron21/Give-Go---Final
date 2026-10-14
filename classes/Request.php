<?php
require_once __DIR__ . '/Location.php';

/**
 * Class Request
 * Encapsulates a donation request submitted by a Receiver.
 */
class Request {
    private string $id;
    private string $receiverId;
    private string $receiverName;
    private string $type;
    private string $itemName;
    private string $category;
    private int $quantityRequired;
    private int $quantityReceived;
    private string $district;
    private string $status;
    private Location $location;
    private string $createdAt;

    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? uniqid('req_');
        $this->receiverId = $data['receiverId'] ?? '';
        $this->receiverName = $data['receiverName'] ?? 'Receiver';
        $this->type = $data['reqType'] ?? $data['type'] ?? 'physical';
        $this->itemName = $data['itemName'] ?? '';
        $this->category = $data['category'] ?? 'General';
        $this->quantityRequired = (int)($data['quantityRequired'] ?? $data['quantity'] ?? 1);
        $this->quantityReceived = (int)($data['quantityReceived'] ?? 0);
        $this->district = $data['district'] ?? 'Colombo';
        $this->status = $data['status'] ?? 'pending_admin';
        $this->createdAt = $data['createdAt'] ?? date('Y-m-d\TH:i:s\Z');

        if (isset($data['location']) && $data['location'] instanceof Location) {
            $this->location = $data['location'];
        } elseif (isset($data['location']) && is_array($data['location'])) {
            $this->location = Location::fromArray($data['location']);
        } else {
            $this->location = new Location(6.9271, 79.8612);
        }
    }

    public function getId(): string {
        return $this->id;
    }

    public function getReceiverId(): string {
        return $this->receiverId;
    }

    public function getReceiverName(): string {
        return $this->receiverName;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getItemName(): string {
        return $this->itemName;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function getQuantityRequired(): int {
        return $this->quantityRequired;
    }

    public function getQuantityReceived(): int {
        return $this->quantityReceived;
    }

    public function getRemainingQuantity(): int {
        return max(0, $this->quantityRequired - $this->quantityReceived);
    }

    public function getDistrict(): string {
        return $this->district;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getLocation(): Location {
        return $this->location;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'receiverId' => $this->receiverId,
            'receiverName' => $this->receiverName,
            'type' => $this->type,
            'reqType' => $this->type,
            'itemName' => $this->itemName,
            'category' => $this->category,
            'quantityRequired' => $this->quantityRequired,
            'quantityReceived' => $this->quantityReceived,
            'remainingNeeded' => $this->getRemainingQuantity(),
            'district' => $this->district,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'location' => [
                'lat' => $this->location->getLatitude(),
                'lng' => $this->location->getLongitude()
            ]
        ];
    }

    public static function fromArray(array $data): Request {
        return new self($data);
    }
}
