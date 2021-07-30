<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';


$sql = "select CONCAT(fn.firstName, ' ', fn.middleName, ' ' , fn.lastName) AS fullName, count(ad.accomplishmentdtlId) as total
from fo3Notifier fn 
inner join accomplishment a on a.fo3notifierId = fn.fo3notifierId
inner join accomplishmentdtl ad on ad.accomplishmentId = a.accomplishmentId
GROUP BY CONCAT(fn.firstName, ' ', fn.middleName, ' ' , fn.lastName)"

?>