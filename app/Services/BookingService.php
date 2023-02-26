<?php

namespace App\Services;

use App\Contracts\IBooking;
use App\DTO\AccommodationPrice;
use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;
use Symfony\Component\HttpKernel\Exception\UnexpectedSessionUsageException;

class BookingService implements IBooking
{
    public const STATUS_PAID = 'paid';
    public const STATUS_PENDING = 'pending';
    public const STATUS_CREATED = 'created';

    /**
     * @param AccommodationPrice $accommodationPrice
     * @param Accommodation $accommodation
     * @param User $user
     * @param Carbon $checkIn
     * @param Carbon $checkOut
     * @return Session
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createBookingSession(
        AccommodationPrice $accommodationPrice,
        Accommodation $accommodation,
        User $user,
        Carbon $checkIn,
        Carbon $checkOut
    ): Session
    {
        $session = Session::create([
            'payment_method_types' => ['card', 'ideal'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => intval($accommodationPrice->totalPrice * 100),
                        'product_data' => [
                            'name' => $accommodation->name,
                            'images' => [$accommodation->images[0]->url]
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            // return the id of the session being made
            'success_url' => route('bookings.success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('bookings.cancel'),
        ]);

        $booking = new Booking();
        $booking->accommodation()->associate($accommodation);
        $booking->user()->associate($user);
        $booking->check_in = Carbon::parse($checkIn);
        $booking->check_out = Carbon::parse($checkOut);
        $booking->status = $this::STATUS_CREATED;
        $booking->stripe_session_id = $session->id;
        $booking->amount = $accommodationPrice->totalPrice;
        $booking->amount_paid = 0;
        $booking->save();

        return $session;
    }

    /**
     * @param string $stripeSessionId
     * @return Booking|null
     */
    public function processBookingPayment(string $stripeSessionId): ?Booking
    {
        $secretKey = env('STRIPE_SECRET');
        try {
            $session = Session::retrieve($stripeSessionId, $secretKey);
        } catch (\Exception $e) {
            throw new SessionNotFoundException();
        }

        if ($session->payment_status !== 'paid') {
            throw new UnexpectedSessionUsageException("Payment status not as expected");
        }

        // get Booking where session_id = $sessionId, firstOrFail
        $booking = Booking::where('stripe_session_id', $stripeSessionId)->firstOrFail();

        if(!$booking) {
            return null;
        }

        $booking->status = 'paid';
        $booking->amount_paid = $session->amount_total / 100;
        $booking->save();

        return $booking;
    }
}
