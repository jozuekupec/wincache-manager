<?php declare(strict_types=1);

echo "<h1>Data stored in WinCache:</h1>";

/** Cache info */
$memcacheInfo = wincache_ucache_meminfo();

$cacheInfoTable = '<table class="cache-table"><tr>' .
    '<th>Info</th>' .
    '<th>Hodnota</th>' .
    '</tr>';
foreach ($memcacheInfo as $key => $value) {
    $cacheInfoTable .= '<tr>' .
        '<td>' . $key . '</td>' .
        '<td>' . $value . '</td>' .
        '</tr>';
}
$cacheInfoTable .= '</table>';


/** Cache data  */

$winCacheStoredData = wincache_ucache_info();
if (!($winCacheStoredData && isset($winCacheStoredData['ucache_entries']))) {
    echo "<b>NO STORED DATA IN CACHE!</b>";
    return;
}

$cacheDataTable = '<table class="cache-table"><tr>' .
    '<th>Klíč</th>' .
    '<th>Hodnota</th>' .
    '<th>Session</th>' .
    '<th>TTL (seconds)</th>' .
    '<th>AGE (seconds)</th>' .
    '<th>HitCount</th>' .
    '</tr>';
foreach ($winCacheStoredData['ucache_entries'] as $winCacheStoredRecord) {
    $cacheDataTable .= '<tr>' .
        '<td>' . $winCacheStoredRecord['key_name'] . '</td>' .
        '<td>' . $winCacheStoredRecord['value_type'] . '</td>' .
        '<td>' . ($winCacheStoredRecord['ttl_seconds'] ? 'TRUE' : 'FALSE') . '</td>' .
        '<td>' . $winCacheStoredRecord['age_seconds'] . '</td>' .
        '<td>' . $winCacheStoredRecord['hitcount'] . '</td>' .
        '</tr>';
}

$cacheDataTable .= '</table>';


// Table style
$style = '
<style>
    .cache-table tr th, .cache-table tr td {
        padding: .6rem 2.2rem;
    }

    .cache-table {
        border: 1px solid lightgray;
        margin: 1rem 0;
    }

    .cache-table tr:first-child {
        background: rgb(250, 235, 215);
    }
   
    .cache-table tr:not(:first-child):hover {
        background: rgba(250,235,215,0.87);
    }
</style>';

// Use style
echo $style;

// Print info table to output
echo "<h3>Cache info:</h3>";
echo $cacheInfoTable;

echo "<hr>";

// Print data table to output
echo "<h3>Cache data:</h3>";
echo $cacheDataTable;