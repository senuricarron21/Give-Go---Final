<?php
require_once __DIR__ . '/Location.php';

/**
 * Class User
 * Base Superclass representing a generic user in GiveGo.
 * Demonstrates: Encapsulation (protected fields), Abstraction, and Polymorphism.
 */
class User {
    protected string $uid;
    protected string $name;
    protected string $email;
    protected string $role;
    protected string $district;
    protected string $status;
    protected Location $location;
    protected string $phone;
    protected string $createdAt;

    public function __construct(array $data = []) {
        $this->uid = $data['uid'] ?? $data['id'] ?? uniqid('usr_');
        $this->name = $data['name'] ?? 'Anonymous User';
        $this->email = $data['email'] ?? '';
        $this->role = $data['role'] ?? 'user';
        $this->district = $data['district'] ?? 'Colombo';
        $this->status = $data['status'] ?? 'pending';
        $this->phone = $data['phone'] ?? '';
        $this->createdAt = $data['createdAt'] ?? date('Y-m-d\TH:i:s\Z');

        if (isset($data['location']) && $data['location'] instanceof Location) {
            $this->location = $data['location'];
        } elseif (isset($data['location']) && is_array($data['location'])) {
            $this->location = Location::fromArray($data['location']);
        } else {
            $this->location = new Location(6.9271, 79.8612); // Default Colombo
        }
    }

    // Encapsulation: Public Accessor and Mutator Methods
    public function getUid(): string {
        return $this->uid;
    }

    public function setUid(string $uid): void {
        $this->uid = $uid;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getRole(): string {
        return $this->role;
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

    public function getPhone(): string {
        return $this->phone;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    /**
     * Polymorphic method to serialize User into array representation.
     */
    public function toArray(): array {
        return [
            'uid' => $this->uid,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'district' => $this->district,
            'status' => $this->status,
            'phone' => $this->phone,
            'createdAt' => $this->createdAt,
            'location' => [
                'lat' => $this->location->getLatitude(),
                'lng' => $this->location->getLongitude()
            ]
        ];
    }

    /**
     * Factory method supporting polymorphic instantiation.
     */
    public static function fromArray(array $data): User {
        $role = strtolower($data['role'] ?? '');
        if ($role === 'donor') {
            require_once __DIR__ . '/Donor.php';
            return new Donor($data);
        } elseif ($role === 'receiver') {
            require_once __DIR__ . '/Receiver.php';
            return new Receiver($data);
        } elseif ($role === 'admin') {
            require_once __DIR__ . '/Admin.php';
            return new Admin($data);
        }
        return new self($data);
    }
}
