SELECT `User_id`, `KWH`, `Time`, `Diff_no`
FROM `residential electricity`
WHERE Time >= :Start_Date AND Time < :End_Date