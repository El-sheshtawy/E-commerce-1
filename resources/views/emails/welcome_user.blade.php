<x-mail::message>
<h1 style=" color: #fd5c63; font-style: italic; opacity: 0.9;">Hello {{$user->name}}, in SHESHTAWY website </h1>

 <p style="color: black">Glad you joined our website, you will receive offers and sales instantly</p>

<x-mail::button :url="''">
   Go to SHESHTAWY
</x-mail::button>

<div style="color: black">Thanks,<br>
{{ config('app.name') }}</div>
</x-mail::message>
