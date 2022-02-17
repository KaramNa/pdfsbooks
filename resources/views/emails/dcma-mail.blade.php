@component('mail::message')
    <img src="{{ asset('logo.jpg') }}" alt="">
    <h4>Hello {{ $data["name"] }}, we hope you're donig well.</h4>
    <p>responding  to your claims of copyright infringement committed, we removed the links.</p>
    <p>We are sorry for that infringement, and we appreciate your report.</p>
    Thank you
@endcomponent
