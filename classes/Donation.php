<?php
require_once __DIR__ . '/Location.php';

/**
 * Class Donation
 * Encapsulates a material donation listing created by a Donor.
 */
class Donation {
    private string $id;
    private string $donorId;
    private string $donorName;
    private string $itemName;
    private string $category;
    private int $quantity;
    private string $unit;
    private string $condition;
    private string $district;
    private string $photoUrl;
    private string $status;
    private Location $location;
    private string $createdAt;

    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? uniqid('don_');
        $this->donorId = $data['donorId'] ?? '';
        $this->donorName = $data['donorName'] ?? 'Donor';
        $this->itemName = $data['itemName'] ?? '';
        $this->category = $data['category'] ?? 'General';
        $this->quantity = (int)($data['quantity'] ?? 1);
        $this->unit = $data['unit'] ?? 'Units';
        $this->condition = $data['condition'] ?? 'Good';
        $this->district = $data['district'] ?? 'Colombo';
        $this->photoUrl = $data['photoUrl'] ?? '';
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

    public function getDonorId(): string {
        return $this->donorId;
    }

    public function getDonorName(): string {
        return $this->donorName;
    }

    public function getItemName(): string {
        return $this->itemName;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function getUnit(): string {
        return $this->unit;
    }

    public function getCondition(): string {
        return $this->condition;
    }

    public function getDistrict(): string {
        return $this->district;
    }

    public function getPhotoUrl(): string {
        return $this->photoUrl;
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
            'donorId' => $this->donorId,
            'donorName' => $this->donorName,
            'itemName' => $this->itemName,
            'category' => $this->category,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'condition' => $this->condition,
            'district' => $this->district,
            'photoUrl' => $this->photoUrl,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'location' => [
                'lat' => $this->location->getLatitude(),
                'lng' => $this->location->getLongitude()
            ]
        ];
    }

    public static function fromArray(array $data): Donation {
        return new self($data);
    }
}
