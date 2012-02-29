<?
$LOOKUP_URL = "http://isbndb.com/api/books.xml?";
$LOOKUP_KEY = "58EJBTZO"; // this is Derek Leung's

function info($fisbn, &$isbn10, &$isbn13, &$title, &$title_ext, &$author, &$publisher, $dump = false) {
    global $LOOKUP_URL, $LOOKUP_KEY;
    $full_url = $LOOKUP_URL . "access_key=" . $LOOKUP_KEY . "&index1=isbn&value1=" . $fisbn;
    $contents = file_get_contents($full_url);
    $parser = xml_parser_create();
    xml_parse_into_struct($parser, $contents, $values, $index);
    xml_parser_free($parser);
    $num_results = $values[$index['BOOKLIST'][0]];
    if($num_results == 0) { // bad ISBN
        return false;
    }
    $indx = $index['BOOKDATA'][0];
    $isbn10 = $values[$indx]['attributes']['ISBN'];
    $isbn13 = $values[$indx]['attributes']['ISBN13'];
    $title = $values[$index['TITLE'][0]]['value'];
    $title_ext = $values[$index['TITLELONG'][0]]['value'];
    $author = $values[$index['AUTHORSTEXT'][0]]['value'];
    $publisher = $values[$index['PUBLISHERTEXT'][0]]['value'];
    
    if(!$dump)
        return true;
    print_r($index);
    echo '<br />';
    print_r($values);
    return true;
}
/*
info('0393312836', $is10, $is13, $tit, $ext, $auth, $pub);
echo $is10;
echo '<br />';
echo $is13;
echo '<br />';
echo $tit;
echo '<br />';
echo $ext;
echo '<br />';
echo $auth;
echo '<br />';
echo $pub;
echo '<br />';
*/