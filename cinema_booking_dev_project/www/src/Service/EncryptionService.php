<?php

namespace App\Service;

class EncryptionService
{
    private $method = 'AES-256-CBC';
    private $key;

    public function __construct(string $encryptionKey)
    {
        if (empty($encryptionKey)) {
            throw new \InvalidArgumentException("Encryption key cannot be empty");
        }
        $this->key = hash('sha256', $encryptionKey, true);
    }

    public function encrypt(string $plainText): string
    {
        $iv = random_bytes(openssl_cipher_iv_length($this->method));
        $cipherText = openssl_encrypt($plainText, $this->method, $this->key, 0, $iv);
        return base64_encode($iv . $cipherText);
    }

    public function decrypt(string $cipherText): string
    {
        $data = base64_decode($cipherText);
        $ivLength = openssl_cipher_iv_length($this->method);
        $iv = substr($data, 0, $ivLength);
        $cipher = substr($data, $ivLength);

        $plainText = openssl_decrypt($cipher, $this->method, $this->key, 0, $iv);
        if ($plainText === false) {
            throw new \RuntimeException("Decryption failed");
        }

        return $plainText;
    }
}
