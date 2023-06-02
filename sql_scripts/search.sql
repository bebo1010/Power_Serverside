SELECT `Serial_no`, `Date`, `KWH`, `Use environment`
FROM `electricity record`
WHERE `Date` >= :Start_Date AND `Date` < :End_Date AND `Use environment` = :Environment;
