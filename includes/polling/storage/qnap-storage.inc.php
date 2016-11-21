<?php
if (!is_array($storage_cache['qnap-storage'])) {
    $storage_cache['qnap-storage'] = snmpwalk_cache_oid($device, 'sysVolumeEntryEX', null, 'NAS-MIB');
    d_echo($storage_cache);
}

$entry = $storage_cache['qnap-storage'][$storage[storage_index]];

$storage['units'] = 1024;
$storage['size'] = ($entry['sysVolumeTotalSizeEX']*$storage['units']);
$storage['free'] = ($entry['sysVolumeFreeSizeEX']*$storage['units']);
$storage['used'] = ($storage['size'] - $storage['free']);

