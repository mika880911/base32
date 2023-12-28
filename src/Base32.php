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

    /**
     * Decodes data encoded with base32.
     *
     * @param string $string
     * @return string
     */
    public static function decode(string $string): string
    {
        if (! $string) {
            return '';
        }

        $mapping = [
            'A' => 0, 'B' => 1, 'C' => 2, 'D' => 3, 'E' => 4, 'F' => 5, 'G' => 6, 'H' => 7, 'I' => 8, 'J' => 9,
            'K' => 10, 'L' => 11, 'M' => 12, 'N' => 13, 'O' => 14, 'P' => 15, 'Q' => 16, 'R' => 17, 'S' => 18,
            'T' => 19, 'U' => 20, 'V' => 21, 'W' => 22, 'X' => 23, 'Y' => 24, 'Z' => 25, '2' => 26, '3' => 27,
            '4' => 28, '5' => 29, '6' => 30, '7' => 31, '=' => 32
        ];
        $index = $binary = $binaryLength = 0;
        $result = '';

        do {
            // Concat each binary.
            $binary = ($binary << 5) | $mapping[$string[$index]];
            $binaryLength += 5;

            while ($binaryLength >= 8) {
                // Take 8 bits from the left and map to ascii.
                $binaryLength -= 8;
                $result .= chr($binary >> $binaryLength);

                // Remove 8 bits from the left.
                $binary &= (1 << $binaryLength) - 1;
            }
        } while (++$index < strlen($string) && $string[$index] != '=');

        return $result;
    }
}
