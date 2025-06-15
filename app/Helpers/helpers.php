<?php

use App\Models\Order;
use App\Models\Payment;
use App\Models\Transaction;

if (! function_exists('format_date')) {
    /**
     * Format a date in a specific way.
     *
     * @param  string  $date
     * @return string
     */
    function format_date($date)
    {
        return \Carbon\Carbon::parse($date)->format('d-m-Y');
    }
}

if (! function_exists('greet_user')) {
    function greet_user($name)
    {
        return "Hello, " . ucfirst($name) . "!";
    }
}

if (!function_exists('convertMinutesToTime')) {
    /**
     * Convert minutes into days, hours, and minutes.
     *
     * @param int $minutes
     * @return string
     */
    function convertMinutesToTime(int $minutes): string
    {
        $days = floor($minutes / (24 * 60));
        $hours = floor(($minutes % (24 * 60)) / 60);
        $remainingMinutes = $minutes % 60;

        $timeComponents = [];

        if ($days > 0) {
            $timeComponents[] = $days . ' day' . ($days > 1 ? 's' : '');
        }

        if ($hours > 0) {
            $timeComponents[] = $hours . ' hr' . ($hours > 1 ? 's' : '');
        }

        if ($remainingMinutes > 0 || empty($timeComponents)) {
            $timeComponents[] = $remainingMinutes . ' min' . ($remainingMinutes > 1 ? 's' : '');
        }

        return implode(', ', $timeComponents);
    }
}

if (!function_exists('formatPrice')) {
    /**
     * Format a price with currency and separators.
     *
     * @param float|int $price
     * @param string $currency
     * @param int $decimals
     * @param string $decimalSeparator
     * @param string $thousandsSeparator
     * @return string
     */
    function formatPrice(
        float|int $price, 
        // string $currency = '₦',
        string $currency = '$', 
        int $decimals = 2, 
        string $decimalSeparator = '.', 
        string $thousandsSeparator = ','
    ): string {
        return $currency . number_format($price, $decimals, $decimalSeparator, $thousandsSeparator);
    }
}


if (!function_exists('generateOTP')) {
    function generateOTP()
    {
        $uniqueCode = random_int(100000, 999999); // Generate a six-digit random number
        return $uniqueCode; // Prefix with "MU_RS" for TrailOman Resources
    }
}

if (!function_exists('generateAgentCode')) {
    function generateAgentCode()
    {
        $uniqueCode = random_int(100000, 999999); // Generate a six-digit random number for agent
        return 'ZD' . $uniqueCode; // Prefix with "TA" for TrailOman Agent
    }
}


if (!function_exists('generateOrderReferenceCode')) {
    function generateOrderReferenceCode()
    {
        $uniqueCode = strtoupper(uniqid()); // Generate a unique code
        return 'MU_OR' . substr($uniqueCode, -9); // Prefix with "MU_OR" for TrailOman Order and ensure 12 characters
    }
}

if (!function_exists('generateWalletIdentifier')) {
    function generateWalletIdentifier()
    {
        $randomBytes = random_bytes(8); // Generates 10 random bytes
        $code = bin2hex($randomBytes); // Convert the bytes to hexadecimal representation
        return 'MU_WA' . substr($code, -7); // Prefix with "MU_OR" for TrailOman Order and ensure 12 characters
    }
}

if (!function_exists('generatePaymentReferenceCode')) {
    function generatePaymentReferenceCode()
    {
        $uniqueCode = strtoupper(uniqid()); // Generate a unique code
        return 'MU_PY' . substr($uniqueCode, -9); // Prefix with "MU_PY" for TrailOman Payment and ensure 12 characters
    }
}

if (!function_exists('generateTransactionReferenceCode')) {
    function generateTransactionReferenceCode()
    {
        $uniqueCode = strtoupper(uniqid()); // Generate a unique code
        return 'MU_PY' . substr($uniqueCode, -9); // Prefix with "MU_PY" for TrailOman Payment and ensure 12 characters
    }
}

if (!function_exists('formatDateToShort')) {
    function formatDateToShort($date)
    {
        return \Carbon\Carbon::parse($date)->format('d/m/y');
    }
}

if (!function_exists('formatToReadableDate')) {
    function formatToReadableDate($date)
    {
        try {
            return \Carbon\Carbon::parse($date)->format('M d, Y');
        } catch (\Exception $e) {
            return null; // Handle invalid date input gracefully
        }
    }
}

if (!function_exists('formatDateToTimezone')) {
    function formatDateToTimezone($date, $timezone)
    {
        return \Carbon\Carbon::parse($date)->setTimezone($timezone)->toDateTimeString();
    }
}

if (!function_exists('shortenTitle')) {
    /**
     * Shorten a given title to 100 characters and append '..' if truncated.
     *
     * @param string $title The title to shorten.
     * @param int $length The maximum length for the title (default: 100).
     * @return string The shortened title.
     */
    function shortenTitle(string $title, int $length = 100): string
    {
        return strlen($title) > $length
            ? substr($title, 0, $length) . '..'
            : $title;
    }
}

if (!function_exists('fullName')) {
    function fullName($firstname, $lastname)
    {
        $firstname = trim($firstname ?? ''); // Ensure the value is trimmed and not null
        $lastname = trim($lastname ?? '');   // Ensure the value is trimmed and not null

        // Merge the names with proper spacing
        return trim("$firstname $lastname");
    }
}


if (!function_exists('getTotalOrdersCount')) {
    /**
     * Get the total count of orders for a given user.
     *
     * @param int $userId
     * @return int
     */
    function getTotalOrdersCount(int $userId): int
    {
        return Order::where('userID', $userId)->count();
    }
}

if (!function_exists('getTotalOrdersValue')) {
    /**
     * Get the total monetary value of orders for a given user.
     *
     * @param int $userId
     * @return float
     */
    function getTotalOrdersValue(int $userId): float
    {
        return Order::where('userID', $userId)->sum('total');
    }
}

if (!function_exists('getTotalPaymentsCount')) {
    /**
     * Get the total count of payments for a given user.
     *
     * @param int $userId
     * @return int
     */
    function getTotalpaymentsCount(int $userId): int
    {
        return Payment::where('userID', $userId)->count();
    }
}

if (!function_exists('getTotalPaymentsValue')) {
    /**
     * Get the total monetary value of payments for a given user.
     *
     * @param int $userId
     * @return float
     */
    function getTotalPaymentsValue(int $userId): float
    {
        return Payment::where('userID', $userId)->sum('amount');
    }
}

if (!function_exists('getTotalTransactionsCount')) {
    /**
     * Get the total count of Transactions for a given user.
     *
     * @param int $userId
     * @return int
     */
    function getTotalTransactionsCount(int $userId): int
    {
        return Transaction::where('userID', $userId)->count();
    }
}

if (!function_exists('getTotalTransactionsValue')) {
    /**
     * Get the total monetary value of Transactions for a given user.
     *
     * @param int $userId
     * @return float
     */
    function getTotalTransactionsValue(int $userId): float
    {
        return Transaction::where('userID', $userId)->sum('amount');
    }
}

if (!function_exists('respondWithTransformer')) {
     /**
     * Get json response for each request.
     */
    function respondWithTransformer($data, $status = true, $code = 200, $headers = [], $message = 'Action was successful')
    {
        $result = [
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ];
    
        return response()->json($result, $code, $headers);
    }
}

if (!function_exists('generateRandomNumbers')) {
    /**
    * Get json response for each request.
    */
   function generateRandomNumbers()
   {
        $min = 100000; // Minimum 6-digit number
        $max = 999999; // Maximum 6-digit number
        // Generate a random number within the specified range
        $randomNumber = rand($min, $max);
        return $randomNumber;
   }
}

if (!function_exists('generateOTP')) {
    /**
    * Get json response for each request.
    */
   function generateOTP()
   {
        $min = 100000; // Minimum 6-digit number
        $max = 999999; // Maximum 6-digit number
        // Generate a random number within the specified range
        $randomNumber = rand($min, $max);
        return $randomNumber;
   }
}
