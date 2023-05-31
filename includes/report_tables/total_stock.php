<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Type</th>
            <th>Fabriek</th>
            <th>Aantal</th>
            <th>Inkoopprijs</th>
            <th>Verkoopprijs</th>
        </tr>
    </thead>
    <tbody>
        <?php // create's <tr> elements with the report data
            foreach ($_SESSION['report'] as $locationRecord) {
                foreach ($_SESSION['locations'] as $location) {
                    if ($locationRecord[0]['location_id'] === $location['id']) {
                        echo '<tr>';
                            echo '<td class="table-location" colspan="6">'.$location['place_name'].'</td>';
                        echo '</tr>';
                    }
                }
                    
                foreach ($locationRecord as $record) {
                    echo '<tr>';
                        echo '<td>'.$record['p_name'].'</td>';
                        echo '<td>'.$record['type'].'</td>';
                        echo '<td>'.$record['m_name'].'</td>';
                        echo '<td>'.$record['in_stock'].'</td>';
                        echo '<td>€ '.$record['purchase_price'].'</td>';
                        echo '<td>€ '.$record['sell_price'].'</td>';
                    echo '</tr>';
                }
            }
        ?>
    </tbody>
</table>