UPDATE LOW_PRIORITY IGNORE QUICK `users`
SET `country` = 'Ukraine',
    U.city    = 'Kyiv',
    u.id      = MAX(DISTINCT u.id) + 1
WHERE a > 1
  AND (b > 3 OR a IN (1, 2, 3))
  AND z <> MIN(U.id)
  AND u.id < 100
  AND u.create >= 1000000
  AND u.login_cnt > 10 + 20 * SUM(u.test) / 2 + 1
  AND (u.name > 3 OR gateway NOT LIKE '%pay-gw%' AND u.name LIKE 'test')
  AND (activities.orderby = 1 AND activities.starttime >= '2013-08-26 04:00:00' AND
       activities.endtime <= '2013-08-27 04:00:00' OR
       activities.orderby <> 1 AND activities.activitydate = '2013-08-26')
  AND (1 <> 1 OR 2 >= 1)
ORDER BY activitytypes.orderby ASC, activities.starttime ASC
