<?php

namespace App\Traits;

trait KeypairTrait
{
    /**
     * Handle Keypair string for compatible with openssl_pkey_get_*()
     *
     * @param  mixed $keypair
     * @param  mixed $default
     * @return void
     */
    function handleKeypair(string $keypair, string $default = null)
    {
        $keypairs = [
            "RSA PRIVATE KEY",
            "PRIVATE KEY",
            "ENCRYPTED PRIVATE KEY",
            "DSA PRIVATE KEY",
            "EC PRIVATE KEY",
            "OPENSSH PRIVATE KEY",
            "PUBLIC KEY",
            "RSA PUBLIC KEY",
            "DSA PUBLIC KEY",
            "EC PUBLIC KEY",
        ];

        foreach ($keypairs as $types) {
            $searchTypes = str_contains($keypair, $types);

            $header = "-----BEGIN {$default}-----";
            $footer = "-----END {$default}-----";
            $body = "";
            if ($searchTypes) {
                $header = "-----BEGIN {$types}-----";
                $footer = "-----END {$types}-----";
            }
        }

        // Remove headers/footers
        $body = preg_replace('/-----BEGIN[ A-Z]+-----/', '', $keypair);
        $body = preg_replace('/-----END[ A-Z]+-----/', '', $body);

        $payload = chunk_split($body, 64, "\n");

        $template = <<<KEY
        %s
        %s
        %s
        KEY;

        return sprintf($template, $header, trim($payload), $footer);
    }

    /**
     * Load Private key string from env
     *
     * @return void
     */
    function getPrivateKeyEnv()
    {
        $privateKey = config("passport.private_key");

        return openssl_pkey_get_private($this->handleKeypair($privateKey));
    }

    /**
     * Load Public key string from env
     *
     * @return void
     */
    function getPublicKeyEnv()
    {
        $publicKey = config("passport.public_key");

        return openssl_pkey_get_public($this->handleKeypair($publicKey));
    }


    /**
     * Load private key in path storage/keys/<public_key.pem>
     *
     * @param  mixed $privateKeyFile
     * @return void
     */
    function getPrivateKeyFile(string $privateKeyFile = "oauth-private.key")
    {
        $privateKeyFile = storage_path($privateKeyFile);

        $privateKey = file_get_contents($privateKeyFile);

        return openssl_pkey_get_private($this->handleKeypair($privateKey));
    }


    /**
     * Load public key in path storage/keys/<public_key.pem>
     *
     * @param  mixed $publicKeyFile
     * @return void
     */
    function getPublicKeyFile(string $publicKeyFile = "oauth-public.key")
    {
        $publicKeyPath = storage_path($publicKeyFile);

        $publicKey = file_get_contents($publicKeyPath);

        return openssl_pkey_get_public($this->hanndleKeypair($publicKey));
    }
}
