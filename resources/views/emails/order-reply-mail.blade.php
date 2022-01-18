<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form</title>
</head>

<body>
    <img src="{{ asset('logo.jpg') }}" alt="">
    <h4>Hello {{ $name }}, we hope you're donig well.</h4>
    <p>Thank you for ordering from our website and we hope you will recommend it for your friends :)</p>
    <p>We have good news for you, we found the book you're looking for, and you will get it for free, YAAAY.</p>
    <p>We would like to suggest on you to follow our page on Facebook to stay up-to-date to date with our acivities, you can find it on this <a href="https://www.facebook.com/FreeBooks/">link</a> .</p>
    <p>And if you have any problem with downloading the book please visit <a href="https://pdfsbooks.com/how-to-download">How to download page.</a> </p>
    <p>We would like to hear from you, for any suggestion please <a href="https://pdfsbooks.com/contact-us">contact
            us</a>, and we will appreciate and feedback.</p>
    <p>And finally here is the free download
        <a href="{{ $book_url }}">link</a>
    </p>
    <p>yours sincerely pdfsbooks.com</p>
</body>

</html>