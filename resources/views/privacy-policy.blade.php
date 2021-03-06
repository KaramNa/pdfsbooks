@extends('layouts.app')

@section('page_title', 'PDFSBOOKS - Privay Policy')
@section('page_description', 'PDFSBOOKS - Privay Policy')
@section('page_url', \Request::fullUrl())
@section('canonical_url', \Request::fullUrl())

@section('content')
    <x-adsense />
    <x-kindle />
    <div class="container my-100 privacy-policy">
        <div>
            <h1 class="text-center">Privacy Policy</h1>
            <p>PLEASE READ THIS PRIVACY POLICY CAREFULLY BEFORE USING OUR WEBSITES OR SERVICES. BY ACCESSING OR USING OUR
                WEBSITE OR OUR SERVICES (OTHER THAN TO READ THIS PRIVACY POLICY FOR THE FIRST TIME), YOU AGREE TO THIS
                PRIVACY POLICY.
            </p>
            <h3>Introduction</h3>
            <p>This Privacy Policy tells you the types of information we collect when you use our Site, and how we use that
                information.</p>
            <h3>Personal identification information</h3>
            <p>We may collect personal identification information from Users in a variety of ways, including, but not
                limited to, when Users visit our site, fill out a formsubscribe to the newsletter, suggest a book, make a
                comment and report a link. Users may be asked for, as appropriate, name, email address.</p>
            <p>We will collect personal identification information from Users only if they voluntarily submit such
                information to us. Users can always refuse to supply personally identification information, except that it
                may prevent them from engaging in certain Site related activities.</p>
            <h3>Non-personal identification information</h3>
            <p>We may collect non-personal identification information about Users whenever they interact with our Site.
                Non-personal identification information may include the browser name, the type of computer and technical
                information about Users means of connection to our Site, such as the operating system and the Internet
                service providers utilized and other similar information.</p>
            <h3>Web browser cookies</h3>
            <p>Our Site may use "cookies" to enhance User experience. User's web browser places cookies on their hard drive
                for record-keeping purposes and sometimes to track information about them. User may choose to set their web
                browser to refuse cookies, or to alert you when cookies are being sent. If they do so, note that some parts
                of the Site may not function properly.</p>
            <h3>How we use collected information</h3>
            <p>PDFsBOOKS.COM collects and uses Users personal information for the following purposes:</p>
            <ul>
                <li>To improve customer service
                    Your information helps us to more effectively respond to your customer service requests and support
                    needs.</li>
                <li>To personalize user experience
                    We may use information in the aggregate to understand how our Users as a group use the services and
                    resources provided on our Site.</li>
                <li>To administer a content, promotion, survey or other Site feature</li>
                <li>The email address Users provide for order processing, will only be used to send them information and
                    updates pertaining to their order. It may also be used to respond to their inquiries, and/or other
                    requests or questions. If User decides to opt-in to our mailing list, they will receive emails that may
                    include company news, updates, related product or service information, etc. If at any time the User
                    would like to unsubscribe from receiving future emails, we include detailed unsubscribe instructions at
                    the bottom of each email or User may contact us via our Site.</li>
            </ul>
            <h3>How we protect your information</h3>
            <p>We adopt appropriate data collection, storage and processing practices and security measures to protect
                against unauthorized access, alteration, disclosure or destruction of your personal information, username,
                email, transaction information and data stored on our Site.</p>
            <p>Sensitive and private data exchange between the Site and its Users happens over a SSL secured communication
                channel and is encrypted and protected with digital signatures. Our Site is also in compliance with PCI
                vulnerability standards in order to create as secure of an environment as possible for Users.</p>
            <h3>Sharing your personal information</h3>
            <p>We do not sell, trade, or rent Users personal identification information to others. We may share generic
                aggregated demographic information not linked to any personal identification information regarding visitors
                and users with our business partners, trusted affiliates and advertisers for the purposes outlined above.We
                may use third party service providers to help us operate our business and the Site or administer activities
                on our behalf, such as sending out newsletters or surveys. We may share your information with these third
                parties for those limited purposes provided that you have given us your permission.</p>
            <h3>Third party websites</h3>
            <p>Users may find advertising or other content on our Site that link to the sites and services of our partners,
                suppliers, advertisers, sponsors, licensors and other third parties. We do not control the content or links
                that appear on these sites and are not responsible for the practices employed by websites linked to or from
                our Site. In addition, these sites or services, including their content and links, may be constantly
                changing. These sites and services may have their own privacy policies and customer service policies.
                Browsing and interaction on any other website, including websites which have a link to our Site, is sub</p>
            <h3>Advertising</h3>
            <p>Ads appearing on our site may be delivered to Users by advertising partners, who may set cookies. These
                cookies allow the ad server to recognize your computer each time they send you an online advertisement to
                compile non personal identification information about you or others who use your computer. This information
                allows ad networks to, among other things, deliver targeted advertisements that they believe will be of most
                interest to you. This privacy policy does not cover the use of cookies by any advertisers.</p>
            <h3>Google Adsense</h3>
            <p>Some of the ads may be served by Google. Google's use of the DART cookie enables it to serve ads to Users
                based on their visit to our Site and other sites on the Internet. DART uses "non personally identifiable
                information" and does NOT track personal information about you, such as your name, email address, physical
                address, etc. You may opt out of the use of the DART cookie by visiting the Google ad and content network
                privacy policy at <a
                    href="https://www.google.com/privacy_ads.html">https://www.google.com/privacy_ads.html</a></p>
            <h3>Compliance with children's online privacy protection act</h3>
            <p>Protecting the privacy of the very young is especially important. For that reason, we never collect or
                maintain information at our Site from those we actually know are under 13, and no part of our website is
                structured to attract anyone under 13.</p>
            <h3>Changes to this privacy policy</h3>
            <p>PDFsBOOKs.com has the discretion to update this privacy policy at any time. When we do, revise the updated
                date
                at the bottom of this page,. We encourage Users to frequently check this page for any changes to stay
                informed about how we are helping to protect the personal information we collect. You acknowledge and agree
                that it is your responsibility to review this privacy policy periodically and become aware of modifications.
            </p>
            <h3>Your acceptance of these terms</h3>
            <p>By using this Site, you signify your acceptance of this policy and terms of service. If you do not agree to
                this policy, please do not use our Site. Your continued use of the Site following the posting of changes to
                this policy will be deemed your acceptance of those changes.</p>
            <h3>Contacting us</h3>
            <p>
                If you have any questions about this Privacy Policy, the practices of this site, or your dealings with this
                site, please <a href="{{ route('contact') }}">Contact us</a>.
            </p>
        </div>
    </div>
@stop
