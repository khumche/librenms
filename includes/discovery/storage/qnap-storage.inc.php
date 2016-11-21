<?php
if($device['os'] == 'qnap')
{
    $qnap_storage = snmpwalk_cache_oid($device, 'SysVolumeEntryEX', null, 'NAS-MIB');
    if (is_array($qnap_storage)) {
        foreach ($qnap_storage as $index => $storage)
        {
            $fstype = $storage['sysVolumeFSEX'];
            $descr  = preg_replace("/\[|\]/", "", $storage['sysVolumeDescrEX']);
            $units  = 1024;
            $size = ($storage['sysVolumeTotalSizeEX'] * $units);
            $free = ($storage['sysVolumeFreeSizeEX'] * $units);
            $used = $size - $free;
            $status = $storage['sysVolumeStatusEX'];
            if(is_numeric($index))
            {
                discover_storage($valid_storage, $device, $index, $fstype, 'qnap-storage', $descr, $size, $units, $used);
            }

            unset($deny, $fstype, $descr, $size, $used, $units, $storage_rrd, $old_storage_rrd, $hrstorage_array);
            
        }
        


    }
}
