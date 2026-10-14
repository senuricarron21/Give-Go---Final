<?php
require_once __DIR__ . '/User.php';

/**
 * Class Receiver
 * Demonstrates: Inheritance (extends User), Encapsulation of receiver verification fields, and Polymorphic serialization.
 */
class Receiver extends User {
    private string $receiverCategory;
    private string $registrationNumber;
    private string $verificationDocumentUrl;
    private string $brDocUrl;
    private string $bankName;
    private string $accountName;
    private string $accountNumber;
    private string $bankBranch;
    private string $bankDocUrl;

    public function __construct(array $data = []) {
        $data['role'] = 'receiver';
        parent::__construct($data);

        $receiverDetails = $data['receiverDetails'] ?? [];
        $this->receiverCategory = $data['receiverCategory'] ?? $receiverDetails['category'] ?? $data['donorType'] ?? 'Children’s Home';
        $this->registrationNumber = $data['registrationNumber'] ?? $receiverDetails['registrationNumber'] ?? $data['brNumber'] ?? 'N/A';
        $this->verificationDocumentUrl = $data['registrationDocUrl'] ?? $data['verificationDocumentUrl'] ?? $receiverDetails['registrationDocUrl'] ?? $data['brDocumentUrl'] ?? '';
        $this->brDocUrl = $data['brDocUrl'] ?? $receiverDetails['brDocUrl'] ?? $this->verificationDocumentUrl;
        
        $this->bankName = $data['bankName'] ?? $receiverDetails['bankName'] ?? '';
        $this->accountName = $data['accountName'] ?? $receiverDetails['accountName'] ?? '';
        $this->accountNumber = $data['accountNumber'] ?? $receiverDetails['accountNumber'] ?? '';
        $this->bankBranch = $data['bankBranch'] ?? $receiverDetails['bankBranch'] ?? '';
        $this->bankDocUrl = $data['bankDocUrl'] ?? $receiverDetails['bankDocUrl'] ?? $data['bankAccountDocUrl'] ?? '';
    }

    public function getReceiverCategory(): string {
        return $this->receiverCategory;
    }

    public function setReceiverCategory(string $category): void {
        $this->receiverCategory = $category;
    }

    public function getRegistrationNumber(): string {
        return $this->registrationNumber;
    }

    public function getVerificationDocumentUrl(): string {
        return $this->verificationDocumentUrl;
    }

    public function getBrDocUrl(): string {
        return $this->brDocUrl;
    }

    public function getBankName(): string {
        return $this->bankName;
    }

    public function getAccountName(): string {
        return $this->accountName;
    }

    public function getAccountNumber(): string {
        return $this->accountNumber;
    }

    public function getBankBranch(): string {
        return $this->bankBranch;
    }

    public function getBankDocUrl(): string {
        return $this->bankDocUrl;
    }

    /**
     * Polymorphic override of toArray()
     */
    public function toArray(): array {
        $data = parent::toArray();
        $data['receiverCategory'] = $this->receiverCategory;
        $data['registrationNumber'] = $this->registrationNumber;
        $data['verificationDocumentUrl'] = $this->verificationDocumentUrl;
        $data['brDocUrl'] = $this->brDocUrl;
        $data['bankName'] = $this->bankName;
        $data['accountName'] = $this->accountName;
        $data['accountNumber'] = $this->accountNumber;
        $data['bankBranch'] = $this->bankBranch;
        $data['bankDocUrl'] = $this->bankDocUrl;
        return $data;
    }
}
