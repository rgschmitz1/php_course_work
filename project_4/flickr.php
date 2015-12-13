<?php
    require_once('appvars.php');

    // display image
    function display_photo($url, $title, $date)
    {
?>
    <td style="vertical-align:bottom; text-align:center" width="<?= (100 / PHOTOS_PER_ROW) ?>%">
        <a href="<?= $url ?>"><?= $title ?><br />
        <span style="font-size:smaller">Date Updated: <?= $date ?></span><br />
        <img src="<?= $url ?>" height="200" width="200"/></a>
    </td>
<?php
    }

    echo '<div class="container">';

    // Read the XML data into an object
    $xml = simplexml_load_file(FLICKR);

    // Get the photo count from flickr api
    $num_photos_found = count($xml->entry);
    if ($num_photos_found == 0)
    {
        echo '<p>Sorry, no photos were found.</p>';
    }
    else
    {
        echo '<table>';
        $photo_num = 0;
        $photos_in_table = min($num_photos_found, MAX_NUM_PHOTOS);
        while ($photos_in_table > 0 )
        {
            echo '<tr>';
            $item_in_row = 0;
            while (($item_in_row < PHOTOS_PER_ROW) && ($photos_in_table != 0))
            {
                $entry = $xml->entry[$photo_num];
                $photo_num++;
                // Get the photo title
                $title = $entry->title;

                // There are multiple links in array per entry
                $num_links = count($entry->link);
                if ($num_links > 0)
                {
                    // Get the thumbnail image URL
                    $updated_date = $entry->updated;

                    for ($link_num = 0; $link_num < $num_links; $link_num++)
                    {
                        $attrs = $entry->link[$link_num]->attributes();
                        // only the enclosure link contains the full image url
                        if ($attrs['rel'] == 'enclosure')
                        {
                            // Get the photo URL
                            $photo_url = $attrs['href'];

                            // Display the results for this entry
                            display_photo($photo_url, $title, $updated_date);

                            $photo_url = '';
                            $update_date = '';
                            $photos_in_table--;
                            $item_in_row++;
                            break;
                        }
                    }
                }
            }
            echo '</tr>';
        }
        echo '</table>';
    }
    echo '</div>';
?>
