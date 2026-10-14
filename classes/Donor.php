<?php
require_once __DIR__ . '/User.php';

/**
 * Class Donor
 * Demonstrates: Inheritance (extends User), Encapsulation of active donations list, and Polymorphic serialization.
 */
class Donor extends User {
    private array $activeDonations;

    public function __construct(array $data = []) {
        $data['role'] = 'donor';
        parent::__construct($data);
        $this->activeDonations = $data['activeDonations'] ?? [];
    }

    public function getActiveDonations(): array {
        return $this->activeDonations;
    }

    public function addDonation(array $donation): void {
        $this->activeDonations[] = $donation;
    }

    /**
     * Polymorphic override of toArray()
     */
    public function toArray(): array {
        $data = parent::toArray();
        $data['activeDonations'] = $this->activeDonations;
        return $data;
    }
}
