<x-mail::message>
# New Message

You received an email from:

{{ ucwords(strtolower($name)) }}, \
{{ $emailAddress }}

{{ $message }}
</x-mail::message>
