<?php 

// send the right header
header('Content-type: text/xml; charset="utf-8"');

// echo the doctype
echo '<?xml version="1.0" encoding="utf-8"?>';

?>
<!-- generator="<?php echo c::get('blog.feed.generator', 'Kirby') ?>" -->

<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom">

  <channel>
    <title><?php echo xml($blog->title()) ?></title>
    <link><?php echo xml($blog->url()) ?></link>
    <generator><?php echo c::get('blog.feed.generator', 'Kirby') ?></generator>
    <lastBuildDate><?php echo $blog->articles()->first()->date('r') ?></lastBuildDate>
    <atom:link href="<?php echo xml(thisURL()) ?>" rel="self" type="application/rss+xml" />

    <?php if($blog->description() != ''): ?>
    <description><?php echo xml($blog->description()) ?></description>
    <?php endif ?>
  
    <?php foreach($blog->articles() as $article): ?>
    <item>
      <title><?php echo xml($article->title()) ?></title>  
      <link><?php echo xml($article->url()) ?></link>
      <guid><?php echo xml($article->url()) ?></guid>
      <pubDate><?php echo ($article->date() != '') ? $article->date('r') : $article->modified('r') ?></pubDate>  
      <description><![CDATA[<?php echo kirbytext($article->text()) ?>]]></description>      
    </item>
    <?php endforeach ?>
        
  </channel>
</rss>