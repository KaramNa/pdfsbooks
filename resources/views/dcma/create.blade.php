@extends('layouts.app')

@section('page_title', 'Free PDFs - DCMA Note Submit')
@section('page_description', 'DCMA Note Submit')
@section('page_url', \Request::fullUrl())
@section('canonical_url', \Request::fullUrl())

@section('content')
    <div class="container my-100 dcma">
        <h1>DMCA Notice of Alleged Infringement (&ldquo;<strong>Notice</strong>&rdquo;)</h1>
        <ol>
            <li>
                <p>Identify the copyrighted work that you claim has been infringed, <strong>only 1 work allowed per
                        submission,
                        if there are multiple copyrighted works, the form must be filled separately for each of
                        them.</strong>
                </p>
            </li>
            <li>
                <p>Identify the material or link you claim is infringing (or the subject of infringing activity) and to
                    which
                    access is to be disabled, including at a minimum,<strong> the URL of the link shown on the Site or the
                        exact
                        location where such material may be found.</strong></p>
            </li>
            <li>
                <p>Provide your company affiliation (if applicable), mailing address, telephone number, and, if available,
                    email
                    address.</p>
            </li>
            <li>Include both of the following statements in the body of the Notice:
                <ul>
                    <li>
                        <p>&ldquo;I hereby state that I have a good faith belief that the disputed use of the copyrighted
                            material is not authorized by the copyright owner, its agent, or the law (e.g., as a fair
                            use).&rdquo;</p>
                    </li>
                    <li>
                        <p>&ldquo;I hereby state that the information in this Notice is accurate and, under penalty of
                            perjury,
                            that I am the owner, or authorized to act on behalf of, the owner, of the copyright or of an
                            exclusive right under the copyright that is allegedly infringed.&rdquo;</p>
                    </li>
                </ul>
            </li>
            <li>Provide your full legal name. </li>
        </ol>
        <p class="warning">As a precautionary health measure for our support specialists, we’re operating with a
            limited team. Thanks for your patience, as it may take longer than usual to connect with us.</p>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" onclick="closeDiv(this)">X</button>
            </div>
        @elseif(session()->has('success'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('failed') }}
                <button type="button" class="btn-close" onclick="closeDiv(this)">X</button>
            </div>
        @endif
        <form action="{{ route('dcma.store') }}" method="POST" class="form">
            @csrf
            <div>
                <label for="name"><span class="text-red">*</span> Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter you Name" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="email"><span class="text-red">*</span> Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter you Email" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="infringing_url"><span class="text-red">*</span> Infringing Url</label>
                <input type="url" name="infringing_url" class="form-control"
                    placeholder="Enter the infringing url (The url on pdfsbooks.com)" required>
                @error('url')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="description"><span class="text-red">*</span> Work Description</label>
                <textarea name="description" class="form-control"
                    placeholder="Describe the copyrighted work in full detail, including links to the original work or evidence of source material."
                    required></textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="message"><span class="text-red">*</span> Message</label>
                <textarea name="message" class="form-control" placeholder="Enter a message" required></textarea>
                @error('message')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            @error('g-recaptcha-response')
                <div class="error">{{ $message }}</div>
            @enderror
            <div>
                <button class="btn btn-primary" type="submit">Submit</button>
                {!! ReCaptcha::htmlScriptTagJsApi() !!}
            </div>
        </form>
    </div>
@stop
