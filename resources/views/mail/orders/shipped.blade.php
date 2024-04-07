<!-- resources/views/mail/orders/shipped.blade.php -->

@component('mail::message')
# {{ __('mail.order_shipped') }}

{{ __('mail.greeting') }}

{{ __('mail.view_order') }}

@component('mail::button', ['url' => $orderId])
{{ __('mail.view_order') }}
@endcomponent

{{ __('mail.regards') }},<br>
{{ config('app.name') }}
@endcomponent
