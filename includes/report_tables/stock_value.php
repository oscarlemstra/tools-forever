<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Type</th>
            <th>Fabriek</th>
            <th>In voorraad</th>
            <th>Prijs</th>
            <th>Waarde inkoop</th>
            <th>Waarde verkoop</th>
        </tr>
    </thead>
    <tbody>
        <?php // create's <tr> elements with the report data
            foreach ($_SESSION['report'] as $locationRecord) {
                foreach ($_SESSION['locations'] as $location) {
                    if ($locationRecord[0]['location_id'] === $location['id']) {
                        echo '<tr>';
                            echo '<td class="table-location" colspan="7">'.$location['place_name'].'</td>';
                        echo '</tr>';
                    }
                }

                foreach ($locationRecord as $record) {
                    echo '<tr>';
                        echo '<td>'.$record['p_name'].'</td>';
                        echo '<td>'.$record['type'].'</td>';
                        echo '<td>'.$record['m_name'].'</td>';
                        echo '<td class="text-align-end">'.$record['in_stock'].'</td>';
                        echo '<td class="text-align-end">€ '.$record['purchase_price'].'</td>';
                        echo '<td class="text-align-end">€ '.$record['total_purchase_price_value'].'</td>';
                        echo '<td class="text-align-end">€ '.$record['total_sell_price_value'].'</td>';
                    echo '</tr>';
                }

                $locationTotalPurchasePriceValue = number_format(array_sum(array_column($locationRecord, "total_purchase_price_value")), 2, '.', '');
                $locationTotalSellPriceValue = number_format(array_sum(array_column($locationRecord, "total_sell_price_value")), 2, '.', '');

                $EndtotalPurchasePriceValues[] = $locationTotalPurchasePriceValue;
                $EndtotalSellPriceValues[] = $locationTotalSellPriceValue;

                echo '<tr>';
                    echo '<td class="text-align-end" colspan="5">Totaal locatie</td>';
                    echo '<td class="text-align-end font-weight-bold">€ '.$locationTotalPurchasePriceValue.'</td>';
                    echo '<td class="text-align-end font-weight-bold">€ '.$locationTotalSellPriceValue.'</td>';
                echo '</tr>';
            }

            $EndtotalPurchasePriceValue = number_format(array_sum($EndtotalPurchasePriceValues), 2, '.', '');
            $EndtotalSellPriceValue = number_format(array_sum($EndtotalSellPriceValues), 2, '.', '');

            echo '<tr>';
                echo '<td class="text-align-end font-weight-bold" colspan="5">Eindtotaal</td>';
                echo '<td class="text-align-end font-weight-bold">€ '.$EndtotalPurchasePriceValue.'</td>';
                echo '<td class="text-align-end font-weight-bold">€ '.$EndtotalSellPriceValue.'</td>';
            echo '</tr>';
        ?>
    </tbody>
</table>