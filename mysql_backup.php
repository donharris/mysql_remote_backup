#!/usr/local/bin/php

<?php
        $dbname = '<your db name>';
        $backup_file = date("Y_m_d") ."_".$dbname.".gz";

        $db_backup = "mysqldump --defaults-extra-file=~/.my.cnf $dbname | gzip > $backup_file";
        system($db_backup);

        $offsite = "rsync -e ssh $backup_file <enter your off-site servername and backup location>";
        system($offsite);
?>
