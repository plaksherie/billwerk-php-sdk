<?php

namespace Billwerk\Sdk\Helper;

class ErrorCodes
{
    public const ALL = array(
        'Ok'                                                                => 0,
        'Invalid request'                                                   => 1,
        'Internal error'                                                    => 2,
        'Invalid user or password'                                          => 3,
        'No accounts for user'                                              => 4,
        'Unknown account'                                                   => 5,
        'Not authenticated'                                                 => 6,
        'Unauthorized'                                                      => 7,
        'Not found'                                                         => 8,
        'Customer not found'                                                => 9,
        'Subscription plan not found'                                       => 10,
        'Duplicate handle'                                                  => 11,
        'Subscription not found'                                            => 12,
        'Subscription expired'                                              => 13,
        'Must be in future'                                                 => 14,
        'Account not found'                                                 => 15,
        'User not found'                                                    => 17,
        'Missing customer'                                                  => 18,
        'Card not found'                                                    => 19,
        'Test data not allowed for live account'                            => 20,
        'Live data not allowed for test account'                            => 21,
        'Subscription cancelled'                                            => 22,
        'From date after to date'                                           => 23,
        'Missing amount'                                                    => 24,
        'Additional cost not pending'                                       => 25,
        'Additional cost not found'                                         => 26,
        'Credit not found'                                                  => 27,
        'Credit not pending'                                                => 28,
        'Invoice already cancelled'                                         => 29,
        'Invoice has active transactions'                                   => 30,
        'Invoice not found'                                                 => 31,
        'Customer has non expired subscriptions'                            => 32,
        'Customer has pending invoices'                                     => 33,
        'Invalid card token'                                                => 34,
        'Missing card'                                                      => 35,
        'Missing card token'                                                => 36,
        'Start date cannot be more than one period away in the past'        => 37,
        'Card not allowed for signup method'                                => 38,
        'Card token not allowed for signup method'                          => 39,
        'Payment method not found'                                          => 40,
        'Payment method not inactive'                                       => 41,
        'Payment method not active'                                         => 42,
        'Not implemented'                                                   => 43,
        'Dunning plan not found'                                            => 44,
        'Organisation not found'                                            => 45,
        'Webhook not found'                                                 => 46,
        'Event not found'                                                   => 47,
        'Dunning plan in use'                                               => 48,
        'Last dunning plan'                                                 => 49,
        'Search error'                                                      => 50,
        'Private key not found'                                             => 51,
        'Public key not found'                                              => 52,
        'Mail not found'                                                    => 53,
        'No order lines for invoice'                                        => 54,
        'Agreement not found'                                               => 55,
        'Multiple agreements'                                               => 56,
        'Duplicate email'                                                   => 57,
        'Invalid group'                                                     => 58,
        'User blocked due to failed logins'                                 => 59,
        'Invalid template'                                                  => 60,
        'Mail type not found'                                               => 61,
        'Card gateway state live/test much match account state live/test'   => 62,
        'Subscription has pending or dunning invoices'                      => 63,
        'Invoice not settled'                                               => 64,
        'Refund amount too high'                                            => 65,
        'Refund failed'                                                     => 66,
        'The subdomain is reserved'                                         => 67,
        'User email already verified'                                       => 68,
        'Go live not allowed'                                               => 69,
        'Transaction not found'                                             => 70,
        'Customer has been deleted'                                         => 71,
        'Currency change not allowed'                                       => 72,
        'Invalid reminder emails days'                                      => 73,
        'Concurrent resource update'                                        => 74,
        'Subscription not eligible for invoice'                             => 75,
        'Payment method not provided'                                       => 76,
        'Transaction declined'                                              => 77,
        'Transaction processing error'                                      => 78,
        'Invoice already settled'                                           => 79,
        'Invoice has processing transaction'                                => 80,
        'Online refund not supported, use manual refund'                    => 81,
        'Invoice wrong state'                                               => 82,
        'Discount not found'                                                => 83,
        'Subscription discount not found'                                   => 84,
        'Multiple discounts not allowed'                                    => 85,
        'Coupon not found or not eligible'                                  => 86,
        'Coupon already used'                                               => 87,
        'Coupon code already exists'                                        => 88,
        'Used coupon cannot be deleted'                                     => 89,
        'Coupon not active'                                                 => 90,
        'Coupon cannot be updated'                                          => 91,
        'Cannot expire in current period'                                   => 93,
        'Cannot uncancel in partial period'                                 => 94,
        'Subscription on hold'                                              => 95,
        'Subscription in trial'                                             => 96,
        'Subscription not on hold'                                          => 97,
        'Invalid setup token'                                               => 98,
        'Customer cannot be changed on invoice'                             => 99,
        'Amount change not allowed on invoice'                              => 100,
        'Request does not belong to invoice'                                => 101,
        'Amount higher than authorized amount'                              => 102,
        'Card token already used'                                           => 103,
        'Card token expired'                                                => 104,
        'Invoice already authorized'                                        => 105,
        'Invoice must be authorized'                                        => 106,
        'Refund not found'                                                  => 107,
        'Transaction cancel failed'                                         => 108,
        'Transaction wrong state for operation'                             => 109,
        'Unknown or missing source'                                         => 110,
        'Source not allowed for signup method'                              => 111,
        'Invoice wrong type'                                                => 112,
        'Add-on not found'                                                  => 113,
        'Add-on already added to subscription'                              => 114,
        'Add-on quantity not allowed for on-off add-on type'                => 115,
        'Add-on not eligible for subscription plan'                         => 116,
        'Subscription add-on not found'                                     => 117,
        'Subscription pending'                                              => 118,
        'Subscription must be pending'                                      => 119,
        'Credit amount too high'                                            => 120,
        'Discount is deleted'                                               => 121,
        'Request rate limit exceeded'                                       => 122,
        'Concurrent request limit exceeded'                                 => 123,
        'Payment method in use'                                             => 124,
        'Subscription has pending payment method'                           => 125,
        'Payment method not pending'                                        => 127,
        'Payment method pending'                                            => 128,
        'Multiple settles not allowed for payment method'                   => 129,
        'Partial settle not allowed for payment method'                     => 130,
        'Multiple refunds not allowed for payment method'                   => 131,
        'Partial refund not allowed for payment method'                     => 132,
        'Payout processing'                                                 => 133,
        'Payout already paid'                                               => 134,
        'Payment method not allowed for payout'                             => 135,
        'Customer cannot be changed on payout'                              => 136,
        'Payout not found'                                                  => 137,
        'No suitable card verification agreement found'                     => 138,
        'Currency not supported by payment method'                          => 139,
        'Source type must be reusable'                                      => 140,
        'Too many settle attempts'                                          => 141,
        'Invalid MFA verification code'                                     => 142,
        'MFA authentication required'                                       => 143,
        'Query took too long, adjust time range'                            => 144,
        'Invoice has zero amount'                                           => 145,
        'Non positive amount'                                               => 146,
        'Payment method failed'                                             => 147,
        'Mfa code expired'                                                  => 148,
        'Cannot activate VTS'                                               => 149,
        'Subscription product not found'                                    => 150,
        'Account funding only allowed for instant settle'                   => 151,
        'VTS token requestor already exists'                                => 152,
        'Add-on type update from \'quantity\' to \'on-off\' is not allowed' => 153,
        'Currency mismatch'                                                 => 154,
        'EMV Token requestor onboarding failed'                             => 155,
        'Customer not allowed to perform operation'                         => 156,
        'Tax policy not found'                                              => 157,
        'Tax policy cannot be deleted'                                      => 158,
        'Invoice accounting number not present on invoice'                  => 159,
        'Credit note not found'                                             => 160,
        'Customer debtor id already exists on another customer'             => 161,
        'Customer debtor id cannot be changed once set'                     => 162,
        'Supported language not found'                                      => 163,
        'Accounting export not found'                                       => 164,
        'Accounting export storage error'                                   => 165,
        'Accounting export cannot be disabled once enabled'                 => 166,
        'Accounting export configuration saving is not successful'          => 167,
    );
}
