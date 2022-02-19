@extends('layouts.app')

@section('page_title', 'Free PDFs - DCMA')
@section('page_description', 'DCMA for pdfsbooks.com')
@section('page_url', \Request::fullUrl())
@section('canonical_url', \Request::fullUrl())

@section('content')
    <x-adsense />
    <div class="container my-100 dcma">
        <x-kindle />
        <h1 class="text-center">Disclaimer for PDFsBooks</h1>

        <p>PdfsBooks respects the intellectual property rights of others and expects its users to do the same.</p>
        <p>PDFsBooks will respond expeditiously to claims of copyright infringement committed using the PdfsBooks website.
        </p>
        <p>
            All the information on this website is published in good faith and for general information purpose only.
            PDFsBooks does not make any warranties about the completeness, reliability and accuracy of this information. Any
            action you take upon the information you find on this website (www.pdfsbooks.com), is strictly at your own risk.
            www.pdfsbooks.com will not be liable for any losses and/or damages in connection with the use of PDFsBooks.
        </p>
        <p>
            From PDFsBooks , you can visit other websites by following hyperlinks to such external sites. While we strive to
            provide only quality links to useful and ethical websites, we have no control over the content and nature of
            these sites.
            These links to other websites do not imply a recommendation for all the content found on these sites. Site
            owners and
            content may change without notice and may occur before we have the opportunity to remove a link which may have
            gone ‘bad’.
            On the download page you can find the remote file source url. Please contact them also to remove your
            copyrighted material.
        </p>
        <p>
            Please be also aware that when you leave PDFsBooks , other sites may have different privacy policies and terms
            which are beyond our control. Please be sure to check the Privacy Policies of these sites as well as their
            “Terms of Service” before engaging in any business or uploading any information.
        </p>
        <span>Consent</span>
        <p>By using our website, you hereby consent to our disclaimer and agree to its terms.</p>
        <span>Update</span>
        <p>Should we update, amend or make any changes to this document, those changes will be prominently posted here.</p>
        <div><a href="{{ route('dcma.create') }}" class="btn btn-primary">Submit DCMA Notice</a></div>
    </div>
@stop
