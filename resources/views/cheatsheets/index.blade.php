@extends('layouts.app')

@section('page_title', 'Free Cheatsheets - Find many cheatsheets in many subjects')
@section('page_description',
    'here you can found thousands of cheatsheets for free, no download limits, no registration
    required',)
@section('canonical_url', \Request::fullUrl())

@section('page_url', \Request::fullUrl())
@section('style')
    <link href="{{ asset('css/cheatsheet.css?v=1') }}" rel="stylesheet">
@stop
@section('content')
    <div class="my-50 container">
        <h1>Over 5,000 Free Cheat Sheets, Revision Aids and Quick References!</h1>
        <x-adsense />
    </div>
    <div class="main-content" id="main-content">
        <div class="cheatsheet filters container">
            <form action="{{ route('cheatsheets.subject') }}" method="get" role="search" class="cs search-form">
                @if (request('subject'))
                    <input type="hidden" name="subject" value="{{ request('subject') }}">
                @endif
                <div class="flex">
                    <input class="search-input" name="cheatsheets_search" autocomplete="off"
                        placeholder="Search for Cheatsheets By Title" type="search"
                        value="{{ request('cheatsheets_search') }}" required><button aria-label="submit"
                        class="search-button" type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill='#FFFFFF'>
                                <path
                                    d="M22.1 20.1l-4.8-4.8C18.4 13.8 19 12 19 10c0-5-4-9-9-9s-9 4-9 9 4 9 9 9c2 0 3.8-.6 5.3-1.7l4.8 4.8c.6.6 1.4.6 2 0 .5-.6.5-1.5 0-2zM10 16.5c-3.6 0-6.5-2.9-6.5-6.5S6.4 3.5 10 3.5s6.5 2.9 6.5 6.5-2.9 6.5-6.5 6.5z">
                                </path>
                            </g>
                        </svg></button>
                </div>
                <div class="flex">
                    <div>
                        <input id="cheatsheets_exact_search" type="checkbox" name="cheatsheets_exact_search"
                            {{ request('cheatsheets_exact_search') == 'on' ? 'checked' : '' }}>
                        <label for="cheatsheets_exact_search"><strong>Exact Search</strong></label>
                    </div>
                </div>
            </form>
            <a href="{{ route('cheatsheets.subject') }}" class="download-button">Clear Filters</a>
        </div>
        <div>
            <div id="cheatsheets" class="container books-filter">
                <div>
                    <h2>CheatSheets Subjects</h2>
                    <div class="category">
                        <div x-data="{ show: false }">
                            <button class="form-control" @click="show = !show" @click.away="show = false"><span
                                    class="me-3">{{ isset($currentSubject) ? Str::headline($currentSubject) : 'All Subjects' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-width="20" height="20">
                                    <g fill='#000'>
                                        <path
                                            d="M18.2 7.6c-.4 0-.7.1-.9.4L13 12.6c-.5.5-1.4.5-1.9 0L6.8 8c-.3-.2-.6-.4-1-.4-1.1 0-1.7 1.3-.9 2.1l6.2 6.8c.5.6 1.4.6 1.9 0l6.2-6.8c.6-.8 0-2.1-1-2.1z">
                                        </path>
                                    </g>
                                </svg>
                            </button>

                            <div x-show="show"
                                class="bg-dark text-white overflow-auto rounded py-3 text-left m-auto mt-2 position-absolute categories-list"
                                style="display: none">
                                <a href="{{ route('cheatsheets.subject') }}">All Subjects</a>
                                @foreach ($subjects as $subject)
                                    <a href="/cheatsheets/?subject={{ $subject->subject_slug }}&{{ http_build_query(request()->except(['subject', 'tag', 'page'])) }}"
                                        class="d-block py-1 px-3 text-start {{ isset($currentSubject) && $currentSubject === Str::lower($subject->subject_slug) ? 'active' : '' }}">{{ Str::headline($subject->subject) }}</a>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                <div>
                    <h2>CheatSheets Tags</h2>
                    <div id="tags" class="tags show-less">
                        @foreach ($tags as $tag)
                            @if ($tag->tag)
                                <a href="/cheatsheets/?tag={{ $tag->tag_slug }}&{{ http_build_query(request()->except(['tag', 'subject', 'search', 'page'])) }}"
                                    class="tag" title="{{ $tag->tag }} cheatsheets">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 442.688 442.688" style="enable-background:new 0 0 442.688 442.688;"
                                        xml:space="preserve" width="15">
                                        <g>
                                            <g>
                                                <path
                                                    d="M442.666,178.822l-4.004-145.078c-0.447-16.222-13.504-29.279-29.727-29.728l-145.08-4.004
                                                                                                                                                                c-8.475-0.237-16.493,2.97-22.468,8.945L8.954,241.391c-11.924,11.924-11.924,31.325,0,43.249l149.083,149.082
                                                                                                                                                                c11.951,11.953,31.296,11.956,43.25,0.001L433.721,201.29C439.636,195.374,442.897,187.184,442.666,178.822z M376.238,139.979
                                                                                                                                                                c-20.323,20.322-53.215,20.324-73.539,0c-20.275-20.275-20.275-53.265,0-73.539c20.323-20.323,53.215-20.324,73.539,0
                                                                                                                                                                C396.512,86.714,396.512,119.704,376.238,139.979z" />
                                            </g>
                                        </g>
                                    </svg> {{ $tag->tag }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div>
                <div class="cheatsheets">
                    @if (count($cheatsheets) > 0)
                        @foreach ($cheatsheets as $cheatsheet)
                            <div class="box">
                                <div class='ribbon-wrapper-4'>
                                    <div class='ribbon-4'>Free</div>
                                </div>
                                <div class="cheatsheet-cover">
                                    <h2 class="cheatsheet-title">{{ $cheatsheet->title }}</p>
                                        <p class="cheatsheet-subtitle">{{ $cheatsheet->subtitle }}</p>
                                </div>
                                <div class="content">
                                    <h5>Subject: <a
                                            href="/cheatsheets/?subject={{ $cheatsheet->subject_slug }}&{{ http_build_query(request()->except(['subject', 'tag', 'page'])) }}">{{ $cheatsheet->subject }}</a>
                                    </h5>
                                    <h5>Tag:
                                        <span class="tags">
                                            <a href="/cheatsheets/?tag={{ $cheatsheet->tag }}&{{ http_build_query(request()->except(['tag', 'subject', 'search', 'page'])) }}"
                                                title="{{ $cheatsheet->title }} cheatsheets">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 442.688 442.688"
                                                    style="enable-background:new 0 0 442.688 442.688;" xml:space="preserve"
                                                    width="15">
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M442.666,178.822l-4.004-145.078c-0.447-16.222-13.504-29.279-29.727-29.728l-145.08-4.004
                                                                                        c-8.475-0.237-16.493,2.97-22.468,8.945L8.954,241.391c-11.924,11.924-11.924,31.325,0,43.249l149.083,149.082
                                                                                        c11.951,11.953,31.296,11.956,43.25,0.001L433.721,201.29C439.636,195.374,442.897,187.184,442.666,178.822z M376.238,139.979
                                                                                        c-20.323,20.322-53.215,20.324-73.539,0c-20.275-20.275-20.275-53.265,0-73.539c20.323-20.323,53.215-20.324,73.539,0
                                                                                        C396.512,86.714,396.512,119.704,376.238,139.979z" />
                                                        </g>
                                                    </g>
                                                </svg>
                                                {{ $cheatsheet->tag }}
                                            </a>
                                        </span>
                                    </h5>
                                    <h5>Language: <a
                                            href="/cheatsheets/?language={{ $cheatsheet->language }}&{{ http_build_query(request()->except(['language', 'page', 'search'])) }}">{{ $cheatsheet->language }}</a>
                                    </h5>
                                    <h5>Date: {{ $cheatsheet->created_at->format('d m Y') }}
                                    </h5>
                                    <h5>Downloads: {{ $cheatsheet->downloads }}
                                    </h5>
                                </div>
                                <a href="{{ route('cheatsheets.cheatsheet', $cheatsheet->slug) }}"
                                    title="Free Download {{ $cheatsheet->title }}">
                                    <div class="info">
                                        <span class="">
                                            Free Download
                                        </span>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                                height="20">
                                                <g fill='#2196f3'>
                                                    <path
                                                        d="M12 4c-.8.8-.8 2.1 0 2.8l3.2 3.2H4c-1.1 0-2 .9-2 2s.9 2 2 2h11.2L12 17.2c-.8.8-.8 2.1 0 2.8.8.8 2 .8 2.8 0l6.6-6.6c.4-.4.6-.9.6-1.4 0-.5-.2-1-.6-1.4L14.8 4c-.7-.8-2-.8-2.8 0z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                </a>

                            </div>
                        @endforeach
                    @else
                        <div class="container no-results">
                            <p class="text-dark mt-3">Sorry, Nothing matches your criteria</p>
                        </div>
                    @endif
                </div>
                {{ $cheatsheets->withQueryString()->links() }}
            </div>
            <x-adsense />

        </div>
    @stop
