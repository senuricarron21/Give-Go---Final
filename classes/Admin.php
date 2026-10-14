<?php
require_once __DIR__ . '/User.php';

/**
 * Class Admin
 * Demonstrates: Inheritance (extends User) and specialized administrative capabilities.
 */
class Admin extends User {
    public function __construct(array $data = []) {
        $data['role'] = 'admin';
        parent::__construct($data);
    }

    public function approveRequest(string $reqId): array {
        return [
            'action' => 'approve_request',
            'requestId' => $reqId,
            'status' => 'published',
            'adminId' => $this->uid,
            'timestamp' => date('Y-m-d\TH:i:s\Z')
        ];
    }

    public function rejectRequest(string $reqId): array {
        return [
            'action' => 'reject_request',
            'requestId' => $reqId,
            'status' => 'rejected',
            'adminId' => $this->uid,
            'timestamp' => date('Y-m-d\TH:i:s\Z')
        ];
    }

    public function approveDonationListing(string $donId): array {
        return [
            'action' => 'approve_donation',
            'donationId' => $donId,
            'status' => 'available',
            'adminId' => $this->uid,
            'timestamp' => date('Y-m-d\TH:i:s\Z')
        ];
    }

    public function rejectDonationListing(string $donId): array {
        return [
            'action' => 'reject_donation',
            'donationId' => $donId,
            'status' => 'rejected',
            'adminId' => $this->uid,
            'timestamp' => date('Y-m-d\TH:i:s\Z')
        ];
    }

    public function updateUserStatus(string $userId, string $newStatus): array {
        return [
            'action' => 'update_user_status',
            'targetUserId' => $userId,
            'status' => $newStatus,
            'adminId' => $this->uid,
            'timestamp' => date('Y-m-d\TH:i:s\Z')
        ];
    }

    public function verifyHandoverEvidence(string $matchId): array {
        return [
            'action' => 'verify_evidence',
            'matchId' => $matchId,
            'evidenceVerified' => true,
            'adminId' => $this->uid,
            'timestamp' => date('Y-m-d\TH:i:s\Z')
        ];
    }

    public function rejectHandoverEvidence(string $matchId): array {
        return [
            'action' => 'reject_evidence',
            'matchId' => $matchId,
            'evidenceVerified' => false,
            'adminId' => $this->uid,
            'timestamp' => date('Y-m-d\TH:i:s\Z')
        ];
    }

    public function adminInspectMatchChat(string $matchId): array {
        return [
            'action' => 'inspect_chat',
            'matchId' => $matchId,
            'adminId' => $this->uid,
            'timestamp' => date('Y-m-d\TH:i:s\Z')
        ];
    }
}
