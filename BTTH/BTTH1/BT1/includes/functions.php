<?php
function getFlowers() {
    $data = file_get_contents('../includes/flowers.json');
    return json_decode($data, true);
}

function saveFlowers($flowers) {
    file_put_contents('../includes/flowers.json', json_encode($flowers, JSON_PRETTY_PRINT));
}
?>