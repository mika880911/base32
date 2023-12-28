<?php

namespace Mika\Base32;

class Base32
{
    /**
     * Encodes data with base32.
     *
     * @param string $string
     * @return string
     */
    public static function encode(string $string): string
    {
        if (! $string) {
            return '';
        }

        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567=';
        $index = $binary = $binaryLength = 0;
        $result = '';

        do {
            // Concat each binary.
            $binary = ($binary << 8) | ord($string[$index]);
            $binaryLength += 8;

            while ($binaryLength >= 5) {
                // Take 5 bits from the left and map to alphabet.
                $binaryLength -= 5;
                $result .= $alphabet[$binary >> $binaryLength];

                // Remove 5 bits from the left.
                $binary &= (1 << $binaryLength) - 1;
            }
        } while (++$index < strlen($string));

        // Handle remaining bits.
        if ($binaryLength > 0) {
            $result .= $alphabet[$binary << (5 - $binaryLength)];
        }

        // Append padding characters.
        return str_pad($result, ceil(strlen($result) / 8) * 8, $alphabet[32]);
    }
}
