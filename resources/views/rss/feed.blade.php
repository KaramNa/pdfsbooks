<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ Pdfsbooks.com ]]></title>
        <link><![CDATA[ https://pdfsbooks.com/feed ]]></link>
        <description><![CDATA[ Online library for download pdf books for free ]]></description>
        <language>en</language>
        <pubDate>{{ now()->toDayDateTimeString('Asia/Damasucs') }}</pubDate>

        @foreach($books as $book)
            <item>
                <title><![CDATA[{{ $book->title }}]]></title>
                <link>{{ "https://pdfsbooks.com/book/" . $book->slug }}</link>
                <description><![CDATA[{!! $book->description !!}]]></description>
                <category>{{ $book->category }}</category>
                <author><![CDATA[{{ $book->author  }}]]></author>
            </item>
        @endforeach
    </channel>
</rss>