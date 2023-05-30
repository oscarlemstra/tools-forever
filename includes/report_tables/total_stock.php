<table>
    <thead>
        <tr>
            <th>fsfe</th>
            <th>thh6h</th>
            <th>wdvth6</th>
            <th>In ofrfj</th>
        </tr>
    </thead>
    <tbody>
        <?php // create's <tr> elements with the report data
            foreach ($_SESSION['report'] as $report) {
                echo '<tr>';
                foreach ($report as $index => $value) {
                    if (gettype($index) === "string") {
                        echo '<td>'.$value.'</td>';
                    } else {
                        continue;
                    }
                }
                echo '</tr>';
            }
        ?>
    </tbody>
</table>