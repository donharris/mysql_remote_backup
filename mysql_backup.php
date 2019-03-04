#!/usr/local/bin/php

<?php
        # Enter the name of your database to be backed up, which will in turn set the time/date named backup file.
        $dbname = '<your db name>';
        $backup_file = date("Y_m_d") ."_".$dbname.".gz";

        # Actually perform the database backup. The database backup will be dumped into the local directory, 
        #   ensure you have the necessary disk space, or move it to a different directory
        $db_backup = "mysqldump --defaults-extra-file=~/.my.cnf $dbname | gzip > $backup_file";
        system($db_backup);

        # Push the backup offsite via rsync.
        # <enter your off-site servername and backup location> should be something like: $server_name:/backup_location
        # Use ssh keys for unauthenticated login/rsync
        $offsite = "rsync -e ssh $backup_file <enter your off-site servername and backup location>";
        system($offsite);
?>
