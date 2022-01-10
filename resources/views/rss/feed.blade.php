<?=
'<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<rss version="2.0" xmlns:media="http://pdfsbooks.com">
    <channel>
        <title>
            <![CDATA[ Pdfsbooks.com ]]>
        </title>
        <link>
        <![CDATA[ https://pdfsbooks.com/feed ]]>
        </link>
        <description>
            <![CDATA[ Online library for download pdf books for free ]]>
        </description>
        <pubDate>{{ date('r', strtotime($books[0]->created_at)) }}</pubDate>
        <language>en</language>

        @foreach ($books as $book)
            <item>
                <title>
                    <![CDATA[{{ $book->title }}]]>
                </title>
                <link>{{ 'https://pdfsbooks.com/book/' . $book->slug }}</link>
                <description>
                    <![CDATA[{!! $book->description !!}]]>
                </description>
                <category>{{ $book->category }}</category>
                <author>
                    <![CDATA[{{ $book->author }}]]>
                </author>
                <pubDate>{{ date('r', strtotime($book->created_at)) }}</pubDate>
                <media:content url="{{ 'https://pdfsbooks.com' . $book->poster }}" type="image/jpg" />
            </item>
        @endforeach
    </channel>
</rss>
