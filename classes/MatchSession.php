<?php
require_once __DIR__ . '/Location.php';

/**
 * Class MatchSession
 * Encapsulates a matching connection between a Donor/Donation and a Receiver/Request.
 */
class MatchSession {
    private string $id;
    private string $donationId;
    private string $requestId;
    private string $donorId;
    private string $donorName;
    private string $receiverId;
    private string $receiverName;
    private string $deliveryMethod;
    private string $status;
    private Location $liveLocation;
    private string $handoverEvidenceUrl;
    private string $createdAt;

    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? $data['deliverySessionId'] ?? uniqid('del_');
        $this->donationId = $data['donationId'] ?? '';
        $this->requestId = $data['requestId'] ?? '';
        $this->donorId = $data['donorId'] ?? '';
        $this->donorName = $data['donorName'] ?? 'Donor';
        $this->receiverId = $data['receiverId'] ?? '';
        $this->receiverName = $data['receiverName'] ?? 'Receiver';
        $this->deliveryMethod = $data['deliveryMethod'] ?? 'pending';
        $this->status = $data['status'] ?? 'pending_receiver_approval';
        $this->handoverEvidenceUrl = $data['handoverEvidenceUrl'] ?? '';
        $this->createdAt = $data['createdAt'] ?? date('Y-m-d\TH:i:s\Z');

        if (isset($data['liveLocation']) && $data['liveLocation'] instanceof Location) {
            $this->liveLocation = $data['liveLocation'];
        } elseif (isset($data['liveLocation']) && is_array($data['liveLocation'])) {
            $this->liveLocation = Location::fromArray($data['liveLocation']);
        } else {
            $this->liveLocation = new Location(6.9271, 79.8612);
        }
    }

    public function getId(): string {
        return $this->id;
    }

    public function getDonationId(): string {
        return $this->donationId;
    }

    public function getRequestId(): string {
        return $this->requestId;
    }

    public function getDonorId(): string {
        return $this->donorId;
    }

    public function getDonorName(): string {
        return $this->donorName;
    }

    public function getReceiverId(): string {
        return $this->receiverId;
    }

    public function getReceiverName(): string {
        return $this->receiverName;
    }

    public function getDeliveryMethod(): string {
        return $this->deliveryMethod;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getLiveLocation(): Location {
        return $this->liveLocation;
    }

    public function getHandoverEvidenceUrl(): string {
        return $this->handoverEvidenceUrl;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'donationId' => $this->donationId,
            'requestId' => $this->requestId,
            'donorId' => $this->donorId,
            'donorName' => $this->donorName,
            'receiverId' => $this->receiverId,
            'receiverName' => $this->receiverName,
            'deliveryMethod' => $this->deliveryMethod,
            'status' => $this->status,
            'handoverEvidenceUrl' => $this->handoverEvidenceUrl,
            'createdAt' => $this->createdAt,
            'liveLocation' => [
                'lat' => $this->liveLocation->getLatitude(),
                'lng' => $this->liveLocation->getLongitude()
            ]
        ];
    }

    public static function fromArray(array $data): MatchSession {
        return new self($data);
    }
}
