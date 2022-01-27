@component('mail::message')
    <img src="{{ asset('logo.jpg') }}" alt="">
    <h4>Hello, we hope you're donig well.</h4>
    <p>Thank you for your report, it helps us too mauch</p>
    <p>We have good news for you, we fixed the link you have reported.</p>
    <p>We would like to suggest on you to follow our page on Facebook to stay up-to-date to date with our acivities, you can
        find it on this <a href="https://www.facebook.com/FreeBooks/">link</a> .</p>
    <p>And if you have any trouble with downloading the book please visit <a
            href="https://pdfsbooks.com/how-to-download">How to download page.</a> </p>
    <p>We would like to hear from you, for any suggestion please <a href="https://pdfsbooks.com/contact-us">contact
            us</a>, and we will appreciate your feedback.</p>
    <p>And finally here is the free download
        <a href="{{ $data["book_url"] }}">link</a>
    </p>
    Thanks
@endcomponent
